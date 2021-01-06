<?php
include_once("db_connect.php");
$input = filter_input_array(INPUT_POST);
if ($input['action'] == 'edit') {	
	$update_field='';
	if(isset($input['solution'])) {
		$update_field.= "solution='".$input['solution']."'";
	}	
	if($update_field && $input['id']) {
		$sql_query = "UPDATE lims SET $update_field WHERE id='" . $input['id'] . "'";	
		mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));		
	}
}