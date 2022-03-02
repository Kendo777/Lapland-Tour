<?php
/*
    file: admin/php/updatepassword.php
    desc: Checks that current password matches and if new password is written
          similarly twice -> updates password
*/
if(empty($_POST)) header('location:../index.php?page=guides');
include('../../../php/dbConnect.php');
session_start();
$sql="SELECT email FROM members WHERE memberID=".$_POST['memberID'];
include('checkEmail.php');
$result=$conn->query($sql);
if($result->num_rows > 0){
    //user password found in db
    $row=$result->fetch_assoc();
        //old password correct
        if($_POST['newemail1']==$_POST['newemail2']){
            //new pwds match -> update if strong enough
            
            // Given password
            $email = $_POST['newemail1'];
            $checkemail =$conn->query("SELECT * FROM members WHERE email LIKE '".$email."'");
            
            if(!validEmail($email)) {
            $_SESSION['emailmsg']='<p class="alert alert-info">Email is not type Email</p>';
            }else if($checkemail->num_rows > 0)
            {
              $_SESSION['emailmsg']='<p class="alert alert-danger">Email is already in db</p>';  
            }else{
                //password strong -> update
                $sql="UPDATE members SET email='$email' ";
                $sql.="WHERE memberID=".$_POST['memberID'];
                if($conn->query($sql)===TRUE){
                   $_SESSION['emailmsg']='<p class="alert alert-success">Email updated!</p>';
                }else $_SESSION['emailmsg']='<p class="alert alert-danger">Update failed!</p>';
            }          
        }else $_SESSION['emailmsg']='<p class="alert alert-danger">New email do not match!</p>';
}else $_SESSION['emailmsg']='<p class="alert alert-danger">Could not retrieve user data!</p>';
//go back to profilepage
header('location:../index.php?page=guides');
?>