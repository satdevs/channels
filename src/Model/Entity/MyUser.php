<?php
declare(strict_types=1);

/**
 * Copyright 2010 - 2019, Cake Development Corporation (https://www.cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2018, Cake Development Corporation (https://www.cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

namespace App\Model\Entity;

use CakeDC\Users\Model\Entity\User;

/**
 * User Entity.
 *
 * @property string $email
 * @property string $role
 * @property string $username
 * @property bool $is_superuser
 * @property \Cake\I18n\Time $token_expires
 * @property string $token
 * @property string $api_token
 * @property array $additional_data
 * @property \CakeDC\Users\Model\Entity\SocialAccount[] $social_accounts
 */
class MyUser extends User
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'is_superuser' => true,
        'role' => true,
    ];

    /**
     * Fields that are excluded from JSON an array versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
        'token',
        'token_expires',
        'api_token',
    ];
	
	
	
    /**
     * Map CakeDC's User.active field to User.is_active when getting
     *
     * @return mixed The value of the mapped property.
     */
	 /*
	*/
	/*
    protected function _getActive()
    {
		//debug($this->active);
		//debug($this->email);
		//debug($this->_properties['email']);
		//debug($this);
		//debug($this->_properties);
		//debug($this->_properties['is_active']);
		//die();
		
        //return $this->active;
        return $this->_properties['is_active'];
    }
	*/

    /**
     * Map CakeDC's User.active field to User.is_active when setting
     *
     * @param mixed $value The value to set.
     * @return static
     */
	/*
    protected function _setActive($value)
    {
        $this->set('is_active', $value);
        return $value;
    }	
	*/
	
}
