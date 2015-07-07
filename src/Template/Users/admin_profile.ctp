
<div class="span10">

<div class="row-fluid">
    <div class="span12">
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo BASE_URL; ?>administrator/dashboard">Admin</a> <span class="divider">/</span>
            </li>
            <li>
                <a href="<?php echo BASE_URL; ?>administrator/user">Client</a> <span class="divider">/</span>
            </li>
            <li>
                <a href="">Edit</a> <span class="divider"></span>
            </li>
        </ul>
    </div>
</div>

<section class="utopia-widget utopia-form-box section" id="formElement">
    <div class="utopia-widget-title">
        <?php echo $this->Html->image('../backend/img/icons2/software24.png',array("class" => "utopia-widget-icon"));?>
        <!--<img class="utopia-widget-icon" src="../backend/img/icons2/software24.png">-->
        <span>Client Details</span>
    </div>

    <span style="color:green;"><?= $this->Flash->render('positive') ?></span>
    <span style="color:red;"><?= $this->Flash->render('negative') ?></span>

    <div class="row-fluid">
        <div class="utopia-widget-content">
            <div class="span6 utopia-form-freeSpace">
                <form class="form-horizontal" name="addFrm" id="addFrm" action="" method="post" enctype="multipart/form-data">
                    <fieldset>

                        <div class="control-group" style="display: block;">
                            <label for="input01" class="control-label">User Pin Code<span style="color:#ff0000;">*</span></label>

                            <div class="controls">
                                <input type="text" value="<?php echo $users['userPin']; ?>" name="userPin" id="userPin" class="span10" id="input01">
                            </div>
                        </div>
                        
                        <div class="control-group" style="display: block;">
                            <label for="input01" class="control-label">Username<span style="color:#ff0000;">*</span></label>

                            <div class="controls">
                                <input type="text" value="<?php echo $users['username']; ?>" name="username" id="username" class="span10" id="input01">
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
                            <label for="input01" class="control-label">Email<span style="color:#ff0000;">*</span></label>

                            <div class="controls">
                                <input type="text" value="<?php echo $users['email']; ?>" name="email" id="email" class="span10" id="input01"> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01"  class="control-label">Phone<span style="color:#ff0000;">*</span></label>

                            <div class="controls">
                                <input type="text" onkeypress="return isNumber(event)" value="<?php echo $users['phone']; ?>" name="phone" id="phone" class="span10" id="input01"> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">City<span style="color:#ff0000;">*</span></label>

                            <div class="controls">
                                <input type="text" value="<?php echo $users['city']; ?>" name="city" id="city" class="span10" id="input01"> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">State<span style="color:#ff0000;">*</span></label>

                            <div class="controls">
                                <input type="text" value="<?php echo $users['state']; ?>" name="state" id="state" class="span10" id="input01"> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">Country<span style="color:#ff0000;">*</span></label>
                            
                            <div class="controls">
                                <input type="text" value="<?php echo $users['country']; ?>" name="country" id="country" class="span10" id="input01">
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">Zip<span style="color:#ff0000;">*</span></label>
                            
                            <div class="controls">
                                <input type="text" value="<?php echo $users['zip']; ?>" name="zip" id="zip" class="span10" id="input01">
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">Address<span style="color:#ff0000;">*</span></label>

                            <div class="controls">
                                <textarea name="address" id="address"><?php echo $users['address']; ?></textarea> 
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
                            <label for="input01" class="control-label"></label>

                            <div class="controls">
                                <input type="submit" value="Submit" name="submitBtn" id="submitBtn" class="span10" id="input01">
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
                        userPin: "required",
                        firstName: "required",
                        lastName: "required",
                        username: {
                                required: true,
                                minlength: 4,
                                maxlength: 14
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
