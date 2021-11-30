<?php
// Baked at 2021.10.28. 15:20:45
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Versions Model
 *
 * @property \App\Model\Table\HeadstationsTable&\Cake\ORM\Association\BelongsTo $Headstations
 * @property \App\Model\Table\AckeysTable&\Cake\ORM\Association\HasMany $Ackeys
 * @property \App\Model\Table\MulticastSourcesTable&\Cake\ORM\Association\HasMany $MulticastSources
 * @property \App\Model\Table\PackagesTable&\Cake\ORM\Association\HasMany $Packages
 * @property \App\Model\Table\PackagesProgramsAnalogsTable&\Cake\ORM\Association\HasMany $PackagesProgramsAnalogs
 * @property \App\Model\Table\PackagesProgramsDigitalsTable&\Cake\ORM\Association\HasMany $PackagesProgramsDigitals
 * @property \App\Model\Table\ProgramsTable&\Cake\ORM\Association\HasMany $Programs
 *
 * @method \App\Model\Entity\Version newEmptyEntity()
 * @method \App\Model\Entity\Version newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Version[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Version get($primaryKey, $options = [])
 * @method \App\Model\Entity\Version findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Version patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Version[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Version|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Version saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Version[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Version[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Version[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Version[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class VersionsTable extends Table
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

        $this->setTable('versions');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
		$this->addBehavior('JeffAdmin.Datepicker');	// inserts only if there is date or time or datetime field

        $this->belongsTo('Headstations', [
            'foreignKey' => 'headstation_id',
            'joinType' => 'INNER',
        ]);
        //$this->hasMany('Ackeys', [			Törölve
        //    'foreignKey' => 'version_id',
		//	'dependent' => true,
		//	'cascadeCallbacks' => true,			
        //]);
        $this->hasMany('MulticastSources', [
            'foreignKey' => 'version_id',
			'dependent' => true,
			'cascadeCallbacks' => true,			
        ]);
        $this->hasMany('Packages', [
            'foreignKey' => 'version_id',
			'dependent' => true,
			'cascadeCallbacks' => true,			
        ]);
        $this->hasMany('Languages', [
            'foreignKey' => 'version_id',
			'dependent' => true,
			'cascadeCallbacks' => true,			
        ]);
        $this->hasMany('Features', [
            'foreignKey' => 'version_id',
			'dependent' => true,
			'cascadeCallbacks' => true,			
        ]);
        $this->hasMany('Programs', [
            'foreignKey' => 'version_id',
			'dependent' => true,
			'cascadeCallbacks' => true,			
        ]);
        $this->hasMany('PackagesProgramsAnalogs', [
            'foreignKey' => 'version_id',
			'dependent' => true,
			'cascadeCallbacks' => true,			
        ]);
        $this->hasMany('PackagesProgramsDigitals', [
            'foreignKey' => 'version_id',
			'dependent' => true,
			'cascadeCallbacks' => true,			
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
            ->nonNegativeInteger('broadcast')
            ->notEmptyString('broadcast', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 250)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('comment')
            ->allowEmptyString('comment');

        $validator
            ->boolean('current')
            ->allowEmptyString('current');

        $validator
            ->date('date_from')
            ->allowEmptyDate('date_from');

        $validator
            ->date('date_to')
            ->allowEmptyDate('date_to');

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
        $rules->add($rules->existsIn(['headstation_id'], 'Headstations'), ['errorField' => 'headstation_id']);
		$rules->add($rules->isUnique(['name']), ['errorField' => 'name', 'message' => __('The name field must be unique')]);

        return $rules;
    }
}
