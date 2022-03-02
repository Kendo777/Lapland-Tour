<?php
/*
    file:   php/search.php
    desc:   Displays results from search-form used in navigation bar 
*/
if(!isset($_GET['search'])) header('location:index.php');
if(empty($_GET['search'])) $msg='<p class="alert alert-danger">You should give a searchword! Results limited</p>';
include('php/dbConnect.php');
?>
<h3>Nordic Guides - Search results</h3>
<?php if(isset($msg)) echo $msg?>
<p>Your search results from cities:</p>
<?php
$sql="SELECT cityID,cityname,country FROM cities WHERE cityname LIKE '".$_GET['search']."%%'";
//limit the results if no searchword given
if(isset($msg)) $sql.=" limit 0,2";
$result=$conn->query($sql); //run the query in $sql-variable with $conn-object created in dbConnect.php
?>
<table class="table table-hover">
    <thead>
      <tr>
        <th>City</th>
        <th>Country</th>
		<th></th>
      </tr>
    </thead>
    <tbody>
      <?php
        
        //display the rows -> records coming as result of the SQL-query
        while($row=$result->fetch_assoc()){
            echo '<tr>';
            echo '<td>';
            echo $row['cityname'];
            echo '</td>';
            echo '<td>'.$row['country'].'</td>';
			echo '<td><a href="index.php?page=cityguides&cityID='.$row['cityID'].'">Show guides</a></td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>
<p>Your search results from guides:</p>
<table class="table table-hover">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
      <?php
        include('php/dbConnect.php');
        $sql="SELECT memberID,firstname,lastname,email FROM members ";
        $sql.="WHERE lastname LIKE '%%".$_GET['search']."%%' OR city LIKE '%%".$_GET['search']."%%'";
        $sql.=" OR firstname LIKE '%%".$_GET['search']."%%'";
        //limit the results if no searchword given
        if(isset($msg)) $sql.=" limit 0,2";
        $result=$conn->query($sql); //run the query in $sql-variable with $conn-object created in dbConnect.php
        //display the rows -> records coming as result of the SQL-query
        while($row=$result->fetch_assoc()){
            echo '<tr>';
            echo '<td>';
            //create a link to current member by memberID
            echo "<a href='index.php?page=showguide&memberID=".$row['memberID']."'>";
            echo $row['firstname'].' '.$row['lastname'];
            echo '</a>'; //closes the memberlink
            echo '</td>';
            echo '<td>'.$row['email'].'</td>';
            echo '</tr>';
        }
        $conn->close(); //close the database connection, when it is not needed anymore in the script
      ?>
    </tbody>
</table>