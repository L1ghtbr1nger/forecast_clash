<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HistoricalForecasts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $WeatherEvents
 * @property \Cake\ORM\Association\BelongsTo $AdminEvents
 *
 * @method \App\Model\Entity\HistoricalForecast get($primaryKey, $options = [])
 * @method \App\Model\Entity\HistoricalForecast newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\HistoricalForecast[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\HistoricalForecast|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HistoricalForecast patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\HistoricalForecast[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\HistoricalForecast findOrCreate($search, callable $callback = null)
 */
class HistoricalForecastsTable extends Table
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

        $this->table('historical_forecasts');
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
        $this->belongsTo('AdminEvents', [
            'foreignKey' => 'admin_event_id'
        ]);
        
        $this->hasMany('TeamsUsers', [
            'foreignKey' => [
                'user_id'
            ],
            'bindingKey' => [
                'user_id'
            ]
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
            ->numeric('latitude')
            ->requirePresence('latitude', 'create')
            ->notEmpty('latitude');

        $validator
            ->numeric('longitude')
            ->requirePresence('longitude', 'create')
            ->notEmpty('longitude');

        $validator
            ->integer('radius')
            ->requirePresence('radius', 'create')
            ->notEmpty('radius');

        $validator
            ->date('forecast_date')
            ->requirePresence('forecast_date', 'create')
            ->notEmpty('forecast_date');

        $validator
            ->boolean('am_pm')
            ->requirePresence('am_pm', 'create')
            ->notEmpty('am_pm');

        $validator
            ->integer('forecast_length')
            ->requirePresence('forecast_length', 'create')
            ->notEmpty('forecast_length');

        $validator
            ->boolean('correct')
            ->allowEmpty('correct');

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
        $rules->add($rules->existsIn(['admin_event_id'], 'AdminEvents'));

        return $rules;
    }
}
