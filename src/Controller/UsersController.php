<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Utility\Security;
use Cake\Network\Email\Email;
use Cake\Auth\DefaultPasswordHasher;
use Cake\I18n\Time;
use Cake\Network\Request;
use Cake\ORM\TableRegistry;


// src/Controller/UsersController.php

class UsersController extends AppController
{
	var $uses=array('User');
	//var $components = array('Auth');

	public function beforeFilter(Event $event)
	{
	   parent::beforeFilter($event);
	}

	public function initialize()
	{
	    parent::initialize();
	}


	////////// login page

	public function index()
	{
		$this->set('title',SITE_NAME." Admin Login Page");
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
			echo $this->Cookie->delete('admin_username');
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
		    else
		    {
			$this->Cookie->delete('admin_password');
			$this->Cookie->delete('admin_username');
			
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
	
	
	
	    $this->set('username',$username);
	    $this->set('password',$password);
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
	$this->loadModel('Users');
	$this->loadModel('Gyms');
	$totClient = $this->Users->find('all')->where(['role' => 'CLIENT'])->count();
	$this->set('totClient',$totClient);
	$totTrainer = $this->Users->find('all')->where(['role' => 'TRAINER'])->count();
	$this->set('totTrainer',$totTrainer);
	$totGyms = $this->Gyms->find('all')->count();
	$this->set('totGyms',$totGyms);
	
}

public function edit($id=null)
{
	Time::setToStringFormat('YYYY-MM-dd h:i:s');
   $this->set('active_class','user');
    $session = $this->request->session();
    $adminDetls = $session->read('admin.details');

    
    $this->loadComponent('ImageTransform');
    $this->loadModel('Users');
    $this->loadModel('Roles');
   
    $allRoles = $this->Roles->find('all');


    $this->set('title',"Admin|Edit Client");
    $this->set('description','Edit Team Client');
    $this->set('userRole',$adminDetls->role);
    $users = $this->Users->get($id, [
        'contain' => []
    ]);
   
    if ($this->request->is('post')){      
        $postData = $this->request->data;
	
	$error = '0';
	
	$pin=$this->Users->find('all',
            array('conditions' => array(
                'userPin' => $postData['userPin'],
                'is_deleted'  => '0'
            )))->count();
	
	$my_pin=$this->Users->find('all',
            array('conditions' => array(
                'userPin' => $postData['userPin'],
		'id' => $id,
                'is_deleted'  => '0'
            )))->count();
	
	if(($pin>0 && $my_pin == 0))
	{
		$error = '1';
		
	}
        
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
			'firstName'         =>      $postData['firstName'],
			'lastName'          =>      $postData['lastName'],
			'userPin'           =>      $postData['userPin'],
			'email'             =>      $postData['email'],
			'phone'             =>      $postData['phone'],
			'city'              =>      $postData['city'],
			'state'             =>      $postData['state'],
			'zip'               =>      $postData['zip'],
			'address'           =>      $postData['address'],
			'photo'             =>      $imageName.'.'.$extn,
			'update_date'	    =>      Time::now(),
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
				'firstName'         =>      $postData['firstName'],
				'lastName'          =>      $postData['lastName'],
				'userPin'           =>      $postData['userPin'],
				'email'             =>      $postData['email'],
				'phone'             =>      $postData['phone'],
				'city'              =>      $postData['city'],
				'state'             =>      $postData['state'],
				'zip'               =>      $postData['zip'],
				'address'           =>      $postData['address'],
				'update_date'	    =>      Time::now(),
				'is_login'          =>      '0',
				'is_active'         =>      '1',
				'is_deleted'        =>      '0'
			);
		}
		else
		{
			
			$databaseArr = array(
				'role'              =>      $postData['role'],
				'firstName'         =>      $postData['firstName'],
				'lastName'          =>      $postData['lastName'],
				'userPin'           =>      $postData['userPin'],
				'email'             =>      $postData['email'],
				'phone'             =>      $postData['phone'],
				'city'              =>      $postData['city'],
				'state'             =>      $postData['state'],
				'zip'               =>      $postData['zip'],
				'address'           =>      $postData['address'],
				'update_date'	    =>      Time::now(),
				'is_login'          =>      '0',
				'is_active'         =>      '1',
				'is_deleted'        =>      '0'
			);
			
		}
            }
	    //echo $error;exit;
	if($error == '0')
	{
		$users = $this->Users->patchEntity($users, $databaseArr);
		$this->Users->save($users);
		
		if($postData['role'] == 'CLIENT')
		{
			$this->Flash->success('The user has been saved', [
				'key' => 'positive'
			]);
			$this->redirect(BASE_URL.'administrator/client');
		}
		else
		{
			$this->Flash->success('The user has been saved', [
				'key' => 'positive'
			]);
			$this->redirect(BASE_URL.'administrator/trainer');
		}
	    
		
	}
	else
	{
		
		$this->Flash->success('Pin already exist', [
		    'key' => 'negative'
		]);
		$this->redirect(BASE_URL.'administrator/user/edit/'.$id);
	}
            
	    


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

