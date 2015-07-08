<div class="body-container span10">

            <div class="row-fluid">
                <div class="span12">
                    <ul class="breadcrumb" id="labelDiv">
                        <li>
                            <a href="<?php echo BASE_URL; ?>administrator/dashboard">Admin</a> <span class="divider">/</span>
                        </li>
                        <li>
                            Gyms
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
                            <span>Gym List</span>
			    <span class="new_span_class"><a href="<?php echo BASE_URL; ?>administrator/gyms/add"><i class="fa fa-pencil"></i>  Add Gym</a></span>
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
                                    <th><?= $this->Paginator->sort('gymName','Gym Name') ?></th>
                                    <th><?= $this->Paginator->sort('gymAddress','Gym Address') ?></th>
                                    <th><?= $this->Paginator->sort('gymPhone','Gym Phone') ?></th>
                                    <th><?= $this->Paginator->sort('gymEmail','Gym Email') ?></th>
                                    <th class="actions"><?= __('Actions') ?></th>
                                </tr>
                                </thead>


                                <tbody>  
                                    
                                <?php if($thisgymCount > 0){ ?>
                                <?php foreach ($gyms as $gym): ?>
                                <tr>
                                    <td><?= h($gym->gymName) ?></td>
                                    <td><?= h($gym->gymAddress) ?></td>
                                    <td><?= h($gym->gymPhone) ?></td>
                                    <td><?= h($gym->gymEmail) ?></td>
                                    <td>
                                        <a href="<?php echo BASE_URL; ?>administrator/gyms/edit/<?php echo  $gym->id; ?>">Edit</a>
                                        &nbsp;|&nbsp;
                                        <a onclick="return delConfirm();" href="<?php echo BASE_URL; ?>administrator/gyms/delete/<?php echo  $gym->id; ?>">Delete</a>
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


