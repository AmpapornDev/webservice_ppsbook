<?php

include('../lib/connect_database.php');
include('../lib/function.php');
// call function fix cross origin for PHP
FIX_PHP_CORSS_ORIGIN();

$id_category = $_GET['id_category'];
$sql = "select * from tb_book left join tb_book_category on tb_book.id_book_cate = tb_book_category.id_book_cate 
where tb_book.id_book_cate = '".$id_category."' order by tb_book.id_book desc";
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
	$results = 'null';
}

echo $results;

?>
