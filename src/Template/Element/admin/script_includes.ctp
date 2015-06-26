<script>
    var global_path='<?php echo BASE_URL;?>';
</script>
<?php

//echo $this->Html->script('../backend/js/utopia');
//echo $this->Html->script('../backend/js/jquery.hoverIntent.min');
//echo $this->Html->script('../backend/js/jquery.easing.1.3');
//echo $this->Html->script('../backend/js/jquery.datatable');
//echo $this->Html->script('../backend/js/tables');
//echo $this->Html->script('../backend/js/jquery.sparkline');
//echo $this->Html->script('../backend/js/jquery.vticker-min');
//echo $this->Html->script('../backend/js/angular');
//echo $this->Html->script('../backend/js/upload/load-image.min');
//echo $this->Html->script('../backend/js/upload/image-gallery.min');
//echo $this->Html->script('../backend/js/jquery.simpleWeather');
//echo $this->Html->script('../backend/js/bootstrap-datepicker');

//echo $this->Html->script('../backend/js/jquery.validationEngine');
//echo $this->Html->script('../backend/js/jquery.validationEngine-en');

//echo $this->Html->script('../backend/js/maskedinput');
//echo $this->Html->script('../backend/js/chosen.jquery');

//echo $this->Html->script('../backend/js/map');
//echo $this->Html->script('../backend/js/gmap3');

?>
<script type="text/javascript" src="<?php echo BASE_URL;?>/app/webroot/backend/js/header6654.js?v1"></script>

<?php
//echo $this->Html->script('../backend/js/sidebar');
?>
<script type="text/javascript">

    $(function() {

        //$( "#utopia-dashboard-datepicker" ).datepicker().css({marginBottom:'20px'});

        //$(".chzn-select").chosen(); $(".chzn-select-deselect").chosen({allow_single_deselect:true});

       
        
    });

    
    //$("#utopia-sparkline-type1").sparkline([5, 6, 7, 9, 9, 5, 3, 2, 2, 4, 6, 7, 5, 6, 7, 9, 9], {type:"line", height:48, width:140});
    //
    //$('.utopia-activity-feeds').vTicker({
    //    speed: 500,
    //    pause: 3000,
    //    animation: 'fade',
    //    height: 335,
    //    mousePause: true,
    //    showItems: 4
    //});

    $(document).ready(function(){
        id='#<?php echo $left_sidebar_selected;?>';
        
        $(id).addClass("current");
        if (id=='#add_enterprise')
        {
            //$('#manage_enterprise #manage_ent_a span').css('color','green');
        }
        });
    
    //permanent delete confirmation function
    
    function do_confirm(url_sent)
    {
        if (confirm('All your related records will also be deleted and once deleted it can\'t be restored.Do you still want to delete?'))
        {
            window.location.href=url_sent;
        }
    }
    
    //trash confirmation function
    
    function do_trash(url_sent)
    {
        if (confirm('Confirm delete?'))
        {
            window.location.href=url_sent;
        }
    }
    
    /***********
     * operation to check whether to allow the delete action to proceed.
     * return true if user wants to proceed with the delete operation
     * else return false
     * Normally used in hyperlinks. It is assumed that the anchor link has url
     * to the delete operation
     * 
     * In the hyperlink, use it like
     * onclick="return confirm_delete(msg);"
     */
    function confirm_delete(msg)
    {
        /*******
         * if the msg is not specified or blank, use a default message
         */
        if((typeof msg === "undefined")||(msg === ''))
        {
            msg = "This record and all related records (if any) will be deleted and cannot be restored. Do you still  want to delete?";
        }
        var ok = confirm(msg);
        if(ok)
        {
            return true;
        }
        return false;
    }
    
    //function for slidetoggle
    function maketoggle(id,imgid)
    {
        $('#'+id).fadeToggle(2000);
       
            imgvalue=$('#'+imgid).attr('imgvalue');
            if (imgvalue=='up')
            {
                $('#'+imgid).attr('imgvalue','down');
                $('#'+imgid).attr('src','<?php echo BASE_URL;?>app/webroot/backend/img/icons2/directional_down.png');
            }
            else if (imgvalue=='down')
            {
                $('#'+imgid).attr('imgvalue','up');
                $('#'+imgid).attr('src','<?php echo BASE_URL;?>app/webroot/backend/img/icons2/directional_up.png');
            }
        
    }
</script>
<script>
   // $(document).ready(function(){if($('#validation').length){$('#validation').validationEngine('hideAll');}});
</script>
