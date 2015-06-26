<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Utility\Security;
use Cake\Utility\Sendemail;
use Cake\Auth\DefaultPasswordHasher;  

// src/Controller/UsersController.php

class UsersController extends AppController
{
	var $uses=array('User');

	public function beforeFilter(Event $event)
	{
	   parent::beforeFilter($event);
	}

	public function initialize()
	{
	    parent::initialize();
	    //$this->loadComponent('ImageTransform');
	    
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
		
		'unauthorizedRedirect' => $this->referer()
		]);
		
	}


	////////// login page

	public function index()
	{
		$this->set('title',SITE_NAME." Admin Dashboard");
		$this->set('description','Admin login panel '.SITE_NAME.' admin panel');
		$this->set('authors',['Gym','Fitness','Gym App']);
		
		$this->set('active_class','user');
	    $session = $this->request->session();
	    
	    if($this->is_admin_logged()){
		return $this->redirect(BASE_URL.'administrator/dashboard');
	    }
	    if($this->request->is('post')){
	       $user = $this->Auth->identify();
	       if($user){
		    $data_arr=$this->request->data;
		    $this->Auth->setUser($user);
		    $query = $this->Users->findByUsername($data_arr['username']);
		    $user_details=$query->first();
		    $session->write('admin.details',$user_details);
		    if(isset($data_arr['remember_me']))
		    {
			if($data_arr['remember_me']=='on')
			{
			    if($this->Cookie->check('admin_username'))
			    {
				 $this->Cookie->delete('admin_username');
			    }
	
			    $this->Cookie->write('admin_username',$data_arr['username'],false,31536000);
			    if($this->Cookie->check('admin_password'))
			    {
				 $this->Cookie->delete('admin_password');
			    }
			    $this->Cookie->write('admin_password',$data_arr['password'],false,31536000);
			}
		    }
		    return $this->redirect($this->Auth->redirectUrl(BASE_URL.'administrator/dashboard'));
	       }
	       else
	       {
	
		   $session->write('login_error',1);
		   return $this->redirect(BASE_URL.'administrator');
	
	       }
	    }
	    $this->set('title',SITE_NAME." Admin Login");
	    $this->set('description','Login page for '.SITE_NAME.' admin login');
	
	    if($this->Cookie->check('admin_username'))
	    {
		    $username=$this->Cookie->read('admin_username');
	    }
	    else
	    {
		    $username='';
	    }
	    if($this->Cookie->check('admin_password'))
	    {
		    $password=$this->Cookie->read('admin_password');
	    }
	    else
	    {
		    $password='';
	    }
	
	
	
	    $this->set('admin_username',$username);
	    $this->set('admin_password',$password);
	    if($this->Cookie->check('admin_username') && $this->Cookie->check('admin_password'))
	    {
		    $this->set('remember_me','on');
	    }
	    else
	    {
		    $this->set('remember_me','off');
	    }
	}

////////---> loading dashboard

public function dashboard()
{
	$this->set('title',SITE_NAME." Admin Dashboard");
	$this->set('description','Admin login panel '.SITE_NAME.' admin panel');
	$this->set('authors',['Gym','Fitness','Gym App']);
   $session = $this->request->session();
   $adminDetls = $session->read('admin.details');
   $this->set('title',SITE_NAME." Admin Dashboard");
   $this->set('description','Dashboard of '.SITE_NAME.' admin panel');
   $this->set('userRole',$adminDetls->role);
   $this->set('active_class','dashboard');
}

