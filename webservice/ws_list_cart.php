<?php

include('../lib/connect_database.php');
include('../lib/function.php');
// call function fix cross origin for PHP
FIX_PHP_CORSS_ORIGIN();

$id_member = '1';
$sql = "select * from tb_book left join tb_cart_order on tb_book.id_book = tb_cart_order.id_book  where tb_cart_order.id_member = '".$id_member."' 
order by tb_cart_order.add_cart_order desc";
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
	$results = '{"results":null}';
}

echo $results;

?>
