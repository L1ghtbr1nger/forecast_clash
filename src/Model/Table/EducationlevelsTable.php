<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EducationLevels Model
 *
 * @property \Cake\ORM\Association\HasMany $Profiles
 *
 * @method \App\Model\Entity\EducationLevel get($primaryKey, $options = [])
 * @method \App\Model\Entity\EducationLevel newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EducationLevel[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EducationLevel|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EducationLevel patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EducationLevel[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EducationLevel findOrCreate($search, callable $callback = null)
 */
class EducationLevelsTable extends Table
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

        $this->table('education_levels');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('Profiles', [
            'foreignKey' => 'education_level_id'
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
            ->requirePresence('education', 'create')
            ->notEmpty('education');

        return $validator;
    }
}
