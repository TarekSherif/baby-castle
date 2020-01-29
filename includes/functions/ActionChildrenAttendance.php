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




		
		$where=(isset($_GET["CNO"]) and !isset($_GET["RDate"])) ? " where CNO=" . $_GET["CNO"] . " " : " ";
		$where=(!isset($_GET["CNO"]) and isset($_POST["RDate"])) ? " where RDate='" . $_POST["RDate"] . "' " :$where. " ";
		$where=(!isset($_GET["CNO"]) and isset($_GET["RDate"])) ? " where RDate='" . $_GET["RDate"] . "' " :$where. " ";
		$where=(isset($_GET["CNO"]) and isset($_GET["RDate"])) ? " where CNO=" . $_GET["CNO"] . " and RDate='" . $_GET["RDate"] . "' " : $where." ";
		

		
		//Get record count
		$result = mysqli_query($con,"SELECT COUNT(*) AS RecordCount FROM ChildrenAttendance ".$where.";");
		$row =  mysqli_fetch_array($result,MYSQLI_ASSOC);
		$recordCount = $row['RecordCount'];


	//Return result to jTable


//Get records from database
$SQL="SELECT * FROM ChildrenAttendance  " . $where . " ORDER BY " . $_GET["jtSorting"] ." LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";";
//$SQL="SELECT * FROM ChildrenAttendance  " . $where; //. " ORDER BY " . $_GET["jtSorting"] ." LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";";

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
// $jTableResult['GETs'] =$_GET;
// $jTableResult['posts'] =$_POST;
$jTableResult['TotalRecordCount'] = $recordCount;
$jTableResult['Records'] = $rows;


print json_encode($jTableResult);
}
	
	//Creating a new record (createAction)
	else if($_GET["action"] == "create")
	{
		$SQL="INSERT INTO ChildrenAttendance( CNO,RDate,TAttendance,Tleave,Notes) VALUES( '" . $_POST["CNO"] . "','" . $_POST["RDate"] . "','" . $_POST["TAttendance"] . "','" . $_POST["Tleave"] . "','" . $_POST["Notes"] . "');";
		//Insert record into database
		$result = mysqli_query($con,$SQL);
	
		//Get last inserted record (to return to jTable)
		$result = mysqli_query($con,"SELECT * FROM ChildrenAttendance WHERE (CNO =  '" . $_POST["CNO"] . "' and RDate='" . $_POST["RDate"] . "');");
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	// Free result set
		mysqli_free_result($result);
		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		// $jTableResult['SQL'] =$SQL;
		$jTableResult['Record'] = $row;
		print json_encode($jTableResult);
	}
	//Updating a record (updateAction)
	else if($_GET["action"] == "update")
	{
		//Update record in database
		$result =mysqli_query($con,"UPDATE ChildrenAttendance SET  TAttendance='" . $_POST["TAttendance"] . "',Tleave='" . $_POST["Tleave"] . "',   Notes='" . $_POST["Notes"] . "' WHERE   RDate = '" . $_POST["RDate"] . "' and  CNO='" . $_POST["CNO"] . "' ;");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{

	
		$where=(isset($_GET["CNO"]) and isset($_POST["RDate"])) ? " where CNO=" . $_GET["CNO"] . " and RDate='" . $_POST["RDate"] . "' " : "";
		$where=(isset($_POST["CNO"]) and isset($_GET["RDate"])) ? " where CNO=" . $_POST["CNO"] . " and RDate='" . $_GET["RDate"] . "' " : $where."";
		
		//Delete from database

		if($where!=""){
			$SQL=	"DELETE FROM ChildrenAttendance  $where;";
			$result =mysqli_query($con,$SQL);
		}


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