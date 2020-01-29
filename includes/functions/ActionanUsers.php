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
		
		$where=isset($_GET["UserID"]) ? " where UserID=" . $_GET["UserID"] . " " : $where ." ";

			//Get record count
			$result = mysqli_query($con,"SELECT COUNT(*) AS RecordCount FROM Users    $where ;");
			$row =  mysqli_fetch_array($result,MYSQLI_ASSOC);
			$recordCount = $row['RecordCount'];

		//Get records from database


$SQL="SELECT  * from Users   $where ORDER BY " . $_GET["jtSorting"] ." LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";";


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
		$jTableResult['SQL'] = 	$where;
		$jTableResult['TotalRecordCount'] = $recordCount;
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
	}
	//Creating a new record (createAction)
	else if($_GET["action"] == "create")
	{
				$SQL="INSERT INTO Users (UserName, Password ,UserType) VALUES ('" . $_POST["UserName"] . "', '" . $_POST["Password"] . "', '" . $_POST["UserType"] . "');";
				$result = mysqli_query($con, $SQL);
				
		

				$result = mysqli_query($con,"SELECT * FROM Users  WHERE UserID = LAST_INSERT_ID();");
				
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

		$result =mysqli_query($con,"UPDATE Users SET UserName = '" . $_POST["UserName"] . "', Password = '" . $_POST["Password"] . "',UserType='" . $_POST["UserType"] . "' WHERE UserID = " . $_POST["UserID"] . ";");
		

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$result =mysqli_query($con,"DELETE FROM Users WHERE UserID = " . $_POST["UserID"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}

	else if($_GET["action"] == "Active")
	{
		$IsActive=$_GET["IsActive"];
		$UserID=$_GET["UserID"];
		$result =mysqli_query($con,"UPDATE `users` SET `IsActive` = '$IsActive' WHERE `users`.`UserID` =  $UserID"); 
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