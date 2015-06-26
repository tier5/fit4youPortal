<?php

namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Utility\Security;


class AdminrolesController extends AppController{

    public function index()
    {
        $this->set('active_class','roles');
        $session = $this->request->session();
        $adminDetls = $session->read('admin.details');
        /*$hasAccess = $this->hasAccess($adminDetls->id,'9','moduleList');
        if($hasAccess=='0' && $adminDetls->id!='1'){
            $this->Flash->success("You don't have access to this page.", [
               'key' => 'positive'
            ]);
            $this->redirect('admin/dashboard');        
        }*/
        
        //$connection = ConnectionManager::get('default');
        $this->loadModel('Roles');
        $this->set('title',"Admin|Roles List");
        $this->set('description',"Admin|Roles List");
        $this->set('userRole',$adminDetls->role);
        
        $totRecordPerPage = 10;        
        $this->paginate = [
            'limit'=>$totRecordPerPage,
        ];        
            
        $this_roles = $this->paginate($this->Roles);
        $allRecordCount = $this_roles->count();
        
        $this->set(array(
            'allRecordCount'   =>  $allRecordCount
        ));
        $this->set('roles', $this_roles);
        $this->set('_serialize', ['roles']);
    }
    
    public function add()
    {
        $this->set('active_class','roles');
        $session = $this->request->session();
        $adminDetls = $session->read('admin.details');
        /*$hasAccess = $this->hasAccess($adminDetls->id,'9','moduleAdd');
        if($hasAccess=='0' && $adminDetls->id!='1'){
            $this->Flash->success("You don't have access to this page.", [
               'key' => 'positive'
            ]);
            $this->redirect('admin/dashboard');        
        }*/
        
        $this->loadModel('Roles');
        //$this->loadModel('Modules');
        //$this->loadModel('ModulePermissions');

        $validationErrMsg = array();
        $fieldsValue = array();
        $hasError = 0;
        
        
        $this->set('title',"Admin|Add Roles");
        $this->set('description',"Admin|Add Roles");
        $this->set('userRole',$adminDetls->role);
        
        //$allModules = $this->Modules->find('all');  
        //$allModulesCount = $allModules->count();
        
        if($this->request->is('post'))
        {
           $postData = $this->request->data;
           $roleName = $this->check_duplicate_role($postData['roleName']);
          
           if($postData['roleName'] == "")
           {
                $this->Flash->success('Enter Role Name.', [
                   'key' => 'negative'
                ]);
                $this->redirect(BASE_URL.'administrator/roles/add'); 
           }
           else if($roleName > 0)
           {
           
                $this->Flash->success('You have already been added same role before.', [
                   'key' => 'negative'
                ]);
                
                $this->redirect(BASE_URL.'administrator/roles/add'); 
           }
           else
           {
                        /*$fieldsValue['roleName'] =  $postData['roleName'];
            
            $allRoleNames = $this->Roles->find('all',[
                'roleName' => $postData['roleName']
            ]);  
            if($postData['roleName']==''){
                $validationErrMsg['roleName'] = "Please enter role name.";
                $hasError = 1;
                
            }else if($allRoleNames->count() > 0){
                $validationErrMsg['roleName'] = "This role name already exists.";
                $hasError = 1;
            }else{
                $validationErrMsg['roleName'] = "";
            }
            
            if($hasError==0)
            {*/
                $roles = $this->Roles->newEntity();                       
                $databaseArr = array(
                    'roleName'     =>      $postData['roleName']
                );  

                $roles = $this->Roles->patchEntity($roles, $databaseArr);
                $result=$this->Roles->save($roles);

                $lastRoleId = $result->id;

                /*for($i=1;$i<=$allModulesCount;$i++){

                    if(isset($postData['moduleAdd_'.$i]) && $postData['moduleAdd_'.$i]=="on"){
                        $add = '1';
                    }else{
                        $add = '0';
                    }

                    if(isset($postData['moduleEdit_'.$i]) && $postData['moduleEdit_'.$i]=="on"){
                        $edit = '1';
                    }else{
                        $edit = '0';
                    }

                    if(isset($postData['moduleDelete_'.$i]) && $postData['moduleDelete_'.$i]=="on"){
                        $delete = '1';
                    }else{
                        $delete = '0';
                    }

                    if(isset($postData['moduleList_'.$i]) && $postData['moduleList_'.$i]=="on"){
                        $list = '1';
                    }else{
                        $list = '0';
                    }

                    if(isset($postData['moduleGoalList_'.$i]) && $postData['moduleGoalList_'.$i]=="on"){
                        $goalList = '1';
                    }else{
                        $goalList = '0';
                    }
                    
                    if(isset($postData['moduleSizeAvailability_'.$i]) && $postData['moduleSizeAvailability_'.$i]=="on"){
                        $sizeAvailability = '1';
                    }else{
                        $sizeAvailability = '0';
                    }


                    $modulePermissions = $this->ModulePermissions->newEntity();                       
                    $databaseArr = array(
                        'roleId'                =>      $lastRoleId,
                        'moduleId'              =>      $postData['hidModuleId_'.$i],
                        'moduleAdd'             =>      $add,
                        'moduleEdit'            =>      $edit,
                        'moduleDelete'          =>      $delete,
                        'moduleList'            =>      $list,
                        'moduleGoalList'        =>      $goalList,
                        'moduleSizeAvailability'=>      $sizeAvailability
                    );  

                    $modulePermissions = $this->ModulePermissions->patchEntity($modulePermissions, $databaseArr);
                    $result=$this->ModulePermissions->save($modulePermissions);

                }*/

                $this->Flash->success('Roles has been added successfully.', [
                   'key' => 'positive'
                ]);
                $this->redirect(BASE_URL.'administrator/roles/add');
           }
            //}
            
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
        $this->set('active_class','roles');
        
        /*$hasAccess = $this->hasAccess($adminDetls->id,'9','moduleEdit');
        if($hasAccess=='0' && $adminDetls->id!='1'){
            $this->Flash->success("You don't have access to this page.", [
               'key' => 'positive'
            ]);
            $this->redirect(BASE_URL.'admin/dashboard');        
        }*/
        
       $check_role = $this->check_role_exists($id);
       
        if($check_role == 0)
        {
            $this->Flash->success('Unavailable Role.', [
                   'key' => 'negative'
                ]);
            
                $this->redirect(BASE_URL.'administrator/roles');
        }
        else
        {
            	$session = $this->request->session();
                $adminDetls = $session->read('admin.details');
                /*$hasAccess = $this->hasAccess($adminDetls->id,'9','moduleEdit');
                if($hasAccess=='0' && $adminDetls->id!='1'){
                    $this->Flash->success("You don't have access to this page.", [
                       'key' => 'positive'
                    ]);
                    $this->redirect('administrator/dashboard');        
                }*/
                
                
                $this->loadModel('Roles');
                //$this->loadModel('Modules');
                //$this->loadModel('ModulePermissions');
                
                $validationErrMsg = array();
                $fieldsValue = array();
                $hasError = 0;
                //$connection = ConnectionManager::get('default');        
                
                $this->set('title',"Admin|Edit Roles");
                $this->set('description',"Admin|Edit Roles");
                $this->set('userRole',$adminDetls->role);              
                
            
                $roles = $this->Roles->get($id, [
                    'contain' => []
                ]);        
          
                if ($this->request->is('post')) 
                {  
                    $postData = $this->request->data;
                    
                    $roleName = $this->check_duplicate_role($postData['roleName']);
                  
                   if(($roleName > 0) && ($postData['roleName']!=$postData['old_roleName']))
                   {
                   
                        $this->Flash->success('You have already been added same role before.', ['key' => 'negative'
                			]);
                        $this->redirect(BASE_URL.'administrator/roles/edit/'.$id);        
                   }
                   else
                   {
                    
                    
                    $databaseArr = array(
                        'roleName'     =>      $postData['roleName']
                    );
        
                    $roles = $this->Roles->patchEntity($roles, $databaseArr);   
                    $this->Roles->save($roles);            

                  
                    $this->Flash->success('Roles has been updated successfully.', [
                        'key' => 'positive'
                    ]);
                    $this->redirect(BASE_URL.'administrator/roles/edit/'.$id);
                   }
                }
                
                $this->set(compact('roles'));
                $this->set('_serialize', ['roles']);
        }
    }
    
    
   
    
    public function delete($id = null)
    {
        $session = $this->request->session();
        $adminDetls = $session->read('admin.details');
        
        
        $hasAccess = $this->hasAccess($adminDetls->id,'9','moduleDelete');
        if($hasAccess=='0' && $adminDetls->id!='1'){
            $this->Flash->success("You don't have access to this page.", [
               'key' => 'positive'
            ]);
            $this->redirect(BASE_URL.'admin/dashboard');        
        }

        $this->loadModel('Roles');
        $this->loadModel('Users');
        
        $role_name = $this->Users->find('all',[
         'conditions' => [
            'userRoles'  => $id
        ]]);
        $role_count = $role_name->count();
        if($role_count>0)
        {
            $this->Flash->success('This role is already assigned.', [
                'key' => 'negative'
            ]);
            return $this->redirect(BASE_URL.'admin/roles');
        }
        else
        {
            
            $entity = $this->Roles->get($id);
            $result = $this->Roles->delete($entity);
           
            $this->Flash->success('Matches has been deleted successfully.', [
                'key' => 'positive'
            ]);
            return $this->redirect(BASE_URL.'admin/roles');
        }
        
        
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

    public function check_duplicate_role($rolename)
    {
        $this->loadModel('Roles');
        $role_name = $this->Roles->find('all',[
         'conditions' => [
            'roleName'  => $rolename
        ]]);
        return $role_name->count();
    }

    public function check_role_exists($roleid)
    {
        $this->loadModel('Roles');
        $role_name = $this->Roles->find('all',[
         'conditions' => [
            'id'  => $roleid
        ]]);
        return $role_name->count();
    }

}
