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
		$where=isset($_GET["PNO"]) ? " where PNO=" . $_GET["PNO"] . " " : " ";
		$where=isset($_GET["CNO"]) ? " where CNO=" . $_GET["CNO"] . " " : $where." ";


		$result =mysqli_query($con,"SELECT * FROM Children ".$where  ." ORDER BY " . $_GET["jtSorting"] ." ;");
		
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
		$jTableResult['Records'] = $rows;
		// $jTableResult['TotalRecordCount'] = $recordCount;
				
      
        print json_encode($jTableResult);
        
	}
	//Creating a new record (createAction)
	else if($_GET["action"] == "create")
	{
		//Insert record into database
		$result = mysqli_query($con,"INSERT INTO Children(CName, BDate,Notes,PNO) VALUES('" . $_POST["CName"] . "','" . $_POST["BDate"] . "','" . $_POST["Notes"] . "', '" . $_POST["PNO"] . "');");
		
		//Get last inserted record (to return to jTable)
		$result = mysqli_query($con,"SELECT * FROM Children WHERE CNO = LAST_INSERT_ID();");
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
		$result =mysqli_query($con,"UPDATE Children SET CName = '" . $_POST["CName"] . "', BDate = '" . $_POST["BDate"] . "', Notes='" . $_POST["Notes"] . "', PNO='" . $_POST["PNO"] . "' WHERE CNO = " . $_POST["CNO"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$result =mysqli_query($con,"DELETE FROM Children WHERE CNO = " . $_POST["CNO"] . ";");

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