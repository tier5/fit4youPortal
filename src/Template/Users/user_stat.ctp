<div class="body-container span10">

            <div class="row-fluid">
                <div class="span12">
                    <ul class="breadcrumb">
                        <li>
                            <a href="<?php echo BASE_URL; ?>administrator/dashboard">Admin</a> <span class="divider">/</span>
                        </li>
                        <li>
                            <a href="">User Stats</a> <span class="divider">/</span>
                        </li>
                    </ul>
                </div>
            </div>
    
            <span style="color:green;" id="msg"><?php echo $this->Flash->render('positive') ?></span>

            <div class="row-fluid">

                <div class="span12">
                    <section class="utopia-widget">
                        <div class="utopia-widget-title">
                            <img class="utopia-widget-icon" src="<?php echo BASE_URL; ?>backend/img/icons/paragraph_justify.png">
                            <span>
				    <?= $user_details->firstName.' '.$user_details->lastName;?>'s Stats [<?= $user_details->userPin;?>]
			    </span>
                        </div>
                        
                        <div class="utopia-widget-content">
                                
                            <table class="table table-bordered">

                                <tbody>   
				    <tr>
					    <td><input type="text" value="" placeholder="weight" name="weight" id="weight" class="span10" ></td>
					    <td><input type="text" value="" name="chest" placeholder="chest" id="chest" class="span10" ></td>
					    <td><input type="text" value="" name="waist" placeholder="waist" id="waist" class="span10"></td>
					    <td><input type="text" value="" name="biceps" placeholder="biceps" id="biceps" class="span10"></td>
					    <td><input type="text" value="" name="triceps" placeholder="triceps" id="triceps" class="span10"></td>
					    <td><input type="hidden" value="<?php echo $user_id;?>" name="user_id" id="user_id" class="span10" >
					    <input type="hidden" value="" name="id" id="id" class="span10" >
    <input type="button" value="Submit" name="submit" id="submit"></td>
				    </tr>                                
                                </tbody>
                                
                            </table>
			<div class="myAnchorSpanArea">
				    <span id="list" class="active"><a href="javascript:void(0);" ><i class="fa fa-list-ul"></i>List View</a></span>
				    <span id="chart"><a href="javascript:void(0);" ><i class="fa fa-line-chart"></i>Graph View</a></span>
			</div>
			<div id="load_content"> 
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
					<td><?= h($stat->weight) ?></td>
					<td><?= h($stat->chest) ?></td>
					<td><?= h($stat->waist) ?></td>
					<td><?= h($stat->biceps) ?></td>
					<td><?= h($stat->triceps) ?></td>
					<td>
					    <a href="javascript:void(0);" onclick="edit_stat('<?php echo $stat->id; ?>','<?php echo $stat->weight; ?>','<?php echo $stat->chest; ?>','<?php echo $stat->waist; ?>','<?php echo $stat->biceps; ?>','<?php echo $stat->triceps; ?>');">Edit</a>
					    &nbsp;|&nbsp;
					    <a onClick="return delConfirm();" href="<?php echo BASE_URL; ?>administrator/user/delete-stat/<?php echo  $stat->id; ?>/<?php echo $user_id;?>">Delete</a>
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
			
				    <div class="row-fluid" id="list_page">
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
							
			<span id="chart_table" style="display:none">
  								
				    <?php if($allRecordCount > 0){ ?>

				    <div class="select-box">
						<select name="options" id="options">
						       <option value="weight">Weight</option>
						       <option value="chest">Chest</option>
						       <option value="waist">Waist</option>
						       <option value="biceps">Biceps</option>
						       <option value="triceps">Triceps</option>
						</select>
				    </div>
				    <div style="clear:both;"></div>
				    <div id="curve_chart" style=""></div>
					    
				    			
				    
				    <?php } ?>
			</span>

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
		var id = $('#id').val();
		$.ajax({
			type: "post",
			url: '<?php echo BASE_URL."administrator/user/userstat/"; ?>',
			beforeSend: function(xhr) {
        		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    		},
			data: {
				'user_id': '<?php echo $user_id;?>',
				'id': id,
				'weight': weight,
				'chest': chest,
				'waist': waist,
				'biceps': biceps,
				'triceps': triceps,
				'added_date': '<?=date('Y-m-d g:i:s');?>'
			},
			success: function(data){
				    $('#load_content').html(data);
				    $('#msg').html('Data updated successfully');
				    $('#weight').val('');
				    $('#chest').val('');
				    $('#waist').val('');
				    $('#biceps').val('');
				    $('#triceps').val('');
			},
			error: function(e){
				console.log(e);
			}
				
		
		
		});
	});
});
</script>
<script type="text/javascript">
$(document).ready(function(){
	$('#chart').on('click',function(){
	        $('#chart').addClass('active');
		$('#list').removeClass('active');
		$('#list_table').css('display','none');
		$('#chart_table').css('display','block');
	});
	
	$('#list').on('click',function(){
	        $('#chart').removeClass('active');
		$('#list').addClass('active');
		$('#list_table').css('display','block');
		$('#chart_table').css('display','none');
	});
	

});
</script>
<script type="text/javascript">
	    function edit_stat(id,weight,chest,waist,biceps,triceps)
	    {
		$('#id').val(id);
		$('#weight').val(weight);
		$('#chest').val(chest);
		$('#waist').val(waist);
		$('#biceps').val(biceps);
		$('#triceps').val(triceps);
			
			
	    }
