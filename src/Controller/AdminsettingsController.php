<?php

namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Utility\Security;


class AdminsettingsController extends AppController{

    public function index()
    {
        $this->set('active_class','settings');
        $session = $this->request->session();
        $adminDetls = $session->read('admin.details');

        $this->loadModel('Sitesettings');
        $this->set('title',"Admin|Site Settings");
        $this->set('description',"Admin|Site Settings");
        $this->set('userRole',$adminDetls->role);
        
        $totRecordPerPage = 10;        
        $this->paginate = [
            'limit'=>$totRecordPerPage,
        ];        
        
        $this_roles = $this->paginate($this->Sitesettings->find());
        $allRecordCount = $this_roles->count();
        
        $settings = $this->Sitesettings->find('all')->toArray();

        $this->set(array(
            'allRecordCount'   =>  $allRecordCount
        ));
        
        $this_user=$this->paginate($this->Sitesettings->find());
            $this->set(array(
                'allRecordCount' => $this_user->count()
        ));
        
        $this->set('settings', $settings);
        $this->set('_serialize', ['settings']);
    }
    
    public function add()
    {
        
    }
    
    
    public function edit($id = null)
    {
       $session = $this->request->session();
        $adminDetls = $session->read('admin.details');
        $this->set('active_class','settings');    
                
        $this->loadModel('Sitesettings');
        
        $validationErrMsg = array();
        $fieldsValue = array();
        $hasError = 0;        
        
        $this->set('title',"Admin|Edit Sitesettings");
        $this->set('description',"Admin|Edit Sitesettings");
        $this->set('userRole',$adminDetls->role);              
        
    
        $setting = $this->Sitesettings->get($id, [
            'contain' => []
        ]);        
  
        if ($this->request->is('post')) 
        {  
            $postData = $this->request->data;

            $databaseArr = array(
                'name'       =>      $postData['name'],
                'value'      =>      $postData['value'],
                'status'     =>      $postData['status']
            ); 

            $setting = $this->Sitesettings->patchEntity($setting, $databaseArr);   
            $this->Sitesettings->save($setting);            

          
            $this->Flash->success('Setting has been updated successfully.', [
                'key' => 'positive'
            ]);
            $this->redirect(BASE_URL.'administrator/settings/edit/'.$id);
        }
        
        $this->set(compact('setting'));
        $this->set('_serialize', ['setting']);
    }
    
    
   
    
    public function delete($id = null)
    {
        $session = $this->request->session();
        $adminDetls = $session->read('admin.details');

        $this->loadModel('Sitesettings');
        
        $scheduleschedule = $this->UserRelations->find('all',[
         'conditions' => [
            'id'  => $id
        ]]);
        
            
        $entity = $this->Sitesettings->get($id);
        $result = $this->Sitesettings->delete($entity);
       
        $this->Flash->success('Setting has been deleted successfully.', [
            'key' => 'positive'
        ]);
        return $this->redirect(BASE_URL.'administrator/settings');
        
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
