<?php

include( '../lib/connect_database.php' );
include( '../lib/function.php' );

// call function fix cross origin for PHP
FIX_PHP_CORSS_ORIGIN();
$data = file_get_contents( 'php://input' );
$dataJsonDecode = json_decode( $data );

$var_id_book = $dataJsonDecode->var_id_book;
$var_id_member = $dataJsonDecode->var_id_member;
$var_image_book = $dataJsonDecode->var_image_book;
$var_name_book = $dataJsonDecode->var_name_book;
$var_price_book = $dataJsonDecode->var_price_book;
$var_qty = $dataJsonDecode->var_qty;
$var_date = date( 'Y-m-d H:i:s' );

/** เช็ค id_book ว่าถ้าเหมือนกัน ให้อัพเดท qty **/
$sql_check = "select id_book,qty_book,id_member from tb_cart_order where id_book = '".$var_id_book."' and id_member = '".$var_id_member."' and status_cart_order = 'wait'";
$query = $mysqli->query( $sql_check );
$count = $query->num_rows;
if ( $count > 0 ) {

        $data = $query->fetch_assoc();
        $sum_qty = $data['qty_book'] + $var_qty;

        $sql_update = "update tb_cart_order set qty_book = '".$sum_qty."', update_cart_order = '".$var_date."' where id_book = '".$var_id_book."' and id_member = '".$var_id_member."'";
        $resource_update = $mysqli->query( $sql_update );
        if ( $resource_update ) {
                $data_update = 'success';
                $results = json_encode( $data_update );
            } else {
                $data_update = 'error update';
                $results = json_encode( $data_update );
            }


} else {

    $sql = "INSERT INTO tb_cart_order(id_payment, id_member, id_book, cover_book, name_book, price_book,qty_book,status_cart_order,add_cart_order,update_cart_order) 
VALUES('0','".$var_id_member."','".$var_id_book."','".$var_image_book."','".$var_name_book."','".$var_price_book."','".$var_qty."','wait','".$var_date."','".$var_date."')";
    $resource = $mysqli->query( $sql );
    if ( $resource ) {
        $data_insert = 'success';
        $results = json_encode( $data_insert );
    } else {
        $data_insert = 'error insert';
        $results = json_encode( $data_insert );
    }

}

echo $results;
