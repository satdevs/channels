<?php
// Baked at 2021.10.28. 15:20:45
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PackagesProgramsAnalogs Model
 *
 * @property \App\Model\Table\VersionsTable&\Cake\ORM\Association\BelongsTo $Versions
 * @property \App\Model\Table\PackagesTable&\Cake\ORM\Association\BelongsTo $Packages
 * @property \App\Model\Table\ProgramsTable&\Cake\ORM\Association\BelongsTo $Programs
 * @property \App\Model\Table\BandsTable&\Cake\ORM\Association\BelongsTo $Bands
 *
 * @method \App\Model\Entity\PackagesProgramsAnalog newEmptyEntity()
 * @method \App\Model\Entity\PackagesProgramsAnalog newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PackagesProgramsAnalog[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PackagesProgramsAnalog get($primaryKey, $options = [])
 * @method \App\Model\Entity\PackagesProgramsAnalog findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PackagesProgramsAnalog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PackagesProgramsAnalog[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PackagesProgramsAnalog|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PackagesProgramsAnalog saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PackagesProgramsAnalog[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PackagesProgramsAnalog[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PackagesProgramsAnalog[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PackagesProgramsAnalog[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PackagesProgramsAnalogsTable extends Table
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

        $this->setTable('packages_programs_analogs');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('CounterCache', [
            //'Packages' => ['program_count'],
            //'Programs' => ['package_count'],
            'Packages' => ['packages_programs_analog_count'],
            'Programs' => ['packages_programs_analog_count'],
            //'Programs' => ['packages_programs_digital_count'],
        ]);

        $this->belongsTo('Versions', [
            'foreignKey' => 'version_id',
        ]);
        $this->belongsTo('Packages', [
            'foreignKey' => 'package_id',
        ]);
        $this->belongsTo('Programs', [
            'foreignKey' => 'program_id',
        ]);
        $this->belongsTo('Bands', [
            'foreignKey' => 'band_id',
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
            ->notEmptyString('version_id', null, 'create');

        $validator
            ->nonNegativeInteger('package_id')
			->requirePresence('package_id')
            ->notEmptyString('package_id', null, false);

        $validator
            ->nonNegativeInteger('program_id')
			->requirePresence('program_id')
			->notEmptyString('program_id', null, false);

        $validator
            ->nonNegativeInteger('band_id')
			->requirePresence('band_id')
			->notEmptyString('band_id', null, false);

        //$validator
        //    ->nonNegativeInteger('packagegroup_id')
        //    ->notEmptyString('packagegroup_id', null, 'create');

        //$validator
        //    ->allowEmptyString('packageorder');

        $validator
            ->scalar('name')
            ->maxLength('name', 250)
            ->allowEmptyString('name');

        $validator
            ->nonNegativeInteger('lcn')
            ->allowEmptyString('lcn');

        $validator
            ->scalar('channel')
            ->maxLength('channel', 20)
            ->allowEmptyString('channel');

        $validator
            ->decimal('frequency')
            ->allowEmptyString('frequency');

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
        $rules->add($rules->existsIn(['band_id'], 'Bands'), ['errorField' => 'band_id']);
        //$rules->add($rules->existsIn(['packagegroup_id'], 'Packagegroups'), ['errorField' => 'packagegroup_id']); Törölve

        return $rules;
    }
}
