<div class="span10">

<div class="row-fluid">
    <div class="span12">
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo BASE_URL; ?>administrator/dashboard">Admin</a> <span class="divider">/</span>
            </li>
            <li>
                <a href="<?php echo BASE_URL; ?>administrator/user">User</a> <span class="divider">/</span>
            </li>
            <li>
                <a href="">Add</a> <span class="divider"></span>
            </li>
        </ul>
    </div>
</div>
   
    
 

<section class="utopia-widget utopia-form-box section" id="formElement">
    <div class="utopia-widget-title">
        <?php echo $this->Html->image('../backend/img/icons2/software24.png',array("class" => "utopia-widget-icon"));?>
        <!--<img class="utopia-widget-icon" src="../backend/img/icons2/software24.png">-->
        <span>Add User Details</span>
    </div>

    
    <span style="color:green; font-size:18px; padding-top:10px;"><?= $this->Flash->render('positive') ?></span>
    <span style="color:red;"><?= $this->Flash->render('negative') ?></span>
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
                                <input value="" type="text" value="" name="userPin" id="userPin" class="span10" id="input01">
                            </div>
                        </div>
                        
                        <div class="control-group" style="display: block;">
                            <label for="input01" class="control-label">Username<span style="color:#ff0000;">*</span></label>

                            <div class="controls">
                                <input value="" type="text" value="" name="username" id="username" class="span10" id="input01">
                            </div>
                        </div>
                        
                        <div class="control-group" style="display: block;">
                            <label for="input01" class="control-label">Password<span style="color:#ff0000;">*</span></label>

                            <div class="controls">
                                <input value="" type="password" value="" name="password" id="password" class="span10" id="input01">
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
                            <label for="input01" class="control-label">Email<span style="color:#ff0000;">*</span></label>

                            <div class="controls">
                                <input type="text" value="" name="email" id="email" class="span10" id="input01"> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">Phone<span style="color:#ff0000;">*</span></label>

                            <div class="controls">
                                <input type="text" value="" name="phone" id="phone" class="span10" id="input01"> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">City<span style="color:#ff0000;">*</span></label>

                            <div class="controls">
                                <input type="text" value="" name="city" id="city" class="span10" id="input01"> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">State<span style="color:#ff0000;">*</span></label>

                            <div class="controls">
                                <input type="text" value="" name="state" id="state" class="span10" id="input01"> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">Country<span style="color:#ff0000;">*</span></label>
                            
                            <div class="controls">
                                <input type="text" value="" name="country" id="country" class="span10" id="input01">
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">Zip<span style="color:#ff0000;">*</span></label>
                            
                            <div class="controls">
                                <input type="text" value="" name="zip" id="zip" class="span10" id="input01">
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">Address<span style="color:#ff0000;">*</span></label>

                            <div class="controls">
                                <textarea class="span10" name="address" id="address"></textarea> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">Image<span style="color:#ff0000;">*</span></label>

                            <div class="controls">
                                <input type="file" name="usersImage" id="usersImage">
                                <br />
                                <span id="errUsersImage" style="color:#ff0000;"></span>
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="input01" class="control-label"></label>

                            <div class="controls">
                                <input type="submit" value="Submit" name="submitBtn" id="submitBtn" class="span10" id="input01">
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
                        userPin: "required",
                        firstName: "required",
                        lastName: "required",
                        username: {
                                required: true,
                                minlength: 4,
                                maxlength: 14
                        },
                        password: {
                                required: true,
                                minlength: 6,
                                maxlength: 20
                        },
                        email: {
                                required: true,
                                email: true
                        },
                        phone: "required",
                        city: "required",
                        state: "required",
                        country: "required",
                        zip: "required",
                        address: "required"
                },
                messages: {
                        role: "Please select user role",
                        userPin: "please enter user PIN",
                        firstName: "Please enter user's firstname",
                        lastName: "Please enter user's lastname",
                        username: {
                                required: "Please enter a username",
                                minlength: "Your username must consist of at least 4 characters",
                                maxlength: "Your username must consist less or equal 14 characters"
                        },
                        password: {
                                required: "Please provide a password",
                                minlength: "Your password must be at least 6 characters",
                                maxlength: "Your password must consist less or equal 20 characters"
                        },
                        
                        email: {
                                required: "Please enter email ID",
                                email: "Email ID not valid"
                        },
                        phone: "Please enter phone number",
                        city: "Please enter city",
                        state: "Please enter state",
                        country: "Please enter country",
                        zip: "Please enter zip",
                        address: "Please enter address"
                }
        });

		

});
</script>
