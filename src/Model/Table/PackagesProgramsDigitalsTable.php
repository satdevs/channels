<?php
// Baked at 2021.10.28. 15:20:45
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PackagesProgramsDigitals Model
 *
 * @property \App\Model\Table\VersionsTable&\Cake\ORM\Association\BelongsTo $Versions
 * @property \App\Model\Table\PackagesTable&\Cake\ORM\Association\BelongsTo $Packages
 * @property \App\Model\Table\ProgramsTable&\Cake\ORM\Association\BelongsTo $Programs
 * @property \App\Model\Table\MulticastSourcesTable&\Cake\ORM\Association\BelongsTo $MulticastSources
 * @property \App\Model\Table\AckeysTable&\Cake\ORM\Association\BelongsTo $Ackeys
 *
 * @method \App\Model\Entity\PackagesProgramsDigital newEmptyEntity()
 * @method \App\Model\Entity\PackagesProgramsDigital newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PackagesProgramsDigital[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PackagesProgramsDigital get($primaryKey, $options = [])
 * @method \App\Model\Entity\PackagesProgramsDigital findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PackagesProgramsDigital patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PackagesProgramsDigital[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PackagesProgramsDigital|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PackagesProgramsDigital saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PackagesProgramsDigital[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PackagesProgramsDigital[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PackagesProgramsDigital[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PackagesProgramsDigital[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\CounterCacheBehavior
 */
class PackagesProgramsDigitalsTable extends Table
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

        $this->setTable('packages_programs_digitals');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        //$this->addBehavior('CounterCache', [
        //    //'Packages' => ['program_count'],
        //    //'Programs' => ['package_count'],
        //    'Packages' => ['packages_programs_digital_count'],
        //    'Programs' => ['packages_programs_digital_count'],
        //]);

        $this->belongsTo('Versions', [
            'foreignKey' => 'version_id',
        ]);
        $this->belongsTo('Packages', [
            'foreignKey' => 'package_id',
        ]);
        $this->belongsTo('Programs', [
            'foreignKey' => 'program_id',
        ]);
        $this->belongsTo('Ackeys', [
            'foreignKey' => 'ackey_id',
        ]);
        //$this->belongsTo('Packagegroups', [		Törölve
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
            ->nonNegativeInteger('version_id')
			//->requirePresence('version_id')
            ->notEmptyString('version_id', null, 'create');

        $validator
            ->nonNegativeInteger('ackey_id')
			->requirePresence('ackey_id')
            ->notEmptyString('ackey_id', null, false);

        $validator
            ->nonNegativeInteger('package_id')
			->requirePresence('package_id')
            ->notEmptyString('package_id', null, false);

        $validator
            ->nonNegativeInteger('program_id')
			//->minLength('program_id', 1)
			->requirePresence('program_id')
			->notEmptyString('program_id', null, false);

        $validator
            ->nonNegativeInteger('multicast_source_id')
            ->notEmptyString('multicast_source_id', null, 'create');

        //$validator
        //    ->allowEmptyString('packageorder');

        $validator
            ->scalar('name')
            ->maxLength('name', 250)
            ->allowEmptyString('name');

        $validator
            ->scalar('short_name')
            ->maxLength('short_name', 10)
            ->allowEmptyString('short_name');

        $validator
            ->nonNegativeInteger('lcn')
			->notEmptyString('lcn', null, 'create');
            //->allowEmptyString('lcn');

        $validator
            ->scalar('channel')
            ->maxLength('channel', 20)
            ->allowEmptyString('channel');

        $validator
            ->decimal('frequency')
            ->allowEmptyString('frequency');

        $validator
            ->scalar('qam')
            ->maxLength('qam', 10)
			->notEmptyString('qam', null, 'create');
            //->allowEmptyString('qam');

        $validator
            ->nonNegativeInteger('sid')
			->notEmptyString('sid', null, 'create');
            //->allowEmptyString('sid');

        $validator
            ->scalar('comment')
            ->allowEmptyString('comment');

        $validator
            ->scalar('public_comment')
            ->maxLength('public_comment', 250)
            ->allowEmptyString('public_comment');

        $validator
            ->scalar('changed')
            ->maxLength('changed', 250)
            ->allowEmptyString('changed');

        $validator
            ->boolean('to_delete')
            ->allowEmptyString('to_delete');

        $validator
            ->boolean('visible')
            ->allowEmptyString('visible');

        $validator
            ->integer('pos')
            ->allowEmptyString('pos');

		//debug($validator); die('V');

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
        $rules->add($rules->existsIn(['version_id'], 'Versions'), ['errorField' => 'version_id']);
        $rules->add($rules->existsIn(['package_id'], 'Packages'), ['errorField' => 'package_id']);
        $rules->add($rules->existsIn(['program_id'], 'Programs'), ['errorField' => 'program_id']);
        $rules->add($rules->existsIn(['ackey_id'], 'Ackeys'), ['errorField' => 'ackey_id']);
		//$rules->add($rules->existsIn(['packagegroup_id'], 'Packagegroups'), ['errorField' => 'packagegroup_id']); Törölve

		//debug($rules); die('R');

        return $rules;
    }
}
