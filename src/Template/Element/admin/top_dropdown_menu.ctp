
                        <div class="user-panel header-divider">
                            <div class="user-info">
                              <?php
                                   echo $this->Html->image('../backend/img/icons/user.png');
                              ?>
                                <a href="javascript:void(0)">Admin user</a>
                            </div>

                            <div class="user-dropbox">
                                <ul>
                                    <li class="user"><a href="#">Profile</a></li>
                                    <li class="settings"><!--<a href="#">Change Password</a>-->
                                    <?php echo $this->Html->link('Change Password', array('controller'=>'Adminchangepass','action'=>'index','admin' => TRUE)); ?>
                                    
                                    </li>
                                    <li class="settings">
                                        <?php echo $this->Html->link('Logout', array('controller'=>'Users','action'=>'logout','admin' => TRUE)); ?>
                                    </li>
                                </ul>
                            </div>

                        </div><!-- User panel end -->

                   
