<script>
    
function IDfees(id)
    {
        document.getElementById("year").value = id;
    }
function IDfees1(id)
    {
        document.getElementById("member").value = id;
    }
</script>
<h3>Nordic Guides - Fees List</h3>
<?php
        if(isset($_SESSION['infoMsg'])) echo $_SESSION['infoMsg'];
        $_SESSION['infoMsg']='';
?>
<table class="table table-hover">
    <thead>
      <tr>
        <th>Year</th>
        <th>Basic fee</th>
          <th>Due date</th>
          <th>Extra fee</th>
          <th></th>
          <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
        include('../../php/dbConnect.php');
        $id = $_SESSION['userID'];
        $sql="SELECT year,basicfee,duedate,extrafee FROM fees ORDER BY year";
        $result=$conn->query($sql); //run the query in $sql-variable with $conn-object created in dbConnect.php
        //display the rows -> records coming as result of the SQL-query
        while($row=$result->fetch_assoc()){
            echo '<tr>';
            echo '<td>'.$row['year'].'</td>';
            echo '<td>'.$row['basicfee'].'€</td>';
            echo '<td>'.$row['duedate'].'</td>';
            echo '<td>'.$row['extrafee'].'€</td>';
            echo '<td><button onclick="IDfees('.$row['year'].')" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#fees">Update</button></td>';
            echo '<td><a class="btn btn-info btn-lg" href="index.php?page=showMembersFees&year='.$row['year'].'">Show payments</a></td>';
            echo '</tr>';
        }
        $conn->close(); //close the database connection, when it is not needed anymore in the script
      ?>
    </tbody>
    <div class="modal fade" id="fees" role="dialog">
    <div class="modal-dialog" id="cards"></div>
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
          
        <form action='php/updateFees.php' method='post'>
        <div class="form-group">
            <input type="hidden" class="form-control" id="year" name="year" value="">
        </div>
        <div class="form-group">
            <label for="fee">Basic fee:</label>
            <input type="number" class="form-control" name="basicfee">
        </div>
        <div class="form-group">
            <label for="fee">Due Date:</label>
            <input type="date" class="form-control" name="duedate">
        </div>
        <div class="form-group">
            <label for="fee">Extra fee:</label>
            <input type="number" class="form-control" name="extrafee">
        </div> 
        <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>

  </div>   
    
