<?php

include('../lib/connect_database.php');
include('../lib/function.php');
// call function fix cross origin for PHP
FIX_PHP_CORSS_ORIGIN();

$id_member = $_GET['var_id_member'];
$sql = "SELECT * FROM tb_payment INNER JOIN tb_cart_order ON tb_payment.id_payment = tb_cart_order.id_payment where tb_payment.id_member = '".$id_member ."' and tb_cart_order.id_payment !=0 GROUP 
BY tb_payment.id_payment order by tb_payment.id_payment desc";
$query = $mysqli->query($sql);
$count = $query->num_rows;

if($count > 0){

	while($result = $query->fetch_assoc()){
		$rows[]=$result;
	}

	$data = json_encode($rows,JSON_UNESCAPED_UNICODE);
	$totaldata = sizeof($rows);
	$results = $data;
    

}else{

	$data_insert = 'null';
    $results = json_encode( $data_insert );
}

echo $results;

?>
