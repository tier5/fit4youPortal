 <?php
 echo $this->Html->script(['../backend/js/html5']);
 ?>
 <![endif]-->
<?php
 echo $this->Html->script(['../backend/js/html5','../backend/js/jquery.min']);
 ?>
   <script>
     function hide_it(args)
     {
          $('.'+args).fadeOut();     
     }
     </script>
  