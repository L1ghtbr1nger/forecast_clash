<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BadgesUsers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Badges
 *
 * @method \App\Model\Entity\BadgesUser get($primaryKey, $options = [])
 * @method \App\Model\Entity\BadgesUser newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BadgesUser[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BadgesUser|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BadgesUser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BadgesUser[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BadgesUser findOrCreate($search, callable $callback = null)
 */
class BadgesUsersTable extends Table
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

        $this->table('badges_users');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Badges', [
            'foreignKey' => 'badge_id',
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
            ->integer('badge_count')
            ->allowEmpty('badge_count');

        $validator
            ->integer('silver')
            ->requirePresence('silver', 'create')
            ->notEmpty('silver');

        $validator
            ->integer('gold')
            ->requirePresence('gold', 'create')
            ->notEmpty('gold');

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
        $rules->add($rules->existsIn(['badge_id'], 'Badges'));

        return $rules;
    }
}