public function edit($id=null)
{
   $this->set('active_class','user');
    $session = $this->request->session();
    $adminDetls = $session->read('admin.details');
    /*$hasAccess = $this->hasAccess($adminDetls->id,'8','moduleEdit');
    if($hasAccess=='0' && $adminDetls->id!='1'){
        $this->Flash->success("You don't have access to this page.", [
           'key' => 'positive'
        ]);
        $this->redirect(BASE_URL.'admin/dashboard');        
    }*/
    
    $this->loadComponent('ImageTransform');
    $this->loadModel('Users');
    $this->loadModel('Roles');
   
    $allRoles = $this->Roles->find('all');

    $validationErrMsg = array();
    $fieldsValue = array();
    $organisationTeams = array();
    $hasError = 0;
    $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/i";


    $this->set('title',"Admin|Edit Client");
    $this->set('description','Edit Team Client');
    $this->set('userRole',$adminDetls->role);
    $users = $this->Users->get($id, [
        'contain' => []
    ]);
   
    if ($this->request->is('post')){      
        $postData = $this->request->data; 
        
        if($_FILES['usersImage']['name']!=''){
            $fileName = $_FILES['usersImage']['name'];
            $fileNameArr = explode(".",$fileName);
            $fileNameArrCnt = count($fileNameArr);
            $extn = $fileNameArr[$fileNameArrCnt-1];
            $extn = strtolower($extn);
        }

        
            //$postData = $this->request->data;            

            if($_FILES['usersImage']['name']!='')
            {
		
		$targetPath = './uploads/images/users_profile/';
		$imageName = time().rand(0,100);
		$up=$this->ImageTransform->upload("usersImage",$targetPath,$imageName);
		if($up)
		{
		    chmod($targetPath.$imageName.'.'.$extn,0777);                    
		    $this->ImageTransform->setQuality(100);
		    $this->ImageTransform->resize($this->ImageTransform->main_src,100,100, './uploads/images/users_profile/thumb/'.$this->ImageTransform->main_img);
		}
	    
                $databaseArr = array(
			'role'              =>      $postData['role'],
			'username'          =>      $postData['username'],
			'password'          =>      $postData['password'],
			'firstName'         =>      $postData['firtName'],
			'lastName'          =>      $postData['lastName'],
			'userPin'           =>      $postData['userPin'],
			'email'             =>      $postData['email'],
			'phone'             =>      $postData['phone'],
			'city'              =>      $postData['city'],
			'state'             =>      $postData['state'],
			'country'           =>      $postData['country'],
			'zip'               =>      $postData['zip'],
			'address'           =>      $postData['address'],
			'photo'             =>      $imageName.'.'.$extn,
			'join_date'	    =>      date('Y-m-d'),
			'update_date'	    =>      time(),
			'is_login'          =>      '0',
			'is_active'         =>      '1',
			'is_deleted'        =>      '0'
		);    
            }
            else
            {
		if(!empty($postData['password']))
		{
			$databaseArr = array(
				'role'              =>      $postData['role'],
				'username'          =>      $postData['username'],
				'password'          =>      $postData['password'],
				'firstName'         =>      $postData['firstName'],
				'lastName'          =>      $postData['lastName'],
				'userPin'           =>      $postData['userPin'],
				'email'             =>      $postData['email'],
				'phone'             =>      $postData['phone'],
				'city'              =>      $postData['city'],
				'state'             =>      $postData['state'],
				'country'           =>      $postData['country'],
				'zip'               =>      $postData['zip'],
				'address'           =>      $postData['address'],
				'join_date'	    =>      date('Y-m-d'),
				'update_date'	    =>      time(),
				'is_login'          =>      '0',
				'is_active'         =>      '1',
				'is_deleted'        =>      '0'
			);
		}
		else
		{
			
			$databaseArr = array(
				'role'              =>      $postData['role'],
				'username'          =>      $postData['username'],
				'firstName'         =>      $postData['firstName'],
				'lastName'          =>      $postData['lastName'],
				'userPin'           =>      $postData['userPin'],
				'email'             =>      $postData['email'],
				'phone'             =>      $postData['phone'],
				'city'              =>      $postData['city'],
				'state'             =>      $postData['state'],
				'country'           =>      $postData['country'],
				'zip'               =>      $postData['zip'],
				'address'           =>      $postData['address'],
				'join_date'	    =>      date('Y-m-d'),
				'update_date'	    =>      time(),
				'is_login'          =>      '0',
				'is_active'         =>      '1',
				'is_deleted'        =>      '0'
			);
			
		}
            }

            $users = $this->Users->patchEntity($users, $databaseArr);
            $this->Users->save($users);
            $this->Flash->success('The user has been saved', [
                'key' => 'positive'
            ]);
            return $this->redirect(BASE_URL.'administrator/user/edit/'.$id);


    }    
    
    $this->set(compact('users'));
    $this->set('_serialize', ['users']);
    $this->set(array(
         'allRoles' =>  $allRoles
    ));
}

