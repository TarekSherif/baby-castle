<?php
 
   
         $Page=array();
         $Page["Title"]= 'index';
         $Page["Permission"]=array("Parent","Admin","Partner","TeamWork");
         $Page["Include"]=array("language","header","mysqli_connect","script");

         include 'init.php';

        //  $Page["Permission"]=array("","Parent","Admin","Partner","TeamWork");
        //  $Page["Include"]=array("language","header","jtable","Nav","mysqli_connect","footer","script");

       
       
        $UserName= $_SESSION['UserName'];
     
        
    	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           $UserID= $_SESSION['UserID'];
            
            $UserName=$_POST["username"];
            $Password=$_POST["password"];
            $cPassword=$_POST["cpassword"];
           if(  $Password==  $cPassword)
           {
    
            $result =mysqli_query($con,"UPDATE Users SET UserName = '" . $_POST["username"] . "', Password = '" . $_POST["password"] . "' WHERE UserID = $UserID;");           //Add all records to an array
 
            $_SESSION['UserName']= $UserName;
         }   
         else{
             //Confirm password error
         }
         
                  
                    mysqli_close($con);
                   
        }
    
  
  

	
    ?>
    <br/>
    <br/>
    <br/>

<div class="container">
    <div class="row">
                
                <div    class="animated pulse Item-details" data-toggle="tooltip" data-placement="bottom" title="login"     >
                
                  
              
                

         
                    <h3 class="text-center">
                        <?php echo lang('ChangeUserData'); ?>                       
                    </h3>
                    <!-- Start Login Form -->
                    <form class="login <?php echo lang('Clang'); ?>  "  action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="input-container">
                            <input 
                                class="form-control" 
                                type="text" 
                                name="username" 
                                autocomplete="off"
                                placeholder="<?php echo lang('CuserName');?>" 
                                value="<?php echo $UserName ?>"
                                required />
                        </div>
                        <div class="input-container">
                            <input 
                                class="form-control" 
                                type="password" 
                                name="password" 
                                autocomplete="new-password"
                                placeholder="<?php echo lang('CPassword');?>" 
                                required />
                        </div>
                        <div class="input-container">
                            <input 
                                class="form-control" 
                                type="password" 
                                name="cpassword" 
                                autocomplete="new-password"
                                placeholder="<?php echo lang('confirmPassword');?>" 
                                required />
                        </div>
                       
                        <br>
                        <input class="btn btn-primary btn-block" name="login" type="submit" value="<?php echo lang('ChangeUserData'); ?> " />
                    </form>
                    <!-- End Login Form -->


        </div>


    </div>
</div>


<?php
	include $tpl . 'footer.php'; 
	ob_end_flush();
?>