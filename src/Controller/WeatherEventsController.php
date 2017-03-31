<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * WeatherEvents Controller
 *
 * @property \App\Model\Table\WeatherEventsTable $WeatherEvents
 */
class WeatherEventsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $weatherEvents = $this->paginate($this->WeatherEvents);

        $this->set(compact('weatherEvents'));
        $this->set('_serialize', ['weatherEvents']);
    }
}
