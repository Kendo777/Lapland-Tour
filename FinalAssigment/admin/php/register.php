<?php
/*
    file:   admin/php/register.php
    desc:   Checks that email is valid and not existing in the database. 
            Two passwords must match. No empty values.
*/
if(empty($_POST)) header('location:../');
$error=false;
session_start();
if(!empty($_POST['firstname'])) $firstname=$_POST['firstname'];
else{
	$error=true;
	$_SESSION['infoMsg']='Firstname can not be empty! ';
}
if(!empty($_POST['lastname'])) $lastname=$_POST['lastname'];
else{
	$error=true;
	$_SESSION['infoMsg'].='Lastname can not be empty! ';
}
include('checkEmail.inc');
if(validEmail($_POST['email'])) $email=$_POST['email'];
else{
	$error=true;
	$_SESSION['infoMsg'].='Email was not correct! ';
}
if($_POST['pwd']==$_POST['pwd1']){
      //new pwds match -> update if strong enough
      // Given password
      $password = $_POST['pwd'];

      // Validate password strength
      $uppercase = preg_match('@[A-Z]@', $password);
      $lowercase = preg_match('@[a-z]@', $password);
      $number    = preg_match('@[0-9]@', $password);
      $specialChars = preg_match('@[^\w]@', $password);
      
      if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            $_SESSION['infoMsg'].='<p class="alert alert-info">Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.</p>';
            $error=true;
      }else{
          //insert into members if email is not found there!
          include('../../../php/dbConnect.php');
          $sql="SElECT email FROM members WHERE email='$email'";
          $result=$conn->query($sql);
          //if email already exists -> error and msg to user
          if($result->num_rows > 0){
              $error=true;
              $_SESSION['infoMsg'].='Email already exists!';
          }else{
              $password=password_hash($password,PASSWORD_DEFAULT); //crypts pw
              //ok to insert new email, firstname,lastname and password
              $sql="INSERT INTO members(email,password,firstname,lastname) ";
              $sql.="VALUES('$email','$password','$firstname','$lastname')";
              if(!$conn->query($sql)===TRUE){
                  $error=true;
                  $_SESSION['infoMsg'].='Could not insert into database!';
              }else{
                  //send email to user about registration (does not work here in my XAMPP)
                  $to      = $email;
                  $subject = 'Registration to Nordic Guides';
                  $message = 'Hello '.$firstname.' '.$lastname.'!';
                  $message.= 'You have now successfully registered as a user';
                  $message.= 'into Nordic Guides.'. "\r\n";
                  $message.= 'Your username is :'.$email;
                  $message.= ' and your password is '. $_POST['pwd']. "\r\n";
                  $headers = 'From: webmaster@example.com' . "\r\n" .
                             'Reply-To: answerhere@example.com' . "\r\n" .
                             'X-Mailer: PHP/' . phpversion();

                  mail($to, $subject, $message, $headers);
              }
          }
      }
}else{
    $_SESSION['infoMsg'].='Passwords do not match! ';
    $error=true;
}
if($error) header('location:registerfrm.php');else header('location:../');
?>