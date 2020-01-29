<?php


ob_start();

session_start();

	$UserType= isset($_SESSION["UserType"])?$_SESSION["UserType"]:"";
	
	  if(! in_array($UserType,$Page["Permission"]))
	  {
		  switch ($UserType) {
			  case '':
				  $gotoPage="index.php";
			  break;
			  case 'Parent':
				  $gotoPage="Profile.php";
			  break;
			  case 'Admin':
				  $gotoPage="TimeSheet.php";
			  break;
			  case 'TeamWork':
				  $gotoPage="TimeSheet.php";
			  break;
			  case 'Partner':
			  // $gotoPage="Profile.php":"TimeSheet.php";
			  break;
		  }
		  
		  header('Location:'. $gotoPage);
		
	  }
	  



	// Routes


	//includes
	$tpl 	= 'includes/templates/'; // Template Directory
	$lang 	= 'includes/languages/'; // Language Directory
    $func	= 'includes/functions/'; // Functions Directory
	
	

	//layout
	$img 	= 'layout/images/'; // Js Directory
	$css 	= 'layout/css/'; // Css Directory
	$js 	= 'layout/js/'; // Js Directory

	$jtable ='layout/JTable/';//JTable

	$FileUploader="layout/FileUploader/server/php/";//FileUploader
	// include_once The Important Files

	include_once $func . 'functions.php';



	// Include
	if (in_array("language",$Page["Include"]))
	{
		if(isset($_COOKIE["language"]))
		{
			$language	= (($_COOKIE["language"] == 'arabic' ) ? 'arabic':'english');
		}
		else{
			$language	='arabic';
		}
	
		include_once $lang . $language.'.php';

	}




	if (in_array("header",$Page["Include"]))
	{
		include_once $tpl . 'header.php';
	}
	if (in_array("mysqli_connect",$Page["Include"]))
	{
		include_once $func."MYSQLConnect.php";
	}


