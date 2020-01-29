<?php 
	//Open database connection
 $con=mysqli_connect("localhost","root","mysql","babycastle");
    //$con=mysqli_connect("188.121.44.194:3306","DBAdmin","DB_Admin","babycastle");
// $con=mysqli_connect("188.121.44.192:3306","babyCastle","baby_Castle","babycastleDB");
// $con = mysqli_connect("localhost", "babyCastle", "baby_Castle", "babycastleDB");
	//To select the database
	//mysqli_select_db($con,""); 
	//To select the Language
    mysqli_query($con,"SET NAMES 'utf8'");
