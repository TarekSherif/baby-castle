<?php
 
   
         $Page=array();
         $Page["Title"]= 'index';
         $Page["Permission"]=array("");
         $Page["Include"]=array("language","header","Nav","mysqli_connect","footer","script");

         include 'init.php';

        //  $Page["Permission"]=array("","Parent","Admin","Partner","TeamWork");
        //  $Page["Include"]=array("language","header","jtable","Nav","mysqli_connect","footer","script");
        
    
  
  

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $UserName=$_POST["username"];
        $Password=$_POST["password"];
        $UserType=$_POST["UserType"];


        $SQL="SELECT  UserID,UserName,UserID  FROM Users where IsActive=TRUE and UserName='$UserName' and Password='$Password' and UserType='$UserType';";
        
        
                $result =mysqli_query($con,$SQL);
                //Add all records to an array
                if (mysqli_num_rows($result)>0)
                {
                    $row =  mysqli_fetch_array($result,MYSQLI_ASSOC);
                    $_SESSION['UserID']  =$row["UserID"];
                    $_SESSION['UserName']=$row["UserName"];
                    $_SESSION['UserType']=$UserType;
           
                    $gotoPage= isset($_SESSION["PNO"])?"Profile.php":"TimeSheet.php";
                    header('Location:'. $gotoPage);
            
                    
                
                }
               
                
               // 
            // Free result set
                mysqli_free_result($result);
                mysqli_close($con);
               
    }



    ?>

<div class="container">
    <div class="row">
        <div class="col-lg-6">
                
                    <div  class="row Advantages animated bounceInLeft" ng-hide="filterMenuItem" >
                            <br /><br />
                        <div class="col-xs-6  col-sm-4 col-md-3 col-lg-4 " ng-repeat="MItem in MenuItems| orderBy:'orderid'" data-toggle="tooltip" data-placement="bottom" title="{{MItem.MName}}" ng-click="ShowDetailsfunction(MItem.MName)" >
                            <img ng-src="<?php echo $img ?>{{MItem.Micon}}" alt="{{MItem.MName}}">
                            <p>{{MItem.MName}}</p>
                        </div>
                        
                    </div>
            

        <table  ng-show="filterMenuItem " >
            <tr>
            <td></td>
            <!-- fadeInLeft slideInUp rollIn bounceIn -->
            <td> <img  class="Sun-image animated slideInLeft " src="<?php echo $img ?>cloud.png" alt="cloud" /></td>
            </tr>
            <tr>
                    <td> <img  class="Sun-image animated rollIn" src="<?php echo $img ?>sun.png" alt="Sun"  /></td>
                    
                    <td></td>
                </tr>
        </table>
                
                <div    ng-repeat="MItem in MenuItems |filter:filterMenuItem"  ng-show="filterMenuItem"  ng-class="MItem.Mclass"
                    class="animated  Item-details" data-toggle="tooltip" data-placement="bottom" title="{{MItem.MName}}"   >
                    
                    <a class="Close"  title="Close"   ng-click="hideDetailsfunction()">X</a>
                    <br/>
                    <h2>{{MItem.MName}}</h2>
                    <br/>
                    
                    <div class="row">
                            <div class="col-lg-3">
                                    <img class="img-responsive Micon" ng-src="<?php echo $img ?>{{MItem.Micon}}" alt="{{MItem.MName}}">
                            </div>
                        
                            <div class="col-lg-9">

                                <ul class="details-List" >
                                    <li ng-repeat="d in MItem.details" >
                                        <i class="glyphicon glyphicon-star"></i>
                                        {{d}}
                                    </li>
                                </ul>
                    
                            </div>
                    
                    </div>
                </div>

                <div    class="animated pulse Item-details" data-toggle="tooltip" data-placement="bottom" title="login" 
                ng-show="filterMenuItem.MName=='login'"  >
                
                    <a class="Close"  title="Close"   ng-click="hideDetailsfunction()">X</a>
                    
              
                

         
                    <h3 class="text-center">
                        <?php echo lang('Login'); ?>                       
                    </h3>
                    <!-- Start Login Form -->
                    <form class="login <?php echo lang('Clang'); ?>  "  action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="input-container">
                            <input 
                                class="form-control" 
                                type="text" 
                                name="username" 
                                autocomplete="off"
                                placeholder="<?php echo lang('PHuserName');?>" 
                                required />
                        </div>
                        <div class="input-container">
                            <input 
                                class="form-control" 
                                type="password" 
                                name="password" 
                                autocomplete="new-password"
                                placeholder="<?php echo lang('PHPassword');?>" 
                                required />
                        </div>
                        <div class="input-container">
                           <select name="UserType" class="form-control">
                               <option  value="Parent">Parent</option>
                               <option  value="Admin">Admin</option>
                               <option  value="TeamWork">TeamWork</option>
                               <option  value="Partner">Partner</option>
                           </select>
                        </div>
                        <br>
                        <input class="btn btn-primary btn-block" name="login" type="submit" value="<?php echo lang('Login'); ?> " />
                    </form>
                    <!-- End Login Form -->


                    <div class="the-errors text-center">
                        <?php 

                            if (!empty($formErrors)) {

                                foreach ($formErrors as $error) {

                                    echo '<div class="msg error">' . $error . '</div>';

                                }

                            }

                            if (isset($succesMsg)) {

                                echo '<div class="msg success">' . $succesMsg . '</div>';

                            }

                        ?>
                    </div>

<br/><br/>
                </div>
            <br/>
        </div>
        <div class="col-lg-6">
            <!-- Carousel
    ================================================== -->
    <img src="<?php echo $img ?>castle1.png"    class="castle-image" alt="castle logo">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
        

                <!-- Wrapper for slides -->
            
                <div class="carousel-inner">
                        <div class="item active">
                                <img src="<?php echo $img ?>castle2.png" alt="castle">
                            </div>
                        <div class="item">
                                <img src="<?php echo $img ?>castle.jpg" alt="castle">
                            </div>
                
                    <div class="item ">
                        <img class="r" src="<?php echo $img ?>slider-1.jpg" alt="Los Angeles">
                    </div>

                    <div class="item">
                        <img src="<?php echo $img ?>slider-2.jpg" alt="Chicago">
                    </div>

                    <div class="item">
                        <img src="<?php echo $img ?>slider-3.jpg" alt="New York">
                    </div>
                
                
                </div>


                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

        </div>


    </div>
</div>


<?php
	include $tpl . 'footer.php'; 
	ob_end_flush();
?>