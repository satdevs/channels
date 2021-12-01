<?php
// Baked at 2021.10.28. 15:20:43
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Bands Model
 *
 * @property \App\Model\Table\PackagesProgramsAnalogsTable&\Cake\ORM\Association\HasMany $PackagesProgramsAnalogs
 *
 * @method \App\Model\Entity\Band newEmptyEntity()
 * @method \App\Model\Entity\Band newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Band[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Band get($primaryKey, $options = [])
 * @method \App\Model\Entity\Band findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Band patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Band[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Band|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Band saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Band[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Band[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Band[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Band[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BandsTable extends Table
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

        $this->setTable('bands');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('PackagesProgramsAnalogs', [
            'foreignKey' => 'band_id',
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
            ->maxLength('name', 8)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('band')
            ->maxLength('band', 6)
            //->allowEmptyString('band');
			->notEmptyString('band');

        $validator
            ->scalar('type')
            ->maxLength('type', 10)
			->notEmptyString('type');
            //->allowEmptyString('type');

        $validator
            ->decimal('frequency')
			->requirePresence('frequency', 'create')
			->notEmptyString('frequency');

        $validator
            //->decimal('bandwidth')
			->scalar('bandwidth')
			->requirePresence('bandwidth', 'create')
			->notEmptyString('bandwidth');

        $validator
            ->decimal('audio_frequency')
            ->allowEmptyString('audio_frequency');

        $validator
            ->boolean('visible')
            ->allowEmptyString('visible');

        $validator
            ->integer('pos')
            ->allowEmptyString('pos');

        return $validator;
    }
}
