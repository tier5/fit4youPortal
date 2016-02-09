<!-- Body start -->

     <div class="span10 body-container">
          <span style="color:green;"><?php echo $this->Flash->render('positive') ?></span>
          <div class="row-fluid">
            <div class="span12">
                <ul class="breadcrumb">
                    <li class='action disabled'>
                        <span>Dashboard</span> 
               </ul>
            </div>
</div>
<div class="row-fluid"style='margin-top:3%;margin-left:1%;width:98%;'>


<!--Chart Icons -->
                    <!--Chart Icons -->
                    
                    <div class="span3">
                        <a class="elements" href="<?php echo BASE_URL.'administrator/client' ?>" title="Registered Client">
                            <div class="utopia-chart-legend">
                                <div class="utopia-chart-icon">
                                           <span style="font-size: 50px"><i class="fa fa-user"></i></span>          
                                </div>
                                <div class="utopia-chart-heading"><?php echo $totClient ?></div>
                                <div class="utopia-chart-desc">Registered Clients</div>
                            </div>
                        </a>
                    </div>
                    
                    <div class="span3">
                        <a class="elements" href="<?php echo BASE_URL.'administrator/trainer' ?>" title="Registered Trainer">
                            <div class="utopia-chart-legend">
                                <div class="utopia-chart-icon">
                                           <span style="font-size: 50px"><i class="fa fa-user"></i></span>          
                                </div>
                                <div class="utopia-chart-heading"><?php echo $totTrainer ?></div>
                                <div class="utopia-chart-desc">Registered Trainers</div>
                            </div>
                        </a>
                    </div>
                    
                    
                    <div class="span3">
                        <a class="elements" href="<?php echo BASE_URL.'administrator/gyms' ?>" title="Total Gyms">
                            <div class="utopia-chart-legend">
                                <div class="utopia-chart-icon">
                                    <span style="font-size: 50px"><i class="fa fa-bullseye"></i></span>  
                                   
                                </div>
                                <div class="utopia-chart-heading"><?php echo $totGyms ?></div>
                                <div class="utopia-chart-desc">Total Gyms</div>
                            </div>
                        </a>
                    </div>

                    <!--Chart Icons End -->
                </div>
                    
  
</div>
     </div>


</div>

<!-- Body end -->