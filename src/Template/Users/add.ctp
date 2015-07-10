<div class="span10">

<div class="row-fluid">
    <div class="span12">
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo BASE_URL; ?>administrator/dashboard">Admin</a> <span class="divider">/</span>
            </li>
            <li>
                Add User
            </li>
        </ul>
    </div>
</div>
   
    <span class="msg_class"><?= $this->Flash->render('negative') ?></span>

<section class="utopia-widget utopia-form-box section" id="formElement">
    <div class="utopia-widget-title">
        <?php echo $this->Html->image('../backend/img/icons2/software24.png',array("class" => "utopia-widget-icon"));?>
        <!--<img class="utopia-widget-icon" src="../backend/img/icons2/software24.png">-->
        <span>Add User Details</span>
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
                                    <option value="<?php echo $val->roleName; ?>"><?php echo $val->roleName; ?></option> 
                                    <?php } ?>
                                </select>                             
                            </div>
                        </div>
                        
                        <div class="control-group" style="display: block;">
                            <label for="input01" class="control-label">User Pin Code<span style="color:#ff0000;">*</span></label>

                            <div class="controls">
                                <input type="text" value="" name="userPin" id="userPin" class="span10" id="input01">
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="input01" class="control-label">First Name<span style="color:#ff0000;">*</span></label>

                            <div class="controls">
                                <input type="text" value="" name="firstName" id="firstName" class="span10" id="input01">
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">Last Name<span style="color:#ff0000;">*</span></label>

                            <div class="controls">
                                <input type="text" value="" name="lastName" id="lastName" class="span10" id="input01">                               
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">Email</label>

                            <div class="controls">
                                <input type="text" value="" name="email" id="email" class="span10" id="input01"> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">Phone</label>

                            <div class="controls">
                                <input type="text" value="" name="phone" id="phone" class="span10" id="input01"> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">Address</label>

                            <div class="controls">
                                <textarea class="span10" name="address" id="address"></textarea> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">City</label>

                            <div class="controls">
                                <input type="text" value="" name="city" id="city" class="span10" id="input01"> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">State</label>

                            <div class="controls">
                                <input type="text" value="" name="state" id="state" class="span10" id="input01"> 
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="input01" class="control-label">Zip</label>
                            
                            <div class="controls">
                                <input type="text" value="" name="zip" id="zip" class="span10" id="input01">
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">Image</label>

                            <div class="controls">
                                <input type="file" name="usersImage" id="usersImage">
                                <br />
                                <span id="errUsersImage" style="color:#ff0000;"></span>
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
                <script type="text/javascript">
                    $('#usersImage').bind('change', function() {

                    var fileSize = this.files[0].size;
                    if (fileSize > 1048578) {
                        $('#errUsersImage').html("Max file size is 1 MB is allowed.");
                        $('#usersImage').val('');
                    }else{
                        $('#errUsersImage').html("");
                    }
                  
                  });
                </script>
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
                        userPin: {
                            required: true,
                            minlength: 4,
                            maxlength: 6,
                            number: true,
                        },
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