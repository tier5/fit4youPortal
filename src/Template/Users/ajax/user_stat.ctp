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
                               <option value="">Select Stat Option</option>
                               <option value="weight">Weight</option>
                               <option value="chest">Chest</option>
                               <option value="waist">Waist</option>
                               <option value="biceps">Biceps</option>
                               <option value="triceps">Triceps</option>
                        </select>
            </div>
            <div style="clear:both;"></div>
            <div id="curve_chart" style="width: 100%; height: 500px;"></div>
                    
                                
            
            <?php } ?>
</span>
<script>
    $('#options').on('change',function(){
	    //google.setOnLoadCallback(drawChart);
	    var type = $('#options').val();
	    drawChart(type);
    });
</script>