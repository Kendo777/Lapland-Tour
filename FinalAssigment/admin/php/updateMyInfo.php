<?php
/*
	file:	admin/php/updateMyInfo.php
	desc:	Updates users member-table (no role and no email)
*/
if(empty($_POST)) header('location:../index.php?page=myprofile');
session_start();
$error=false;
$_SESSION['infoMsg']='';
if(!empty($_POST['firstname'])) $firstname=$_POST['firstname'];
else{
	$error=true;
	$_SESSION['infoMsg']='Firstname can not be empty! ';
}
if(!empty($_POST['lastname'])) $lastname=$_POST['lastname'];
else{
	$error=true;
	$_SESSION['infoMsg']='Lastname can not be empty! ';
}
if(!empty($_POST['birthdate'])) $birthdate=$_POST['birthdate'];else $birthdate='';
if(!empty($_POST['street'])) $street=$_POST['street'];else $street='';
if(!empty($_POST['city'])) $city=$_POST['city'];else $city='';
if(!empty($_POST['zip'])) $zip=$_POST['zip'];else $zip='';
if(!empty($_POST['phone'])) $phone=$_POST['phone'];else $phone='';
if(!empty($_POST['birthdate'])) $birthdate=$_POST['birthdate'];else $birthdate='';
if(!empty($_POST['driversl'])) $driversl=$_POST['driversl'];else $driversl='';
if($error){
	$_SESSION['infoMsg']='<p class="alert alert-danger">'.$_SESSION['infoMsg'].'</p>';
	header('location:../index.php?page=myprofile');
}
else{
	//update members-table for current user
	include('../../../php/dbConnect.php');
	$sql="UPDATE members SET firstname='$firstname',lastname='$lastname',street='$street',city='$city',zip='$zip',";
	$sql.="birthdate='$birthdate',driverslicense='$driversl' WHERE memberID=".$_SESSION['userID'];
	if($conn->query($sql)===TRUE){
        $_SESSION['infoMsg']='<p class="alert alert-success">Updated!</p>';
    }
	
}
header('location:../index.php?page=myprofile');
?>