<?php
/*
    file:   admin/php/loginform.php
    desc:   Displays the login form
*/
?>
<h3>Nordic Guides - Login</h3>
<?php
        if(isset($_SESSION['infoMsg'])) echo $_SESSION['infoMsg'];
        $_SESSION['infoMsg']='';
?>
<form action="php/login.php" method="post">
    
    <div class="form-group">
        <label for="email">Email address:</label>
        <input type="email" class="form-control" id="email" name="email">
    </div>
    <div class="form-group">
        <label for="pwd">Password:</label>
        <input type="password" class="form-control" id="pwd" name="password">
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>
<p></p>
<p class="alert alert-info">If you have not registered as user, you can do it
    <a href="php/registerfrm.php">here</a>. 
    <br />Read our GDPR -compliant user policy <a href="">here</a>.
</p>
<p></p>
<p class="alert alert-secondary">&copy; Nordic Guides
</p>