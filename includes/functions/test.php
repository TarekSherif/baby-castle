<?php






include  'MYSQLConnect.php';



if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else
{
    echo "ssss<br/>" ;
}


$result = mysqli_query($con,"SELECT COUNT(*) AS RecordCount FROM Parents  ;");
$row =  mysqli_fetch_array($result,MYSQLI_ASSOC);
$recordCount = $row['RecordCount'];

//Get records from database




$result =mysqli_query($con,"SELECT  
Parents.PNO, Parents.FatherName,Parents.MotherName
FROM Parents ;");

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