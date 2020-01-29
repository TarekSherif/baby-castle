<?php

$Page=array();
$Page["Title"]= '';
$Page["Permission"]=array("Admin","TeamWork");
$Page["Include"]=array("mysqli_connect");


include_once '../../init.php';

// include 'init.php';
//  $Page["Permission"]=array("","Parent","Admin","Partner","TeamWork");
//  $Page["Include"]=array("language","header","jtable","Nav","mysqli_connect","footer","script");



$do=isset($_GET["do"])?$_GET["do"]:"";

switch ($do) {
	case 'Parents':

		$searchTerm = $_GET['term'];
	
		$where= " WHERE FatherName LIKE '%$searchTerm%' ";
	
			// $result =mysqli_query($con,"SELECT count(*)    FROM Parents  $where  ;"); 
			// $rowCount=
			//Get records from database
		$result =mysqli_query($con,"SELECT FatherName    FROM Parents  $where ORDER BY FatherName ;"); 
	
			// 		$result =mysqli_query($con,"SELECT FatherName  FROM Parent  ;"); 
	
			
			//Add all records to an array
		$rows = array();
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$rows[] = $row["FatherName"];
		}
		 // Free result set
	    mysqli_free_result($result);
	
		print json_encode($rows);

	break;
	
	case 'Children':
		

	break;
	

}



	

	
		
        mysqli_close($con);
?>




		


