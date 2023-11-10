<?php

include( '../lib/connect_database.php' );
include( '../lib/function.php' );

// call function fix cross origin for PHP
FIX_PHP_CORSS_ORIGIN();
$data = file_get_contents("php://input");
$dataJsonDecode = json_decode($data);

$var_id_member = $dataJsonDecode->var_id_member;
$var_id_book = $dataJsonDecode->var_id_book;

if($var_id_member!='' and $var_id_book!=''){
	
	$sql = "delete from tb_cart_order where id_member = '".$var_id_member."' and id_book = '".$var_id_book."'";
	$resource = $mysqli->query($sql);
	if($resource) {
			
        $data_update = 'success';
        $results = json_encode( $data_update );
	
	}else{

		$data_update = 'error';
        $results = json_encode( $data_update );
	}
	
	
}else{
	
	$data = 'error';
    $results = json_encode( $data );
}

echo $results;


?>
