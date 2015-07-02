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
                <a href="">Profile</a> <span class="divider"></span>
            </li>
        </ul>
    </div>
</div>
   
    
 

<section class="utopia-widget utopia-form-box section" id="formElement">
    <div class="utopia-widget-title imageColorCHange">
        <?php echo $this->Html->image('../backend/img/icons2/software24.png',array("class" => "utopia-widget-icon"));?>
        <!--<img class="utopia-widget-icon" src="../backend/img/icons2/software24.png">-->
        <span>User Details View</span>
    </div>

    
    <span style="color:green; font-size:18px; padding-top:10px;"><?= $this->Flash->render('positive') ?></span>
    <div class="row-fluid">
        <div class="utopia-widget-content">
            <div class="span12 utopia-form-freeSpace">
				<div class="control-group">
					<label for="input01" class="control-label"><?php echo $user['firstName']; ?></label>
				</div>
			
			</div>
			
			<div class="control-group">
				<!--<label for="input01" class="control-label">&nbsp;</label>-->
				<div class="span2">
                    <div class="controls">
                        <img src="<?php echo SITE_UPLOADS; ?>images/users_profile/thumb/<?php echo $user['photo']; ?>" alt="User Image" />
                    </div>                    
                </div>
                <div class="span10">
                	<div class="controls">
                    	Christiano Ronaldo
                    </div>
                    <div class="controls">
                    	cr7@gmail.com
                    </div>
                </div>
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
<style>
.imageColorCHange img{ filter: brightness(10);
    -webkit-filter: brightness(10);
    -moz-filter: brightness(10);
    -o-filter: brightness(10);
    -ms-filter: brightness(10);}
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>