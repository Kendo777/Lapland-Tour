<?php
/*
    file:   admin/php/addNewLanguage.php
    desc:   Adds new language into table languages. Checks that the language value does not
            exist before inserting.
*/
if(!empty($_POST['lng'])){
    include('../../../php/dbConnect.php');
    $sql="SELECT language FROM languages WHERE language='".$_POST['lng']."'";
    $conn->query($sql);
    $result=$conn->query($sql);
    //if there was language already existing -> back to languages without inserting
    if($result->nub_rows > 0) header('location:../index.php?page=languages');
    else{
        //language does not exist in db table languages -> insert this value
        $sql="INSERT INTO languages(language) VALUES('".$_POST['lng']."')";
        $conn->query($sql);
    }
}
header('location:../index.php?page=languages');
?>