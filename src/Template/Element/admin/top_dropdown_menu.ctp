
                        <div class="user-panel header-divider">
                            <div class="user-info">
                              <?php
                                   echo $this->Html->image('../backend/img/icons/user.png');
                              ?>
                                <a href="javascript:void(0)">Admin user</a>
                            </div>

                            <div class="user-dropbox">
                                <ul>
                                    <li class="user"><a href="<?php echo BASE_URL.'administrator/admin-profile';?>">Profile</a></li>
                                    <li class="settings"><a href="<?php echo BASE_URL.'administrator/change-password';?>">Change Password</a></li>
                                    <li class="settings">
                                        <?php echo $this->Html->link('Logout', array('controller'=>'Users','action'=>'logout','admin' => TRUE)); ?>
                                    </li>
                                </ul>
                            </div>

                        </div><!-- User panel end -->

                   
