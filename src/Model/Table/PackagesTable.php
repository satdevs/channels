<?php
// Baked at 2021.10.28. 15:20:44
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Packages Model
 *
 * @property \App\Model\Table\VersionsTable&\Cake\ORM\Association\BelongsTo $Versions
 * @property \App\Model\Table\HeadstationsTable&\Cake\ORM\Association\BelongsTo $Headstations
 * @property \App\Model\Table\PackagesProgramsAnalogsTable&\Cake\ORM\Association\HasMany $PackagesProgramsAnalogs
 * @property \App\Model\Table\PackagesProgramsDigitalsTable&\Cake\ORM\Association\HasMany $PackagesProgramsDigitals
 *
 * @method \App\Model\Entity\Package newEmptyEntity()
 * @method \App\Model\Entity\Package newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Package[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Package get($primaryKey, $options = [])
 * @method \App\Model\Entity\Package findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Package patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Package[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Package|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Package saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Package[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Package[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Package[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Package[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\CounterCacheBehavior
 */
class PackagesTable extends Table
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

        $this->setTable('packages');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('CounterCache', [
            'Headstations' => ['package_count'],
        //    'Packages' => ['packages_programs_analog_count'],
        //    'Programs' => ['packages_programs_analog_count'],
        //    'Packages' => ['packages_programs_digital_count'],
        //    'Programs' => ['packages_programs_digital_count'],
        ]);


        $this->belongsTo('Versions', [
            'foreignKey' => 'version_id',
        ]);
        $this->belongsTo('Headstations', [
            'foreignKey' => 'headstation_id',
        ]);
        $this->belongsTo('Packagegroups', [
            'foreignKey' => 'packagegroup_id',
        ]);
		
		$this->hasMany('PackagesProgramsAnalogs', [
            'foreignKey' => 'package_id',
			'dependent' => true,
			'cascadeCallbacks' => true,			
        ]);
        $this->hasMany('PackagesProgramsDigitals', [
            'foreignKey' => 'package_id',
			'dependent' => true,
			'cascadeCallbacks' => true,			
        ]);
        $this->belongsToMany('Programs', [
            'foreignKey' => 'package_id',
            'targetForeignKey' => 'program_id',
            'joinTable' => 'packages_programs_analogs',
        ]);
        $this->belongsToMany('Programs', [
            'foreignKey' => 'package_id',
            'targetForeignKey' => 'program_id',
            'joinTable' => 'packages_programs_digitals',
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
            ->nonNegativeInteger('version_id')
            ->notEmptyString('version_id', null, 'create');

        $validator
            ->nonNegativeInteger('headstation_id')
            ->notEmptyString('headstation_id', null, 'create');

        $validator
            ->nonNegativeInteger('packagegroup_id')
			->requirePresence('packagegroup_id')
            ->notEmptyString('packagegroup_id', null, false);

        $validator
            ->scalar('encoded')
            ->maxLength('encoded', 20)
            ->allowEmptyString('encoded');

        $validator
            ->scalar('broadcast')
            ->maxLength('broadcast', 10)
			->notEmptyString('broadcast', null, 'create');

        $validator
            ->nonNegativeInteger('packageGroup')
            ->allowEmptyString('packageGroup');

        $validator
            ->allowEmptyString('packageorder');

        $validator
            ->scalar('name')
            ->maxLength('name', 200)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('shortname')
            ->maxLength('shortname', 200)
			->notEmptyString('shortname');

        $validator
            ->scalar('popular_name')
            ->maxLength('popular_name', 200)
			->notEmptyString('popular_name');

        $validator
            ->scalar('external_name')
            ->maxLength('external_name', 200)
            ->allowEmptyString('external_name');

        $validator
            ->scalar('comment')
            ->allowEmptyString('comment');

        $validator
            ->scalar('popular_comment_analog')
            ->maxLength('popular_comment_analog', 250)
            ->allowEmptyString('popular_comment_analog');

        $validator
            ->scalar('popular_comment_digital')
            ->maxLength('popular_comment_digital', 250)
            ->allowEmptyString('popular_comment_digital');

        $validator
            ->nonNegativeInteger('price')
			->allowEmptyString('price');
			//->notEmptyString('price');

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
        $rules->add($rules->existsIn(['headstation_id'], 'Headstations'), ['errorField' => 'headstation_id']);
        $rules->add($rules->existsIn(['packagegroup_id'], 'Packagegroups'), ['errorField' => 'packagegroup_id']);

        return $rules;
    }
}
