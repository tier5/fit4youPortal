<?php


namespace App\Controller;

///----> Classes to be used

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Utility\Security;
use Cake\Utility\Sendemail;
use Cake\Auth\DefaultPasswordHasher;


class AdminforgotpassController extends AppController{
    var $uses=array('User');
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow('index');
        $this->Auth->allow('resetpass');
    }

    public function index(){
        $errMsg = "";
        $this->set('title',SITE_NAME." Admin Forgot Password");
        $this->set('description','Login page for '.SITE_NAME.' Admin Forgot Password');
        if($this->request->is('post')){
            $this->loadModel('Users');
            $postData = $this->request->data;
            if($postData['email']!=""){
                $query = $this->Users->find('all', [
                    'conditions' => [
                        'Users.email' => $postData['email'],
                        'id' => '1'
                ]]);
                if($query->count()!=0){
                    
                    $resetPasswordKey = $this->randomPrefix(16);
                    
                    $this->Users->updateAll(
                        array('resetPasswordKey' => $resetPasswordKey), 
                        array('email' => $postData['email'])
                    );
                    
                    $encoded = base64_encode($postData['email']);
                    $resetPasswordKey = $resetPasswordKey.'----'.$encoded;
                    $to = $postData['email'];
                    $subject = "Admin Reset Password.";
                    $mailBody = '
                    <div style="width:700px; border:1px solid black;">
                        <div><h2>Team Trial</h2></div>
                        <div>
                            Hello Admin,
                            <br /><br />
                            Please follow the link below to reset your password.
                            <br />
                            <a href="'.BASE_URL.'admin/reset-password/'.$resetPasswordKey.'">Click Here </a>to reset password.
                            <br /><br />
                            Regards,<br />
                            Team Trial.
                        </div>
                    </div>
                    ';
                    $sendemail = new Sendemail();
                    $sendemail->send($to,$mailBody,$subject);    
                    
                    $this->Flash->success('Please check your mail to reset password.', [
                        'key' => 'positive'
                    ]);
                    $this->redirect(BASE_URL.'admin/forgotpass');
                    
                }else{
                    $errMsg = "This is not the registered email address to access this account.";
                }
            }else{
                $errMsg = "Please enter email to reset the password.";                
            }
        }
        $this->set(array('errMsg'=>$errMsg));
    }
    
    public function resetpass($resetPaswordKey){
        $this->set('title',"Admin Reset Password");
        $this->set('description','Admin Reset Password');
        
        $this->loadModel('Users');
        $errPassword = '';
        $errRetypePassword = '';
        
        $resetPaswordKeyArr = explode("----",$resetPaswordKey);
        $email = base64_decode($resetPaswordKeyArr[1]);
        $query = $this->Users->find('all', [
            'conditions' => [
                'email' => $email,
                'resetPasswordKey' => $resetPaswordKeyArr[0],
                'id' => '1'
        ]]);
        
        if($query->count() == 0){
            $hasError = "1";
        }else{
            $hasError = "0";
        }
        
        if($this->request->is('post')){

            $postData = $this->request->data;
            //echo $postData['password']; exit;
            if($postData['password']==''){
                $errPassword = "Please enter password.";
            }else if($postData['retypePassword']==''){
                $errRetypePassword = "Please enter retype password.";
            }else if($postData['retypePassword']!=$postData['password']){
                $errRetypePassword = "Password mismatch error.";
            }else{
                $hasher = new DefaultPasswordHasher();
                $newPassword = $hasher->hash($postData['password']);
                
                $this->Users->updateAll(
                    array('resetPasswordKey' => '','password'=>$newPassword), 
                    array('email' => $email)
                );
                
                //echo "success";exit;;
                $this->Flash->success('Your password has been changed successfully.', [
                    'key' => 'positive'
                ]);
                $this->redirect(BASE_URL.'admin');
            }
        }
        
        
        
        //echo $hasError;exit;
        $this->set(array('hasError'=>$hasError,'errPassword'=>$errPassword,'errRetypePassword'=>$errRetypePassword));
        //exit;
    }
    
    
    public function isAuthorized($user)
    {
         $action = $this->request->params['action'];
         
         // The add and index actions are always allowed.
         if (in_array($action, ['index','resetpass'])) {
            return true;
         }
         // All other actions require an id.
         if (empty($this->request->params['pass'][0])) {
            return false;
         }

         return parent::isAuthorized($user);
    }




}
