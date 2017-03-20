<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Forecasts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $WeatherEvents
 *
 * @method \App\Model\Entity\Forecast get($primaryKey, $options = [])
 * @method \App\Model\Entity\Forecast newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Forecast[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Forecast|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Forecast patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Forecast[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Forecast findOrCreate($search, callable $callback = null)
 */
class ForecastsTable extends Table
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

        $this->table('forecasts');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('WeatherEvents', [
            'foreignKey' => 'weather_event_id',
            'joinType' => 'INNER'
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
            ->dateTime('submit_date')
            ->allowEmpty('submit_date');

        $validator
            ->date('forecast_date')
            ->requirePresence('forecast_date', 'create')
            ->notEmpty('forecast_date', 'Please select a Forecast Date');

        $validator
            ->boolean('am_pm')
            ->requirePresence([
                'am_pm' => [
                    'mode' => 'create',
                    'message' => 'Please select the time of day for your forecast'
                ]
            ])
            ->notEmpty('am_pm', 'Please select the time of day for your forecast');

        $validator
            ->integer('radius')
            ->requirePresence('radius', 'create')
            ->notEmpty('radius');
        
        $validator
            ->integer('weather_event_id')
            ->requirePresence([
                'weather_event_id' => [
                    'mode' => 'create',
                    'message' => 'Please select the icon for the weather event you are forecasting'
                ]
            ])
            ->notEmpty('weather_event_id', 'Please select the icon for the weather event you are forecasting');

        $validator
            ->numeric('latitude')
            ->requirePresence([
                'latitude' => [
                    'mode' => 'create',
                    'message' => 'Please select a point on the map'
                ]
            ])
            ->notEmpty('latitude', 'Please select a point on the map');

        $validator
            ->numeric('longitude')
            ->allowEmpty('longitude');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['weather_event_id'], 'WeatherEvents'));

        return $rules;
    }
}
