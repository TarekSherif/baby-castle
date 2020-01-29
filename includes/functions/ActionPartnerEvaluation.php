<?php


$Page=array();
$Page["Title"]= '';
$Page["Permission"]=array("Parent","Admin");
$Page["Include"]=array("mysqli_connect");


include_once '../../init.php';

// include 'init.php';
//  $Page["Permission"]=array("","Parent","Admin","Partner","TeamWork");
//  $Page["Include"]=array("language","header","jtable","Nav","mysqli_connect","footer","script");


 

try
{


	
	

	//Getting records (listAction)
	if($_GET["action"] == "list")
	{

		$where=(isset($_GET["PartnerID"])?" where PartnerID=".$_GET["PartnerID"]." ":"");

		$where=(isset($_POST["PNO"])?" where PNO=".$_POST["PNO"]." ":$where."");

		//Get record count
		$result = mysqli_query($con,"SELECT COUNT(*) AS RecordCount FROM  PartnerEvaluation $where ;");
		$row =  mysqli_fetch_array($result,MYSQLI_ASSOC);
		$recordCount = $row['RecordCount'];
		
	
		$SQL="SELECT * FROM PartnerEvaluation $where ORDER BY " . $_GET["jtSorting"] ." LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";";
		$result =mysqli_query($con,$SQL);
		
		//Add all records to an array
		$rows = array();
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
		    $rows[] = $row;
		}
	// Free result set
	    mysqli_free_result($result);
		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['TotalRecordCount'] = $recordCount;
		$jTableResult['Records'] = $rows;
		
      
        print json_encode($jTableResult);
        
	}
	//Creating a new record (createAction)
	else if($_GET["action"] == "create")
	{

		//Insert record into database
		$result = mysqli_query($con,"INSERT INTO PartnerEvaluation( `PartnerID`,`PNO`,`ETrustiness`,`EGoodness`,`ETimeness`) VALUES( '".$_POST['PartnerID']."','". $_POST['PNO']."','". $_POST['ETrustiness']."','". $_POST['EGoodness']."','".$_POST['ETimeness']."');");
		
		//Get last inserted record (to return to jTable)
		$result = mysqli_query($con,"SELECT * FROM PartnerEvaluation WHERE PartnerID = '".$_POST['PartnerID']."' and PNO='".$_POST['PNO']."';");
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	// Free result set
		mysqli_free_result($result);
		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Record'] = $row;
		print json_encode($jTableResult);
	}
	//Updating a record (updateAction)
	else if($_GET["action"] == "update")
	{
		//Update record in database
		$result =mysqli_query($con,"UPDATE PartnerEvaluation SET   ETrustiness='" . $_POST["ETrustiness"] . "' , EGoodness='" . $_POST["EGoodness"] . "',  ETimeness='" . $_POST["ETimeness"] . "'  WHERE PartnerID ='" . $_POST["PartnerID"] . "' and PNO='". $_POST['PNO']."';");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$PNO=(isset($_GET["PNO"])?$_GET["PNO"]:$_SESSION["UserID"]);
		$result =mysqli_query($con,"DELETE FROM PartnerEvaluation WHERE PartnerID ='" . $_POST["PartnerID"] . "' and PNO='$PNO';");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}

	//Close database connection


mysqli_close($con);

}
catch(Exception $ex)
{
    //Return error Message
	$jTableResult = array();
	$jTableResult['Result'] = "ERROR";
	$jTableResult['Message'] = $ex->getMessage();
	print json_encode($jTableResult);
}
	
?>