<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Scores Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Score get($primaryKey, $options = [])
 * @method \App\Model\Entity\Score newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Score[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Score|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Score patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Score[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Score findOrCreate($search, callable $callback = null)
 */
class ScoresTable extends Table
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

        $this->table('scores');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        
        $this->hasMany('WeatherStatistics', [
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
            ->numeric('total_score')
            ->requirePresence('total_score', 'create')
            ->notEmpty('total_score');

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

        return $rules;
    }
}
