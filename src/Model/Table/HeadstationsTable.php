<?php
// Baked at 2021.10.28. 15:20:44
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Headstations Model
 *
 * @property \App\Model\Table\CitiesTable&\Cake\ORM\Association\HasMany $Cities
 * @property \App\Model\Table\PackagesTable&\Cake\ORM\Association\HasMany $Packages
 * @property \App\Model\Table\VersionsTable&\Cake\ORM\Association\HasMany $Versions
 *
 * @method \App\Model\Entity\Headstation newEmptyEntity()
 * @method \App\Model\Entity\Headstation newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Headstation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Headstation get($primaryKey, $options = [])
 * @method \App\Model\Entity\Headstation findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Headstation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Headstation[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Headstation|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Headstation saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Headstation[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Headstation[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Headstation[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Headstation[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class HeadstationsTable extends Table
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

        $this->setTable('headstations');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Cities', [
            'foreignKey' => 'headstation_id',
        ]);
        $this->hasMany('Packages', [
            'foreignKey' => 'headstation_id',
        ]);
        $this->hasMany('Versions', [
            'foreignKey' => 'headstation_id',
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
            ->maxLength('name', 200)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('place')
            ->maxLength('place', 200)
			->notEmptyString('place');

        $validator
            ->scalar('last_sentence')
            ->maxLength('last_sentence', 250)
            ->allowEmptyString('last_sentence');

        $validator
            ->scalar('last_digital_sentence')
            ->maxLength('last_digital_sentence', 250)
            ->allowEmptyString('last_digital_sentence');

        $validator
            ->scalar('comment')
            ->allowEmptyString('comment');

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
		$rules->add($rules->isUnique(['name']), ['errorField' => 'name', 'message' => __('The name field must be unique')]);

        return $rules;
    }
	
	
}
