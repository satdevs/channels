<?php
// Baked at 2021.11.04. 10:09:53
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Packagegroups Model
 *
 * @method \App\Model\Entity\Packagegroup newEmptyEntity()
 * @method \App\Model\Entity\Packagegroup newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Packagegroup[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Packagegroup get($primaryKey, $options = [])
 * @method \App\Model\Entity\Packagegroup findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Packagegroup patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Packagegroup[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Packagegroup|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Packagegroup saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Packagegroup[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Packagegroup[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Packagegroup[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Packagegroup[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PackagegroupsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('packagegroups');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Packages', [
            'foreignKey' => 'packagegroup_id',
        ]);
        //$this->hasMany('PackagesProgramsAnalogs', [	T??r??lve
        //    'foreignKey' => 'packagegroup_id',
        //]);
        //$this->hasMany('PackagesProgramsDigitals', [	T??r??lve
        //    'foreignKey' => 'packagegroup_id',
        //]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 200)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->boolean('visible')
            ->requirePresence('visible', 'create')
            ->notEmptyString('visible');

        $validator
            ->integer('pos')
            ->requirePresence('pos', 'create')
            ->notEmptyString('pos');

        return $validator;
    }
}
