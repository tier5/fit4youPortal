<div class="span10">

<div class="row-fluid">
    <div class="span12">
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo BASE_URL; ?>administrator/dashboard">Admin</a> <span class="divider">/</span>
            </li>
            <li>
                Add Gym
            </li>
        </ul>
    </div>
</div>

<section class="utopia-widget utopia-form-box section" id="formElement">
    <div class="utopia-widget-title">
        <?php echo $this->Html->image('../backend/img/icons2/software24.png',array("class" => "utopia-widget-icon"));?>
        <!--<img class="utopia-widget-icon" src="../backend/img/icons2/software24.png">-->
        <span>Add Gym</span>
    </div>

    <span class="msg_class"><?= $this->Flash->render('positive') ?></span>

    <div class="row-fluid">
        <div class="utopia-widget-content">
            <div class="span6 utopia-form-freeSpace">
                <form class="form-horizontal" name="addFrm" id="addFrm" action="" method="post">
                    <fieldset>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">Gym Name<span style="color:#ff0000;">*</span></label>

                            <div class="controls">
                                <input type="text" value="" name="gymName" id="gymName" class="span10" id="input01">
                            </div>
                        </div>
                        
			<div class="control-group">
                            <label for="input01" class="control-label">Address</label>

                            <div class="controls">
                                <textarea name="gymAddress" id="gymAddress" class="span10"></textarea>
                            </div>
                        </div>
			
			<div class="control-group">
                            <label for="input01" class="control-label">City</label>

                            <div class="controls">
                                <input type="text" value="" name="gymCity" id="gymCity" class="span10" id="input01">
                            </div>
                        </div>
			
			<div class="control-group">
                            <label for="input01" class="control-label">State</label>

                            <div class="controls">
                                <input type="text" value="" name="gymState" id="gymState" class="span10" id="input01">
                            </div>
                        </div>
			
			<div class="control-group">
                            <label for="input01" class="control-label">Zip</label>

                            <div class="controls">
                                <input type="text" value="" name="gymZip" id="gymZip" class="span10" id="input01">
                            </div>
                        </div>
			
			<div class="control-group">
                            <label for="input01" class="control-label">Email</label>

                            <div class="controls">
                                <input type="text" value="" name="gymEmail" id="gymEmail" class="span10" id="input01">
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">Phone</label>

                            <div class="controls">
                                <input type="text" value="" name="gymPhone" id="gymPhone" class="span10" id="input01">
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

<script>

$().ready(function() {

        // validate signup form on keyup and submit
        $("#addFrm").validate({
                rules: {
                        gymName: "required",
                        gymCity: {lettersonly: true},
                        gymState: {lettersonly: true},
                        gymPhone: { phoneUS: true},
                        gymEmail: { email: true}
                },
                messages: {
                        gymName: "Please enter gym name",
                        gymCity: {lettersonly: "Please enter valid city name"},
                        gymState: {lettersonly: "Please enter valid state name"},
                        gymPhone: { phoneUS: "Please enter US phone number only"},
                        gymEmail: {
                                email: "Email ID not valid"
                        }
                }
        });

		

});
</script>