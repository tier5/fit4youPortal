<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo h($title);?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo h($description);?>">
    <meta name="author" content="<?php h(implode(',',$authors));?>">

    <!-- styles -->
    <?php
        echo $this->element('admin_login/header_css');
        echo $this->element('admin_login/header_js');
    ?>
    
   

</head>

<body>

<div class="container-fluid">

    <div class="row-fluid">
        <div class="span12">
            <div class="utopia-login-message">
                <h1>Welcome to <?php echo SITE_NAME;?></h1>
                <p>Sign in to get access</p>
            </div>
        </div>
    </div>

    <div class="row-fluid">

        <div class="span12">

            <div class="row-fluid">

                <div class="span6">
                    <div class="utopia-login-info">
                     <?php
                          echo $this->Html->image('../backend/img/login.png', ['alt' => 'image']);
                    ?>
                    </div>
                   
                </div>
                 <?php
                  echo $this->fetch('content');
                    ?>
</div>
            

            </div>

        </div>
    </div>
</div> <!-- end of container -->

<!-- javascript placed at the end of the document so the pages load faster -->
<?php
$this->element('admin_login/footer_js');
?>
</body>
</html>
