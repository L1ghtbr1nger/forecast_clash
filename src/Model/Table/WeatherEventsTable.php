<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WeatherEvents Model
 *
 * @property \Cake\ORM\Association\HasMany $Forecasts
 * @property \Cake\ORM\Association\HasMany $HistoricalForecasts
 * @property \Cake\ORM\Association\HasMany $WeatherStatistics
 *
 * @method \App\Model\Entity\WeatherEvent get($primaryKey, $options = [])
 * @method \App\Model\Entity\WeatherEvent newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\WeatherEvent[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\WeatherEvent|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\WeatherEvent patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\WeatherEvent[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\WeatherEvent findOrCreate($search, callable $callback = null)
 */
class WeatherEventsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('weather_events');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('Forecasts', [
            'foreignKey' => 'weather_event_id'
        ]);
        $this->hasMany('HistoricalForecasts', [
            'foreignKey' => 'weather_event_id'
        ]);
        $this->hasMany('WeatherStatistics', [
            'foreignKey' => 'weather_event_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('weather', 'create')
            ->notEmpty('weather');

        return $validator;
    }
}
