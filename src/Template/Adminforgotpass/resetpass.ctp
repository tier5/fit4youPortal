<span style="color:green;"><?= $this->Flash->render('positive') ?></span>
<div class="span6">
    
    <?php if($hasError=="1"){ ?>    
    <div style="color: #ff0000; font-weight:bold;">Invalid Link. Please try again.</div>    
    <?php }else{ ?>
    
        <div class="utopia-login">
        <h1>Team Trial Reset Password</h1>
        
        <form name="resetPassFrm" id="resetPassFrm" method="POST" action="">
            <input type="password" name="password" id="password" placeholder="New Password..." />
            <br /><span style="color: #ff0000;"><?php echo $errPassword; ?></span>
            <br />
            <input type="password" name="retypePassword" id="retypePassword" placeholder="Retype Password..." />
            <br /><span style="color: #ff0000;"><?php echo $errRetypePassword; ?></span>
            <br />        
            <input type="submit" name="resetSub" id="resetSub" value="Reset" />
        </form>
        
        </div>
    
    
    
    <?php } ?>
    <?php /*
    <div class="utopia-login">
    <h1><?php echo SITE_NAME;?> Access</h1>
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
    </div>*/ ?>
</div>

           