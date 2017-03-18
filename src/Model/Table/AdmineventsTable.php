<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AdminEvents Model
 *
 * @property \Cake\ORM\Association\HasMany $HistoricalForecasts
 *
 * @method \App\Model\Entity\AdminEvent get($primaryKey, $options = [])
 * @method \App\Model\Entity\AdminEvent newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AdminEvent[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AdminEvent|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AdminEvent patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AdminEvent[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AdminEvent findOrCreate($search, callable $callback = null)
 */
class AdminEventsTable extends Table
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

        $this->table('admin_events');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('HistoricalForecasts', [
            'foreignKey' => 'admin_event_id'
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
            ->dateTime('start_date')
            ->requirePresence('start_date', 'create')
            ->notEmpty('start_date');

        $validator
            ->dateTime('end_date')
            ->requirePresence('end_date', 'create')
            ->notEmpty('end_date');

        $validator
            ->integer('multiplier')
            ->requirePresence('multiplier', 'create')
            ->notEmpty('multiplier');

        return $validator;
    }
}
