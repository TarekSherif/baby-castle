<?php

$Page=array();
$Page["Title"]= '';
$Page["Permission"]=array("Admin","TeamWork");
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

		$where=" where SID='2'" ;
		
		$where=( isset($_POST["RDate"])) ? $where." and  RDate='" . $_POST["RDate"] . "' " :  $where.  " ";
		$where=( isset($_GET["RDate"])) ? $where."  and  RDate='" . $_GET["RDate"] . "' " : $where. " ";
		
		
		//Get record count
		$result = mysqli_query($con,"SELECT COUNT(*) AS RecordCount FROM DayReport ".$where." ;");
		$row =  mysqli_fetch_array($result,MYSQLI_ASSOC);
		$recordCount = $row['RecordCount'];


	//Return result to jTable


//Get records from database
//$SQL="SELECT * FROM DayReport  " . $where . " ORDER BY " . $_GET["jtSorting"] ." LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";";
$SQL="SELECT * FROM DayReport  " . $where;
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
// $jTableResult['SQL'] = $SQL;

$jTableResult['TotalRecordCount'] = $recordCount;
$jTableResult['Records'] = $rows;


print json_encode($jTableResult);
}
	
	//Creating a new record (createAction)
	else if($_GET["action"] == "create")
	{

		//Insert record into database
		$result = mysqli_query($con,"INSERT INTO DayReport( NPriority,RDate,RUrl,Notes,SID) VALUES( '" . $_POST["NPriority"] . "','" . $_POST["RDate"] . "','" . $_POST["RUrl"] . "','" . $_POST["Notes"] . "','2');");
		
		//Get last inserted record (to return to jTable)
		$result = mysqli_query($con,"SELECT * FROM DayReport WHERE DRID = LAST_INSERT_ID();");
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
		$result =mysqli_query($con,"UPDATE DayReport SET  NPriority= '" . $_POST["NPriority"] . "', RDate = '" . $_POST["RDate"] . "',RUrl='" . $_POST["RUrl"] . "', Notes='" . $_POST["Notes"] .  "' WHERE DRID = " . $_POST["DRID"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		
		//Delete from database
		$result =mysqli_query($con,"DELETE FROM DayReport WHERE DRID = " . $_POST["DRID"] . ";");

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