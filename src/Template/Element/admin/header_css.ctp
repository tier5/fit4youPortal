<!-- styles -->
<?php

echo $this->Html->css(['../backend/css/utopia-white','../backend/css/utopia-responsive','../backend/css/ui-lightness/jquery-ui','../backend/css/modal','../jqvd/css/validationEngine.jquery','../backend/css/chosen','../backend/css/ie','../backend/css/datepicker']);
echo $this->Html->css(['../backend/fullcalendar/fullcalendar']);
echo $this->Html->css(['../backend/fullcalendar/fullcalendar.print'],['media' => 'print']);
echo $this->Html->css(['../backend/css/font-awesome.min.css']);
echo $this->Html->css(['../backend/css/styles']);
echo $this->Html->css(['../backend/css/jquery.ui.timepicker']);
echo $this->Html->css(['https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css']);

?>
 
<!--[if IE 8]>

    <?php

    echo  $this->Html->css(['../backend/css/ie8']);
    ?>

<![endif]-->

<!--[if gte IE 9]>
      
      <style type="text/css">
        .gradient {
           filter: none;
        }
      </style>
      
<![endif]-->