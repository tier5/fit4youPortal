<div class="body-container span10">

            <div class="row-fluid">
                <div class="span12">
                    <ul class="breadcrumb">
                        <li>
                            <a href="<?php echo BASE_URL; ?>administrator/dashboard">Admin</a> <span class="divider">/</span>
                        </li>
                        <li>
                            <a href="<?php echo BASE_URL; ?>administrator/roles">Roles</a> <span class="divider">/</span>
                        </li>
                        <li>
                            <a href="">List</a> <span class="divider">/</span>
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
                            <span>Roles List</span>
                        </div>

                        <style type="text/css">
                            .stopHidden {
                                    display: block !important;
                                    margin-left: 15px !important;
                                    margin-top: 9px !important;
                            }
                        </style>
                  
                        <div class="utopia-widget-content">
                        
                        <div class="row-fluid stopHidden">
                                                    
                        <!--<div class="span6">
                            <div class="dataTables_filter" id="DataTables_Table_0_filter" style="margin-top: 4px; margin-right: 293px;"> 
                                <input type="text" placeholder="Enter roles here" name="roleName" id="roleName" value="<?php //echo $searchKey; ?>" />
                            </div>
                        </div>-->

                        </div>
                                    
                            <span style="color:green;"><?= $this->Flash->render('positive') ?></span>
                            <span style="color:red;"><?= $this->Flash->render('negative') ?></span>        
                            <table class="table table-bordered ">
                                <thead>
                                <tr>
                                    <th>Role Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>  
                                <?php if($allRecordCount > 0){ ?>
                                <?php foreach ($roles as $val): ?>                                    
                                <tr>
                                    <td><?php echo $val->roleName; ?></td>
                                    <td>
                                         <a href="<?php echo BASE_URL; ?>administrator/roles/edit/<?php echo  $val->id; ?>">Edit</a>
                                        
                                    </td>
                                </tr>  
                                <?php endforeach; ?>
                                <?php }else{ ?>
                                <tr><td colspan="2">No Records.</td></tr>
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
    function delConfirm(del_id)
    {
            var ans = confirm("Do you really want to delete this record ?");
            if (ans){
                window.location="<?php echo BASE_URL ?>admin/roles/delete/"+del_id;
            }else{
                return false;
            }
    }
</script>

