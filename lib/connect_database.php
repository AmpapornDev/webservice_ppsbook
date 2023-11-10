<?php

$Setup_Server = 'localhost';
$Setup_User = 'root';
$Setup_Pwd = '';
$Setup_Database = 'db_book';

$mysqli = new mysqli($Setup_Server,$Setup_User,$Setup_Pwd,$Setup_Database);
$mysqli->set_charset('utf8');
if ($mysqli -> connect_errno) {
    //echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
   
}else{
    //echo "Connect to MySQL success";

}


   
?>
