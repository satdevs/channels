<?php
// Baked at 2021.10.28. 15:20:45
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Programs Model
 *
 * @property \App\Model\Table\VersionsTable&\Cake\ORM\Association\BelongsTo $Versions
 * @property \App\Model\Table\FeaturesTable&\Cake\ORM\Association\BelongsTo $Features
 * @property \App\Model\Table\LanguagesTable&\Cake\ORM\Association\BelongsTo $Languages
 * @property \App\Model\Table\PackagesProgramsAnalogsTable&\Cake\ORM\Association\HasMany $PackagesProgramsAnalogs
 * @property \App\Model\Table\PackagesProgramsDigitalsTable&\Cake\ORM\Association\HasMany $PackagesProgramsDigitals
 *
 * @method \App\Model\Entity\Program newEmptyEntity()
 * @method \App\Model\Entity\Program newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Program[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Program get($primaryKey, $options = [])
 * @method \App\Model\Entity\Program findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Program patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Program[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Program|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Program saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Program[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Program[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Program[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Program[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\CounterCacheBehavior
 */
class ProgramsTable extends Table
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

        $this->setTable('programs');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('CounterCache', [
			'MulticastSources' => ['programs_count'],
            'Features' => ['program_count'],
            'Languages' => ['program_count'],
            //'Packages' => ['packages_programs_analog_count'],
            //'Programs' => ['packages_programs_analog_count'],
            //'Packages' => ['packages_programs_digital_count'],
            //'Programs' => ['packages_programs_digital_count'],
        ]);

        $this->belongsTo('Versions', [
            'foreignKey' => 'version_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Features', [
            'foreignKey' => 'feature_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Languages', [
            'foreignKey' => 'language_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('MulticastSources', [
            'foreignKey' => 'multicast_source_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('PackagesProgramsAnalogs', [
            'foreignKey' => 'program_id',
        ]);
        $this->hasMany('PackagesProgramsDigitals', [
            'foreignKey' => 'program_id',
        ]);
        $this->belongsToMany('Packages', [
            'foreignKey' => 'program_id',
            'targetForeignKey' => 'package_id',
            'joinTable' => 'packages_programs_analogs',
        ]);
        $this->belongsToMany('Packages', [
            'foreignKey' => 'program_id',
            'targetForeignKey' => 'package_id',
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
            ->nonNegativeInteger('feature_id')
			->requirePresence('feature_id')
            ->notEmptyString('feature_id', null, false);

        $validator
            ->nonNegativeInteger('language_id')
			->requirePresence('language_id')
            ->notEmptyString('language_id', null, false);
        
        $validator
            ->nonNegativeInteger('multicast_source_id')
			->requirePresence('multicast_source_id')
            ->notEmptyString('multicast_source_id', null, false);

        $validator
            ->scalar('name')
            ->maxLength('name', 200)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('short_name')
            ->maxLength('short_name', 10)
            ->allowEmptyString('short_name');

        $validator
            ->scalar('logo_file')
            ->maxLength('logo_file', 250)
            ->allowEmptyFile('logo_file');

        $validator
            ->scalar('logo_url')
            ->maxLength('logo_url', 250)
            ->allowEmptyString('logo_url');

        $validator
            ->scalar('url')
            ->maxLength('url', 200)
            ->allowEmptyString('url');

        $validator
            ->scalar('programs_url')
            ->maxLength('programs_url', 250)
            ->allowEmptyString('programs_url');

        $validator
            ->email('email')
            ->allowEmptyString('email');

        $validator
            ->scalar('address')
            ->maxLength('address', 250)
            ->allowEmptyString('address');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 100)
            ->allowEmptyString('phone');

        $validator
            ->scalar('comment')
            ->allowEmptyString('comment');

        $validator
            ->boolean('new')
            ->allowEmptyString('new');

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
        $rules->add($rules->existsIn(['feature_id'], 'Features'), ['errorField' => 'feature_id']);
        $rules->add($rules->existsIn(['language_id'], 'Languages'), ['errorField' => 'language_id']);
        $rules->add($rules->existsIn(['multicast_source_id'], 'MulticastSources'), ['errorField' => 'multicast_source_id']);
        return $rules;
    }
}
