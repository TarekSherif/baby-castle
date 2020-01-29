<?php
$Page=array();
$Page["Title"]= '';
$Page["Permission"]=array("Parent","Admin","Partner","TeamWork");
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
	
		$where=isset($_GET["UserID"]) ? " where UserID=" . $_GET["UserID"] . " " : " ";
	
		//Get records from database
		$result =mysqli_query($con,"SELECT * FROM Contact $where ;"); 
		
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
		print json_encode($jTableResult);
	}
	//Creating a new record (createAction)
	else if($_GET["action"] == "create")
	{
		//Insert record into database
		$SQL="INSERT INTO Contact(CType, CValue,UserID) VALUES('" . $_POST["CType"] . "', '" . $_POST["CValue"] . "','" . $_POST["UserID"] . "');";
		 $result = mysqli_query($con,$SQL);
		
		
		//Get last inserted record (to return to jTable)
		
		$result = mysqli_query($con,"SELECT * FROM Contact WHERE CID = LAST_INSERT_ID();");
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
		$SQL=(isset($_POST["UserID"] )
		?	"UPDATE Contact SET CType = '" . $_POST["CType"] . "', CValue = '" . $_POST["CValue"] . "',UserID='" . $_POST["UserID"] . "' WHERE CID = " . $_POST["CID"] . ";"
		: 	"UPDATE Contact SET CType = '" . $_POST["CType"] . "', CValue = '" . $_POST["CValue"] . "',UserID='" . $_POST["UserID"] . "'  WHERE CID = " . $_POST["CID"] . ";"
		);
		$result =mysqli_query($con,$SQL);

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$result =mysqli_query($con,"DELETE FROM Contact WHERE CID = " . $_POST["CID"] . ";");

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