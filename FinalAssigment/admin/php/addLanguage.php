<?php
/*
	file:	admin/php/addLanguage.php
	desc:	Inserts language and level for current user
*/
if(empty($_POST)) header('location:../index.php?page=myprofile');
session_start();
$_SESSION['lngInfo']='';
if(!empty($_POST['language'])) $language=$_POST['language'];
else $_SESSION['lngInfo']='<p class="alert alert-danger">Select language!</p>';
if(!empty($_POST['level'])) $level=$_POST['level'];
else $_SESSION['lngInfo'].='<p class="alert alert-danger">Select level!</p>';
if($_SESSION['lngInfo']==''){
    //insert data into database here
    include('../../../php/dbConnect.php');
    $sql="INSERT INTO memberlanguages(memberID,language,level)";
    $sql.="VALUES(".$_SESSION['userID'].",'$language','$level')";
    if($conn->query($sql)===TRUE) $_SESSION['lngInfo'].='<p class="alert alert-success">Skill added!</p>';
    else $_SESSION['lngInfo'].='<p class="alert alert-danger">Could not insert skills into db!</p>';
}
header('location:../index.php?page=myprofile');
?>