<?php
/*
    file:   admin/php/registerfrm.php
    Desc:   Form for registering into Nordic Guides database
            Email, firstname, lastname and password required
*/
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">

    <title>Nordic Guides Registering</title>
  </head>
  <body>
      <div class="container">
      <a href="../">Back</a>
      <h3>Register yourself as guide in Nordic Guides</h3>
          <?php
            session_start();
            if(isset($_SESSION['infoMsg'])) echo $_SESSION['infoMsg'];
            $_SESSION['infoMsg']='';
          ?>
          <form action="register.php" method="post">
            <div class="form-group">
                <label for="firstname">Firstname:</label>
                <input type="text" class="form-control" id="firstname" name="firstname" required>
            </div>
            <div class="form-group">
                <label for="lastname">Lastname:</label>
                <input type="text" class="form-control" id="lastname" name="lastname" required>
            </div>
            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd" name="pwd" required>
            </div>
            <div class="form-group">
                <label for="pwd">Retype password:</label>
                <input type="password" class="form-control" id="pwd1" name="pwd1" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
          </form>
          
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="../../js/bootstrap.min.js"></script>
  </body>
</html>