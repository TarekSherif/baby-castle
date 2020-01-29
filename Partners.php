<?php




$Page=array();
$Page["Title"]= 'Partners';
$Page["Permission"]=array("","Parent","Admin","Partner","TeamWork");
$Page["Include"]=array("language","header","mysqli_connect","script");

//  $Page["Permission"]=array("","Parent","Admin","Partner","TeamWork");
//  $Page["Include"]=array("language","header","jtable","Nav","mysqli_connect");

    include 'init.php';


?>

<div class="container">
        <div class="row">
                <?php 
                       $where=isset($_GET['PartnerID'])?' and  Partners.PartnerID='.$_GET['PartnerID'].' ':' ';
                
     



                         
                       $SQL="SELECT
                                `Partners`.`Title` 
                                
                            from `Partners` inner join   `Users` on `Partners`.`PartnerID` = `Users`.`UserID`
                            where      `Users`.`IsActive`=1 $where ;";
                            

                            
                        $result =mysqli_query($con,$SQL);
                        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

                        if (count( $row)==0)
                        {
                                exit();
                                
                        }
                 ?>

            <div class="col-sm-12">
                <?php echo $row["Title"]; ?>
            </div>
        
            <div class="col-sm-12">

                <ul class="details-List" >
            <?php
                $SQL="SELECT 
                PartnerShipDetails.Notes 
                FROM Partners INNER JOIN PartnerShipDetails ON Partners.PartnerID= PartnerShipDetails.PartnerID  
                where PartnerShipDetails.IsActive=1    $where 
                ORDER BY PartnerShipDetails.PSDID ;";
                 $result =mysqli_query($con,$SQL);
                $rows = array();
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
                {?>
                    <li>
                        <i class="glyphicon glyphicon-star"></i>
                        <?php echo   $row["Notes"] ?>
                    </li>
                    <?php } ?>
                </ul>
    
            </div>
                <?php 
                        mysqli_free_result($result);
                        mysqli_close($con);
                ?>                                                
        </div>
</div>

<?php
include $tpl . 'footer.php'; 
ob_end_flush();
?>

<!-- <script>


$(document).ready(function(){

    var PartnerShipDetails = [];
 

    $.post('includes/functions/ActionPartnerShipDetails.php?action=PDetailsList&PartnerID=<?php echo $_GET["PartnerID"] ?>',function(data){
    

        $.each(data, function(   value ) {
            console.log(  value );
        });

    });
   

});



</script> -->