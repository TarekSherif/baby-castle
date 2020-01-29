<?php

ob_start();

session_start();



 function GetConnection($servername = "localhost",
                        $username = "root",
                        $password = "",
                        $dbname = "karimelessawy")
{
 $con = mysqli_connect($servername, $username, $password, $dbname);
mysqli_query($con,"SET NAMES 'utf8'");
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
return $con;
}



function GetList($SQL)
 {

    $ListCon =GetConnection();                                             
    $result =mysqli_query($ListCon,$SQL);
   
    
    $rows = array();
    if (mysqli_num_rows($result)>0)
    {
      while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
      {
          $rows[] = $row;
      }
    }
      // Free result set
    mysqli_free_result($result);
    mysqli_close($ListCon);
    return $rows;
}



function Execute($SQL)
 {

    $ExeCon =GetConnection();                                             
    $result =mysqli_query($ExeCon,$SQL);

    mysqli_close($ExeCon);

}

function insertGetID($SQLInsert)
 {
    $ExeCon =GetConnection();                                             
    $result =mysqli_query($ExeCon,$SQLInsert);
    $id=mysqli_insert_id($ExeCon);
    mysqli_close($ExeCon);
    return $id;

}

?>