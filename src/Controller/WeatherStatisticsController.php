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
    
    public function scores($scores, $userID) { //function to grab separate data collected from DB and do some calculations on them before returning new data
        $rank = 0;
        $tempScore = -1;
        $count = 0;
        $leads = false;
        foreach($scores as $score) {
            $rank++; //simple counter to show rank
            $user = $score['user'];
            if ($userID == $user['id']) {
                $leads = true;
            }
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
            $entry = ['rank' => $rank, 'user_id' => $user['id'], 'first_name' => h($user['first_name']), 'last_name' => h($user['last_name']), 'score' => $score['total_score']]; //building arrays of data for the view to put in multi-dimensional array
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
            return [$result, $data, $leads];
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
        $users = TableRegistry::get('Users');
        $teamUser = $users->find()->where(['id' => $userID])->contain('Teams')->first(); //look for user's team
        $scoreboard = TableRegistry::get('Scores');
        $scores = $scoreboard->find('all')->order(['Scores.total_score' => 'DESC'])->limit(20)->contain('WeatherStatistics.WeatherEvents');
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
            $results = $this->scores($scores, $userID);
            $result = $results[0];
            if ($result) { //if yes
                $board = $results[1]; //grab the result data
                if (!$results[2]) {
                    if ($userID) {
                        $scorez = $scoreboard->find('all')->where(['user_id' => $userID])->contain('WeatherStatistics.WeatherEvents');
                        if ($scorez->toArray()) {
                            $results = $this->scores($scorez, $userID);
                            $board[] = $results[1];
                        } else {
                            $currentUser = $users->find()->where(['id' => $userID])->first();
                            $board[] = [
                                'rank' => '...',
                                'user_id' => $userID,
                                'first_name' => $currentUser['first_name'],
                                'last_name' => $currentUser['last_name'],
                                'score' => 0,
                                'total' => 0
                            ];
                        }
                    }
                } else {
                    $board = [0];
                }
            }
            echo json_encode(['result' => $result, 'leaderboard' => $board, 'user_id' => $userID]); //leaderboard.js
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
            $results = $this->scores($scores, $userID); //save results of scores function which grabs the data from each found row
            $result = $results[0]; //were any rows found
            $this->set('result', $result); //tell the view
            if ($result) { //if yes
                $board = $results[1]; //grab the result data
                if (!$results[2]) {
                    if ($userID) {
                        $scorez = $scoreboard->find('all')->where(['user_id' => $userID])->contain('WeatherStatistics.WeatherEvents');
                        if ($scorez->toArray()) {
                            $results = $this->scores($scorez, $userID);
                            $board[] = $results[1];
                        } else {
                            $board[] = [
                                'rank' => '...',
                                'user_id' => $userID,
                                'first_name' => $currentUser['first_name'],
                                'last_name' => $currentUser['last_name'],
                                'score' => 0,
                                'total' => 0
                            ];
                        }
                    }
                }
                $this->set('leaderboard', $board); //share with view
            }
        }   
    }
    
    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow();

    }
}
