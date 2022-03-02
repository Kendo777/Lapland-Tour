<?php
/*
    file:   php/dbConnect.php
    desc:   Defines the connection to database nordicguides
*/
$databasename='nordicguides';
$databaseuser='root';   //user created in MySQL to access the database
$databasepassword=''; //password should be better!
$databaseserver='localhost'; //localhost, because PHP-code and MySQL in the same server

$conn=new mysqli($databaseserver,$databaseuser,$databasepassword,$databasename);
if($conn->connect_error){
	die('Error in connecting to database. Error: '.$conn->connect_error);
}
mysqli_set_charset($conn,"utf8"); //use the same characterset as in your userinterface
?>