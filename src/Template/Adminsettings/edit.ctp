
<div class="span10">

<div class="row-fluid">
    <div class="span12">
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo BASE_URL; ?>administrator/dashboard">Admin</a> <span class="divider">/</span>
            </li>
            <li>
                Edit Settings
            </li>
        </ul>
    </div>
</div>

<section class="utopia-widget utopia-form-box section" id="formElement">
    <div class="utopia-widget-title">
        <?php echo $this->Html->image('../backend/img/icons2/software24.png',array("class" => "utopia-widget-icon"));?>
        <!--<img class="utopia-widget-icon" src="../backend/img/icons2/software24.png">-->
        <span>Setting Details</span>
    </div>

    <span class="msg_class"><?= $this->Flash->render('positive') ?></span>
    <span class="msg_class"><?= $this->Flash->render('negative') ?></span>

    <div class="row-fluid">
        <div class="utopia-widget-content">
            <div class="span6 utopia-form-freeSpace">
                <form class="form-horizontal" name="addFrm" id="addFrm" action="" method="post" enctype="multipart/form-data">
                    <fieldset>
                        
                        <div class="control-group" style="display: block;">
                            <label for="input01" class="control-label">Name<span style="color:#ff0000;">*</span></label>

                            <div class="controls">
                                <input type="text" readonly value="<?php echo $setting['name']; ?>" name="name" id="name" class="span10" id="input01">
                            </div>
                        </div>
                        
                        <div class="control-group" style="display: block;">
                            <label for="input01" class="control-label">Description<span style="color:#ff0000;">*</span></label>

                            <div class="controls">
                                <textarea name="description" id="description" class="span10"><?php echo $setting['description']; ?></textarea>
                            </div>
                        </div>
                        
                        <div class="control-group" style="display: block;">
                            <label for="input01" class="control-label">Value<span style="color:#ff0000;">*</span></label>

                            <div class="controls">
                                <input type="text" value="<?php echo $setting['value']; ?>" name="value" id="value" class="span10" id="input01">
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">Active<span style="color:#ff0000;"></span></label>

                            <div class="controls">
                                <input type="radio" name="status" value="1" <?php if($setting['status'] == '1'){?> checked <?php }?> >&nbsp;Yes&nbsp;
                                <input type="radio" name="status" value="0" <?php if($setting['status'] == '0'){?> checked <?php }?> >&nbsp;No&nbsp;
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
                        value: "required"
                }
        });

		

});
</script>