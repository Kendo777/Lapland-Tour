<?php
/*
	file:	admin/php/updateMyInfo.php
	desc:	Updates users member-table (no role and no email)
*/
if(empty($_POST)) header('location:../index.php?page=myprofile');
session_start();
$error=false;
include('../../../php/dbConnect.php');

if(isset($_POST['membergroupID'])){
    
	$sql="DELETE FROM membergroups WHERE membergroupID = ".$_POST['membergroupID'] ;
    $_SESSION['grpInfo'].='<p class="alert alert-danger">You have left the group</p>';
}

if(isset($_POST['groupID']) && isset($_SESSION['userID'])){
    
    $sql="INSERT INTO membergroups (groupID, memberID) VALUES ('".$_POST['groupID']."','".$_SESSION['userID']."')";
    $_SESSION['grpInfo'].='<p class="alert alert-success">You have joined the group</p>';
}
$result=$conn->query($sql);
header('location:../index.php?page=myprofile');
?>