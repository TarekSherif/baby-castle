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

	
	// CREATE TABLE `ReportComment` (
	// 	`RCID` INT AUTO_INCREMENT ,
	// 	 `DRID` INT NOT NULL , 
	// 	 `UserID` INT NOT NULL,
	// 	  `Comment` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	// 	   PRIMARY KEY (`RCID`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;
	 
	

	
	

	//Getting records (listAction)
	if($_GET["action"] == "list")
	{

		
		
		$where=( isset($_GET["DRID"])) ? " where  DRID='" . $_GET["DRID"] . "' " : $where. " ";
		
		
		//Get record count
		$result = mysqli_query($con,"SELECT COUNT(*) AS RecordCount FROM ReportComment ".$where." ;");
		$row =  mysqli_fetch_array($result,MYSQLI_ASSOC);
		$recordCount = $row['RecordCount'];


	//Return result to jTable


//Get records from database
//$SQL="SELECT * FROM ReportComment  " . $where . " ORDER BY " . $_GET["jtSorting"] ." LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";";
$SQL="SELECT * FROM ReportComment  " . $where;
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
		$result = mysqli_query($con,"INSERT INTO ReportComment( `DRID` , `UserID` ,  `Comment`) VALUES( '" . $_POST["DRID"] . "','" . $_SESSION["UserID"] . "','" . $_POST["Comment"] . "');");
		
		//Get last inserted record (to return to jTable)
		$result = mysqli_query($con,"SELECT * FROM ReportComment WHERE RCID = LAST_INSERT_ID();");
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
		$result =mysqli_query($con,"UPDATE ReportComment SET  DRID= '" . $_POST["DRID"] . "', UserID = '" . $_SESSION["UserID"] . "',Comment='" . $_POST["Comment"] . "' WHERE RCID = " . $_POST["RCID"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		
		//Delete from database
		$result =mysqli_query($con,"DELETE FROM ReportComment WHERE RCID = " . $_POST["RCID"] . ";");

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