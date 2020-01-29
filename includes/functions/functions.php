<?php


function GetUserName(){
    return (isset( $_SESSION['UserName'])? $_SESSION['UserName']:"");
}
function GetPNO(){
    return (isset( $_SESSION['PNO'])? $_SESSION['PNO']:"");
}




?>