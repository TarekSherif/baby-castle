<?php
$Page=array();
$Page["Permission"]=array("Parent");
$Page["Include"]=array("mysqli_connect");


include_once '../../init.php';


 $PNO= $_SESSION["UserID"];
 
$do=isset($_GET["do"])?$_GET["do"]:"Posts";

switch ($do) {
	case 'History':
			$SQL="SELECT DISTINCT  ChildrenAttendance.Rdate    
			FROM (( Parents
			INNER JOIN Children ON Parents.PNO = Children.PNO)   
			INNER JOIN ChildrenAttendance ON ChildrenAttendance.CNO = Children.CNO  ) 
			WHERE Parents.PNO=$PNO
			ORDER BY   ChildrenAttendance.Rdate DESC;";


			//Get records from database
			$result =mysqli_query($con,$SQL); 

			//Add all records to an array
			$rows = array();
			while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
			{
				$rows[] = $row["Rdate"];
			}
			// Free result set
			mysqli_free_result($result); 
			print json_encode($rows);
	break;
	case 'Posts':


	$condition=(isset($_GET["RDate"]) ?" and ChildrenReport.RDate='".$_GET["RDate"]."'" :"");
	$LIMIT=(!isset($_GET["RDate"])?" LIMIT 25" :"");

	$SQL="SELECT 	
		ChildrenReport.CNO ,	Children.CName , 
		DayReport.DRID ,  DayReport.RDate ,	DayReport.NPriority , 	DayReport.RUrl,	DayReport.Tags,	DayReport.Notes  ,
		ChildrenReport.IsFavorite,	1 as directory,	1  as  RImages
	
	FROM (((( Parents
	INNER JOIN Children ON Parents.PNO = Children.PNO)   
	INNER JOIN ChildrenAttendance ON ChildrenAttendance.CNO = Children.CNO  ) 
		
	INNER JOIN DayReport ON DayReport.RDate = ChildrenAttendance.RDate  )
	INNER JOIN ChildrenReport ON ChildrenReport.DRID = DayReport.DRID  )
	WHERE 
	( ChildrenReport.CNO =  Children.CNO )
	and
	Parents.PNO=$PNO  $condition
    UNION
 SELECT 				
	'0'  AS CNO,
	'0'  AS CName  , 
	DayReport.DRID , 
    DayReport.RDate , 
    DayReport.NPriority , 
    DayReport.RUrl, 
    DayReport.Tags, 
    DayReport.Notes  ,

	ChildrenReport.IsFavorite, 
    1 as directory, 
    1  as  RImages
	
FROM (((( Parents
INNER JOIN Children ON Parents.PNO = Children.PNO)   
INNER JOIN ChildrenAttendance ON ChildrenAttendance.CNO = Children.CNO  ) 
	  
INNER JOIN DayReport ON DayReport.RDate = ChildrenAttendance.RDate  )
LEFT JOIN ChildrenReport ON ChildrenReport.DRID = DayReport.DRID  )
WHERE 
  (   ChildrenReport.CNO is null)
  and
Parents.PNO=$PNO  $condition;";
	
			
			// $SQL="SELECT  
			// 		Children.CNO ,
			// 		Children.CName , 
			// 		DayReport.DRID , 
			// 		DayReport.SID , 
			// 		DayReport.RDate ,
			// 		DayReport.NPriority , 
			// 		DayReport.RUrl,
			// 		DayReport.Tags,
			// 		DayReport.Notes  ,
			// 		childrenreport.IsFavorite,
			// 		1 as directory,
			// 		1  as  RImages
					
			// 	FROM (((( Parents
			// 	INNER JOIN Children ON Parents.PNO = Children.PNO)   
			// 	INNER JOIN ChildrenAttendance ON ChildrenAttendance.CNO = Children.CNO  ) 
					  
			// 	INNER JOIN DayReport ON DayReport.RDate = ChildrenAttendance.RDate  )
			// 	LEFT JOIN childrenreport ON childrenreport.DRID = DayReport.DRID  )
			// 	WHERE 
            //       ( childrenreport.CNO = children.CNO or  childrenreport.CNO is null)
            //       and
            //     Parents.PNO=$PNO  $condition
			// 	ORDER BY   DayReport.DRID DESC $LIMIT;";


			//Get records from database
			$result =mysqli_query($con,$SQL); 

		
						
			
			//Add all records to an array
			$rows = array();
			while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
			{
				$parts = explode('-',$row["RDate"]);
				$path= $parts[0]."/". (int) $parts[1]."/".(int) $parts[2]."/".$row["DRID"];
				$directory = '../../layout/images/baby-castle/DayReport/'.$path;
				if(is_dir($directory))
				{
					$row["directory"]=$path;
					$row["RImages"]= array_values(array_diff(scandir($directory), array('thumbnail','..', '.')));
					
				}
				else{
					$row["RImages"]=array();
				}

				$rows[] = $row;
			}


// echo "<pre>";
// print_r($rows);
// echo "</pre>";
			// Free result set
			mysqli_free_result($result); 
			print json_encode($rows);

	break;
	case 'EditFavorite':

	if(isset($_GET["DRID"]))
	{
		$DRID=$_GET["DRID"];

		$SQL="UPDATE ChildrenReport
				SET IsFavorite= CASE
				WHEN IsFavorite=1 THEN 0
				ELSE 1
				END 
				where DRID=$DRID";
		
		$result =mysqli_query($con,$SQL); 
		

	} 
break;

}

		
        mysqli_close($con);
?>


