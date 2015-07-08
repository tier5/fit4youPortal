
<div class="span10">

<div class="row-fluid">
    <div class="span12">
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo BASE_URL; ?>administrator/dashboard">Admin</a> <span class="divider">/</span>
            </li>
            <li>
                Change Password
            </li>
        </ul>
    </div>
</div>
    <span class="msg_class"><?= $this->Flash->render('positive') ?></span>
    <span class="msg_class"><?= $this->Flash->render('negetive') ?></span>
<section class="utopia-widget utopia-form-box section" id="formElement">
    <div class="utopia-widget-title">
        <?php echo $this->Html->image('../backend/img/icons2/software24.png',array("class" => "utopia-widget-icon"));?>
        <!--<img class="utopia-widget-icon" src="../backend/img/icons2/software24.png">-->
        <span>Change Password</span>
    </div>
    <div class="row-fluid">
        <div class="utopia-widget-content">
            <div class="span6 utopia-form-freeSpace">
                <form class="form-horizontal" name="changePassForm" id="changePassForm" action="" method="post">
                    <fieldset>
                        <div class="control-group">
                            <label for="input01" class="control-label">Old Password</label>

                            <div class="controls">
                                <input type="password" name="oldPassword" id="oldPassword" class="span10" >
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">New Password</label>

                            <div class="controls">
                                <input type="password" name="newPassword" id="newPassword" class="span10" ></span>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">Confirm Password</label>

                            <div class="controls">
                                <input type="password" name="confirmPassword" id="confirmPassword" class="span10">
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label"></label>

                            <div class="controls">
                                <input type="submit" value="Submit" name="Submit" id="submitBtn">
                                        <input type="button" value="Cancel" onclick="javascript:history.go(-1);" name="submitBtn" id="submitBtn" id="input01">
                            </div>
                        </div>
                        
                    </fieldset>
                </form>
            </div>
            
        </div>
    </div>
</section>

</div>

<script>

$().ready(function() {

        // validate signup form on keyup and submit
        $("#changePassForm").validate({
                rules: {
                        oldPassword: "required",
                        newPassword: {
                                required: true,
                                minlength: 6,
                                maxlength: 20
                        },
                        confirmPassword: {
                                required: true,
                                equalTo: '#newPassword'
                        }
                },
                messages: {
                        oldPassword: "Please enter old password",
                        newPassword: {
                                required: "Please enter new password",
                                minlength: "New password must be min 6 char long",
                                maxlength: "New password must be max 20 char long"
                        },
                        confirmPassword: {
                                required: "Please enter confirm password",
                                equalTo: "Password does not match"
                        }
                }
        });

		

});
</script>