<div class="body-container span10">

            <div class="row-fluid">
                <div class="span12">
                    <ul class="breadcrumb">
                        <li>
                            <a href="<?php echo BASE_URL; ?>admin/dashboard">Admin</a> <span class="divider">/</span>
                        </li>
                        <li>
                            <a href="">Trainer</a> <span class="divider">/</span>
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
                            <span>Client List</span>
                        </div>
                        
                        <style type="text/css">
                            .stopHidden {
                                    display: block !important;
                                    margin-left: 15px !important;
                                    margin-top: 9px !important;
                            }
                        </style>
                        
                        <div class="utopia-widget-content">
                                
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <!--<th><input type="checkbox" class="utopia-check-all"></th>-->
                                    <th><?= $this->Paginator->sort('role','Role') ?></th>
                                    <th><?= $this->Paginator->sort('firstName','First Name') ?></th>
                                    <th><?= $this->Paginator->sort('userPin','Pin Code') ?></th>
                                    <th><?= $this->Paginator->sort('join_date','Registration Date') ?></th>
                                    <th class="actions"><?= __('Actions') ?></th>
                                </tr>
                                </thead>


                                <tbody>    
                                <?php if($allRecordCount > 0){ ?>
                                <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= h($user->role) ?></td>
                                    <td><?php echo $user->firstName.' '.$user->lastName; ?></td>
                                    <td><?php echo $user->userPin; ?></td>
                                    <td><?= h(date('d-M-Y g:i A',strtotime($user->join_date))) ?></td>
                                    <td>
										<a href="<?php echo BASE_URL; ?>administrator/user/profile/<?php echo $user->id; ?>">View Profile</a>
                                        &nbsp;|&nbsp;
										<a href="<?php echo BASE_URL; ?>administrator/user/userstat/<?php echo $user->id; ?>">View Stat</a>
                                        &nbsp;|&nbsp;
                                        <a href="<?php echo BASE_URL; ?>administrator/user/edit/<?php echo $user->id; ?>">Edit</a>
                                        &nbsp;|&nbsp;
                                        <a onclick="return delConfirm();" href="<?php echo BASE_URL; ?>administrator/user/delete/<?php echo  $user->id; ?>">Delete</a>
                                    </td>
                                </tr>                                
                                <?php endforeach; ?>
                                <?php }else{ ?>
                                <tr>
                                    <td colspan="5">No Records.</td>
                                </tr>  
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
