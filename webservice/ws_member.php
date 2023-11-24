<?php

include('../lib/connect_database.php');
include('../lib/function.php');
// call function fix cross origin for PHP
FIX_PHP_CORSS_ORIGIN();
$id_member = $_GET['var_id_member'];

$sql ="select * from tb_member where id_member = '".$id_member."'";
$query = $mysqli->query($sql);
$count = $query->num_rows;

if($count > 0){

	$result = $query->fetch_assoc();
	$data = json_encode($result);
	$results = $data;

}else{

	$data_insert = 'null';
    $results = json_encode( $data_insert );
}

echo $results;

?>
