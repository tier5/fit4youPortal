<div class="body-container span10">

            <div class="row-fluid">
                <div class="span12">
                    <ul class="breadcrumb">
                        <li>
                            <a href="<?php echo BASE_URL; ?>admin/dashboard">Admin</a> <span class="divider">/</span>
                        </li>
                        <li>
                            <a href="">User Stats</a> <span class="divider">/</span>
                        </li>
                    </ul>
                </div>
            </div>
    
            <span style="color:green;"><?= $this->Flash->render('positive') ?></span>

            <div class="row-fluid">

                <div class="span12">
                    <section class="utopia-widget">
                        <div class="utopia-widget-title">
                            <img class="utopia-widget-icon" src="<?php echo BASE_URL; ?>backend/img/icons/paragraph_justify.png">
                            <span>
								<?= $user_details->firstName.' '.$user_details->lastName;?>'s Stats [<?= $user_details->userPin;?>]
								<input type="button" value="Chart" name="chart" id="chart" class="span10" id="input01">
							</span>
                        </div>
                        
                        <style type="text/css">
                            .stopHidden {
                                    display: block !important;
                                    margin-left: 15px !important;
                                    margin-top: 9px !important;
                            }
							#curve_chart{width:100%;height:500px;}
                        </style>
                        
                        <div class="utopia-widget-content">
                                
                            <table class="table table-bordered">

                                <tbody>   
									<tr>
										<td><input type="text" value="" placeholder="weight" name="weight" id="weight" class="span10" ></td>
										<td><input type="text" value="" name="chest" placeholder="chest" id="chest" class="span10" ></td>
										<td><input type="text" value="" name="waist" placeholder="waist" id="waist" class="span10"></td>
										<td><input type="text" value="" name="biceps" placeholder="biceps" id="biceps" class="span10"></td>
										<td><input type="text" value="" name="triceps" placeholder="triceps" id="triceps" class="span10"></td>
										<td><input type="hidden" value="<?= $user_id;?>" name="user_id" id="user_id" class="span10" >
                                        <input type="button" value="Submit" name="submit" id="submit" class="span10"></td>
									</tr>                                
                                </tbody>
                                
                            </table>
							<span id="list_table" style="display:block">
							<table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Weight</th>
                                    <th>Chest</th>
                                    <th>Waist</th>
                                    <th>Biceps</th>
									<th>Triceps</th>
                                    <th class="actions"><?= __('Actions') ?></th>
                                </tr>
                                </thead>


                                <tbody>    
                                <?php if($allRecordCount > 0){ ?>
                                <?php foreach ($stats as $stat): ?>
                                <tr>
                                    <td><?= h($stat->weight) ?><?= h($stat->firstName) ?></td>
									<td><?= h($stat->chest) ?></td>
									<td><?= h($stat->waist) ?></td>
									<td><?= h($stat->biceps) ?></td>
									<td><?= h($stat->triceps) ?></td>
									<td>
                                        <a href="<?php echo BASE_URL; ?>administrator/user/edit/<?php echo $stat->id; ?>">Edit</a>
                                        &nbsp;|&nbsp;
                                        <a onclick="return delConfirm();" href="<?php echo BASE_URL; ?>administrator/user/delete/<?php echo  $stat->id; ?>">Delete</a>
                                    </td>
                                </tr>                                
                                <?php endforeach; ?>
                                <?php }else{ ?>
                                <tr>
                                    <td colspan="6">No Records.</td>
                                </tr>  
                                <?php } ?>
                                </tbody>

                                
                            </table>
							</span>
							
							<span id="chart_table" style="display:none">
  								
									<?php if($allRecordCount > 0){ ?>
									<div>
										<select name="options" id="options">
                                        	<option value="weight">Weight</option>
                                            <option value="chest">Chest</option>
                                            <option value="waist">Waist</option>
                                            <option value="biceps">Biceps</option>
                                            <option value="triceps">Triceps</option>
                                         </select>
									<div id="curve_chart" style="width: 100%; height: 500px;"></div></td>
										
									                            
									
									<?php } ?>
							</span>

                            <div class="row-fluid" id="list_page" style="display:block">
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

<script type="text/javascript">
$(document).ready(function(){
	$('#submit').on('click',function(){
		var weight = $('#weight').val();
		var chest = $('#chest').val();
		var waist = $('#waist').val();
		var biceps = $('#biceps').val();
		var triceps = $('#triceps').val();
		$.ajax({
			type: "post",
			url: '<?php echo BASE_URL."administrator/user/userstat/".$user_id; ?>',
			beforeSend: function(xhr) {
        		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    		},
			data: {
				'user_id': '<?=$user_id;?>',
				'weight': weight,
				'chest': chest,
				'waist': waist,
				'biceps': biceps,
				'triceps': triceps,
				'added_date': '<?=date('Y-m-d g:i:s');?>'
			},
			success: function(data){
				alert(data);
			},
			error: function(e){
				console.log(e);
			}
				
		
		
		});
	});
});
</script>
<script type="text/javascript">
$(function(){
	$('#chart').on('click',function(){
		$('#list_page').css('display','none');
		$('#list_table').css('display','none');
		$('#chart_table').css('display','block');
	});
	

});
</script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>

    <script type="text/javascript">
	
	google.load('visualization', '1.1', {packages: ['line']});
	
	$('#options').on('change',function(){
		//google.setOnLoadCallback(drawChart);
		drawChart();
	});
      

      function drawChart() 
	  {
			var data = google.visualization.arrayToDataTable([['Days', 'Weight'],
			  <?php foreach ($stats as $stat): ?>
					['<?=$stat->added_date;?>',  <?=$stat->weight;?>],
			  <?php endforeach; ?>
			]);
	
			var options = {
			  title: 'Improvment Chart',
			  curveType: 'function',
			  legend: { position: 'bottom' },
			  width: 900,
			  height: 400
			};
	
			var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
	
			chart.draw(data, options);
      }
    </script>