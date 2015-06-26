<?php
 echo $this->Html->script('../backend/js/ckeditor/ckeditor');
?>
<?php
if(isset($ckeditor_ids))
{
    foreach($ckeditor_ids as $ckeditor_id)
    {
?>
<script>
$(document).ready(function(){CKEDITOR.replace('<?php echo $ckeditor_id;?>');});

</script>
<?php
    }

if(isset($ck_key))
{
?>
	<script>
		$(document).ready(function(){i=CKEDITOR.instances.messagebody;i.on('key',function(){});});
	</script>
<?php
}
}
?>

<script>
     $(document).ready(
     function(){
      if($('#clinicmanagers_date_of_birth').length){
       
       dt = new Date();
       dt.setFullYear(new Date().getFullYear()-10);
       $('#clinicmanagers_date_of_birth').datepicker({
          format:'yyyy/mm/dd',
         endDate: dt
  });
       }
       if($('#date_of_birth').length){
       
       dt = new Date();
       dt.setFullYear(new Date().getFullYear()-10);
       $('#date_of_birth').datepicker({
          format:'yyyy/mm/dd',
         endDate: dt
  });
       }
       if($('#date').length){
       dt = new Date();
       
       $('#date').datepicker({
          format:'yyyy-mm-dd',
          endDate: dt
        
  	});
       }
       if($('#date_payment').length){
       dt = new Date();
       
       $('#date_payment').datepicker({
          format:'yyyy-m-d',
          //endDate: dt
        
  	});
       }
	if($('#add_award').length){
       dt = new Date();
       
       $('#add_award').datepicker({
          format:'yyyy-m-d',
          //endDate: dt
        
  	});
       }
       
       });
</script>
