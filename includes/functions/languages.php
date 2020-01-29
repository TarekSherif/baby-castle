<?php 


$language	= (isset($_GET["lang"]) and $_GET["lang"]=="AR" ) ? 'english':'arabic';



setcookie("language", $language, time() + (10 * 365 * 24 * 60 * 60),"/" );
    


$redirect_to = !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../../index.php';
header('Location: ' . $redirect_to);



?>