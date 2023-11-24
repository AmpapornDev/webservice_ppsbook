<?php

include('../lib/connect_database.php');
include('../lib/function.php');

// call function fix cross origin for PHP
FIX_PHP_CORSS_ORIGIN();
$data = file_get_contents('php://input');
$dataJsonDecode = json_decode($data);

$var_username = $dataJsonDecode->var_username;
$var_password = md5($dataJsonDecode->var_password);

$sql = "select * from tb_member where username_member = '".$var_username."' and password_member = '".$var_password."'";
$query = $mysqli->query($sql);
$count = $query->num_rows;

if($count > 0){
    $result = $query->fetch_assoc();
    $data = json_encode($result,JSON_UNESCAPED_UNICODE);
    $results = $data;
} else {
    $data_insert = 'error';
    $results = json_encode($data_insert);
}

echo $results;
