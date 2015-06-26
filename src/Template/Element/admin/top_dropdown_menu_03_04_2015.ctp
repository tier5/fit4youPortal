                        <div class="user-panel header-divider">
                            <div class="user-info">
                                <span class="user-icon"><?php
					echo $this->Html->image('../backend/img/icons/user.png',array('alt'=>''));
				?></span>
                                <a href="#" style='word-break:break-all;'><?php echo substr($logged_admin_username,0,10);if(strlen($logged_admin_username)>10){echo "...";}?></a>
                            </div>

                            <div class="user-dropbox">
                                <ul>
                                    
				    <?php
				    if($this->Session->read('ums_logged_type')!='Corporate')
				    {
				    ?>
					<li class="user"><a href="<?php echo BASE_URL;?>Profile">My Profile</a></li>
				 <?php
				 }
				?>
				  
				 <li class="settings"><a href="<?php echo BASE_URL.'ChangePassword/';?>">Change Password</a></li>
				    <li class="logout"><a href="<?php echo BASE_URL;?>Logout">Logout</a></li>
                                </ul>
                            </div>

                        </div><!-- User panel end -->