    $this->loadComponent('ImageTransform');
    $this->set('title','Admin|Add Users');
    $this->set('description','Admin|Add Users');
    $this->set('userRole',$adminDetls->role);
   
    $this->loadModel('Users');
    $this->loadModel('Roles');
   
    $allRoles = $this->Roles->find('all');
   
    if($this->request->is('post'))
    {

        $postData = $this->request->data;
	
	$error = '0';
	
	$pin=$this->Users->find('all',
            array('conditions' => array(
                'userPin' => $postData['userPin'],
                'is_deleted'  => '0'
            )))->count();
	
	if($pin>0)
	{
		$error = '1';
	}
        
        if($_FILES['usersImage']['name']!=''){
            $fileName = $_FILES['usersImage']['name'];
            $fileNameArr = explode(".",$fileName);
            $fileNameArrCnt = count($fileNameArr);
            $extn = $fileNameArr[$fileNameArrCnt-1];
            $extn = strtolower($extn);
        }
            
            
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
	    
	    $postData['photo'] = $imageName.'.'.$extn;
	}
	else
	{
	    $postData['photo'] = '';
	}
	
	//$password = $this->generatePassword();
	$activationKey = $this->randomPrefix(16);
	$user = $this->Users->newEntity();
       
	$databaseArr = array(
		    'role'              =>      $postData['role'],
		    'firstName'         =>      $postData['firstName'],
		    'lastName'          =>      $postData['lastName'],
		    'userPin'           =>      $postData['userPin'],
		    'email'             =>      $postData['email'],
		    'phone'             =>      $postData['phone'],
		    'city'              =>      $postData['city'],
		    'state'             =>      $postData['state'],
		    'zip'               =>      $postData['zip'],
		    'address'           =>      $postData['address'],
		    'photo'             =>      $postData['photo'],
		    'join_date'	    	=>      Time::now(),
		    'update_date'	=>      Time::now(),
		    'is_login'          =>      '0',
		    'is_active'         =>      '1',
		    'is_deleted'        =>      '0'
	    );         
	    
	if($error == 0)
	{
		$user = $this->Users->patchEntity($user, $databaseArr);
		$this->Users->save($user);
		
		if($postData['role'] == 'CLIENT')
		{
			$this->Flash->success('The client profile has been saved', [
				'key' => 'positive'
			]);
			$this->redirect(BASE_URL.'administrator/client');
		}
		else
		{
			$this->Flash->success('The trainer profile has been saved', [
				'key' => 'positive'
			]);
			$this->redirect(BASE_URL.'administrator/trainer');
		}
	
		$this->redirect(BASE_URL.'administrator/user/add');
	}
	else
	{
		$this->Flash->success('Pin already exist', [
                'key' => 'negative'
		]);
		
		$this->redirect(BASE_URL.'administrator/user/add');
	}
	
	
	
