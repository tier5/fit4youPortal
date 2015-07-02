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
							.modalMyCLass h4{ color:#333; font:18px/38px "OpenSans-Bold",Georgia,serif;}
							.modalMyCLass .modal-header button.close{/* position:absolute; */right:0; width:20px; /*margin-right:15px;*/}
							.modalMyCLass table tr td{ text-align:left; font-size:14px;}
							.modalMyCLass table tr td:first-child{ font-weight:bold; text-align:right;}
							.modalMyCLass img{ border:3px solid #ccc; border-radius:3px; -webkit-border-radius:3px; width:95%; height:auto;}
							
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
										<a href="<?php echo BASE_URL; ?>administrator/user/profile/<?php echo $user->id; ?>" data-toggle="modal" data-target="#myModal">View Profile</a>
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

                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog modalMyCLass" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Profile</h4>
                      </div>
                      <div class="modal-body">
                        <div class="span3">
                        	<img src="http://unifiedinfotech.co.in/webroot/team1/gym/uploads/images/users_profile/thumb/143533143339.jpg" />
                        </div>
                        <div class="span9">
                        	<table class="table table-bordered">
                            	<tr>
                                	<td width="30%">Name</td>
                                    <td width="70%">Christiano Ronaldo</td>
                                </tr>
                                <tr>
                                	<td width="30%">E-mail</td>
                                    <td width="70%">cr7@gmail.com</td>
                                </tr>
                                <tr>
                                	<td width="30%">Phone No</td>
                                    <td width="70%">9000090000</td>
                                </tr>
                                <tr>
                                	<td width="30%">Address</td>
                                    <td width="70%">Avenida de Concha Espina, 1<br />
28036</td>
                                </tr>
                                <tr>
                                	<td width="30%">City</td>
                                    <td width="70%">Madrid</td>
                                </tr>
                                <tr>
                                	<td width="30%">Contry</td>
                                    <td width="70%">Spain</td>
                                </tr>
                                <tr>
                                	<td width="30%">Zip</td>
                                    <td width="70%">9000090000</td>
                                </tr>
                            </table>
                        </div>
                      </div>
                      <!--<div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                      </div>-->
                    </div>
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
