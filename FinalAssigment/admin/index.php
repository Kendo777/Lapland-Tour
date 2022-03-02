<?php
/*
    file:   admin/index.php
    desc:   Displays the user interface in administration part of the app
            Checks that user is logged in - > if not, displays loginform
            Prevents the pages to be saved into any cachememory (no browser cache, no proxy cache etc)
*/
session_start();
if(!isset($_SESSION['userID'])) $page='login';
elseif(isset($_GET['page'])) $page=$_GET['page'];
else $page='';
header('Cache-control: no-cache, no-store, must-revalidate');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Nordic Guides Admin</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../../css/bootstrap.min.css">
        <?php if($page=='login')
            echo '<link rel="stylesheet" href="../../css/signin.css">';
        ?>
    </head>
    <body>
        <div class="container">
        <?php
            if(isset($_SESSION['userID'])){
            include('../../php/dbConnect.php');
            $sql="SELECT role FROM members WHERE memberID=".$_SESSION['userID'];
            $result=$conn->query($sql);
            $role=$result->fetch_assoc();
            $admin;
            if($role['role'] == "admin")
            {
                $admin=true;
            }else
            {
                $admin=false;
            }
            }
            if(isset($_SESSION['userID'])) include('php/session.php');
            if($page=='login') 
            {
                include('php/loginform.php');
            }
            if($page=='' OR $page=='home') include('php/home.php');
            if($page=='myprofile') include('php/myprofile.php');
            if($page=='languages' && $admin) include('php/languages.php'); else if ($page=='languages' && !$admin) include('php/notAdmin.php');
            if($page=='guides' && $admin) include('php/guides.php'); else if ($page=='guides' && !$admin) include('php/notAdmin.php');
            if($page=='fees' && $admin) include('php/fees.php'); else if ($page=='fees' && !$admin) include('php/notAdmin.php');
            if($page=='showMembersFees') include('php/showMembersFees.php');
        ?>        
        </div>
        
        
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="../../js/bootstrap.min.js"></script>
    </body>
</html>
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
