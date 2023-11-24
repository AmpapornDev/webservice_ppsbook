<?php

include('../lib/connect_database.php');
include('../lib/function.php');

// call function fix cross origin for PHP
FIX_PHP_CORSS_ORIGIN();
$data = file_get_contents('php://input');
$dataJsonDecode = json_decode($data);

$var_username = $dataJsonDecode->var_username;
$var_name = $dataJsonDecode->var_name;
$var_lastname = $dataJsonDecode->var_lastname;
$var_email = $dataJsonDecode->var_email;
$var_mobile = $dataJsonDecode->var_mobile;
$var_address = $dataJsonDecode->var_address;
$var_district = $dataJsonDecode->var_district;
$var_amphur = $dataJsonDecode->var_amphur;
$var_province = $dataJsonDecode->var_province;
$var_postcode = $dataJsonDecode->var_postcode;
$var_password = md5($dataJsonDecode->var_password);
/*
$var_username = "ampaporn";
$var_name = "Ampaporn";
$var_lastname = "Borworn";
$var_email = "yinghunter.am@gmail.com";
$var_mobile = '0859996321';
$var_address = "222 บุษราคัม Terrace พุทธมณฑลสาย 2";
$var_district = "ศาลาธรรมสพน์";
$var_amphur = "ทวีวัฒนา";
$var_province = "กรุงเทพฯ";
$var_postcode = "10170";
$var_password = md5('11111111');
*/

$var_add_datetime = date('Y-m-d H:i:s');

$sql = "INSERT INTO tb_member(
    username_member, 
    name_member, 
    lastname_member, 
    email_member, 
    password_member, 
    image_member,
    mobile_member,
    address_member,
    province_member,
    amphur_member,
    district_member,
    postcode_member,
    add_datetime,
    update_datetime) 
VALUES('".$var_username."',
'".$var_name."',
'".$var_lastname."',
'".$var_email."',
'".$var_password."',
'',
'".$var_mobile."',
'".$var_address."',
'".$var_province."',
'".$var_amphur."',
'".$var_district."',
'".$var_postcode."',
'".$var_add_datetime."',
'".$var_add_datetime."')";

$query = $mysqli->query($sql);
$last_id = $mysqli->insert_id;

if($last_id > 0){

    $sql_member = "select * from tb_member where id_member = '" . $last_id . "'";
    $query_member = $mysqli->query($sql_member);
    $result = $query_member->fetch_assoc();
    
    $data = json_encode($result,JSON_UNESCAPED_UNICODE);
    $results = $data;

} else {

    $data_insert = 'error';
    $results = json_encode($data_insert);

}

echo $results;
