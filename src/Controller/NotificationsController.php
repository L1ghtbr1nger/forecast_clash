<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Notifications Controller
 *
 * @property \App\Model\Table\NotificationsTable $Notifications
 */
class NotificationsController extends AppController
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
        $notifications = $this->paginate($this->Notifications);

        $this->set(compact('notifications'));
        $this->set('_serialize', ['notifications']);
    }
    
    public function notifier() {
        if ($this->request->is('ajax')) {
            $data = $this->request->data;
            if ($data['id'] != 'guest') {
                $notice = $this->Notifications->get($data['id']);
                $notice->seen = 1;
                $this->Notifications->save($notice);
            }
        }
    }
    
    public function deleter() {
        $session = $this->request->session();
        if ($userID = $session->read('Auth.User.id')) {
            $data = $this->request->data;
            if ($data['toDismiss']) {
                $notices = $this->Notifications->deleteAll(['user_id' => $userID]);
            } else {
                $notices = $this->Notifications->deleteAll(['user_id' => $userID, 'seen' => 1]);
            } 
        }
    }
}
