<?php

$Page=array();
$Page["Permission"]=array("Parent","Admin");
$Page["Include"]=array("mysqli_connect");


include_once '../../init.php';
//  $Page["Permission"]=array("","Parent","Admin","Partner","TeamWork");
//  $Page["Include"]=array("language","header","jtable","Nav","mysqli_connect","footer","script");
 

try
{
	// include_once   'MYSQLConnect.php';
	
	

	//Getting records (listAction)
	if($_GET["action"] == "list")
	{


		$where=(isset($_GET["TeacherID"])?" where TeacherID=".$_GET["TeacherID"]." ":"");

		$where=(isset($_POST["PNO"])?" where PNO=".$_POST["PNO"]." ":$where."");

		//Get record count
		$result = mysqli_query($con,"SELECT COUNT(*) AS RecordCount FROM  TeamWorkEvaluation $where ;");
		$row =  mysqli_fetch_array($result,MYSQLI_ASSOC);
		$recordCount = $row['RecordCount'];
	
		//Get records from database
		$result =mysqli_query($con,"SELECT * FROM TeamWorkEvaluation $where ORDER BY " . $_GET["jtSorting"] ." LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
		
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
		$result = mysqli_query($con,"INSERT INTO TeamWorkEvaluation( `TeacherID`,`PNO`,`Evaluation`) VALUES( '".$_POST['TeacherID']."','". $_POST['PNO']."','". $_POST['Evaluation']."');");
		
		//Get last inserted record (to return to jTable)
		$result = mysqli_query($con,"SELECT * FROM TeamWorkEvaluation WHERE TeacherID = '".$_POST['TeacherID']."' and PNO='".$_POST['PNO']."';");
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
		$result =mysqli_query($con,"UPDATE TeamWorkEvaluation SET   Evaluation='" . $_POST["Evaluation"] . "'   WHERE TeacherID ='" . $_POST["TeacherID"] . "' and PNO='". $_POST['PNO']."';");

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

		$result =mysqli_query($con,"DELETE FROM TeamWorkEvaluation WHERE TeacherID ='" . $_POST["TeacherID"] . "' and PNO='$PNO';");

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