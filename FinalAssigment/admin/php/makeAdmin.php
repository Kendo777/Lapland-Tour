<?php
/*
    file:   php/showguide.php
    desc:   Shows the information about selected memberID. Selects the member from db
            by members.memberID. Check that the information was found. Displays the
            result of SQL-query
*/
if(!isset($_POST['memberID'])) header('location:../index.php?page=guides');
include('../../../php/dbConnect.php');
$sql="SELECT role FROM members WHERE memberID=".$_POST['memberID'];
$result=$conn->query($sql);
$role=$result->fetch_assoc();
    if($role['role'] == "admin")
    {
        $sql="UPDATE members SET role='member' ";
    }else{
        $sql="UPDATE members SET role='admin' ";
    }
    $sql.="WHERE memberID=".$_POST['memberID'];
    $result=$conn->query($sql);
    header('location:../index.php?page=guides');
?>

    