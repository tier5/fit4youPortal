<div class="span10">

<div class="row-fluid">
    <div class="span12">
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo BASE_URL; ?>admin/dashboard">Admin</a> <span class="divider">/</span>
            </li>
            <li>
                <a href="<?php echo BASE_URL; ?>admin/organisation/">Gym</a> <span class="divider">/</span>
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
        <span>Gym Details</span>
    </div>

    <span style="color:green;"><?= $this->Flash->render('positive') ?></span>

    <div class="row-fluid">
        <div class="utopia-widget-content">
            <div class="span6 utopia-form-freeSpace">
                <form class="form-horizontal" name="changePassForm" id="changePassForm" action="" method="post">
                    <fieldset>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">Gym Name</label>

                            <div class="controls">
                                <input type="text" name="gymName" id="gymName" value="<?php echo $gyms['gymName']; ?>" class="span10" id="input01">
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">Gym Address</label>

                            <div class="controls">
                                <textarea name="gymAddress" id="gymAddress" class="span10" id="input01"><?php echo $gyms['gymAddress']; ?></textarea>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">Gym Phone</label>

                            <div class="controls">
                                <input type="text" name="gymPhone" id="gymPhone"  value="<?php echo $gyms['gymPhone']; ?>" class="span10" id="input01">
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">Gym Email</label>

                            <div class="controls">
                                <input type="text" name="gymEmail" id="gymEmail"  value="<?php echo $gyms['gymEmail']; ?>" class="span10" id="input01">
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label"></label>

                            <div class="controls">
                                <input type="submit" value="Submit" name="subBtn" id="subBtn" class="span10" id="input01">
                            </div>
                        </div>                        
                    </fieldset>
                </form>
            </div>

        </div>
    </div>
</section>

</div>