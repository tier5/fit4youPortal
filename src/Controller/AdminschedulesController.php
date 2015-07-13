<?php

namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Utility\Security;
use Cake\I18n\Time;


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
            'order' => [
		    'UserRelations.id' => 'desc'
	    ]
        ];        
        $query=$this->UserRelations->find('all',array('conditions'=>['Client.is_active' => '1','Trainer.is_active' => '1'],'contain'=>['Client','Trainer']));
        $allRecordCount = $query->count();
        
        
        //$arr = $query->toArray();

        $this->set(array(
            'allRecordCount'   =>  $allRecordCount
        ));
        
        $schedules=$this->paginate($query);
        
        $this->set('schedules', $schedules);
        $this->set('_serialize', ['schedules']);
    }
    
    public function add()
    {
        $this->set('active_class','schedule');
        $session = $this->request->session();
        $adminDetls = $session->read('admin.details');
        
        $this->loadModel('UserRelations');
        $this->loadModel('Users');

        $validationErrMsg = array();
        $fieldsValue = array();
        $hasError = 0;
        
        
        $this->set('title',"Admin|Add Schedule");
        $this->set('description',"Admin|Add Schedule");
        $this->set('userRole',$adminDetls->role);
        
        $clients = $this->Users->find('all')->where(['role' => 'CLIENT']);
        $totClients = $clients->count();
        $trainers = $this->Users->find('all')->where(['role' => 'TRAINER']);
        $totTrainer = $trainers->count();
        
        if($this->request->is('post'))
        {
           $postData = $this->request->data;
           $postData['date'].$postData['start_time'];
           
           

            $schedules = $this->UserRelations->newEntity();                       
            $databaseArr = array(
                'client_id'     =>      $postData['client_id'],
                'trainer_id'    =>      $postData['trainer_id'],
                'start_time'    =>      Time::createFromTimestamp(strtotime($postData['date'].' '.$postData['start_time'].':00')),
                'end_time'      =>      Time::createFromTimestamp(strtotime($postData['date'].' '.$postData['end_time'].':00')),
                'date'          =>      Time::now(),
                'status'        =>      '0'
            );
            
            $find = $this->UserRelations->find()
                    ->where(['trainer_id' => $databaseArr['trainer_id']])
                    ->orWhere(['client_id' => $databaseArr['client_id']])
		    ->andWhere(['start_time <=' => $databaseArr['start_time'], 'end_time >=' => $databaseArr['start_time']])
                    ->count();

            if($find == 0)
            {
                $schedules = $this->UserRelations->patchEntity($schedules, $databaseArr);
                $result=$this->UserRelations->save($schedules);
                
                $lastRoleId = $result->id;

                $this->Flash->success('Schedules has been added successfully.', [
                   'key' => 'positive'
                ]);
                $this->redirect(BASE_URL.'administrator/schedule');
            }
            else
            {
                $this->Flash->success('There is a session already exisit in this time slot.', [
                   'key' => 'negative'
                ]);
            }
            
        }
        
        $this->set('clients',$clients);
        $this->set('totClients',$totClients);
        $this->set('trainers',$trainers);
        $this->set('totTrainer',$totTrainer);
    }
    
    
    public function edit($id = null)
    {
       $session = $this->request->session();
        $adminDetls = $session->read('admin.details');
        $this->set('active_class','schedule');    
                
        $this->loadModel('UserRelations');
        $this->loadModel('Users');
        
        $clients = $this->Users->find('all')->where(['role' => 'CLIENT']);
        $totClients = $clients->count();
        $trainers = $this->Users->find('all')->where(['role' => 'TRAINER']);
        $totTrainer = $trainers->count();
        
        
        $validationErrMsg = array();
        $fieldsValue = array();
        $hasError = 0;       
        
        $this->set('title',"Admin|Edit Schedule");
        $this->set('description',"Admin|Edit Schedule");
        $this->set('userRole',$adminDetls->role);              
        
    
        $schedule = $this->UserRelations->get($id, [
            'contain' => []
        ]);        
  
        if ($this->request->is('post')) 
        {  
            $postData = $this->request->data;
          
 
            
            
            $databaseArr = array(
                'client_id'     =>      $postData['client_id'],
                'trainer_id'    =>      $postData['trainer_id'],
                'start_time'    =>      Time::createFromTimestamp(strtotime($postData['date'].' '.$postData['start_time'].':00')),
                'end_time'      =>      Time::createFromTimestamp(strtotime($postData['date'].' '.$postData['end_time'].':00')),
                'date'          =>      Time::now(),
                'status'        =>      '0'
            );
            
            $find = $this->UserRelations->find()
                    ->where(['trainer_id' => $databaseArr['trainer_id']])
                    ->orWhere(['client_id' => $databaseArr['client_id']])
		    ->andWhere(['start_time <=' => $databaseArr['start_time'], 'end_time >=' => $databaseArr['start_time']])
                    ->andWhere(['id !=' => $id])
                    ->count();
                           

            if($find == 0)
            {
                $query = $this->UserRelations->query();
                $flag = $query->update()
                    ->set($databaseArr)
                    ->where(['id' => $postData['id']])
                    ->execute();

                $this->Flash->success('Schedule has been updated successfully.', [
                    'key' => 'positive'
                ]);
                $this->redirect(BASE_URL.'administrator/schedule');
            }
            else
            {
                $this->Flash->success('There is a session already exisit in this time slot.', [
                   'key' => 'negative'
                ]);
            }
            
        }
        
        $this->set('clients',$clients);
        $this->set('totClients',$totClients);
        $this->set('trainers',$trainers);
        $this->set('totTrainer',$totTrainer);
        $this->set(compact('schedule'));
        $this->set('_serialize', ['schedule']);
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
        return $this->redirect(BASE_URL.'administrator/schedule');
        
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
