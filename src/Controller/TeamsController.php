<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Collection\Collection;
use Cake\Routing\Router;

/**
 * Teams Controller
 *
 * @property \App\Model\Table\TeamsTable $Teams
 */
class TeamsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $teams = $this->paginate($this->Teams);

        $this->set(compact('teams'));
        $this->set('_serialize', ['teams']);
    }
    
    public function dugout() { //view creator for the team index page dugout
        $session = $this->request->session();
        $userID = $session->read('Auth.User.id');
        $teamsUsers = TableRegistry::get('TeamsUsers');
        $users = TableRegistry::get('Users');
        $userTeam = $users->find()->where(['id' => $userID])->contain('Teams')->first(); //look for user's team
        $teamRankings = TableRegistry::get('Scores')->find('all')->contain(['TeamsUsers' => ['Teams']])->order('Teams.id');
        if($teamRanking = $teamRankings->toArray()) {
            $teamScore = [];
            $tempID = 0; //team ids start at 1
            foreach ($teamRanking as $teamRank) {
                $team_id = $teamRank['teams_user']['team_id']; //get the team_id of the selected user's score
                $team_name = $teamRank['teams_user']['team']['team_name']; //get the name of the selected team
                $score = $teamRank['total_score']; //set temporary score equal to score of selected user
                if ($team_id === $tempID) { //if current selected user has same team as previous selected user
                    $teamScore[$team_id]['team_score'] += $score; //add selected user's score to selected team's score
                    $teamScore[$team_id]['roster']++;
                } else { //if not
                    $tempID = $team_id; //set tempID to that of selected team
                    $teamScore[$team_id] = ['team_id' => $team_id, 'team_name' => $team_name, 'team_score' => $score, 'roster' => 1]; //move to team's array key
                }
            }
            $collection = new Collection($teamScore);
            $rankedScores = $collection->sortBy('team_score')->toArray(); //sort the new team array by score
            $rank = 0;
            $count = 0;
            $tempScore = -1;
            foreach ($rankedScores as $rs) { //go through sorted team list and rank, accounting for ties
                $rank++;
                if ($rs['team_score'] === $tempScore) {
                    $rank--;
                    $count++;
                } else {
                    $rank += $count;
                    $count = 0;
                    $tempScore = $rs['team_score'];
                }
                $rs['rank'] = $rank;
                $rankScore[] = $rs;
            }
            $this->set('rankResult', true);
            $this->set('rankings', $rankScore);
        } else {
            $this->set('rankResult', false);
        }
        if (!empty($userTeam['teams'])) { //if user has team
            $teamID = $userTeam['teams'][0]['id'];
            $teammates = $this->Teams->find('all')->where(['id' => $teamID])->contain([
                'Users'=> function($q) {
                    return $q->order('Users.first_name')->contain('Scores');
                }
            ])->toArray();
            $this->set('teammates', $teammates);
            $total = 0;
            foreach ($teammates as $teammate) {
                foreach ($teammate['users'] as $user) {
                    if (isset($user['scores']) && !empty($user['scores'])) {
                        $total += $user['scores'][0]['total_score'];
                    }
                }
            }
            $this->set('total', $total);
            if ($userID === $userTeam['teams'][0]['user_id']) {
                $this->set('captain', true);
            } else {
                $this->set('captain', false);
            }
            $this->set('hasTeam', true);
            $this->set('data', $userTeam);
            $url = Router::url([
                'controller' => 'TeamsUsers',
                'action' => 'waiver',
                'q' => $teamID,
                'z' => $userID
            ], true);
            $this->set('url', $url);
        } else {
            $this->set('hasTeam', false);
        }
    }
    
    public function typer() { //predictive list from search box
        if ($this->request->is('ajax')) {
            $data = $this->request->data;
            $teams = $this->Teams->find()->where(['team_name LIKE' => $data['letters'].'%'])->limit(10)->order('team_name');
            if ($team = $teams->toArray()) {
                foreach ($team as $t) {
                   $t['team_name'] = h($t['team_name']); 
                }
                echo json_encode(['result' => 1, 'team_data' => $team]);
                die;
            } else {
                echo json_encode(['result' => 0]);
                die;
            }
        }
    }
    
    public function creator() { //function to save new row to Teams
        $url = Router::url(['controller' => 'Teams', 'action' => 'dugout'], TRUE);
        if ($this->request->is('ajax')) {
            $data = $this->request->data;
            $session = $this->request->session();
            $userID = $session->read('Auth.User.id');
            $team = $this->Teams->newEntity();
            $teamName = $data['team_name'];
            $team->team_name = $teamName;
            $team->privacy = $data['privacy'];
            $team->user_id = $userID;
            //check for valid file, move file to server, save file name with extension to DB
            if (!empty($data['team_logo']) && isset($data['team_logo']) && $data['team_logo'] != 'undefined') {
                $file = $data['team_logo']; //put the data into a var for easy use
                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                $arr_ext = array('jpg', 'jpeg', 'gif', 'png'); //set allowed extensions
                $setNewFileName = time() . "_" . rand(000000, 999999);
                if (in_array($ext, $arr_ext)) { //only process if the extension is valid
                    //do the actual uploading of the file. First arg is the tmp name, second arg is where we are putting it
                    move_uploaded_file($file['tmp_name'], WWW_ROOT . '/img/teams/users/' . $setNewFileName . '.' . $ext);
                    $imageFileName = $setNewFileName . '.' . $ext; //prepare the filename for database entry
                }
                $team->team_logo = $imageFileName;
            }
            if ($teamID = $this->Teams->save($team)) { //if new team saved successfully, assign creating user to the team in TeamsUsers
                $teamUsers = TableRegistry::get('TeamsUsers');
                $teamUser = $teamUsers->newEntity();
                $teamUser->user_id = $userID;
                $teamUser->team_id = $teamID->id;
                if ($teamUsers->save($teamUser)) {
                    $notices = TableRegistry::get('Notifications');
                    $notice = $notices->newEntity();
                    $notice = $notices->patchEntity($notice, [
                        'user_id' => $userID,
                        'message' => 'You have created a team and become its captain! Visit the '.h($teamName).' Dugout.',
                        'link_address' => '/forecast_clash/teams/dugout',
                        'link_image' => 'teams/users/'.(isset($imageFileName) ? $imageFileName : 'logo-mark.png')
                    ]);
                    $notices->save($notice);
                    $session->write('successBox', 'Team successfully created!');
                    $session->delete('errorBox');
                } else {
                    $session->write('errorBox', 'Error adding you to your roster.');
                }
            } else {
                $session->write('errorBox', 'Unable to create team at this time.');
            }
            echo json_encode(['url' => $url]);
            die;
        }
    }
    
    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
    }
}
