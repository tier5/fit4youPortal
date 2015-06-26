<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $title;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $description;?>">
    <meta name="author" content="<?php echo implode(',',$authors);?>">
    <?php
     echo $this->element('admin/header_css');
     echo  $this->element('admin/header_js');
    ?>

</head>

<body>

<div class="container-fluid">

    <!-- Header starts -->
    <div class="row-fluid">
        <div class="span12">

            <div class="header-top">

                <div class="header-wrapper">

                    <a href="#" class="utopia-logo">
                         <?php echo $this->Html->image('../backend/img/fit-100x100.png');?>
                         
                    </a>

                    <div class="header-right">

                        <div class="header-divider">&nbsp;</div>
                        
                         <?php
                         echo $this->element('admin/top_search_bar');
                         echo $this->element('admin/top_notification_bar');
                         echo $this->element('admin/top_dropdown_menu');
                         ?>

                     </div><!-- End header right -->

                </div><!-- End header wrapper -->

            </div><!-- End header -->

        </div>

    </div>

    <!-- Header ends -->

    <div class="row-fluid">
        <?php
         echo $this->element('admin/left_sidebar');
        ?>