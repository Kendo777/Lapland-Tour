<?php
/*
    file:   admin/php/saveProfileImg.php
    desc:   Uploads the imgfile into server - folder defined in code.
            Updates members-table for current user.
            Uses checkImageFile.php to check some features of the file (filesize, filetype, it does not already exist in folder)
*/
if(empty($_POST)) header('location:../index.php?page=myprofile');
session_start();
$img=basename($_FILES['imgFile']['name']); //filename to $img
$target_dir='../../../images/members/';  //folder location
$target_file=$target_dir.$img; //target folder and filename combined
$imageFileType=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
include('../../../php/dbConnect.php');
$sql="SELECT profileimage FROM members WHERE memberID=".$_SESSION['userID'];
$result=$conn->query($sql);
if($result->num_rows > 0){
    //image already exists -> mark it removable
    $row=$result->fetch_assoc();
    $imgRemovable=$row['profileimage'];
}else $imgRemovable='';
include('checkImageFile.php'); //some checking for uploaded file
if($uploadOk==0) $_SESSION['imgMsg']='<p class="alert alert-danger">'.$msg.'</p>';
else{
    //if existing image, remove it first
    if(!empty($imgRemovable)) unlink($target_dir.$imgRemovable); //removes previous imagefile
    //upload and update
    if(move_uploaded_file($_FILES['imgFile']['tmp_name'],$target_file)){
        //uploaded file is saved into target folder
        $sql="UPDATE members SET profileimage='$img' WHERE memberID=".$_SESSION['userID'];
        if($conn->query($sql)===TRUE){
            $_SESSION['imgMsg']='<p class="alert alert-success">Image updated!</p>';
        }
    }
}
header('location:../index.php?page=myprofile');
?>