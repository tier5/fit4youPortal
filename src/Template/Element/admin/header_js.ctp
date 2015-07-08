<?php
echo $this->Html->script(['../backend/js/jquery.min']);
echo $this->Html->script(['../backend/bootstrap/js/bootstrap.min']);
echo $this->Html->script(['../backend/bootstrap/js/bootstrap']);
echo $this->Html->script(['../backend/fullcalendar/lib/moment.min']);
echo $this->Html->script(['../backend/fullcalendar/fullcalendar.min']);
echo $this->Html->script(['../backend/js/jquery.validate']);


//echo $this->Html->script(['../backend/js/bootstrap-datepicker.js']);
?>



<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->


    <!--[if lt IE 9]>
    
          <?php
                echo $this->Html->script(['../backend/js/html5']);
           ?>
          
    
    <![endif]-->