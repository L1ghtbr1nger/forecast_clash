<?php
namespace App\Shell;

use Cake\Console\Shell;

class LockerShell extends Shell
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Statistics');
    }
    
    public function main() {
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
?>