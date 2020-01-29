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

		$where="";
		//Get record count
		$result = mysqli_query($con,"SELECT COUNT(*) AS RecordCount FROM  TeamWork INNER JOIN Users ON TeamWork.TeacherID= Users.UserID  $where ;");
		$row =  mysqli_fetch_array($result,MYSQLI_ASSOC);
		$recordCount = $row['RecordCount'];
		
	
 		//Get records from database
		 $SQL="SELECT TeamWork.TName,TeamWork.TeacherID,	TeamWork.Specialization,
		  Users.UserName, Users.Password,Users.IsActive ,
		   avg(TeamWorkEvaluation.Evaluation) as Evaluation 

		 FROM ((TeamWork INNER JOIN Users ON TeamWork.TeacherID= Users.UserID ) 
		 LEFT JOIN TeamWorkEvaluation ON TeamWork.TeacherID= TeamWorkEvaluation.TeacherID)
		   $where
		 group by TeamWork.TName ,TeamWork.TeacherID, Users.UserName, Users.Password,Users.IsActive
		 
		 ORDER BY " . $_GET["jtSorting"] ." LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";";
		

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
		
		$SQL="INSERT INTO Users (UserName, Password ,UserType,IsActive) VALUES ('" . $_POST["UserName"] . "', '" . $_POST["Password"] . "','TeamWork', '" . $_POST["IsActive"] . "');";
		$result = mysqli_query($con, $SQL);

		$result = mysqli_query($con,"SELECT UserID FROM Users  WHERE UserID = LAST_INSERT_ID();");
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$UserID=$row["UserID"] ;

		//Insert record into database
		$SQL="INSERT INTO TeamWork(`TeacherID`,`TName`,`Specialization`) VALUES( $UserID,'".$_POST['TName']."','".$_POST['Specialization']."');";
		$result = mysqli_query($con,$SQL);
		
		


		$SQL="SELECT
		  TeamWork.TName ,TeamWork.TeacherID,TeamWork.Specialization
		  Users.UserName, Users.Password,Users.IsActive ,
		  0 as Evaluation 
		FROM TeamWork  INNER JOIN Users ON TeamWork.TeacherID= Users.UserID WHERE  TeamWork.TeacherID =$UserID;";

		$result = mysqli_query($con, $SQL);
		
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
		$SQL="UPDATE TeamWork SET   TName = '" . $_POST["TName"] . "' , Specialization = '" . $_POST["Specialization"] . "'   WHERE TeacherID = " . $_POST["TeacherID"] . ";";
		$result =mysqli_query($con,$SQL);
		
		$SQL="UPDATE Users SET UserName = '" . $_POST["UserName"] . "', Password = '" . $_POST["Password"] . "' , IsActive=" . $_POST["IsActive"] . "  WHERE UserID = " . $_POST["TeacherID"] . ";";
		$result =mysqli_query($con,$SQL);
		
		
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$result =mysqli_query($con,"DELETE FROM Users WHERE UserID = " . $_POST["TeacherID"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Get 
	else if($_GET["action"] == "TeamWorkList")
	{
		
 		//Get records from database
		 $SQL="SELECT 
		 TeamWork.TeacherID,TeamWork.TName 
		 FROM TeamWork INNER JOIN Users ON TeamWork.TeacherID= Users.UserID  
		 where Users.IsActive=1 
		 ORDER BY TeamWork.TeacherID ;";
		 
 
		 $result =mysqli_query($con,$SQL);
 
 
		 //Add all records to an array
		 $rows = array();
		 while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		 {
			 $rows[] = $row;
		 }
	
		 mysqli_free_result($result);
		 print json_encode($rows);
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