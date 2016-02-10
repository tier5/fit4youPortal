<div class="body-container span10 new-modal4Area">

            <div class="row-fluid">
                <div class="span12">
                    <ul class="breadcrumb">
                        <li>
                            <a href="<?php echo BASE_URL; ?>administrator/dashboard">Admin</a> <span class="divider">/</span>
                        </li>
                        <li>
                            Client List
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
                            <span>Client List</span>
                        </div>
                        
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
                                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user->id; ?>">
                                    <a href="#" onclick="javascript:viewProfile('<?php echo $user->id; ?>');" data-modal-id="popup" class="js-open-modal">View Profile</a>
                                        &nbsp;|&nbsp;
				    <a href="<?php echo BASE_URL; ?>administrator/user/userstat/<?php echo $user->id; ?>">View Stat</a>
                                        &nbsp;|&nbsp;
                                        <a href="<?php echo BASE_URL; ?>administrator/user/edit/<?php echo $user->id; ?>">Edit</a>
                                        &nbsp;|&nbsp;
                                        <a onclick="return delConfirm();" href="<?php echo BASE_URL; ?>administrator/user/delete-client/<?php echo  $user->id; ?>">Delete</a>
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
			
            <div id="popup" class="modal-box">  
				<header>
				  <a href="#" class="js-modal-close close">×</a>
				  <h3>Client Profile</h3>
				</header>
				<div class="modal-body" id="user_profile">User profile to load here...</div>
				<footer>
				  <a href="#" class="js-modal-close">Close</a>
				</footer>
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
function viewProfile(user_id)
{
	$.ajax({
		type: "post",
		url: '<?php echo BASE_URL."administrator/user/user-profile"; ?>',
		data: {
			'user_id': user_id
		},
		success: function(data){
			$('#user_profile').html(data);
		},
		error: function(e){
				console.log(e);
		}
	


	});

}
</script>
            
            
