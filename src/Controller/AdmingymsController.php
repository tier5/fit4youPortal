<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Utility\Security;


class AdmingymsController extends AppController{

    public function index($search1=null,$search2=null)
    {
        $session = $this->request->session();
        $adminDetls = $session->read('admin.details');
        $this->set('active_class','gyms');

        $this->loadModel('Gyms');
        $this->set('title',"Admin|List Gyms");
        $this->set('description','Admin|List Gym');
        $this->set('userRole',$adminDetls->role);
        
        
        $totRecordsPerPage = 10;
                    
    	$this->paginate = [
        		'limit' =>  $totRecordsPerPage,
			'order' => [
				'Gyms.id' => 'desc'
			]
        	];
        
        $thisGyms = $this->paginate($this->Gyms);
        $thisGymsCount = $thisGyms->count();
        
        $this->set(array('thisgymCount'=>$thisGymsCount));
        $this->set('gyms',$thisGyms);
        $this->set('_serialize', ['gyms']);
    }
    
    public function add()
    {
        $this->loadModel('Gyms');
        $session = $this->request->session();
        $this->set('active_class','gyms');
        
        $adminDetls = $session->read('admin.details');
        
        $validationErrMsg = array();
        $fieldsValue = array();
        $hasError = 0;
        
        $this->set('title',"Admin|Add Organisation");
        $this->set('description','Admin|Add Organisation');
        $this->set('userRole',$adminDetls->role);
        $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/i";
        
        if($this->request->is('post'))
        {
            $postData = $this->request->data;     

            $gyms = $this->Gyms->newEntity();

                       
	    $gymsArr = array(
	    		'gymName'      	=>      $postData['gymName'],
			'gymCity'   	=>      $postData['gymCity'],
			'gymState'   	=>      $postData['gymState'],
			'gymZip'   	=>      $postData['gymZip'],
	    		'gymAddress'   	=>      $postData['gymAddress'],
	    		'gymPhone'     	=>      $postData['gymPhone'],
	    		'gymEmail'     	=>      $postData['gymEmail']
		);         

             $gym = $this->Gyms->patchEntity($gyms, $gymsArr);
             $this->Gyms->save($gym);
                
             $this->Flash->success('Gym has been saved successfully.', [
                    'key' => 'positive'
                ]);
             $this->redirect(BASE_URL.'administrator/gyms');
            
        }
    }
    
    
    public function edit($id = null)
    {
        $this->loadModel('Gyms');
        $this->set('active_class','gyms');
        
        $session = $this->request->session();
        $adminDetls = $session->read('admin.details');
        
        $this->set('title',"Admin|Edit Gym");
        $this->set('description',"Admin|Edit Gym");
        $this->set('userRole',$adminDetls->role);

        
        $gyms = $this->Gyms->get($id, [
            'contain' => []
        ]);
        //if ($this->request->is(['patch', 'post', 'put'])) {
        if ($this->request->is('post')) {
            
            $postData = $this->request->data;  

	    $databaseArr = array(
	    		'gymName'      	=>      $postData['gymName'],
			'gymCity'   	=>      $postData['gymCity'],
			'gymState'   	=>      $postData['gymState'],
			'gymZip'   	=>      $postData['gymZip'],
	    		'gymAddress'   	=>      $postData['gymAddress'],
	    		'gymPhone'     	=>      $postData['gymPhone'],
	    		'gymEmail'     	=>      $postData['gymEmail']
	    ); 

	    $gym = $this->Gyms->patchEntity($gyms, $databaseArr);                                       
	    $this->Gyms->save($gym);
	    $this->Flash->success('Gym has been updated successfully.', [
		'key' => 'positive'
	    ]);
	    return $this->redirect(BASE_URL.'administrator/gyms');          
        }
        
        $this->set(compact('gyms'));
        $this->set('_serialize', ['gyms']);
    }
    
    public function delete($id = null)
    {
        $session = $this->request->session();
        $adminDetls = $session->read('admin.details');
       /* $hasAccess = $this->hasAccess($adminDetls->id,'1','moduleDelete');
        if($hasAccess=='0' && $adminDetls->id!='1'){
            $this->Flash->success("You don't have access to this page.", [
               'key' => 'positive'
            ]);
            $this->redirect(BASE_URL.'admin/dashboard');        
        }*/
        
        $this->loadModel('Gyms');
        //$this->loadModel('Teams');
        
	$entity = $this->Gyms->get($id);
        $result = $this->Gyms->delete($entity);
	$this->Flash->success('Gym has been delete successfully.', [
	    'key' => 'positive'
	]);
        return $this->redirect(BASE_URL.'administrator/gyms');
        
    }
    
    
    public function isAuthorized($user)
    {
         $action = $this->request->params['action'];
         
         // The add and index actions are always allowed.
         if (in_array($action, ['index','add','edit','delete'])) {
            return true;
         }
         // All other actions require an id.
         if (empty($this->request->params['pass'][0])) {
            return false;
         }

         return parent::isAuthorized($user);
    }




}
