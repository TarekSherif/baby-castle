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
		$where=isset($_POST["FatherName"]) ? " where Parents.FatherName='" . $_POST["FatherName"] . "' " :  " ";
		
		$where=isset($_GET["PNO"]) ? " where Parents.PNO=" . $_GET["PNO"] . " " : $where ." ";
		//$where=isset($_GET["UserName"]) ? " where Users.UserName=" . $_GET["UserName"] . " " : $where ." ";
		$where=isset($_GET["CNO"]) ? " INNER JOIN Children ON Parents.PNO= Children.PNO  where Children.CNO=" . $_GET["CNO"] . " " : $where ." ";
		

		//Get record count
		$result = mysqli_query($con,"SELECT COUNT(*) AS RecordCount FROM Parents   INNER JOIN Users ON Parents.PNO= Users.UserID  $where ;");
		$row =  mysqli_fetch_array($result,MYSQLI_ASSOC);
		$recordCount = $row['RecordCount'];

		//Get records from database


		$SQL="SELECT  Parents.PNO, Parents.FatherName,Parents.MotherName,Users.UserID, Users.UserName, Users.Password, Users.IsActive  
		FROM Parents INNER JOIN Users ON Parents.PNO= Users.UserID  $where ORDER BY " . $_GET["jtSorting"] ." LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";";


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
		// $jTableResult['SQL'] = 	$where;
		$jTableResult['TotalRecordCount'] = $recordCount;
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
	}
	//Creating a new record (createAction)
	else if($_GET["action"] == "create")
	{

				$SQL="INSERT INTO Users (UserName, Password ,UserType,IsActive) VALUES ('" . $_POST["UserName"] . "', '" . $_POST["Password"] . "','Parent', '" . $_POST["IsActive"] . "');";
				$result = mysqli_query($con, $SQL);

				$result = mysqli_query($con,"SELECT UserID FROM Users  WHERE UserID = LAST_INSERT_ID();");
				$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
				$UserID=$row["UserID"] ;

				$SQL="INSERT INTO Parents(PNO,FatherName, MotherName) VALUES ('$UserID','" . $_POST["FatherName"] . "', '" . $_POST["MotherName"] . "');";
				$result = mysqli_query($con,$SQL);
				
				
				
		
				 $SQL="SELECT
				 Parents.PNO, Parents.FatherName,Parents.MotherName,
				  Users.UserName, Users.Password, Users.IsActive 
				 FROM Parents  INNER JOIN Users ON Parents.PNO= Users.UserID WHERE  Users.UserID =$UserID;";
				$result = mysqli_query($con,$SQL);
				$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
				
			
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
		 $IsActive= ($_POST["IsActive"]==1)?'1':'0' ;

		$result =mysqli_query($con,"UPDATE Parents SET FatherName = '" . $_POST["FatherName"] . "', MotherName = '" . $_POST["MotherName"] . "' WHERE PNO = " . $_POST["PNO"] . ";");
		


		$SQL="UPDATE Users SET  UserName = '" . $_POST["UserName"] . "', Password = '" . $_POST["Password"] . "' , IsActive="
		 .$IsActive . "  WHERE UserID = " . $_POST["PNO"] . ";";
		

		$result =mysqli_query($con,$SQL);
		
		
		
		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		// $jTableResult['SQL'] = $SQL;
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database

		$result =mysqli_query($con,"DELETE FROM Users WHERE UserID = " . $_POST["PNO"] . ";");

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