</script>
<script type="text/javascript">
$(function(){
	$('#chart1,#chart2').on('click',function(){
		$('#list_table').css('display','none');
		$('#chart_table').css('display','block');
	});
	
	$('#list1,#list2').on('click',function(){
		$('#list_table').css('display','block');
		$('#chart_table').css('display','none');
	});
	

});
</script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<script type="text/javascript">
    
    google.load('visualization', '1.1', {packages: ['corechart']});
    
    $('#options').on('change',function(){
	    //google.setOnLoadCallback(drawChart);
	    var type = $('#options').val();
	    drawChart(type);
    });
  

  function drawChart(type) 
      {
	
	if (type == 'weight')
	{
		    var data = google.visualization.arrayToDataTable([['Days', 'Weight'],
		      <?php foreach ($stats as $stat): ?>
				    ['<?=$stat->added_date;?>',  <?=$stat->weight;?>],
		      <?php endforeach; ?>
		    ]);
	}
	else if (type == 'chest')
	{
		    var data = google.visualization.arrayToDataTable([['Days', 'Weight'],
		      <?php foreach ($stats as $stat): ?>
				    ['<?=$stat->added_date;?>',  <?=$stat->chest;?>],
		      <?php endforeach; ?>
		    ]);
	}
	else if (type == 'waist')
	{
		    var data = google.visualization.arrayToDataTable([['Days', 'Weight'],
		      <?php foreach ($stats as $stat): ?>
				    ['<?=$stat->added_date;?>',  <?=$stat->waist;?>],
		      <?php endforeach; ?>
		    ]);
	}
	else if (type == 'biceps')
	{
		    var data = google.visualization.arrayToDataTable([['Days', 'Weight'],
		      <?php foreach ($stats as $stat): ?>
				    ['<?=$stat->added_date;?>',  <?=$stat->biceps;?>],
		      <?php endforeach; ?>
		    ]);
	}
	else if (type == 'triceps')
	{
		    var data = google.visualization.arrayToDataTable([['Days', 'Weight'],
		      <?php foreach ($stats as $stat): ?>
				    ['<?=$stat->added_date;?>',  <?=$stat->triceps;?>],
		      <?php endforeach; ?>
		    ]);
	}
        
    
		    var options = {
		      title: 'Improvment Chart',
		      curveType: 'function',
		      legend: { position: 'bottom' },
		      width: 900,
		      height: 400
		    };
    
		    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
    
		    chart.draw(data, options);
                    $('#curve_chart').css('height','200');
  }
</script>
