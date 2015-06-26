<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;

use Cake\ORM\Entity;


/**
 * User Entity.
 */
class User extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    
   
    
    
    
    protected $_accessible = [
        'parentId' => true,
        'role' => true,
        'regisNo' => true,
        'username' => true,
        'password' => true,
        'firstName' => true,
        'lastName' => true,
        'email' => true,
        'phone' => true,
        'address' => true,
        'city' => true,
        'state' => true,
        'country' => true,
	'zip' => true,
        'photo' => true,
        'join_date' => true,
	'update_date' => true,
        'is_login' => true,
        'is_active' => true,
        'is_deleted' => true
        
    ];

    
    
    protected function _setPassword($value)
    {
    	$hasher = new DefaultPasswordHasher();
    	return $hasher->hash($value);
    }
}
