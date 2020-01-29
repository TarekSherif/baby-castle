
 <header>
 
  <div class="Mypage-header">
          <br>
          
      <h1>
          &#9820; 
           <br>
          {{Title}}     
      </h1>
      <br>
  </div>
  <nav class="navbar navbar-default <?php echo lang('Clang');?>">


      <div class="container-fluid">



          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#top">
                 <img   src="<?php echo $img ?>logo.ico" alt="School " data-toggle="tooltip" data-placement="bottom" title="MySchool " />
                
              </a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


              <ul class="nav navbar-nav navbar-right">
                  <?php
                  if(GetUserName()=="")
                  {
                      ?>
                   <li>
                      <a ng-click="ShowDetailsfunction('login')">
                          <i class="fa  fa-lock fa-fw"></i>
                          <span ><?php echo lang('Login'); ?></span>
                       </a>
                  </li>
                      <?php }?>
                      <li class="dropdown" ng-show="(Partners.length>0)">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                  <i class="fa fa-handshake-o fa-fw"></i>
                                  <span > <?php echo lang('Partners');  ?></span>
                                  <span class="caret"></span>
                              </a>
                             <ul class="dropdown-menu" >
                                    <li ng-repeat="P in Partners" >
                                    
                                    <a  data-toggle="modal" data-target="#PartnerShipDetailsModal" ng-click="ShowPartners('Partners.php?PartnerID='+P.PartnerID)">{{P.Title}} </a>
                                        <!-- <a ng-href="Partners.php?PartnerID={{P.PartnerID}}">{{P.Title}} </a> -->
                                    </li>
                              </ul>
                        </li> 

                 
                      <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                  <i class="fa fa-th-list fa-fw"></i>
                                  <span ><?php echo lang('Serve'); ?></span>
                                  <span class="caret"></span>
                              </a>
  

                              <ul class="dropdown-menu" >
                              <?php 

                                
                                        if ($UserType=="")
                                        {
                                            ?>
                                            <li ng-repeat="MItem in MenuItems | orderBy  : 'orderid'" data-toggle="tooltip" data-placement="bottom" title="{{MItem.MName}}"  ng-click="ShowDetailsfunction(MItem.MName)">
                                                    <a>	 	{{MItem.MName}} </a>
                                            </li>
                                            <?php 
                                        }else{
                                                    switch ($UserType) {
                                                        case 'Admin':
                                                        ?>
                                                            <li ><a  href="ManageTeamWork.php"><?php echo lang('ManageTeamWork');?></a></li>
                                                            <li ><a  href="ManagePartners.php"><?php echo lang('ViewParents');?></a></li>
                                                            <li ><a  href="ViewParents.php"><?php echo lang('ManagePartners');?></a></li>
                                                            <li ><a  href="TimeSheet.php"><?php echo lang('TimeSheet');?></a></li>
                                                        
                                                            <?php 
                                                        break;
                                                        case 'TeamWork':
                                                        ?>
                                                            <li ><a  href="TimeSheet.php"><?php echo lang('TimeSheet');?></a></li>
                                                        
                                                            <?php 
                                                        break;
                                                        case 'Partner':
                                                        ?>
                                                    
                                                        <?php 
                                                        break;
                                                    }
                                            ?>
                                            <li ><a  href="<?php echo $func ."logout.php";?>"><?php echo lang('Logout');?></a></li>
                                            <?php 

                                             }
                                                                    
                                                        ?>                 
                                    
  
  
                            
                              
                              </ul>
                          </li>
                          <li ><a  href="<?php echo $func."languages.php?lang=". lang('Clang');?>"><?php echo lang('LangNotActive');?></a></li>
                 
              </ul>
          </div>

      </div><!-- /.navbar-collapse -->

  </nav>

</header>
<br /><br />

<div class="container">
 

  <!-- Modal -->
  <div class="modal fade" id="PartnerShipDetailsModal" role="dialog" >
   <div class="modal-dialog"  style="width: 90%;height: 90%;">
    
      <!-- Modal content-->
      <div class="modal-content" style="width: 100%;height: 100%;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">
             <i class="fa fa-star  fa-2x" style="color: orange;" ></i> 
             <?php echo lang('Evaluation');?>
          </h4>
        </div>
        <div class="modal-body" style="height:75%;">
   			<iframe  id="FrameID"  ng-src="{{PartnersUrl}}"  style="width:100%;height:100%;"></iframe>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"> <?php echo lang('Close');  ?></button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
