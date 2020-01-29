<?php
$Page=array();
$Page["Permission"]=array("Parent","Admin","Partner","TeamWork");
$Page["Include"]=array("mysqli_connect");


include_once '../../init.php';


$do=isset($_GET["do"])?$_GET["do"]:"";



	switch ($do) {
		case 'ContactInfo':
				//Get records from database
			$result =mysqli_query($con,"SELECT CType as DisplayText , CType as Value  FROM ContactInfo;"); 
			
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
			$jTableResult['Options'] = $rows;
			print json_encode($jTableResult);
		break;
		case 'CName':
				//Get records from database
				$SQL="SELECT CONCAT(Children.CName,' ' ,Parents.FatherName) as DisplayText ,
							 Children.CNO as Value 
				 FROM Children inner join Parents on Children.PNO=Parents.PNO;";
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
			$jTableResult['Options'] = $rows;
			print json_encode($jTableResult);
		break;
		case 'Priority':
			//Get records from database

			  
			$result =mysqli_query($con,"SELECT TPriority as DisplayText , NPriority  as Value  FROM NPriority "); 
			
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
			$jTableResult['Options'] = $rows;
			print json_encode($jTableResult);
		break;
		case 'Partner':
		//Get records from database

		$result =mysqli_query($con,"SELECT Title as DisplayText , PartnerID  as Value  FROM Partners "); 
		
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
		$jTableResult['Options'] = $rows;
		print json_encode($jTableResult);
		
		
		break;
		case 'Parents':
		//Get records from database

		$result =mysqli_query($con,"SELECT FatherName as DisplayText , PNO  as Value  FROM Parents "); 
		
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
		$jTableResult['Options'] = $rows;
		print json_encode($jTableResult);
		
		
		break;
		case 'UserType':
		//Get records from database
	

		$result =mysqli_query($con,"SELECT UserType as DisplayText , UserType  as Value  FROM UserType "); 
		
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
		$jTableResult['Options'] = $rows;
		print json_encode($jTableResult);
		
		
		break;
		case 'Teacher':
	
		$result =mysqli_query($con,"SELECT TName as DisplayText , TeacherID  as Value  FROM TeamWork "); 
		
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
		$jTableResult['Options'] = $rows;
		print json_encode($jTableResult);
		
		
		break;

		case 'UserList':
	
			$result =mysqli_query($con,"SELECT UserName as DisplayText , UserID  as Value  FROM Users "); 
			
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
			$jTableResult['Options'] = $rows;
			print json_encode($jTableResult);
			
			
			break;
		
		
		
	}

	
	
		
        mysqli_close($con);
?>


