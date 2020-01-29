<?php



$Page=array();
$Page["Title"]= '';
$Page["Permission"]=array("Admin");
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
		$where=isset($_GET["PID"]) ? " where CNO=" . $_GET["PID"] . " " : $where." ";

					//Get record count
					$result = mysqli_query($con,"SELECT COUNT(*) AS RecordCount FROM  Payment $where ;");
					$row =  mysqli_fetch_array($result,MYSQLI_ASSOC);
					$recordCount = $row['RecordCount'];
		
	
				//Return result to jTable
	
	
		//Get records from database
		$result =mysqli_query($con,"SELECT * FROM Payment $where ORDER BY " . $_GET["jtSorting"] ." LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
		
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
		$result = mysqli_query($con,"INSERT INTO Payment( PayValue,PDate,SDate,EDate,Notes,PNO) VALUES( '". $_POST["PayValue"] ."','" . $_POST["PDate"] . "','" . $_POST["SDate"] . "','" . $_POST["EDate"] . "','" . $_POST["Notes"] . "', '" . $_POST["PNO"] . "');");
		
		//Get last inserted record (to return to jTable)
		$result = mysqli_query($con,"SELECT * FROM Payment WHERE PID = LAST_INSERT_ID();");
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
		$result =mysqli_query($con,"UPDATE Payment SET   PayValue='". $_POST["PayValue"] ."', PDate = '" . $_POST["PDate"] . "', SDate = '" . $_POST["SDate"] . "', EDate = '" . $_POST["EDate"] . "',   Notes='" . $_POST["Notes"] . "', PNO='" . $_POST["PNO"] . "' WHERE PID = " . $_POST["PID"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$result =mysqli_query($con,"DELETE FROM Payment WHERE PID = " . $_POST["PID"] . ";");

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