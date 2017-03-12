<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Weatherstatistics Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $WeatherEvents
 *
 * @method \App\Model\Entity\Weatherstatistic get($primaryKey, $options = [])
 * @method \App\Model\Entity\Weatherstatistic newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Weatherstatistic[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Weatherstatistic|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Weatherstatistic patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Weatherstatistic[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Weatherstatistic findOrCreate($search, callable $callback = null)
 */
class WeatherstatisticsTable extends Table
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

        $this->table('weatherstatistics');
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
        
        $this->hasMany('Scores', [
            'foreignKey' => [
                'user_id'
            ],
            'bindingKey' => [
                'user_id'
            ]
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
            ->integer('attempts')
            ->requirePresence('attempts', 'create')
            ->notEmpty('attempts');

        $validator
            ->integer('valid_attempts')
            ->requirePresence('valid_attempts', 'create')
            ->notEmpty('valid_attempts');

        $validator
            ->integer('radius')
            ->requirePresence('radius', 'create')
            ->notEmpty('radius');

        $validator
            ->integer('forecast_length')
            ->requirePresence('forecast_length', 'create')
            ->notEmpty('forecast_length');

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