	/*$mailBody = '
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
	<b>Pin Code :</b> '.$postData['userPin'].'<br />
	<br /><br />
	Regards,<br />
	Team Trial.
	</div>
	</div>
	';
	$to = $postData['email'];
	$subject = $postData['role']." Registration";
	$email = new Email('default');
		    $email->from(['santu@unifiedinfotech.net' => 'Fit4You.com'])
		    ->to($to)
		    ->subject($subject)
		    ->send($mailBody);*/

            
    }
   
    $this->set(['allRoles' =>  $allRoles]);
}

public function userlist()
{
   $this->set('active_class','user');
    $session = $this->request->session();
    $adminDetls = $session->read('admin.details');

    $this->loadModel('Users');
    $this->set('title',"Admin|Client List");
    $this->set('description',"Admin|Client List");
    $this->set('userRole',$adminDetls->role);
    $totRecordsPerPage = 10;

    
	// 09 Feb 2016: Rermoved  User Id = 1 hard coded checking
	/*
	
	$this->paginate = [
        'limit'=>$totRecordsPerPage,
        'conditions' => [
                'Users.id <>' => 1,
				'Users.role'  => 'CLIENT',
                'is_deleted' => '0'
            ],
	'order' => [
            'Users.id' => 'desc'
        ]
        ];
		*/
    $this->paginate = [
        'limit'=>$totRecordsPerPage,
        'conditions' => [
                
				'Users.role'  => 'CLIENT',
                'is_deleted' => '0'
            ],
			'order' => [
            'Users.id' => 'desc'
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
            ],
	'order' => [
            'Users.id' => 'desc'
        ]
        ];

    
    $this_user=$this->paginate($this->Users);
    $this->set(array(
        'allRecordCount' => $this_user->count()
    ));
    $this->set('users',$this_user );
    $this->set('_serialize', ['users']);
	
	
}


public function test()
{
		
}
public function userProfile()
{	
	$this->request->allowMethod(['ajax']);
	$this->layout = 'ajax';
	$this->set('active_class','user');
	$session = $this->request->session();
	$adminDetls = $session->read('admin.details');
	
	$user_id = $this->request->data['user_id'];

	$this->loadModel('Users');

	$this->set('title',"Admin|View Client Profile");
	$this->set('description','View Client Profile');
	$this->set('userRole',$adminDetls->role);
	$userData = $this->Users->get($user_id);
	
	//print_r($userData);
	//exit;
	
	$this->set(compact('userData'));
	$this->set('_serialize', ['userData']);
	$this->render('ajax/user_profile');
}

