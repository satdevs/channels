<?php
// Baked at 2021.10.28. 15:20:44
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MulticastSources Model
 *
 * @property \App\Model\Table\VersionsTable&\Cake\ORM\Association\BelongsTo $Versions
 * @property \App\Model\Table\PackagesProgramsDigitalsTable&\Cake\ORM\Association\HasMany $PackagesProgramsDigitals
 *
 * @method \App\Model\Entity\MulticastSource newEmptyEntity()
 * @method \App\Model\Entity\MulticastSource newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\MulticastSource[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MulticastSource get($primaryKey, $options = [])
 * @method \App\Model\Entity\MulticastSource findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\MulticastSource patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MulticastSource[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\MulticastSource|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MulticastSource saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MulticastSource[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\MulticastSource[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\MulticastSource[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\MulticastSource[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MulticastSourcesTable extends Table
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

        $this->setTable('multicast_sources');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Versions', [
            'foreignKey' => 'version_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Programs', [
            'foreignKey' => 'multicast_source_id',
        ]);
        //$this->hasMany('PackagesProgramsDigitals', [
        //    'foreignKey' => 'multicast_source_id',
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
            ->maxLength('name', 250)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('comment')
            ->allowEmptyString('comment');

        $validator
            ->scalar('src_ip')
            ->maxLength('src_ip', 15)
			->notEmptyString('src_ip');

        $validator
            ->scalar('dest_ip')
            ->maxLength('dest_ip', 15)
			->notEmptyString('dest_ip');

        $validator
            ->scalar('port')
            ->maxLength('port', 250)
			->notEmptyString('port');

        $validator
            ->scalar('interface')
            ->maxLength('interface', 250)
			->notEmptyString('interface');

        $validator
            ->scalar('provider')
            ->maxLength('provider', 10)
			->notEmptyString('provider');

		$validator
            ->boolean('visible')
            ->allowEmptyString('visible');

        $validator
            ->integer('pos')
            ->allowEmptyString('pos');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
		$rules->add($rules->isUnique(['version_id', 'name']), ['errorField' => 'name', 'message' => __('The name field must be unique')]);
        $rules->add($rules->existsIn(['version_id'], 'Versions'), ['errorField' => 'version_id']);

        return $rules;
    }
}
