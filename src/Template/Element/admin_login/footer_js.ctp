
<?php
echo $this->Html->script(['../backend/js/utopia','../jqvd/jquery.validationEngine','../jqvd/jquery.validationEngine-en']);
?>
<script type="text/javascript">
    jQuery(function(){
        jQuery(".utopia").validationEngine('attach', {promptPosition : "topLeft", scroll: false});
    })
</script>