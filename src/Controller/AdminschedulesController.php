<?php

namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Utility\Security;


class AdminschedulesController extends AppController{

    public function index()
    {
        $this->set('active_class','schedule');
        $session = $this->request->session();
        $adminDetls = $session->read('admin.details');

        $this->loadModel('UserRelations');
        $this->loadModel('Users');
        $this->set('title',"Admin|Schedule List");
        $this->set('description',"Admin|Schedule List");
        $this->set('userRole',$adminDetls->role);
        
        $totRecordPerPage = 10;        
        $this->paginate = [
            'limit'=>$totRecordPerPage,
        ];        
        
        $this_roles = $this->paginate($this->UserRelations->find());
        $allRecordCount = $this_roles->count();
        
        $r=$this->UserRelations->find('all',array('conditions'=>['Client.is_active' => '1','Trainer.is_active' => '1'],'contain'=>['Client','Trainer']));
        
        $arr = $r->toArray();

        $this->set(array(
            'allRecordCount'   =>  $allRecordCount
        ));
        
        $this_user=$this->paginate($this->UserRelations);
            $this->set(array(
                'allRecordCount' => $this_user->count()
        ));
        
        $this->set('schedules', $arr);
        $this->set('_serialize', ['schedules']);
    }
    
    public function add()
    {
        $this->set('active_class','schedule');
        $session = $this->request->session();
        $adminDetls = $session->read('admin.details');
        
        $this->loadModel('UserRelations');
        //$this->loadModel('Modules');
        //$this->loadModel('ModulePermissions');

        $validationErrMsg = array();
        $fieldsValue = array();
        $hasError = 0;
        
        
        $this->set('title',"Admin|Add Schedule");
        $this->set('description',"Admin|Add Schedule");
        $this->set('userRole',$adminDetls->role);
        
        //$allModules = $this->Modules->find('all');  
        //$allModulesCount = $allModules->count();
        
        if($this->request->is('post'))
        {
           $postData = $this->request->data;


            $schedules = $this->UserRelations->newEntity();                       
            $databaseArr = array(
                'client_id'     =>      $postData['client_id'],
                'trainer_id'    =>      $postData['trainer_id'],
                'start_time'    =>      $postData['start_time'],
                'end_time'      =>      $postData['end_time'],
                'status'        =>      $postData['status']
            );  

            $schedules = $this->UserRelations->patchEntity($schedules, $databaseArr);
            $result=$this->UserRelations->save($schedules);

            $lastRoleId = $result->id;

            $this->Flash->success('Schedules has been added successfully.', [
               'key' => 'positive'
            ]);
            $this->redirect(BASE_URL.'administrator/schedules/add');
            
        }
        
        $this->set(array(
            'validationErrMsg' =>  $validationErrMsg,
            'fieldsValue' =>  $fieldsValue,
        ));
    }
    
    
    public function edit($id = null)
    {
       $session = $this->request->session();
        $adminDetls = $session->read('admin.details');
        $this->set('active_class','schedule');
        
        /*$hasAccess = $this->hasAccess($adminDetls->id,'9','moduleEdit');
        if($hasAccess=='0' && $adminDetls->id!='1'){
            $this->Flash->success("You don't have access to this page.", [
               'key' => 'positive'
            ]);
            $this->redirect(BASE_URL.'admin/dashboard');        
        }*/
       
        if($check_role == 0)
        {
            $this->Flash->success('Unavailable Schedule.', [
                   'key' => 'negative'
                ]);
            
                $this->redirect(BASE_URL.'administrator/schedules');
        }
        else
        {
                /*$hasAccess = $this->hasAccess($adminDetls->id,'9','moduleEdit');
                if($hasAccess=='0' && $adminDetls->id!='1'){
                    $this->Flash->success("You don't have access to this page.", [
                       'key' => 'positive'
                    ]);
                    $this->redirect('administrator/dashboard');        
                }*/
                
                
                $this->loadModel('UserRelations');
                //$this->loadModel('Modules');
                //$this->loadModel('ModulePermissions');
                
                $validationErrMsg = array();
                $fieldsValue = array();
                $hasError = 0;
                //$connection = ConnectionManager::get('default');        
                
                $this->set('title',"Admin|Edit Schedule");
                $this->set('description',"Admin|Edit Schedule");
                $this->set('userRole',$adminDetls->role);              
                
            
                $schedule = $this->Schedules->get($id, [
                    'contain' => []
                ]);        
          
                if ($this->request->is('post')) 
                {  
                    $postData = $this->request->data;
                  
         
                    
                    
                    $databaseArr = array(
                        'client_id'     =>      $postData['client_id'],
                        'trainer_id'    =>      $postData['trainer_id'],
                        'start_time'    =>      $postData['start_time'],
                        'end_time'      =>      $postData['end_time'],
                        'is_active'     =>      $postData['is_active']
                    ); 
        
                    $schedule = $this->UserRelations->patchEntity($schedule, $databaseArr);   
                    $this->Roles->save($schedule);            

                  
                    $this->Flash->success('Roles has been updated successfully.', [
                        'key' => 'positive'
                    ]);
                    $this->redirect(BASE_URL.'administrator/schedules/edit/'.$id);
                }
                
                $this->set(compact('schedule'));
                $this->set('_serialize', ['schedule']);
        }
    }
    
    
   
    
    public function delete($id = null)
    {
        $session = $this->request->session();
        $adminDetls = $session->read('admin.details');

        $this->loadModel('UserRelations');
        
        $scheduleschedule = $this->UserRelations->find('all',[
         'conditions' => [
            'id'  => $id
        ]]);
        
            
        $entity = $this->UserRelations->get($id);
        $result = $this->UserRelations->delete($entity);
       
        $this->Flash->success('Schedule has been deleted successfully.', [
            'key' => 'positive'
        ]);
        return $this->redirect(BASE_URL.'administrator/schedules');
        
    }
    
    
    public function isAuthorized($user)
    {
         $action = $this->request->params['action'];
         
         // The add and index actions are always allowed.
         if (in_array($action, ['index','add','edit',
             'delete'])) {
            return true;
         }
         // All other actions require an id.
         if (empty($this->request->params['pass'][0])) {
            return false;
         }

         return parent::isAuthorized($user);
    }


}
