<?php

include('../lib/connect_database.php');
include('../lib/function.php');
// call function fix cross origin for PHP
FIX_PHP_CORSS_ORIGIN();

$id_category = $_GET['id_category'];
$sql = "select name_book_cate from tb_book_category where id_book_cate = '".$id_category."'";
$query = $mysqli->query($sql);
$count = $query->num_rows;

if($count > 0){

    $rows = $query->fetch_assoc();
	$data = json_encode($rows,JSON_UNESCAPED_UNICODE);
	$totaldata = sizeof($rows);
	$results = $data;

}else{
	$results = 'null';
}

echo $results;

?> 
