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
                                    <a href="#" onclick="javascript:viewProfile('<?php echo $user->id; ?>');" data-modal-id="popup" class="js-open-modal">View Profile</a>
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
            <div id="popup" class="modal-box">  
                        <header>
                          <a href="#" class="js-modal-close close">×</a>
                          <h3><a href="http://www.jqueryscript.net/tags.php?/Modal/">Modal</a> Title</h3>
                        </header>
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
                        <footer>
                          <a href="#" class="js-modal-close">Close Button</a>
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
function viewProfile()
{
            $.ajax({
                        type: "post",
                        url: '<?php echo BASE_URL."administrator/user/userstat/"; ?>',
                        data: {
                                'user_id': '<?php echo $user_id;?>'
                        },
                        success: function(data){
                                    $('#load_content').html(data);
                        },
                        error: function(e){
                                console.log(e);
                        }
                    

    
            });     
            
            
}
</script>
<script type="text/javascript">
$(function(){

            var appendthis =  ("<div class='modal-overlay js-modal-close'></div>");
            
              $('a[data-modal-id]').click(function(e) {
                e.preventDefault();
                
                $("body").append(appendthis);
                $(".modal-overlay").fadeTo(500, 0.7);
                //$(".js-modalbox").fadeIn(500);
                var modalBox = $(this).attr('data-modal-id');
                $('#'+modalBox).fadeIn($(this).data());
              });  
              
              
            $(".js-modal-close, .modal-overlay").click(function() {
              $(".modal-box, .modal-overlay").fadeOut(500, function() {
                $(".modal-overlay").remove();
              });
            });
             
            $(window).resize(function() {
              $(".modal-box").css({
                top: ($(window).height() - $(".modal-box").outerHeight()) / 2,
                left: ($(window).width() - $(".modal-box").outerWidth()) / 2
              });
            });
             
            $(window).resize();
 
});           
            
</script>
<style>
.modal-box {
  display: none;
  position: absolute;
  z-index: 1000;
  width: 50%;
  background: white;
  border-bottom: 1px solid #aaa;
  border-radius: 4px;
  box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
  border: 1px solid rgba(0, 0, 0, 0.1);
  background-clip: padding-box;
}

.modal-box header,
.modal-box .modal-header {
  padding: 1.25em 1.5em;
  border-bottom: 1px solid #ddd;
}

.modal-box header h3,
.modal-box header h4,
.modal-box .modal-header h3,
.modal-box .modal-header h4 { margin: 0; }

.modal-box .modal-body { padding: 2em 1.5em; }

.modal-box footer,
.modal-box .modal-footer {
  padding: 1em;
  border-top: 1px solid #ddd;
  background: rgba(0, 0, 0, 0.02);
  text-align: right;
}

.modal-overlay {
  opacity: 0;
  filter: alpha(opacity=0);
  position: absolute;
  top: 0;
  left: 0;
  z-index: 900;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.3) !important;
}

a.close {
  line-height: 1;
  font-size: 1.5em;
  position: absolute;
  top: 5%;
  right: 2%;
  text-decoration: none;
  color: #bbb;
}

a.close:hover {
  color: #222;
  -webkit-transition: color 1s ease;
  -moz-transition: color 1s ease;
  transition: color 1s ease;
}
            
</style>

            
            
