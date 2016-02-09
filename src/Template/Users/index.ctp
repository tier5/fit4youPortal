<?php
$session = $this->request->session();
if($session->check('login_error')){
     $session->delete('login_error');
?>
<div class="alert alert-error">
     <a class="close" data-dismiss="alert" href="javascript:hide_it('alert')">×</a>
     <h4 class="alert-heading">Sorry Invalid Username or password or your account has been deleted or blocked</h4>    
</div>


<?php } ?>

<span style="color:green;"><?= $this->Flash->render('positive') ?></span>

 <div class="span6">
     <div class="utopia-login">
         <h1>Gym Fitness Admin Access</h1>
         <?php
         echo $this->Form->create();
         ?>
         
             
             <?php
             echo $this->Form->input('username',['type'=>'text','placeholder'=>'Username','class'=>'span12 utopia-fluid-input validate[required]', 'value' => $username]);
             
             ?>
             

            
             <?php
             echo $this->Form->input('password',['type'=>'password','placeholder'=>'**********','class'=>'span12 utopia-fluid-input validate[required]', 'value' => $password]);
             
             ?>
             

             <ul class="utopia-login-action">
                 <li>
          <?php
          
             echo $this->Form->input('login',['type'=>'submit','class'=>'btn span4','value'=>'Login','label'=>false]);
             
             ?>
                    
                     <div class="pull-right">
                        <?php
						echo $this->Form->checkbox('remember_me', ['value' =>'on','hiddenField' => false, 'checked' => true]);
						?> Remember me !</div> 
                 </li>
             </ul>

                 
             <!-- <label><a href="<?php echo BASE_URL ?>administrator/forgotpass">Can't access your account?</a></label>-->
        
       <?php echo $this->Form->end();?>
     </div>
 </div>

           