public function add()
{
   $this->set('active_class','user');
   
    $session = $this->request->session();
    $adminDetls = $session->read('admin.details');
    /*$hasAccess = $this->hasAccess($adminDetls->id,'8','moduleAdd');
    if($hasAccess=='0' && $adminDetls->id!='1'){
        $this->Flash->success("You don't have access to this page.", [
           'key' => 'positive'
        ]);
        $this->redirect(BASE_URL.'admin/dashboard');        
    }*/
    
    $this->loadComponent('ImageTransform');
    $this->set('title','Admin|Add Users');
    $this->set('description','Admin|Add Users');
    $this->set('userRole',$adminDetls->role);
    $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/i";
    $validationErrMsg = array();
    $fieldsValue = array();
    $hasError = 0;
   
    $this->loadModel('Users');
    $this->loadModel('Roles');
   
    $allRoles = $this->Roles->find('all');
   
    if($this->request->is('post'))
    {
      //$this->request->data['password']=$password='123456';
        $postData = $this->request->data;   
        
        if($_FILES['usersImage']['name']!=''){
            $fileName = $_FILES['usersImage']['name'];
            $fileNameArr = explode(".",$fileName);
            $fileNameArrCnt = count($fileNameArr);
            $extn = $fileNameArr[$fileNameArrCnt-1];
            $extn = strtolower($extn);
        }
        
        //echo count($postData['role']);
        //pr($postData['role']);exit;
        

        $allUsernames=$this->Users->find('all',
            array('conditions' => array(
                'username' => $postData['username'],
                'is_deleted'  => '0'
            )));
        
        $allEmails=$this->Users->find('all',
            array('conditions' => array(
                'email' => $postData['email'],
                'is_deleted'  => '0'
            )));
            

            $userRegisNo = $this->randomPrefix(10);
            
            if($_FILES['usersImage']['name']!='')
            {
                $targetPath = './uploads/images/users_profile/';
                $imageName = time().rand(0,100);
                $up=$this->ImageTransform->upload("usersImage",$targetPath,$imageName);
                if($up)
                {
                    chmod($targetPath.$imageName.'.'.$extn,0777);                    
                    $this->ImageTransform->setQuality(100);
                    $this->ImageTransform->resize($this->ImageTransform->main_src,100,100, './uploads/images/users_profile/thumb/'.$this->ImageTransform->main_img);
                }
            }
            
            //$password = $this->generatePassword();
            $activationKey = $this->randomPrefix(16);
            $user = $this->Users->newEntity();                       
            $databaseArr = array(
			'role'              =>      $postData['role'],
			'username'          =>      $postData['username'],
			'password'          =>      $postData['password'],
			'firstName'         =>      $postData['firstName'],
			'lastName'          =>      $postData['lastName'],
			'userPin'           =>      $postData['userPin'],
			'email'             =>      $postData['email'],
			'phone'             =>      $postData['phone'],
			'city'              =>      $postData['city'],
			'state'             =>      $postData['state'],
			'country'           =>      $postData['country'],
			'zip'               =>      $postData['zip'],
			'address'           =>      $postData['address'],
			'photo'             =>      $imageName.'.'.$extn,
			'join_date'	    =>      date('Y-m-d'),
			'update_date'	    =>      time(),
			'is_login'          =>      '0',
			'is_active'         =>      '1',
			'is_deleted'        =>      '0'
		);         
		

            $user = $this->Users->patchEntity($user, $postData);
            $this->Users->save($user);
            
            $mailBody = '
            <div style="width:700px; border:1px solid black;">
            <div><h2>Team Trial</h2></div>
            <div>
            Hello '.$postData['firstName'].' '.$postData['lastName'].',
            <br /><br />
            You have been registered successfully by admin.
            <br />
            Please see below your login credentials :
            <br />
            <a href="'.BASE_URL.'user-activation/'.$activationKey.'">Click Here </a>to activate your account.
            <br />
            <a href="'.BASE_URL.'user-login">Click Here </a>to login.<br />
            <b>Email :</b> '.$postData['email'].'<br />
            <b>Password :</b> '.$postData['password'].'
            <br /><br />
            Regards,<br />
            Team Trial.
            </div>
            </div>
            ';
            //echo $mailBody;exit;
            $to = $postData['email'];
            $subject = $postData['role']." Registration";
            $sendemail = new Sendemail(); 
            $sendemail->send($to,$mailBody,$subject);
            
            
            $this->Flash->success('The user has been saved', [
                'key' => 'positive'
            ]);
            $this->redirect(BASE_URL.'administrator/user');
    }
   
    $this->set(array(
        'fieldsValue' => $fieldsValue,
        'allRoles' =>  $allRoles
    ));
}

