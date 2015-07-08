<div class="body-container span10">

            <div class="row-fluid">
                <div class="span12">
                    <ul class="breadcrumb" id="labelDiv">
                        <li>
                            <a href="<?php echo BASE_URL; ?>administrator/dashboard">Admin</a> <span class="divider">/</span>
                        </li>
                        <li>
                            Schedules
                        </li>
                    </ul>
                </div>
            </div>
            
            <style type="text/css">
                        .stopHidden {
                                display: block !important;
                                margin-left: 15px !important;
                                margin-top: 9px !important;
                        }
                    </style>
            <script type="text/javascript">
            $(document).ready(function(){
                        $('#pageLabelDiv').click(function(){
                            $('.utopia-widget-content').show().stop();
                        });
                        });
</script>
	    <span class="msg_class"><?= $this->Flash->render('positive') ?></span>
            <div class="row-fluid">

                <div class="span12">
                    <section class="utopia-widget">
                        <div class="utopia-widget-title" id="pageLabelDiv">
                            <img class="utopia-widget-icon" src="<?php echo BASE_URL; ?>backend/img/icons/paragraph_justify.png">
                            <span>Schedule List</span>
			    <span class="new_span_class"><a href="<?php echo BASE_URL; ?>administrator/schedule/add"><i class="fa fa-pencil"></i> Add Session</a></span>
                        </div>
                        <div class="utopia-widget-content">
                        
                        <script type="text/javascript">
                            $(document).ready(function(){
                                $('#organisationType').change(function(){
                                    $('#organNameSrchFrm').submit();
                                });       
                            });
                        </script>  

                        <script type="text/javascript">
                            function goForSearch(){
                                
                                var organisationType = $('#organisationType').val();                                
                                var searchByKeyword = $('#searchKey').val();                                
                                var url = '<?php echo BASE_URL; ?>admin/organisation?organisationType='+organisationType;
                                url += '&searchKey='+searchByKeyword;
                                window.location.href = url;
                            }
                        </script>      
                            <span id="schedule_list" style="display: none;">
                              <div class="myAnchorSpanArea">
                                   <span  class="active"><a href="javascript:void(0);" id="list2"><i class="fa fa-list-ul"></i>List View</a></span>
                                   <span ><a href="javascript:void(0);" id="chart2"><i class="fa fa-line-chart"></i>Calendar View</a></span>
                              </div>
                              <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <!--<th><input type="checkbox" class="utopia-check-all"></th>-->
                                    <th><?= $this->Paginator->sort('client_fname','Client Name') ?></th>
                                    <th><?= $this->Paginator->sort('trainer_fname','Trainer Name') ?></th>
                                    <th><?= $this->Paginator->sort('start_time','Start Time') ?></th>
                                    <th><?= $this->Paginator->sort('end_time','End Time') ?></th>
                                    <th class="actions"><?= __('Actions') ?></th>
                                </tr>
                                </thead>


                                <tbody>  
                                    
                                <?php if($allRecordCount > 0){ $schedule = 0;?>
                                <?php foreach ($schedules as $schedule): $data = $schedule->toArray();
                                        $start_time = get_object_vars($data['start_time']);
                                        $end_time = get_object_vars($data['end_time']);
                              ?>
                                <tr>
                                    <td><?= h($data['client']['firstName']) ?>&nbsp;<?= h($data['client']['lastName']) ?></td>
                                    <td><?= h($data['trainer']['firstName']) ?>&nbsp;<?= h($data['trainer']['lastName']) ?></td>
                                    <td><?= h($start_time['date']) ?></td>
                                    <td><?= h($end_time['date']) ?></td>
                                    <td>
                                        <a href="<?php echo BASE_URL; ?>administrator/schedule/edit/<?php echo  $data['id']; ?>">Edit</a>
                                        &nbsp;|&nbsp;
                                        <a onclick="return delConfirm();" href="<?php echo BASE_URL; ?>administrator/schedule/delete/<?php echo  $data['id']; ?>">Delete</a>
                                </tr>                                
                                <?php endforeach; ?>
                                <?php }else{ ?>
                                <tr><td colspan="5">No Records.</td></tr>
                                <?php } ?>
                                </tbody>

                                
                              </table>
                            
                            

                              <div class="row-fluid">
                            
                                <div class="span6"> </div>

                                <div class="span6">
                                    <div class="pagination pagination-right">
                                        <ul class="pagination">
                                            <?= $this->Paginator->prev('< ' . __('previous')) ?>
                                            <?= $this->Paginator->numbers() ?>
                                            <?= $this->Paginator->next(__('next') . ' >') ?>
                                        </ul>
                                        <p><?= $this->Paginator->counter() ?></p>
                                    </div>
                                </div>
                            </div>
                         </span>
                         <span id="schedule_calendar" style="display:block;">
                              <div class="myAnchorSpanArea">
                                   <span><a href="javascript:void(0);" id="list2"><i class="fa fa-list-ul"></i>List View</a></span>
                                   <span class="active"><a href="javascript:void(0);" id="chart2"><i class="fa fa-line-chart"></i>Calendar View</a></span>
                              </div>
                              <div id='calendar'></div>
                         </span>
                        </div>
                    </section>
                </div>
            </div>



</div>

<script type="text/javascript">
    function delConfirm()
    {
            var ans = confirm("Do you really want to delete this record ?");
            if (ans){
                return true;
            }else{
                return false;
            }
    }
</script>
<script>

	$(document).ready(function() {
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultDate: new Date(),
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: [
                              <?php if($allRecordCount > 0){ $schedule = 0;?>
                              <?php foreach ($schedules as $schedule): $data = $schedule->toArray();
                                      $start_time = get_object_vars($data['start_time']);
                                      $start_datetime = explode(' ',$start_time['date']);
                                      $end_time = get_object_vars($data['end_time']);
                                      $end_datetime = explode(' ',$end_time['date']);
                              ?>
                                     {
                                             title: '<?= $data['client']['firstName'].' '.$data['client']['lastName'];?>',
                                             start: '<?=$start_time['date'];?>',
                                             end: '<?=$end_time['date'];?>',
					     url: '<?=BASE_URL.'administrator/schedule/edit/'.$data['id'] ;?>'
                                     },
                              <?php endforeach; ?>
                              <?php } ?>
				
                              ]     
		});
		
	});

</script>
<style>

	#calendar {
		max-width: 900px;
		margin: 0 auto;
	}
	#schedule_calendar button{ width:auto;}
</style>

<script type="text/javascript">
$(function(){
	$('#chart1,#chart2').on('click',function(){
		$('#schedule_list').css('display','none');
		$('#schedule_calendar').css('display','block');
	});
	
	$('#list1,#list2').on('click',function(){
		$('#schedule_list').css('display','block');
		$('#schedule_calendar').css('display','none');
	});
	

});
</script>


