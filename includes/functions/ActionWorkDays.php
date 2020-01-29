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


		
		$where=( isset($_POST["RDate"])) ? " where RDate='" . $_POST["RDate"] . "' " :  " ";
		$where=( isset($_GET["RDate"])) ? " where RDate='" . $_GET["RDate"] . "' " : $where. " ";
		
		
		
		//Get record count
		$result = mysqli_query($con,"SELECT COUNT(*) AS RecordCount FROM workdays ".$where." ;");
		$row =  mysqli_fetch_array($result,MYSQLI_ASSOC);
		$recordCount = $row['RecordCount'];


	//Return result to jTable


//Get records from database
//$SQL="SELECT * FROM workdays  " . $where . " ORDER BY " . $_GET["jtSorting"] ." LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";";
$SQL="SELECT * FROM workdays  " . $where;
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
		$result = mysqli_query($con,"INSERT INTO workdays( RDate ) VALUES(  '" . $_POST["RDate"] . "');");
		
		//Get last inserted record (to return to jTable)
		$result = mysqli_query($con,"SELECT * FROM workdays  WHERE   RDate='" . $_POST["RDate"] . "' " );
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	// Free result set
		mysqli_free_result($result);
		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Record'] = $row;
		print json_encode($jTableResult);
	}
	
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$result =mysqli_query($con,"DELETE FROM workdays  WHERE   RDate='" . $_POST["RDate"] . "' " );

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