<?php

session_start();
if(isset($_GET['page'])) $page=$_GET['page'];
else $page='';
header('Cache-control: no-cache, no-store, must-revalidate');
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Stylish Portfolio - Start Bootstrap Template</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- Bootstrap Core CSS -->
  <link href="startbootstrap-stylish-portfolio-gh-pages/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="startbootstrap-stylish-portfolio-gh-pages/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
  <link href="startbootstrap-stylish-portfolio-gh-pages/vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="startbootstrap-stylish-portfolio-gh-pages/css/stylish-portfolio.min.css" rel="stylesheet">
    <link href="Bootstrap-Edit/css/style.css" rel="stylesheet">
</head>

<body id="page-top">

  <!-- Navigation -->
  <a class="menu-toggle rounded" id="pos" href="#">
    <i class="fas fa-bars"></i>
  </a>

    <nav class="navbar navbar-expand-lg navbar-light bg-light text-uppercase fixed-top navbar-shrink" id="mainNav">
    <div class="container">
      <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded collapsed" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link active" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?page=lapland">Lapland</a>
      </li><li class="nav-item">
        <a class="nav-link" href="index.php?page=auroras">Auroras</a>
      </li><li class="nav-item">
        <a class="nav-link" href="index.php?page=guides">Guides</a>
      </li><li class="nav-item">
        <a class="nav-link" href="index.php?page=cities">Citys</a>
      </li><li class="nav-item">
        <a class="nav-link" href="index.php?page=about">About</a>
      </li>
        <li class="nav-item">
        <a class="nav-link" href="admin/">Login</a>
      </li>
    </ul>
    
  </div>
</div>
</nav>

  <?php
            if($page=='' OR $page=='home') include('home.php');
            if($page=='guides') include('guides.php');
            if($page=='lapland') include('lapland.php');
            if($page=='auroras') include('auroras.php');
            if($page=='cities') include('cities.php');
            if($page=='cityguides') include('cityguides.php');
            if($page=='countryCities') include('countryCities.php');
            if($page=='about') include('about.php');
        ?>      
        

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded js-scroll-trigger" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript -->
  <script src="startbootstrap-stylish-portfolio-gh-pages/vendor/jquery/jquery.min.js"></script>
  <script src="startbootstrap-stylish-portfolio-gh-pages/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="startbootstrap-stylish-portfolio-gh-pages/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="startbootstrap-stylish-portfolio-gh-pages/js/stylish-portfolio.min.js"></script>

</body>

</html>