public function userlist()
{
   $this->set('active_class','user');
    $session = $this->request->session();
    $adminDetls = $session->read('admin.details');
    /*$hasAccess = $this->hasAccess($adminDetls->id,'8','moduleList');
    if($hasAccess=='0' && $adminDetls->id!='1'){
        $this->Flash->success("You don't have access to this page.", [
           'key' => 'positive'
        ]);
        $this->redirect(BASE_URL.'admin/dashboard');        
    }*/

    $this->loadModel('Users');
    $this->set('title',"Admin|Client List");
    $this->set('description',"Admin|Client List");
    $this->set('userRole',$adminDetls->role);
    $totRecordsPerPage = 10;

    

    $this->paginate = [
        'limit'=>$totRecordsPerPage,
        'conditions' => [
                'Users.id <>' => 1,
		'Users.role'  => 'CLIENT',
                'is_deleted' => '0'
            ]
        ];

    
    $this_user=$this->paginate($this->Users);
    $this->set(array(
        'allRecordCount' => $this_user->count()
    ));
    $this->set('users',$this_user );
    $this->set('_serialize', ['users']);
}

public function trainerlist()
{
	
    $this->set('active_class','user');
    $session = $this->request->session();
    $adminDetls = $session->read('admin.details');
    /*$hasAccess = $this->hasAccess($adminDetls->id,'8','moduleList');
    if($hasAccess=='0' && $adminDetls->id!='1'){
        $this->Flash->success("You don't have access to this page.", [
           'key' => 'positive'
        ]);
        $this->redirect(BASE_URL.'admin/dashboard');        
    }*/

    $this->loadModel('Users');
    $this->set('title',"Admin|Users List");
    $this->set('description',"Admin|Users List");
    $this->set('userRole',$adminDetls->role);
    $totRecordsPerPage = 10;

    

    $this->paginate = [
        'limit'=>$totRecordsPerPage,
        'conditions' => [
                'Users.id <>' => 1,
		'Users.role'  => 'TRAINER',
                'is_deleted' => '0'
            ]
        ];

    
    $this_user=$this->paginate($this->Users);
    $this->set(array(
        'allRecordCount' => $this_user->count()
    ));
    $this->set('users',$this_user );
    $this->set('_serialize', ['users']);
	
	
}

public function logout()
{
    $this->autorender=false;
    $session = $this->request->session();
    $session->delete('admin.details');
    $this->Auth->logout(); 
    $this->redirect(BASE_URL.'administrator');
}


public function delete($id=null)
{   
    $session = $this->request->session();
    $adminDetls = $session->read('admin.details');
    $hasAccess = $this->hasAccess($adminDetls->id,'8','moduleDelete');
    if($hasAccess=='0' && $adminDetls->id!='1'){
        $this->Flash->success("You don't have access to this page.", [
           'key' => 'positive'
        ]);
        $this->redirect(BASE_URL.'admin/dashboard');        
    }
    
    $this->loadModel('Users');
    $this->loadModel('TeamPlayers');
    $this->loadModel('TeamCoaches');
    
    $players = $this->TeamPlayers->find('all',[
         'conditions' => [
            'playerId'  => $id
    ]]);
    
    $coaches = $this->TeamCoaches->find('all',[
         'conditions' => [
            'coachId'  => $id
    ]]);
    
    if($players->count()==0 && $coaches->count()==0){
       $databaseArr = array(
           'is_active'     =>  '0',
           'is_deleted'    =>  '1'
       );
       $users = $this->Users->get($id, [
           'contain' => []
       ]);
       $users = $this->Users->patchEntity($users, $databaseArr);
       $this->Users->save($users);
       $this->Flash->success('The user has been deleted successfully.', [
           'key' => 'positive'
       ]);
       return $this->redirect(BASE_URL.'admin/user');
    }else{
      $this->Flash->success('This user cannot be deleted as this user has already beeen appointed as player or coach.', [
           'key' => 'positive'
       ]);
       return $this->redirect(BASE_URL.'admin/user');
    }
    
    
} 





/////////// ---> defining authorized pages

public function isAuthorized($user)
{
     $action = $this->request->params['action'];
     // The add and index actions are always allowed.
     if (in_array($action, ['index', 'dashboard','logout','add','userlist','trainerlist','edit','delete'])) {
     return true;
     }
     // All other actions require an id.
     if (empty($this->request->params['pass'][0])) {
     return false;
     }

     return parent::isAuthorized($user);
}


}