public function userStat($user_id=NULL)
{
   $this->request->allowMethod(['ajax','post','get']);
   $_ENV['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest'; 
   $this->set('active_class','user');
   
    
    $session = $this->request->session();
    $adminDetls = $session->read('admin.details');

    $this->set('title','Admin|Client Statistics');
    $this->set('description','Admin|Client Statistics');
    $this->set('userRole',$adminDetls->role);
   
    $this->loadModel('UserStats');
    $this->loadModel('Users');
   
    if($this->request->is('ajax'))
    {
	//$this->viewClass ="Ajax";
	$this->layout = 'ajax';
	$postData = $this->request->data();
	
	if(!empty($postData['id']))
	{
		$databaseArr = array(
			'weight'    =>  $postData['weight'],
			'chest'		=>  $postData['chest'],
			'waist'    	=>  $postData['waist'],
			'biceps'    =>  $postData['biceps'],
			'triceps'   =>  $postData['triceps'],
		);
		
		//$user = $this->UserStats->newEntity($postData);
		$query = $this->UserStats->query();	
		$flag = $query->update()
			->set($databaseArr)
			->where(['id' => $postData['id']])
			->execute();
		$user_id = $postData['user_id'];
		$this->Flash->success('Data updated successfully.', [
		    'key' => 'positive'
		]);
		
	}
	else
	{
		$user = $this->UserStats->newEntity($postData);
		$this->UserStats->save($user);
		$user_id = $postData['user_id'];
		$this->Flash->success('Data added successfully.', [
		    'key' => 'positive'
		]);
	}
	
		
		
		$query = $this->UserStats->find()->where(['UserStats.user_id' => $user_id]);
		$user_details = $this->Users->find()->where(['Users.id' => $user_id])->first();
		$totRecordsPerPage = 10;
		$this->paginate = [
		       'limit'=>$totRecordsPerPage,
		       'order' => [
			   'UserStats.id' => 'desc'
		       ]
	       ];
		$stats=$this->paginate($query);
		$this->set('stats',$stats);
		$this->set('user_id',$user_id);
		$this->set('user_details',$user_details);
		$this->set(['allRecordCount' => $stats->count()]);
		$this->render('ajax/user_stat');
    }
	//$query = $this->UserStats->find('all')
	$query = $this->UserStats->find()->where(['UserStats.user_id' => $user_id])->order(['id' => 'desc']);
	$user_details = $this->Users->find()->where(['Users.id' => $user_id])->first();		

	$totRecordsPerPage = 10;
	 $this->paginate = [
		'limit'=>$totRecordsPerPage,
		'order' => [
		    'UserStats.id' => 'desc'
		]
	];
   	$stats=$this->paginate($query);
	$this->set('stats',$stats);
	$this->set('user_id',$user_id);
	$this->set('user_details',$user_details);
	$this->set(['allRecordCount' => $stats->count()]);
}


public function logout()
{
    $this->autorender=false;
    $session = $this->request->session();
    $session->delete('admin.details');
    $this->Auth->logout(); 
    $this->redirect(BASE_URL.'administrator');
}

public function deleteClient($id=null)
{   
    $session = $this->request->session();
    $adminDetls = $session->read('admin.details');
    
    $this->loadModel('Users');
  
	
	$query = $this->Users->query();	
	$flag = $query->delete()
			->where(['id' => $id])
			->execute();
       
       if($flag->rowCount()>0)
       {

		echo $this->Flash->success('The user has been deleted successfully.', [
		    'key' => 'positive'
		]);
       }
       else
       {
		echo $this->Flash->success('Data cannot be deleted.', [
		    'key' => 'negetive'
		]);
	
       }
       return $this->redirect(BASE_URL.'administrator/client/');
    
    
}

public function deleteTrainer($id=null)
{   
    $session = $this->request->session();
    $adminDetls = $session->read('admin.details');
    
    $this->loadModel('Users');
  
	
	$query = $this->Users->query();	
	$flag = $query->delete()
			->where(['id' => $id])
			->execute();
       
       if($flag->rowCount()>0)
       {

		echo $this->Flash->success('The user has been deleted successfully.', [
		    'key' => 'positive'
		]);
       }
       else
       {
		echo $this->Flash->success('Data cannot be deleted.', [
		    'key' => 'negetive'
		]);
	
       }
       return $this->redirect(BASE_URL.'administrator/trainer/');
    
    
}

public function deleteStat($id=null,$user_id=NULL)
{   
    $session = $this->request->session();
    $adminDetls = $session->read('admin.details');
    
    $this->loadModel('UserStats');
  
	
	$query = $this->UserStats->query();	
	$flag = $query->delete()
			->where(['id' => $id])
			->execute();
       
       if($flag->rowCount()>0)
       {

		echo $this->Flash->success('The user has been deleted successfully.', [
		    'key' => 'positive'
		]);
       }
       else
       {
		echo $this->Flash->success('Data cannot be deleted.', [
		    'key' => 'negetive'
		]);
	
       }
       return $this->redirect(BASE_URL.'administrator/user/userstat/'.$user_id);
    
    
} 


public function changePassword()
{
	$this->set('active_class','');
	$session = $this->request->session();
	$adminDetls = $session->read('admin.details');
        $this->set('title',"Admin|Change Password");
        $this->set('description','Admin|Change Password');
        $this->set('userRole',$adminDetls->role);
	
	if($this->request->is('post'))
	{
		
		$oldPassword = $this->request->data['oldPassword'];
		$newPassword = $this->request->data['newPassword'];
		$query=$this->Users->findById($adminDetls->id);
		$main_pass=$query->first();
		$hasher = new DefaultPasswordHasher();
		$check = $hasher->check($oldPassword,$main_pass->password);
		if($check==1) {
		     $newPassword=$hasher->hash($newPassword);
		     ;
		     
			    if ($this->Users->updateAll(["password"=>$newPassword],["id"=>$adminDetls->id])) {
				$this->Flash->success('Successfully change password.', [
			    'key' => 'positive'
			]);
			    } else {
				$this->Flash->error('Unable to change.', [
			    'key' => 'positive'
			]);
			    }
		}else {
		     $this->Flash->success('Old password incorrect.', [
		    'key' => 'negetive'
		]);
		}
	}
	
	
}

public function adminProfile()
{
	
	Time::setToStringFormat('YYYY-MM-dd h:i:s');
	$this->set('active_class','');
	$session = $this->request->session();
	$adminDetls = $session->read('admin.details');
    
	$this->loadComponent('ImageTransform');
	$this->loadModel('Users');
    
    
	$this->set('title',"Admin|Admin Profile");
	$this->set('description','Edit Admin Profile');
	$this->set('userRole',$adminDetls->role);
	$users = $this->Users->get($adminDetls->id, [
	    'contain' => []
	]);
   
    if ($this->request->is('post'))
    {      
        $postData = $this->request->data;
	
	$error = '0';
        
	$pin=$this->Users->find('all',
            array('conditions' => array(
                'userPin' => $postData['userPin'],
                'is_deleted'  => '0'
            )))->count();
	
	$my_pin=$this->Users->find('all',
            array('conditions' => array(
                'userPin' => $postData['userPin'],
		'id' => $adminDetls->id,
                'is_deleted'  => '0'
            )))->count();
	
	if(($pin>0 && $my_pin == 0))
	{
		$error = '1';
		
	}
	
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
					'username'          =>      $postData['username'],
					'firstName'         =>      $postData['firstName'],
					'lastName'          =>      $postData['lastName'],
					'userPin'           =>      $postData['userPin'],
					'email'             =>      $postData['email'],
					'phone'             =>      $postData['phone'],
					'city'              =>      $postData['city'],
					'state'             =>      $postData['state'],
					'zip'               =>      $postData['zip'],
					'address'           =>      $postData['address'],
					'photo'             =>      $imageName.'.'.$extn,
					'update_date'	    =>      Time::now(),
					'is_login'          =>      '1',
					'is_active'         =>      '1',
					'is_deleted'        =>      '0'
				);    
            }
            else
            {
		
		$databaseArr = array(

			'username'          =>      $postData['username'],
			'firstName'         =>      $postData['firstName'],
			'lastName'          =>      $postData['lastName'],
			'userPin'           =>      $postData['userPin'],
			'email'             =>      $postData['email'],
			'phone'             =>      $postData['phone'],
			'city'              =>      $postData['city'],
			'state'             =>      $postData['state'],
			'zip'               =>      $postData['zip'],
			'address'           =>      $postData['address'],
			'update_date'	    =>      Time::now(),
			'is_login'          =>      '1',
			'is_active'         =>      '1',
			'is_deleted'        =>      '0'
		);
		
            }
		
		if($error == 0)
		{
			$user = $this->Users->patchEntity($users, $databaseArr);
			$this->Users->save($users);
			
			$this->Flash->success('Profile has been updated', [
				'key' => 'positive'
			]);
			
			return $this->redirect(BASE_URL.'administrator/admin-profile');

		}
		else
		{
			$this->Flash->success('Pin already exist', [
			'key' => 'negative'
			]);
			
			return $this->redirect(BASE_URL.'administrator/admin-profile');

		}
            

    }    
    
    $this->set(compact('users'));
    $this->set('_serialize', ['users']);
	
}

/////////// ---> defining authorized pages

public function isAuthorized($user)
{
     $action = $this->request->params['action'];
     // The add and index actions are always allowed.
     if (in_array($action, ['index', 'dashboard','logout','add','userlist','trainerlist','edit','delete','userProfile','userStat','changePassword','adminProfile','deleteClient','deleteTrainer','deleteStat'])) {
		return true;
     }
     // All other actions require an id.
     if (empty($this->request->params['pass'][0])) {
		return false;
     }

     return parent::isAuthorized($user);
}


}
