<?php
namespace App\Shell;

use Cake\Console\Shell;

class ClearShell extends Shell
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Notifications');
    }
    
    public function main() {
        $query = $this->Notifications->deleteAll(['read' => 1]); //find all read notifications
    }
}
?>