<?php
/*
	file:	admin/php/removeLanguage.php
	desc:	Removes selected language and level from memberlanguages table by memberlanguageID
*/
if(isset($_GET['mrlngID'])){
    session_start();
    include('../../../php/dbConnect.php');
    $sql="DELETE FROM memberlanguages WHERE memberlanguageID=".$_GET['mrlngID'];
    if($conn->query($sql)===TRUE) $_SESSION['lngInfo']='<p class="alert alert-success">Language skill removed!</p>';
}
header('location:../index.php?page=myprofile');
?>