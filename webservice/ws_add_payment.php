<?php

include('../lib/connect_database.php');
include('../lib/function.php');

// call function fix cross origin for PHP
FIX_PHP_CORSS_ORIGIN();
$data = file_get_contents('php://input');
$dataJsonDecode = json_decode($data);

$var_id_bank = $dataJsonDecode->var_id_bank;
$var_id_member = $dataJsonDecode->var_id_member;
$var_totalprice = $dataJsonDecode->var_totalprice;
$var_totalqty = $dataJsonDecode->var_totalqty;
$var_total_amount = $dataJsonDecode->var_total_amount;
$var_date = date('Y-m-d H:i:s');
$var_orderno = date('Ymd-His');
$var_delivery = '50';


$sql = "INSERT INTO tb_payment(id_bank,id_member,order_no_payment,total_price_payment,total_qty_payment,total_delivery_payment,total_amount,create_datetime,update_datetime) 
VALUES('" . $var_id_bank . "','" . $var_id_member . "','" . $var_orderno . "','" . $var_totalprice . "','" . $var_totalqty . "','" . $var_delivery . "','" . $var_total_amount . "','" . $var_date . "','" . $var_date . "')";

$resource = $mysqli->query($sql);
$last_id = $mysqli->insert_id;

if ($resource) {

    $sql_cart = "select * from tb_cart_order where id_member = '" . $var_id_member . "' and status_cart_order = 'wait' ";
    $query_cart = $mysqli->query($sql_cart);
    if ($query_cart) {
        while ($rec_cart = $query_cart->fetch_assoc()) {

            $sql_update_cart = "update tb_cart_order set id_payment = '".$last_id."', status_cart_order ='success' where id_cart_order = '".$rec_cart['id_cart_order']."'";
            $query_update_cart = $mysqli->query($sql_update_cart);

        }
        $data_insert = 'success';
        $results = json_encode($data_insert);
    } else {
        $data_insert = 'error insert';
        $results = json_encode($data_insert);
    }
} else {
    $data_insert = 'error insert';
    $results = json_encode($data_insert);
}

echo $results;
