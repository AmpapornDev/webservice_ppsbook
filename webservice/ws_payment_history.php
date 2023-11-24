<?php

include('../lib/connect_database.php');
include('../lib/function.php');
// call function fix cross origin for PHP
FIX_PHP_CORSS_ORIGIN();

$var_id_payment = $_GET['var_id_payment'];
$var_id_member = $_GET['var_id_member'];

$sql ="select * from tb_payment left join tb_acc_bank on tb_payment.id_bank = tb_acc_bank.id_acc_bank  where id_payment = '".$var_id_payment."' and id_member = '".$var_id_member."'";
$query = $mysqli->query($sql);
$count = $query->num_rows;

if($count > 0){

    $rows = $query->fetch_assoc();
	$data = json_encode($rows,JSON_UNESCAPED_UNICODE);
	$totaldata = sizeof($rows);
	$results = $data;

}else{

	$data_insert = 'null';
    $results = json_encode( $data_insert );
}

echo $results;

?>
