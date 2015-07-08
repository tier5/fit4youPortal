
<div class="span10">

<div class="row-fluid">
    <div class="span12">
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo BASE_URL; ?>administrator/dashboard">Admin</a> <span class="divider">/</span>
            </li>
            <li>
                Edit User
            </li>
        </ul>
    </div>
</div>
  <span class="msg_class"><?= $this->Flash->render('negative') ?></span>
<section class="utopia-widget utopia-form-box section" id="formElement">
    <div class="utopia-widget-title">
        <?php echo $this->Html->image('../backend/img/icons2/software24.png',array("class" => "utopia-widget-icon"));?>
        <!--<img class="utopia-widget-icon" src="../backend/img/icons2/software24.png">-->
        <span>Client Details</span>
    </div>

    <div class="row-fluid">
        <div class="utopia-widget-content">
            <div class="span6 utopia-form-freeSpace">
                <form class="form-horizontal" name="addFrm" id="addFrm" action="" method="post" enctype="multipart/form-data">
                    <fieldset>
                        
                        <div class="control-group" style="display:block;">
                            <label for="select01" class="control-label">User Roles<span style="color:#ff0000;">*</span></label>
                                
                            <div class="controls">
                                <select class="span6" id="role" name="role">
                                    <option value="">--Select--</option> 
                                    <?php foreach($allRoles as $val){ ?>
                                    <option <?php echo $users['role']==$val->roleName ? "selected='selected'" : "" ?> value="<?php echo $val->roleName; ?>"><?php echo $val->roleName; ?></option> 
                                    <?php } ?>
                                </select>                              
                            </div>
                        </div>

                        <div class="control-group" style="display: block;">
                            <label for="input01" class="control-label">User Pin Code<span style="color:#ff0000;">*</span></label>

                            <div class="controls">
                                <input type="text" value="<?php echo $users['userPin']; ?>" name="userPin" id="userPin" class="span10" id="input01">
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">First Name<span style="color:#ff0000;">*</span></label>

                            <div class="controls">
                                <input type="text" value="<?php echo $users['firstName']; ?>" name="firstName" id="firstName" class="span10" id="input01">
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">Last Name<span style="color:#ff0000;">*</span></label>

                            <div class="controls">
                                <input type="text" value="<?php echo $users['lastName']; ?>" name="lastName" id="lastName" class="span10" id="input01">                               
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="input01" class="control-label">Email</label>

                            <div class="controls">
                                <input type="text" value="<?php echo $users['email']; ?>" name="email" id="email" class="span10" id="input01"> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01"  class="control-label">Phone</label>

                            <div class="controls">
                                <input type="text" value="<?php echo $users['phone']; ?>" name="phone" id="phone" class="span10" id="input01"> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">Address</label>

                            <div class="controls">
                                <textarea name="address" id="address"><?php echo $users['address']; ?></textarea> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">City</label>

                            <div class="controls">
                                <input type="text" value="<?php echo $users['city']; ?>" name="city" id="city" class="span10" id="input01"> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">State</label>

                            <div class="controls">
                                <input type="text" value="<?php echo $users['state']; ?>" name="state" id="state" class="span10" id="input01"> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">Zip</label>
                            
                            <div class="controls">
                                <input type="text" value="<?php echo $users['zip']; ?>" name="zip" id="zip" class="span10" id="input01">
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">&nbsp;</label>

                            <div class="controls">
                                <img src="<?php echo SITE_UPLOADS; ?>images/users_profile/thumb/<?php echo $users['photo']; ?>" alt="User Image" />
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">Image<span style="color:#ff0000;"></span></label>

                            <div class="controls">
                                <input type="file" name="usersImage" id="usersImage">
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">Active<span style="color:#ff0000;"></span></label>

                            <div class="controls">
                                <input type="radio" name="is_active" value="1" <?php if($users['is_active'] == '1'){?> checked <?php }?> id="is_active">&nbsp;Yes&nbsp;
                                <input type="radio" name="is_active" value="0" <?php if($users['is_active'] == '0'){?> checked <?php }?> id="is_active">&nbsp;No&nbsp;
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">Logged in<span style="color:#ff0000;"></span></label>

                            <div class="controls">
                                <input type="radio" name="is_login" value="1" <?php if($users['is_login'] == '1'){?> checked <?php }?> id="is_active">&nbsp;Yes&nbsp;&nbsp;
                                <input type="radio" name="is_login" value="0" <?php if($users['is_login'] == '0'){?> checked <?php }?> id="is_active">&nbsp;No&nbsp;&nbsp;
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="input01" class="control-label"></label>

                            <div class="controls">
                                <input type="submit" value="Submit" name="submitBtn" id="submitBtn" id="input01">
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

<script type="text/javascript">
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>
<script>

$().ready(function() {

        // validate signup form on keyup and submit
        $("#addFrm").validate({
                rules: {
                        role: "required",
                        userPin: {required: true, minlength: 4, maxlength: 6, number: true},
                        firstName: "required",
                        lastName: "required",
                        email: {
                                email: true
                        },
                        phone: { phoneUS: true},
                        city: {lettersonly: true},
                        state: {lettersonly: true}
                },
                messages: {
                        role: "Please select user role",
                         userPin: {required: "Please enter user PIN", minlength: "Please enter PIN with in 4-6 digits", maxlength: "Please enter PIN with in 4-6 digits", number: "Please enter valid PIN"},
                        firstName: "Please enter user's firstname",
                        lastName: "Please enter user's lastname",
                        
                        email: {
                                email: "Email ID not valid"
                        },
                        phone: { phoneUS: "Please enter US phone number only"},
                        city: {lettersonly: "Please enter correct city name"},
                        state: {lettersonly: "Please enter correct state name"}
                }
        });

		

});
</script>
