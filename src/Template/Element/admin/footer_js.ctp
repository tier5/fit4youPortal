
<!-- javascript placed at the end of the document so the pages load faster -->
<?php
echo $this->Html->script(['../backend/js/utopia','../backend/js/jquery.hoverIntent.min','../backend/js/jquery.easing.1.3','../backend/js/jquery.datatable','../backend/js/tables','../backend/js/jquery.sparkline','../backend/js/jquery.vticker-min','../backend/js/upload/load-image.min','../backend/js/upload/image-gallery.min','../jqvd/jquery.validationEngine','../backend/js/maskedinput','../backend/js/chosen.jquery','../backend/js/sidebar','../backend/js/header6654.js?v1']);

echo $this->Html->script(['../backend/js/pop-up']);
echo $this->Html->script(['../backend/js/jquery.ui.timepicker']);
echo $this->Html->script(['http://code.jquery.com/ui/1.11.4/jquery-ui.js']);
echo $this->Html->script(['../backend/js/additional-methods']);

?>


<script type="text/javascript">

    jQuery(function() {

        

        
        
        $(".chzn-select").chosen(); $(".chzn-select-deselect").chosen({allow_single_deselect:true});

       

        
       
        
    });

    
    $("#utopia-sparkline-type1").sparkline([5, 6, 7, 9, 9, 5, 3, 2, 2, 4, 6, 7, 5, 6, 7, 9, 9], {type:"line", height:48, width:140});

    $('.utopia-activity-feeds').vTicker({
        speed: 500,
        pause: 3000,
        animation: 'fade',
        height: 335,
        mousePause: true,
        showItems: 4
    });


    
</script>