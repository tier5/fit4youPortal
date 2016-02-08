<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Utility\Security;
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
     var $helpers=['Html'];
     var $settings = array();
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Flash');
        $this->loadComponent('Cookie');
        $this->loadComponent('RequestHandler');
        
        $this->loadComponent('Auth', [
			'authorize'=> 'Controller',//added this line
			'authenticate' => [
			'Form' => [
					  'fields' => [
									 'username' => 'username',
									 'password' => 'password'
									 ]
					  ,
					  'scope' => [
									 'Users.is_active'=>1,
									 'Users.is_deleted'=>0
				 
									 ]
					  ]
			],
		'loginAction' => [
		'controller' => 'Users',
		'action' => 'index'
		],
		
		'unauthorizedRedirect' => $this->referer(),
                'logoutRedirect'=> ['controller'=>'Users','action'=>'logout'],
	  ]);
        
    }
    
    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
		
		$session = $this->request->session();
		
        $this->loadModel('Sitesettings');
        $settings_data = $this->Sitesettings->find('all')->toArray();
		if(isset($settings_data[0]->value))
			$this->settings['xtime'] = $settings_data[0]->value;
        
		if(isset($settings_data[1]->value))
				$this->settings['ytime'] = $settings_data[1]->value;
        $session = $this->request->session();
        $uri=$_SERVER['REQUEST_URI']; //// uri defined 
             
        if (strpos($uri,'admin') !== false) {
            if($session->check('admin.details')){
                define('TYPE','ADMIN');
                $this->layout='admin';                      
            }else{
                define('TYPE','ADMIN');
                $this->layout='admin_login';
            }
        }
        else
        {
            define('TYPE','FRONT');
            $this->layout='frontend';
        }
        $this->set('authors',array('Tier5'));
        
    }
    
    public function is_admin_logged(){
        $session = $this->request->session();
        if($session->check('admin.details')){
            return 1;
        }else{
            return 0;
        }
    }
    
    public function generatePassword(){
        $alpha = "abcdefghijklmnopqrstuvwxyz";
        $alpha_upper = strtoupper($alpha);
        $numeric = "0123456789";
        $special = ".-+=_,!@$#*%<>[]{}";
        $chars = "";
        
        $chars = $alpha . $alpha_upper . $numeric;
        $length = 9;
        
        $len = strlen($chars);
        $pw = '';
        for ($i=0;$i<$length;$i++){
            $pw .= substr($chars, rand(0, $len-1), 1);
        }
        $pw = str_shuffle($pw);
        return $pw;
    }
    
    public function randomPrefix($length){
        $random= "";
        srand((double)microtime()*1000000);
        $data = "AbcDE123IJKLMN67QRSTUVWXYZ";
        $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
        $data .= "0FGH45OP89";

        for($i = 0; $i < $length; $i++)
        {
        $random .= substr($data, (rand()%(strlen($data))), 1);
        }
        return $random;
    } 
}
