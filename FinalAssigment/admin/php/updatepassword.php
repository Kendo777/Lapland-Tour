<?php
/*
    file: admin/php/updatepassword.php
    desc: Checks that current password matches and if new password is written
          similarly twice -> updates password
*/
if(empty($_POST)) header('location:../index.php?page=myprofile');
session_start();
$sql="SELECT password FROM members WHERE memberID=".$_SESSION['userID'];
include('../../../php/dbConnect.php');
$result=$conn->query($sql);
if($result->num_rows > 0){
    //user password found in db
    $row=$result->fetch_assoc();
    if(password_verify($_POST['oldpwd'],$row['password'])){
        //old password correct
        if($_POST['newpwd1']==$_POST['newpwd2']){
            //new pwds match -> update if strong enough
            
            // Given password
            $password = $_POST['newpwd1'];

            // Validate password strength
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number    = preg_match('@[0-9]@', $password);
            $specialChars = preg_match('@[^\w]@', $password);

            if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            $_SESSION['msg']='<p class="alert alert-info">Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.</p>';
            }else{
                //password strong -> update
                $password=password_hash($password,PASSWORD_DEFAULT); //crypts pw
                $sql="UPDATE members SET password='$password' ";
                $sql.="WHERE memberID=".$_SESSION['userID'];
                if($conn->query($sql)===TRUE){
                   $_SESSION['msg']='<p class="alert alert-success">Password updated!</p>';
                }else $_SESSION['msg']='<p class="alert alert-danger">Update failed!</p>';
            }          
        }else $_SESSION['msg']='<p class="alert alert-danger">New passwords do not match!</p>';
    }else $_SESSION['msg']='<p class="alert alert-danger">Check old password!</p>';
}else $_SESSION['msg']='<p class="alert alert-danger">Could not retrieve user data!</p>';
//go back to profilepage
header('location:../index.php?page=myprofile');
?>