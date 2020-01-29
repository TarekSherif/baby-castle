<?php
    
     
     $Page=array();
     $Page["Title"]= 'Profile';
     $Page["Permission"]=array("Parent");
     $Page["Include"]=array("language");

     include   'init.php';


    //  $Page["Permission"]=array("","Parent","Admin","Partner","TeamWork");
    //  $Page["Include"]=array("language","header","jtable","Nav","mysqli_connect");

    $UserName=(isset($_SESSION['UserName'])?$_SESSION['UserName']:"");

    ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="description" content="profile" />
    

    <meta name="keywords"   content="profile">


            
    <meta name="author" content="profile">


    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>profile</title>
    <link href="<?php echo  $img ?>logo.ico" rel="shortcut icon" type="image/x-icon">

    <!-- Bootstrap -->
   
    <link href="<?php echo $css ?>bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $css ?>font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo $css ?>profile.css" rel="stylesheet">
      <link href="<?php echo $css ?>sidebar.css" rel="stylesheet" />
      <link href="<?php echo $css ?>rating.css" rel="stylesheet" />


 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
<body ng-app="profileModule" ng-controller="profileController" >

    <header>
        <a id="top"></a>
        <nav class="navbar navbar-inverse ">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- <a class="navbar-brand" href="#top">
                        <img class="visible-lg" src="<?php echo $img ?>logo.ico" alt="profile " data-toggle="tooltip" data-placement="bottom" title="profile " />
                        <p class="hidden-lg">profile</p>
                    </a> -->
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <div class="col-sm-2  "></div>
                <div class="col-sm-6  ">
                    <form class="navbar-form" role="search">
                    <div class="input-group">
                        <input  type="text" class="form-control"  ng-change="Search(SearchText)"  ng-model="SearchText"  placeholder="Search" onblur="(this.type='text')"    onfocus="(this.type='date')"  name="Txt-Search" id="Txt-Search">
                        <div class="input-group-btn">
                            <button class="btn btn-default btn-lg"   ng-click="Search(SearchText)" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                    </form>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <!--<li><a href="#">Link</a></li>-->
                     

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user-circle  fa-fw"></i>

                                <?php echo $UserName  ?>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" ng-nicescroll>
                                
                            <li data-toggle="modal" data-target="#FrmModal" >
                            <a ng-click="Showframe('EvaluationPartner.php','E')"  >
                            <?php echo lang('EPartner');?>
                            </a>
                        </li>
                        <li data-toggle="modal" data-target="#FrmModal" >
                            <a ng-click="Showframe('EvaluationTeamWork.php','E')"  >
                            <?php echo lang('ETeamWork');?>
                            </a>
                        </li>
                        <li data-toggle="modal" data-target="#FrmModal" >
                                
                                    <a ng-click="Showframe('ChangePassword.php',' <?php echo lang('ChangeUserData');?>')"  >
                                    <?php echo lang('ChangeUserData');?>
                                    </a>
                                </li>
                                <li ><a  href="<?php echo $func ."logout.php";?>"><?php echo lang('Logout');?></a></li>
                            
                            </ul>


                            </ul>
                        </li>
                    </ul>
                </div>

                </div><!-- /.navbar-collapse -->
   
        </nav>
    </header>

  
    <div>


        <!--END TOPBAR-->

        <nav id="sidebar" role="navigation" data-step="2" data-intro="Template has many navigation styles"  data-position="right" class="navbar-default navbar-static-side hidden-xs" style="min-height: 100%;">
            <br /><br /><br />
             <div class="sidebar-collapse menu-scroll" style="overflow: initial;">
                <div id="wrapper">
                    <!--BEGIN SIDEBAR MENU-->
                    <div id="header-topbar-option-demo" class="page-header-topbar">
                        <nav id="topbar" role="navigation" style="margin-bottom: 0;" data-step="3" class="">


                            <div class="topbar-main">
                                <a id="menu-toggle" href="#" class="hidden-xs"><i class="fa fa-bars"></i></a>


                            </div>
                          
                        </nav>

                    </div>
                    <ul id="side-menu" class="nav">

                        <div class="clearfix"></div>



                    


                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-calendar  fa-2x"></i>
                                        <span  class="menu-title" ng-pluralize count="history.length" when="{'one': '1 Day', 'other': '{} Days'}"></span>
                                
                                <span class="caret"></span>
                            </a>
                                                                            
                        
                            <ul class="Search dropdown-menu ">
                                  <li>

                                    <img src="<?php echo $img ?>funnel_new.png" />
                                    <input type="text" ng-model="DaySearchMenu" />

                                </li>
                                <li></li>
                                <li ng-repeat="h in history | filter: DaySearchMenu ">
                                    <a href="#top" ng-click="Search(h); ">
                                         <i class="fa fa-calendar  fa-2x"></i>
                                         <!-- fa fa-calendar-check-o -->
                                        {{h}}
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li>
                               

                            </ul>
                        
                       

                        </li>
         
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user-circle  fa-fw"></i>


                                <span class="menu-title">
                                     <?php echo $UserName  ?>
                                </span>
                                <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu " ng-nicescroll   >
                                   
                                <li data-toggle="modal" data-target="#FrmModal" >
                                    <a ng-click="Showframe('EvaluationPartner.php','E')"  >
                                    <?php echo lang('EPartner');?>
                                    </a>
                                </li>
                                <li data-toggle="modal" data-target="#FrmModal" >

                                    <a ng-click="Showframe('EvaluationTeamWork.php','E')"  >
                                    <?php echo lang('ETeamWork');?>
                                    </a>
                                </li>
                                <li data-toggle="modal" data-target="#FrmModal" >
                                
                                    <a ng-click="Showframe('ChangePassword.php',' <?php echo lang('ChangeUserData');?>')"  >
                                    <?php echo lang('ChangeUserData');?>
                                    </a>
                                </li>
                                <li ><a  href="<?php echo $func ."logout.php";?>"><?php echo lang('Logout');?></a></li>
                            
                            </ul>
                        </li>
                    


                    </ul>
                </div>
            </div>
        </nav>


        <div id="page-wrapper">
    


