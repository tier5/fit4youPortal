
<div class="span10">


<section class="utopia-widget utopia-form-box section" id="formElement">

    <div class="row-fluid">
        <div class="utopia-widget-content">
            <div class="span6 utopia-form-freeSpace">
                <?php echo $this->Form->create(null, ['url' => '/webservice/clientlogin','type' => 'post']) ?>
                    <fieldset>
                        
                      
                        <div class="control-group" style="display: block;">
                            <label for="input01" class="control-label">User Pin Code<span style="color:#ff0000;">*</span></label>

                            <div class="controls">
                                <input type="text" value="" name="pin" id="userPin" class="span10" id="input01">
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
                <?php echo $this->Form->end() ?>
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
