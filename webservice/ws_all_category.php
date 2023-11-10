<?php

include('../lib/connect_database.php');
include('../lib/function.php');

// call function fix cross origin for PHP
FIX_PHP_CORSS_ORIGIN();
$sql ="select * from tb_book_category order by id_book_cate desc";
$query = $mysqli->query($sql);
$count = $query->num_rows;
if($count > 0){

	while($result = $query->fetch_assoc()){
		$rows[]=$result;
	}

	$data = json_encode($rows);
	$totaldata = sizeof($rows);
	$results = $data;

}else{
	$results = '{"results":null}';
}

echo $results;

?>
