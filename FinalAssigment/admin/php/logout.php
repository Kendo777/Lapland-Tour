<?php
/*
    file:   admin/php/logout.php
    desc:   Removes the session information and redirects to public pages
*/
session_start(); //access existing session
session_destroy(); //remove existing session 
header('location:../../'); //two folders up -> application-folder
?>