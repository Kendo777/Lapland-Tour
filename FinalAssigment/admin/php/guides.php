
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script>
    
function getCard(id)
    {
        $.ajax({
            url: "php/guideCard.php",
            type: "get",
            data: {memberID:id},
            success: function(result){
                document.getElementById("cards").innerHTML = result;
            }
        });
    }
    function IDpassword(id)
    {
        document.getElementById("memberID").value = id;
    }function IDemail(id)
    {
        document.getElementById("memberID1").value = id;
    }
</script>

<h3>Nordic Guides - Guideslist</h3>
<?php
        if(isset($_SESSION['msg'])) echo $_SESSION['msg'];
        $_SESSION['msg']=''; //remove session variable msg

        if(isset($_SESSION['emailmsg'])) echo $_SESSION['emailmsg'];
        $_SESSION['emailmsg']=''; //remove session variable msg
        ?>
<table class="table table-hover">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
          <th></th>
          <th></th>
          <th>Admin</th>
          <th>Make Admin</th>
      </tr>
    </thead>
    <tbody>
      <?php
        include('../../php/dbConnect.php');
        $id = $_SESSION['userID'];
        $sql="SELECT memberID,firstname,lastname,email,role FROM members WHERE memberID NOT LIKE '$id' ORDER BY lastname";
        $result=$conn->query($sql); //run the query in $sql-variable with $conn-object created in dbConnect.php
        //display the rows -> records coming as result of the SQL-query
        while($row=$result->fetch_assoc()){
            echo '<tr>';
            echo '<td>';
            //create a link to current member by memberID
            echo '<p>'.$row['firstname'].' '.$row['lastname'].'</p>';
            echo '</td>';
            echo '<td>'.$row['email'].'</td>';
            echo '<td>';
            echo '</td>';
            echo '<td>';
            echo '<button onclick="IDemail('.$row['memberID'].')" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#email">Update email</button>';
            echo '</td>';
            echo '<td>';
            echo '<button onclick="IDpassword('.$row['memberID'].')" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#password">Update Password</button>';
            echo '</td>';
            echo '<td>';
            echo '<label class="switch">';
            if($row['role'] == 'admin'){
                echo '<input type="checkbox" checked disabled>';
            }else{
                echo '<input type="checkbox" disabled>';
            }
            echo '<span class="slider"></span></label><br><br>';
            echo '</td>';
            echo '<td>';
            echo '<form action="php/makeAdmin.php" method="post">
                    <input type="hidden" class="form-control" name="memberID" value="'.$row['memberID'].'">
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>';
            echo '</td>';
            echo '</tr>';
        }
        $conn->close(); //close the database connection, when it is not needed anymore in the script
      ?>
    </tbody>
</table>
<div class="modal fade" id="password" role="dialog">
    <div class="modal-dialog" id="cards"></div>
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
          
        <form action='php/updateMemberPassword.php' method='post'>
        <div class="form-group">
            <input type="hidden" class="form-control" id="memberID" name="memberID" value="">
        </div>
        <div class="form-group">
            <label for="pwd">New password:</label>
            <input type="password" class="form-control" id="pwd" name="newpwd1">
        </div>
        <div class="form-group">
            <label for="pwd">Retype new password:</label>
            <input type="password" class="form-control" id="pwd" name="newpwd2">
        </div> 
        <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>

  </div>
<div class="modal fade" id="email" role="dialog">
    <div class="modal-dialog" id="cards"></div>
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
          
        <form action='php/updateMemberEmail.php' method='post'>
        <div class="form-group">
            <input type="hidden" class="form-control" id="memberID1" name="memberID" value="">
        </div>
        <div class="form-group">
            <label for="email">New email:</label>
            <input type="email" class="form-control" id="email" name="newemail1">
        </div>
        <div class="form-group">
            <label for="email">Retype new email:</label>
            <input type="email" class="form-control" id="email" name="newemail2">
        </div> 
        <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>

  </div>












