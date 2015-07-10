<div class="body-container span10">

            <div class="row-fluid">
                <div class="span12">
                    <ul class="breadcrumb">
                        <li>
                            <a href="<?php echo BASE_URL; ?>administrator/dashboard">Admin</a> <span class="divider">/</span>
                        </li>
                        <li>
                            Settings
                        </li>
                    </ul>
                </div>
            </div>
    
            <span class="msg_class"><?= $this->Flash->render('positive') ?></span>

            <div class="row-fluid">

                <div class="span12">
                    <section class="utopia-widget">
                        <div class="utopia-widget-title">
                            <img class="utopia-widget-icon" src="<?php echo BASE_URL; ?>backend/img/icons/paragraph_justify.png">
                            <span>Setting List</span>
                        </div>
                        
                        <div class="utopia-widget-content">
                                
                            <table class="table table-bordered">
                                <thead>
				    <tr>
					<!--<th><input type="checkbox" class="utopia-check-all"></th>-->
					<th><?= $this->Paginator->sort('name','Name') ?></th>
					<th><?= $this->Paginator->sort('value','Value') ?></th>
					<th><?= $this->Paginator->sort('description','Description') ?></th>
					<th class="actions"><?= __('Actions') ?></th>
				    </tr>
                                </thead>


                                <tbody>    
				    <?php if($allRecordCount > 0){ ?>
				    <?php foreach ($settings as $setting): ?>
				    <tr>
					<td><?= h($setting['name']) ?></td>
					<td><?= h($setting['value']); ?></td>
					<td><?= h($setting['description']); ?></td>
					<td>
					    <a href="<?php echo BASE_URL; ?>administrator/settings/edit/<?php echo $setting['id']; ?>">Edit</a>
					    
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
