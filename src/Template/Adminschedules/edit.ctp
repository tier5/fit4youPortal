<div class="span10">

<div class="row-fluid">
    <div class="span12">
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo BASE_URL; ?>administrator/dashboard">Admin</a> <span class="divider">/</span>
            </li>
            <li>
                Edit Schedule
            </li>
        </ul>
    </div>
</div>

<section class="utopia-widget utopia-form-box section" id="formElement">
    <div class="utopia-widget-title">
        <?php echo $this->Html->image('../backend/img/icons2/software24.png',array("class" => "utopia-widget-icon"));?>
        <!--<img class="utopia-widget-icon" src="../backend/img/icons2/software24.png">-->
        <span>Edit Shedule</span>
    </div>

    <div class="row-fluid">
        <div class="utopia-widget-content">
            <div class="span6 utopia-form-freeSpace">
                <form class="form-horizontal" name="addFrm" id="addFrm" action="" method="post">
                    <input type="hidden" name="id" value="<?php echo $schedule->id;?>">
                    <fieldset>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">Client<span style="color:#ff0000;">*</span></label>
                            <div class="controls">
                                <select name="client_id" id="client_id">
                                    <option value="">Select Client</option>
                                    <?php
                                        if($totClients>0)
                                        {
                                            foreach($clients as $client)
                                            {
                                    ?>
                                        <option value="<?php echo $client->id;?>" <?php if($client->id == $schedule->client_id){?> selected<?php }?>>
                                        <?php echo $client->firstName;?> <?php echo $client->lastName;?></option>
                                    <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">Trainer<span style="color:#ff0000;">*</span></label>

                            <div class="controls">
                                <select name="trainer_id" id="trainer_id">
                                    <option value="">Select Trainer</option>
                                    <?php
                                        if($totTrainer>0)
                                        {
                                            foreach($trainers as $trainer)
                                            {
                                    ?>
                                        <option value="<?php echo $trainer->id;?>" <?php if($trainer->id == $schedule->trainer_id){?> selected<?php }?>>
                                        <?php echo $trainer->firstName;?> <?php echo $trainer->lastName;?></option>
                                    <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">Date<span style="color:#ff0000;">*</span></label>

                            <div class="controls">
                                 <input type="text" value="<?php echo date('Y-m-d',strtotime($schedule->start_time));?>" name="date" id="datepicker" class="span10" id="input01">
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">Start Time<span style="color:#ff0000;">*</span></label>

                            <div class="controls">
                                 <input type="text" value="<?php echo date('H:i',strtotime($schedule->start_time));?>" name="start_time" id="start_time" class="span10" id="input01">
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">End Time<span style="color:#ff0000;">*</span></label>

                            <div class="controls">
                                 <input type="text" value="<?php echo date('H:i',strtotime($schedule->end_time));?>" name="end_time" id="end_time" class="span10" id="input01">
                                 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label"></label>

                            <div class="controls">
                                <input type="submit" value="Submit" name="confirmPassword" id="submitBtn" id="input01">
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

$().ready(function() {

        // validate signup form on keyup and submit
        $("#addFrm").validate({
                rules: {
                        client_id: "required",
                        trainer_id: "required",
			date: "required",
                        start_time: "required",
                        end_time: "required"
                },
                message: {
                        client_id: "Please select client",
                        trainer_id: "Please select trainer",
			date: "Please select date",
                        start_time: "Please select start time",
                        end_time: "Please select end time"
                    
                }
        });

		

});
</script>
<script type="text/javascript">
        jQuery(document).ready(function () {

	    jQuery( "#datepicker" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy-mm-dd',
		defaultDate: new Date()
	    });
	    
	    jQuery('#start_time').timepicker();
	    jQuery('#end_time').timepicker();
        });
		
		

</script>