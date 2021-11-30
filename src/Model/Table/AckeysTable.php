<?php
// Baked at 2021.10.29. 08:06:17
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ackeys Model
 *
 * @property \App\Model\Table\VersionsTable&\Cake\ORM\Association\BelongsTo $Versions
 * @property \App\Model\Table\PackagesProgramsDigitalsTable&\Cake\ORM\Association\HasMany $PackagesProgramsDigitals
 *
 * @method \App\Model\Entity\Ackey newEmptyEntity()
 * @method \App\Model\Entity\Ackey newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Ackey[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ackey get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ackey findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Ackey patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ackey[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ackey|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ackey saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ackey[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ackey[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ackey[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ackey[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AckeysTable extends Table
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

        $this->setTable('ackeys');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        //$this->belongsTo('Versions', [
        //    'foreignKey' => 'version_id',
        //    'joinType' => 'INNER',
        //]);
		
        $this->hasMany('PackagesProgramsDigitals', [
            'foreignKey' => 'ackey_id',
        ]);
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
            ->maxLength('name', 250)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('value')
            ->maxLength('value', 20)
            ->requirePresence('value', 'create')
            ->notEmptyString('value');

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

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
/*
public function buildRules(RulesChecker $rules): RulesChecker
    {
		$rules->add($rules->isUnique(['version_id', 'name']), ['errorField' => 'name', 'message' => __('The name field must be unique')]);
        $rules->add($rules->existsIn(['version_id'], 'Versions'), ['errorField' => 'version_id']);

        return $rules;
    }
*/

}
