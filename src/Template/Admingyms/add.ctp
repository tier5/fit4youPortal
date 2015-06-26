<div class="span10">

<div class="row-fluid">
    <div class="span12">
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo BASE_URL; ?>administrator/dashboard">Admin</a> <span class="divider">/</span>
            </li>
            <li>
                <a href="<?php echo BASE_URL; ?>administrator/organisation">Gym</a> <span class="divider">/</span>
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
        <span>Gym Details</span>
    </div>

    <span style="color:green;"><?= $this->Flash->render('positive') ?></span>

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
                            <label for="input01" class="control-label">Gym Address<span style="color:#ff0000;">*</span></label>

                            <div class="controls">
                                <textarea name="gymAddress" id="gymAddress" class="span10"></textarea>
                            </div>
                        </div>
			
			<div class="control-group">
                            <label for="input01" class="control-label">Gym Email<span style="color:#ff0000;">*</span></label>

                            <div class="controls">
                                <input type="text" value="" name="gymEmail" id="gymEmail" class="span10" id="input01">
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">Gym Phone<span style="color:#ff0000;">*</span></label>

                            <div class="controls">
                                <input type="text" value="" name="gymPhone" id="gymPhone" class="span10" id="input01">
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label"></label>

                            <div class="controls">
                                <input type="submit" value="Submit" name="confirmPassword" id="confirmPassword" class="span10" id="input01">
                            </div>
                        </div>
                       
                    </fieldset>
                </form>
            </div>


        </div>
    </div>
</section>

</div>
