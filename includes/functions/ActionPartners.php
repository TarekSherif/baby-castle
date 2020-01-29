<?php



$Page=array();
$Page["Title"]= '';
$Page["Permission"]=array("","Admin");
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
		$result = mysqli_query($con,"SELECT COUNT(*) AS RecordCount FROM  Partners INNER JOIN Users ON Partners.PartnerID= Users.UserID  $where ;");
		$row =  mysqli_fetch_array($result,MYSQLI_ASSOC);
		$recordCount = $row['RecordCount'];
		
	
 		//Get records from database
		 $SQL="SELECT Partners.Title , Partners.Notes,Partners.PartnerID,
		  Users.UserName, Users.Password,Users.IsActive ,
		   avg(PartnerEvaluation.ETrustiness) as ETrustiness ,
		   avg(PartnerEvaluation.EGoodness) as EGoodness ,
		   avg(PartnerEvaluation.ETimeness) as ETimeness 
		 FROM ((Partners INNER JOIN Users ON Partners.PartnerID= Users.UserID ) 
		 LEFT JOIN PartnerEvaluation ON Partners.PartnerID= PartnerEvaluation.PartnerID)
		   $where
		 group by Partners.Title , Partners.Notes,Partners.PartnerID, Users.UserName, Users.Password,Users.IsActive
		 
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
		$SQL="INSERT INTO Users (UserName, Password ,UserType,IsActive) VALUES ('" . $_POST["UserName"] . "', '" . $_POST["Password"] . "','Partner', '" . $_POST["IsActive"] . "');";
		$result = mysqli_query($con, $SQL);

		$result = mysqli_query($con,"SELECT UserID FROM Users  WHERE UserID = LAST_INSERT_ID();");
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$UserID=$row["UserID"] ;

		//Insert record into database
		$SQL="INSERT INTO Partners(`PartnerID`,`Title`,`Notes`) VALUES( $UserID,'".$_POST['Title']."','".$_POST['Notes']."');";
		$result = mysqli_query($con,$SQL);
		
		


		$SQL="SELECT
		  Partners.Title , Partners.Notes,Partners.PartnerID,
		  Users.UserName, Users.Password,Users.IsActive ,
		  0 as ETrustiness ,0 as EGoodness ,0 as ETimeness  
		FROM Partners  INNER JOIN Users ON Partners.PartnerID= Users.UserID WHERE  Partners.PartnerID =$UserID;";

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



		//Update record in database
		$SQL="UPDATE Partners SET   Title = '" . $_POST["Title"] . "' ,   Notes='" . $_POST["Notes"] . "'  WHERE PartnerID = " . $_POST["PartnerID"] . ";";
		$result =mysqli_query($con,$SQL);
		
		$SQL="UPDATE Users SET UserName = '" . $_POST["UserName"] . "', Password = '" . $_POST["Password"] . "' , IsActive=" . $_POST["IsActive"] . "  WHERE UserID = " . $_POST["PartnerID"] . ";";
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
		$result =mysqli_query($con,"DELETE FROM Users WHERE UserID = " . $_POST["PartnerID"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Get 
	else if($_GET["action"] == "PartnerList")
	{
		
 		//Get records from database
		 $SQL="SELECT 
		 Partners.PartnerID,Partners.Title 
		 FROM Partners INNER JOIN Users ON Partners.PartnerID= Users.UserID  
		 where Users.IsActive=1 
		 ORDER BY Partners.PartnerID ;";
		 
 
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