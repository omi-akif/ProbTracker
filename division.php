<?php
require_once("db_connect.php");

$div_sql = "SELECT * FROM divisions;
$div_res = $conn->query($div_sql);
//$div_sql = $conn->prepare("SELECT * FROM divisions");
//$sth->execute();

$div_array = $div_res->fetch_all();
$divisions = json_encode($div_array);
?>
