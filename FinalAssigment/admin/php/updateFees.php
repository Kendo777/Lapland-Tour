<?php
/*
	file:	admin/php/updateMyInfo.php
	desc:	Updates users member-table (no role and no email)
*/
if(!isset($_POST)) header('location:../index.php?page=fees');
include('../../../php/dbConnect.php');
session_start();
$_SESSION['infoMsg']='';
$sql="SELECT basicfee, duedate, extrafee FROM fees WHERE year LIKE '".$_POST['year']."'";

$result=$conn->query($sql);
$row=$result->fetch_assoc();
if(!empty($_POST['basicfee'])) $basicfee=$_POST['basicfee']; else $basicfee=$row['basicfee'];
if(!empty($_POST['duedate'])) $duedate=$_POST['duedate']; else $duedate=$row['duedate'];
if(!empty($_POST['extrafee'])) $extrafee=$_POST['extrafee']; else $extrafee=$row['extrafee'];

$sql="UPDATE fees SET basicfee='$basicfee', duedate='$duedate', extrafee='$extrafee' WHERE year = ".$_POST['year'];
$result=$conn->query($sql);

if($conn->query($sql)===TRUE){
$_SESSION['infoMsg']='<p class="alert alert-success">Updated!</p>';
	
}else
{
    $_SESSION['infoMsg']='<p class="alert alert-danger">Error!</p>';
}
header('location:../index.php?page=fees');
?>