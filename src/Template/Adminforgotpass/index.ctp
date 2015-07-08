<?php
$session = $this->request->session();
if($session->check('login_error'))
{
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
    <h1>Team Trial Forgot Password</h1>
    <?php echo $this->Form->create(); ?>
    <?php
        echo $this->Form->input('email',['type'=>'text','placeholder'=>'Email','class'=>'span12 utopia-fluid-input validate[required]']);
    ?>
    <br />
    <span style="color: #ff0000;"><?php echo isset($errMsg) ? $errMsg : ""; ?></span>
    <ul class="utopia-login-action">
        <li>
            <?php
               echo $this->Form->input('Submit',['type'=>'submit','class'=>'btn span4','value'=>'Submit','label'=>false]);
            ?>
        </li>
    </ul>
    <label><a href="<?php echo BASE_URL; ?>admin">Login Here</a></label>
    <?php echo $this->Form->end();?>
    </div>
</div>

           