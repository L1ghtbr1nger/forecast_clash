<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * WeatherStatistics Controller
 *
 * @property \App\Model\Table\WeatherStatisticsTable $WeatherStatistics
 */
class WeatherStatisticsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'WeatherEvents']
        ];
        $weatherStatistics = $this->paginate($this->WeatherStatistics);

        $this->set(compact('weatherStatistics'));
        $this->set('_serialize', ['weatherStatistics']);
    }

    /**
     * View method
     *
     * @param string|null $id Weather Statistic id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $weatherStatistic = $this->WeatherStatistics->get($id, [
            'contain' => ['Users', 'WeatherEvents']
        ]);

        $this->set('weatherStatistic', $weatherStatistic);
        $this->set('_serialize', ['weatherStatistic']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $weatherStatistic = $this->WeatherStatistics->newEntity();
        if ($this->request->is('post')) {
            $weatherStatistic = $this->WeatherStatistics->patchEntity($weatherStatistic, $this->request->data);
            if ($this->WeatherStatistics->save($weatherStatistic)) {
                $this->Flash->success(__('The weather statistic has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The weather statistic could not be saved. Please, try again.'));
            }
        }
        $users = $this->WeatherStatistics->Users->find('list', ['limit' => 200]);
        $weatherEvents = $this->WeatherStatistics->WeatherEvents->find('list', ['limit' => 200]);
        $this->set(compact('weatherStatistic', 'users', 'weatherEvents'));
        $this->set('_serialize', ['weatherStatistic']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Weather Statistic id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $weatherStatistic = $this->WeatherStatistics->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $weatherStatistic = $this->WeatherStatistics->patchEntity($weatherStatistic, $this->request->data);
            if ($this->WeatherStatistics->save($weatherStatistic)) {
                $this->Flash->success(__('The weather statistic has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The weather statistic could not be saved. Please, try again.'));
            }
        }
        $users = $this->WeatherStatistics->Users->find('list', ['limit' => 200]);
        $weatherEvents = $this->WeatherStatistics->WeatherEvents->find('list', ['limit' => 200]);
        $this->set(compact('weatherStatistic', 'users', 'weatherEvents'));
        $this->set('_serialize', ['weatherStatistic']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Weather Statistic id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $weatherStatistic = $this->WeatherStatistics->get($id);
        if ($this->WeatherStatistics->delete($weatherStatistic)) {
            $this->Flash->success(__('The weather statistic has been deleted.'));
        } else {
            $this->Flash->error(__('The weather statistic could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function scores($scores) { //function to grab separate data collected from DB and do some calculations on them before returning new data
        $rank = 0;
        $tempScore = -1;
        $count = 0;
        foreach($scores as $score) {
            $rank++; //simple counter to show rank
            $user = $score['user'];
            $weatherStats = $score['weather_statistics'];
            if (isset($score['scores'])) {
                $score = $score['scores'][0];
            }
            if ($tempScore === $score['total_score']) {
                $rank--;
                $count++;
            } else {
                $rank += $count;
                $count = 0;
                $tempScore = $score['total_score'];
            }
            $entry = ['rank' => $rank, 'user_id' => $user['id'], 'first_name' => $user['first_name'], 'last_name' => $user['last_name'], 'score' => $score['total_score']]; //building arrays of data for the view to put in multi-dimensional array
            $totalAttempts = 0;
            $totalValid = 0;
            foreach ($weatherStats as $stat) { //calculate percentages for each weather event and total
                $attempts = $stat['attempts'];
                $valid = $stat['valid_attempts'];
                $totalAttempts += $attempts;
                $totalValid += $valid;
                $percent = $valid / $attempts * 100;
                $entry[$stat['weather_event']['weather']] = (float) $percent;
            }
            $percent = $totalValid / $totalAttempts * 100;
            $entry['total'] = $percent;
            $data[] = $entry;
        }
        if ($rank === 0) {
            $result = 0;
            return [$result];
        } else {
            $result = 1;
            return [$result, $data];
        }
    }
    
    public function meteor($x, $exp) {
        return $x->contain([
            'Users' => function($q) use($exp) {
                switch($exp) {
                    case 3: //amateur:deselected meteorologist:deselected
                        $q = $q->where(['Users.meteorologist' => null]);
                        break;
                    case 2: //amateur:selected meteorologist:selected
                        break;
                    case 1: //amateur:unselected meteorologist:selected
                        $q = $q->where(['Users.meteorologist' => 1]);
                        break;
                    case 0: //amateur:selected meteorologist:unselected
                        $q = $q->where(['Users.meteorologist' => 0]);
                        break;
                }
                return $q;
            }
        ]);
    }
    
    public function stats() {
        $session = $this->request->session();
        $userID = $session->read('Auth.User.id');
        $teamsUsers = TableRegistry::get('TeamsUsers');
        $users = TableRegistry::get('Users');
        $teamUser = $users->find()->where(['id' => $userID])->contain('Teams')->first(); //look for user's team
        $scoreboard = TableRegistry::get('Scores');
        $scores = $scoreboard->find('all')->order(['Scores.total_score' => 'DESC'])->limit(20)->contain(['WeatherStatistics' => ['WeatherEvents']]);
        if ($this->request->is('ajax')) {
            $data = $this->request->data;
            $exp = intval($data['experience']); //leaderboard experience filter
            $players = intval($data['players']); //leaderboard tabs
            if (!$players) { //if team tab clicked
                $scores = $scores->matching('Users.Teams', function($q) use($teamUser) {
                    return $q->where(['Teams.id' => $teamUser['teams'][0]['id']]);
                });
            }
            $scores = $this->meteor($scores, $exp);
            $results = $this->scores($scores);
            $result = $results[0];
            ($result) ? $board = $results[1] : $board = [0];
            echo json_encode(['result' => $result, 'leaderboard' => $board, 'user_id' => $userID]);
            die;
        } else {
            if ($teamUser) { //check if team was found
                $this->set('teamResult', 1); //user has team
                $this->set('teamUser', $teamUser); //save user's team info for view
            } else {
                $this->set('teamResult', 0); //user does not have team
            }
            $users = TableRegistry::get('Users'); //get info about logged user
            if ($currentUser = $users->find()->where(['id' => $userID])->first()) { //if logged in user
                $this->set('user', $currentUser); //save user info for view
            } else {
                $this->set('user', null);
            }
            $scores = $scores->contain(['Users']); //get top 20 scores with default filters
            $results = $this->scores($scores); //save results of scores function which grabs the data from each found row
            $result = $results[0]; //were any rows found
            $this->set('result', $result); //tell the view
            if ($result) { //if yes
                $board = $results[1]; //grab the result data
                $this->set('leaderboard', $board); //share with view
            }
        }   
    }
    
    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow();

    }
}
