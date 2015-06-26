<div class="body-container span10">

            <div class="row-fluid">
                <div class="span12">
                    <ul class="breadcrumb" id="labelDiv">
                        <li>
                            <a href="<?php echo BASE_URL; ?>administrator/dashboard">Admin</a> <span class="divider">/</span>
                        </li>
                        <li>
                            <a href="">Schedules</a> <span class="divider">/</span>
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

            <div class="row-fluid">

                <div class="span12">
                    <section class="utopia-widget">
                        <div class="utopia-widget-title" id="pageLabelDiv">
                            <img class="utopia-widget-icon" src="<?php echo BASE_URL; ?>backend/img/icons/paragraph_justify.png">
                            <span>Schedule List</span>
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
                                    
                            <span style="color:green;"><?= $this->Flash->render('positive') ?></span>        
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
                                    
                                <?php if($allRecordCount > 0){ $i = 0;?>
                                <?php foreach ($schedules as $schedule):?>
                                <tr>
                                    <td><?= h($schedule['client_fname']) ?>&nbsp;<?= h($schedule['client_lname']) ?></td>
                                    <td><?= h($schedule['trainer_fname']) ?>&nbsp;<?= h($schedule['trainer_lname']) ?></td>
                                    <td><?= h($schedule[$i]['start_time']) ?></td>
                                    <td><?= h($schedule[$i]['end_time']) ?></td>
                                    <td>
                                        <a href="<?php echo BASE_URL; ?>administrator/gyms/edit/<?php echo  $schedule['id']; ?>">Edit</a>
                                        &nbsp;|&nbsp;
                                        <a onclick="return delConfirm();" href="<?php echo BASE_URL; ?>administrator/gyms/delete/<?php echo  $schedule['id']; ?>">Delete</a>
                                </tr>                                
                                <?php $i++;endforeach; ?>
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


