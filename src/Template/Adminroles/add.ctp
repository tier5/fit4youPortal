<div class="span10">

<div class="row-fluid">
    <div class="span12">
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo BASE_URL; ?>administrator/dashboard">Admin</a> <span class="divider">/</span>
            </li>
            <li>
                <a href="<?php echo BASE_URL; ?>administrator/roles/add">Role</a> <span class="divider">/</span>
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
        <span>Add Role</span>
    </div>

    <span style="color:green;"><?= $this->Flash->render('positive') ?></span>
    <span style="color:red;"><?= $this->Flash->render('negative') ?></span>

    <div class="row-fluid">
        <div class="utopia-widget-content">
            <div class="span6 utopia-form-freeSpace">
                <form class="form-horizontal" name="addFrm" id="addFrm" action="" method="post" enctype="multipart/form-data">
                    <fieldset>
				    <form name="addFrm" id="addFrm" method="POST" action="">
					<fieldset>			    
					    <div class="control-group" style="display: block;">
						<label for="input01" class="control-label">Role<span style="color:#ff0000;">*</span></label>
		    
						<div class="controls">
						   <input type="text" placeholder="Enter roles here" name="roleName" id="roleName" value="" />
						</div>
					    </div>
	    
					    <div class="control-group">
						<label for="input01" class="control-label"></label>
			    
						<div class="controls">
						    <input type="submit" value="Submit" name="submitBtn" id="submitBtn" id="input01">
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
                        roleName: "required"
                }
        });

		

});
</script>
