<?php
/*
    file:   admin/php/session.php
    desc:   Displays the userinformation and menu - common for each page
*/
echo '<h3>Nordic Guides Administration</h3>';
echo '<p>You are logged in as: <b>'.$_SESSION['name'].'</b>. ';
echo 'Session started: <b>'.$_SESSION['starttime'].'</b></p>';
?>
<ul class="nav">
        <li class="nav-item">
    <a class="nav-link" href="index.php">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php?page=myprofile">My profile</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php?page=guides">Members</a>
  </li>
<li class="nav-item">
    <a class="nav-link" href="index.php?page=languages">Languages</a>
  </li>
    <li class="nav-item">
    <a class="nav-link" href="index.php?page=fees">Fees</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="php/logout.php">Logout</a>
  </li>
</ul>
<hr>