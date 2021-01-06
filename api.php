<?php
header('Access-Control-Allow-Origin: *');

$type = $_REQUEST['type'];

switch($type){
	
	case "division" :
	 require_once("division.php");
	break;
	
	case  "district" :
	 require_once("district.php");
	break;
	
	case  "upazila" :
	 require_once("upazila.php");
	break;
	
	default :
	 require_once("division.php");
	break;
}
?>
