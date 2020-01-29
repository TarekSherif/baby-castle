<?php


$Page=array();
$Page["Title"]= '';
$Page["Permission"]=array("Admin","Partner");
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
		$where=isset($_GET["PSDID"]) ? " where CID=" . $_GET["PSDID"] . " " : "$where ";
		$where=isset($_GET["PartnerID"]) ? " where PartnerID=" . $_GET["PartnerID"] . " " : "$where ";

		//Get record count
		$result = mysqli_query($con,"SELECT COUNT(*) AS RecordCount FROM  PartnerShipDetails $where ;");
		$row =  mysqli_fetch_array($result,MYSQLI_ASSOC);
		$recordCount = $row['RecordCount'];


	//Return result to jTable

	
		//Get records from database
		$result =mysqli_query($con,"SELECT * FROM PartnerShipDetails $where ORDER BY PSDID LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
		
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
		$result = mysqli_query($con,"INSERT INTO PartnerShipDetails( `IsActive`,`PartnerID`,`Notes`) VALUES( '". $_POST['IsActive']."','".$_POST['PartnerID']."','".$_POST['Notes']."');");
		
		//Get last inserted record (to return to jTable)
		$result = mysqli_query($con,"SELECT * FROM PartnerShipDetails WHERE PSDID = LAST_INSERT_ID();");
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
		$result =mysqli_query($con,"UPDATE PartnerShipDetails SET   IsActive='" . $_POST["IsActive"] . "' , PartnerID='" . $_POST["PartnerID"] . "',  Notes='" . $_POST["Notes"] . "'  WHERE PSDID = " . $_POST["PSDID"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$result =mysqli_query($con,"DELETE FROM PartnerShipDetails WHERE PSDID = " . $_POST["PSDID"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	else if($_GET["action"] == "PDetailsList")
	{
		$where=(isset($_GET['PartnerID'])?' and  Partners.PartnerID='.$_GET['PartnerID']:' ');

		$where=(isset($_GET['Title'])?' and  Partners.Title="'.str_replace("-"," ",$_GET["Title"]).'"':' ');

		
 		//Get records from database
		 $SQL="SELECT 
		 PartnerShipDetails.Notes
		 FROM Partners INNER JOIN PartnerShipDetails ON Partners.PartnerID= PartnerShipDetails.PartnerID  
		 where PartnerShipDetails.IsActive=1 $where 
		 ORDER BY PartnerShipDetails.PSDID ;";
		 
 
		 $result =mysqli_query($con,$SQL);
 
 
		 //Add all records to an array
		 $rows = array();
		 while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		 {
			 $rows[] = $row["Notes"];
		 }
	 // Free result set
		 mysqli_free_result($result);
		 //Return result to jTable
		 
	   
		 print json_encode($rows);
	}
	//Close database connection


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