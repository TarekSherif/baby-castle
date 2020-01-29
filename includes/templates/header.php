
<!DOCTYPE html>
<html lang="en"  >
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="description" content=" نسعى لإعداد جيل من النشء صحي ومبدع، مؤهل عقلياً ولائق جسدياً، يتمتع بقدرات عقلية متطورة، وفقاً لأحدث المناهج التربوية المتبعة في دول العالم المتقدم.">
    

    <meta name="keywords"   content="Baby Castle">


            
    <meta name="author" content="Baby Castle">


    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>☺ | Baby Castle  حضانة </title>
    <link href="<?php echo $img ?>logo.ico" rel="shortcut icon" type="image/x-icon">
    

    <!-- Bootstrap -->
  
 



<!-- Special Style -->

<?php   if (in_array("jtable",$Page["Include"]))
        {        ?>  

        <link href="<?php echo $jtable ?>themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $jtable ?>Scripts/jtable/themes/lightcolor/blue/jtable.css" rel="stylesheet" type="text/css" />
        <!-- Import CSS file for validation engine (in Head section of HTML) -->
        <link href="<?php echo $jtable ?>Scripts/validationEngine/validationEngine.jquery.css" rel="stylesheet" type="text/css" />
        
        <script src="<?php echo $jtable ?>scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
        <script> $jt = jQuery.noConflict();</script>
        <script src="<?php echo $jtable ?>scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
        <script src="<?php echo $jtable ?>Scripts/jtable/jquery.jtable.js" type="text/javascript"></script>
      
        <?php 
        if(lang("Clang") =="AR")
        { ?>

        <script src="<?php echo $jtable ?>Scripts/jtable/localization/jquery.jtable.AR.js" type="text/javascript"></script>
         <?php } ?>
        <!-- Import Javascript files for validation engine (in Head section of HTML) -->
        <script type="text/javascript" src="<?php echo $jtable ?>Scripts/validationEngine/jquery.validationEngine.js"></script>
        <script type="text/javascript" src="<?php echo $jtable ?>Scripts/validationEngine/jquery.validationEngine-<?php echo lang('Clang'); ?>.js"></script>

 <?php }  ?>  

        <!-- Public  Style -->
        <link href="<?php echo $css ?>bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo $css ?>font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo $css ?>animate.min.css" rel="stylesheet">
        <link href="<?php echo $css ?>rating.css" rel="stylesheet">
        <link href="<?php echo $css ?>Style.css" rel="stylesheet">

    
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
    .ui-dialog {
                <?php echo lang('Sdirection'); ?>;
            }
        .ui-autocomplete{
            <?php echo lang('Stext-align'); ?>;
            }

    </style>
  </head>
<body ng-app="SchoolModule" ng-controller="SchoolController"  ng-nicescroll   >
<a id="top"></a>
<?php
      if (in_array("Nav",$Page["Include"]))
        {
          include_once $tpl . 'Nav.php';
        }
  ?>
   