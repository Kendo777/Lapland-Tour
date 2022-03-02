<?php
    include('../../php/dbConnect.php');
//define the variables for limiting results
$howmany=5; //number of records displayed in one page
if(isset($_GET['start'])) $start=$_GET['start'];else $start=0; //set the start value for limit
if($start<0)$start=0;
$next=$start+$howmany;
$prev=$start-$howmany;
//calculate the total nr of rows in members
$sql="SELECT count(*) as Total FROM languages";
$result=$conn->query($sql);
if($row=$result->fetch_assoc()) $total=$row['Total'];
$division=$total%$howmany; //counts the number of rows in last page
$pages=($total-$division)/$howmany; //number of whole page
?>
<h3>Languages</h3>
<table class="table table-hover">
    <tr>
        <th>Language</th>
        <th></th>
    </tr>
    <?php
        if(isset($_SESSION['infoMsg'])) echo $_SESSION['infoMsg'];
        $_SESSION['infoMsg']='';
?>
    <tbody>
      <?php
        $sql="SELECT * FROM languages ORDER BY language LIMIT $start,$howmany";
        $result=$conn->query($sql); //run the query in $sql-variable with $conn-object created in dbConnect.php
        //display the rows -> records coming as result of the SQL-query
        while($row=$result->fetch_assoc()){
            echo '<tr>';
            echo '<td>'.$row['language'].'</td>';
            echo '<td><form action="php/deleteLanguage.php" method="post">
            <div class="form-group">
            <input type="text" hidden class="form-control" id="language" name="language" value="'.$row['language'].'">
            <button type="submit" class="btn btn-primary">Remove</button>
            </div>
            </form></td>';
            echo '</tr>';
        }
        $conn->close(); //close the database connection, when it is not needed anymore in the script
      ?>
    </tbody>
</table>

<ul class="pagination">
  <?php if($start<=0) echo '<li class="page-item disabled">';
    else echo '<li class="page-item">';
  ?>
      <a class="page-link" href="index.php?page=languages&start=<?php echo $prev?>">Previous</a>
   <li>
    <?php
    $pg=0;
    for($i=1;$i<=$pages;$i++){
        echo '<li class="page-item"><a class="page-link" href="index.php?page=languages&start='.$pg.'">'.$i.'</a></li>';
        $pg=$pg+$howmany;
    }
    if($division>0) echo '<li class="page-item"><a class="page-link" href="index.php?page=languages&start='.$pg.'">'.$i.'</a></li>';
    ?>
  <?php
    if($total-$division>=$next) echo '<li class="page-item">';
    else echo '<li class="page-item disabled">';
   ?>
    <a class="page-link" href="index.php?page=languages&start=<?php echo $next ?>">Next</a>
  </li>
</ul>

<form action="php/addNewLanguage.php" method="post">
<div class="form-group">
            <label for="language">New language:</label>
            <input type="text" class="form-control" id="language" name="lng">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
</form>

