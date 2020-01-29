<?php
      
      session_start();
     
      error_reporting(E_ALL | E_STRICT);
     
      
      require('UploadHandler.php');

      $FilePath=(isset($_SESSION["FilePath"])?$_SESSION["FilePath"].'/' :"");



      $upload_handler = new UploadHandler( null, true,  null,'/images/baby-castle/'.$FilePath);