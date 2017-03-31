<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Statistics Controller
 *
 * @property \App\Model\Table\StatisticsTable $Statistics
 */
class StatisticsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $statistics = $this->paginate($this->Statistics);

        $this->set(compact('statistics'));
        $this->set('_serialize', ['statistics']);
    }
    
    public function stats() {
        $query = $this->Statistics->find('all');
        foreach ($query as $row) {
            if($row['active']) {
                $currentStreak = $row['current_streak'] + 1;
                $row->current_streak = $currentStreak;
                $highStreak = $row['highest_streak'];
                if ($currentStreak > $highStreak) {
                    $row->highest_streak = $currentStreak;
                }
                $row->active = 0;
            } else {
                $row->current_streak = 0;
            }
            $this->Statistics->save($row);
        }
    }
}