<br />   <br />
              

          


<div class="container page-body">

    <div class="row"   >
        <div class="col-sm-8" > 
            <div class="main-post" ng-repeat="p in Posts">
                <h4  ng-hide ="( p.CNO==0)">
                    <span class="post-ciled">
                    <i class="fa fa-user fa-fw "></i>
                    {{p.CName}}
                    </span>
                   
                    <i class="fa fa-star   fa-fw"    ng-click="EditFavorite(p)" ng-Style='p.IsFavorite=="1"?{"color":"orange"} :{"color" : "#999"} '></i>
                 </h4>
                 <h4  ng-show ="( p.CNO == 0)">
                    <span class="post-ciled">
  
                   
                    <i class="fa    fa-users fa-fw"    ></i>
                 </h4>
                
                <span class="post-date">
                    <i class="fa fa-calendar  fa-fw  "></i>
                    {{p.RDate}},
                </span>
                <span class="post-comments">
                    <i class="fa fa-comments-o fa-fw  "></i>
                    
                </span>
                <hr />
                
          
          <div id="myCarouse{{p.DRID}}" class="carousel slide" data-ride="carousel"  ng-show ="{{( p.RImages.length>0)}}"  >
                <!-- Wrapper for slides -->
              
                <div class="carousel-inner">
                 

                    <div class="item"   ng-repeat="image in p.RImages"  ng-class="{active : $first }">
                    
                    
                        <img class="img-responsive img-thumbnail"    ng-title="image.length" ng-src="<?php echo $img ?>baby-castle/DayReport/{{p.directory+'/'+image}}" ng-alt="{{image}}" />
                        
                    </div>
                 
                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarouse{{p.DRID}}" ng-hide ="{{( p.RImages.length<2)}}"  data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarouse{{p.DRID}}" ng-hide ="{{( p.RImages.length<2)}}"  data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

                <p class="post-content">
                    {{p.Notes}}
                </p>
                <hr />
                <div class="post-footer">
                    
                        <p class="post-tags">
                            <i class="fa fa-tags fa-fw  "></i>
                        </p>
        
                        <a   data-toggle="modal" data-target="#FrmModal"  ng-click="Showframe(p.RUrl,'Y')"  ng-show="{{p.RUrl}}">
                            <i class="fa fa-youtube fa-2x"   aria-hidden="true"></i>
                        </a>
                    
                </div>
                
             
            </div>
        </div>
        <div class="col-sm-4" > 
         </div>
    </div>
</div> 





        </div>
        <!--END PAGE WRAPPER-->

    </div>



    <a id="back-to-top" href="#top"><i class="fa fa-angle-double-up"></i></a>



    <div class="container">
 

  <!-- Modal -->
  <div class="modal fade" id="FrmModal" role="dialog" >
   <div class="modal-dialog"  style="width: 90%;height: 90%;">
    
      <!-- Modal content-->
      <div class="modal-content" style="width: 100%;height: 100%;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" ng-show="FrmTitle=='E'">
             <i class="fa fa-star  fa-2x" style="color: orange;" ></i> 
             <?php echo lang('Evaluation');?>
          </h4>
          <h4 class="modal-title" ng-show="FrmTitle=='Y'">
             <i class="fa fa-star  fa-2x" style="color: orange;" ></i> 
             <!-- <?php echo lang('Evaluation');?> -->
             فيديو
          </h4>
        </div>
        <div class="modal-body" style="height:75%;">
   			<iframe ng-src="{{FrmUrl}}"  style="width:100%;height:100%;"></iframe>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"> <?php echo lang('Close');  ?></button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>



    <script src="<?php echo $js ?>jquery-3.2.1.min.js"></script>


<script src="<?php echo $js ?>jquery-migrate-1.2.1.min.js"></script>

    <script src="<?php echo $js ?>bootstrap.min.js"></script>


    <script src="<?php echo $js ?>jquery.menu.js"></script>


    <script src="<?php echo $js ?>angular.min.js"></script>
    <script src="<?php echo $js ?>jquery.nicescroll.min.js"></script>
    <script  src="<?php echo $js ?>angular-nice.js"></script>


    <!-- <script src="<?php echo $js ?>filterByKey.js"></script> -->
    

    <script src="<?php echo $js ?>profile.js"></script>


</body>
</html>
<?php
//	include $tpl . 'footer.php'; 

//	ob_end_flush();
?>