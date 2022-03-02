<?php
if(!isset($_GET['year'])) header('location:index.php?page=fees');
include('../../php/dbConnect.php');
$sql="SELECT members.*, annualfee.amount, annualfee.date FROM members INNER JOIN annualfee ON members.memberID=annualfee.memberID INNER JOIN fees ON annualfee.year=fees.year WHERE fees.year = ".$_GET['year'];

$result=$conn->query($sql); //run the query in $sql-variable with $conn-object created in dbConnect.php
        //display the rows -> records coming as result of the SQL-query
 //close the database connection, when it is not needed anymore in the script
      ?>
<h3>Nordic Guides - Members in <?php echo $_GET['year'] ?> fee</h3>
<table class="table table-hover">
    <thead>
      <tr>
        <th>Name</th>
		<th>Fees paid</th>
		<th>Fees paid</th>
      </tr>
    </thead>
    <tbody>
      <?php
        while($row=$result->fetch_assoc()){
            echo '<tr>';
            echo '<td><p>'.$row['firstname'].' '.$row['lastname'].'</p></td>';
            echo '<td>'.$row['amount'].'€</td>';
            echo '<td>'.$row['date'].'</td>';
            echo '</tr>';
        }
        $conn->close(); //close the database connection, when it is not needed anymore in the script
      ?>
    </tbody>
</table>