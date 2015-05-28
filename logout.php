<?php

@session_start();
@session_destroy();
$root = "http://".$_SERVER['HTTP_HOST'];
$root.= preg_replace('@/+$@','',dirname($_SERVER['SCRIPT_NAME'])).'/'; 
header("location:$root");

?>

