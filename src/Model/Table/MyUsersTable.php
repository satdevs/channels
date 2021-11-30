<?php
// Baked at 2021.11.22. 14:34:40
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use CakeDC\Users\Model\Table\UsersTable;

use Cake\ORM\RulesChecker;
//use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \CakeDC\Users\Model\Table\SocialAccountsTable&\Cake\ORM\Association\HasMany $SocialAccounts
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MyUsersTable extends UsersTable //Table
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

        $this->setTable('users');
        $this->setDisplayField(['last_name', 'first_name']);
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');
		
        $this->addBehavior('CakeDC/Users.Register');
        $this->addBehavior('CakeDC/Users.Password');
        $this->addBehavior('CakeDC/Users.Social');
        $this->addBehavior('CakeDC/Users.LinkSocial');
        $this->addBehavior('CakeDC/Users.AuthFinder');
        $this->hasMany('SocialAccounts', [
            'foreignKey' => 'user_id',
            'className' => 'CakeDC/Users.SocialAccounts',
        ]);

/*
        $this->setTable('users');
        $this->setDisplayField('first_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        //$this->hasMany('Logs', [
        //    'foreignKey' => 'user_id',
        //]);
        $this->hasMany('SocialAccounts', [
            'foreignKey' => 'user_id',
        ]);
*/

    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */

    public function validationDefault(Validator $validator): Validator
    {

/*
        $validator
            ->uuid('id')
            ->allowEmptyString('id', null, 'create');

        //$validator
        //    ->scalar('username')
        //    ->maxLength('username', 255)
        //    ->allowEmptyString('username');

        $validator
            ->email('email')
			->notEmptyString('password');
            //->allowEmptyString('email');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 50)
			->notEmptyString('password');
            //->allowEmptyString('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 50)
			->notEmptyString('password');
            //->allowEmptyString('last_name');

/*
        $validator
            ->scalar('token')
            ->maxLength('token', 255)
            ->allowEmptyString('token');

        $validator
            ->dateTime('token_expires')
            ->allowEmptyDateTime('token_expires');

        $validator
            ->scalar('api_token')
            ->maxLength('api_token', 255)
            ->allowEmptyString('api_token');

        $validator
            ->dateTime('activation_date')
            ->allowEmptyDateTime('activation_date');

        $validator
            ->scalar('secret')
            ->maxLength('secret', 32)
            ->allowEmptyString('secret');

        $validator
            ->boolean('secret_verified')
            ->allowEmptyString('secret_verified');

        $validator
            ->dateTime('tos_date')
            ->allowEmptyDateTime('tos_date');

        $validator
            ->boolean('active')
            ->notEmptyString('active');

        $validator
            ->boolean('is_superuser')
            ->notEmptyString('is_superuser');

        $validator
            ->scalar('role')
            ->maxLength('role', 255)
            ->allowEmptyString('role');

        $validator
            ->allowEmptyString('additional_data');
*/

        return $validator;
    }

    /**
     * Wrapper for all validation rules for register
     *
     * @param \Cake\Validation\Validator $validator Cake validator object.
     * @return \Cake\Validation\Validator
     */
/*
    public function validationRegister(Validator $validator)
    {
        $validator = $this->validationDefault($validator);
        $validator = $this->validationPasswordConfirm($validator);

        return $validator;
    }
*/

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
		//debug($rules); die();
        //$rules->add($rules->isUnique(['username']), ['errorField' => 'username']);
        //$rules->add($rules->isUnique(['email']), ['errorField' => 'email']);
        if ($this->isValidateEmail) {
			$rules->add($rules->isUnique(['email']), [
				'errorField' => 'email',
				'message' => __d('CakeDC/Users', 'Email already exists')
			]);		
        }

        return $rules;
    }
}
