<nav id="sidebar-wrapper">
    <ul class="sidebar-nav">
      <li class="sidebar-brand">
        <a class="js-scroll-trigger" href="#page-top">Cities</a>
      </li>
      <li class="sidebar-nav-item">
        <a class="js-scroll-trigger" href="#page-top">Home</a>
      </li>
      <li class="sidebar-nav-item">
        <a class="js-scroll-trigger" href="#cities">Cities</a>
      </li>
    </ul>
  </nav>
  <!-- Header -->
  <header class="masthead d-flex" id="cities-page">
    <div class="container text-center my-auto">
      <h1 class="mb-1" >CITIES</h1>
      <h3 class="mb-5">
      </h3>
      <a class="btn btn-primary btn-xl js-scroll-trigger" href="#cities">Find your guides in the different cities</a>
    </div>
    <div class="overlay"></div>
  </header>

  <!-- About -->
  <section class="content-section bg-light" id="cities">
    <div class="container">
        
<script>
function getCard(id)
    {
        $.ajax({
            url: "guideCard.php",
            type: "get",
            data: {memberID:id},
            success: function(result){
                document.getElementById("cards").innerHTML = result;
            }
        });
    }
    
</script>
<?php
/*
    file:   php/cityguides.php
    desc:   Shows the list of guides in a city  
*/

if(!isset($_GET['cityID'])) header('location:index.php?page=cities');
include('../php/dbConnect.php');
$sql="SELECT cityname FROM cities WHERE cityID=".$_GET['cityID'];
$result=$conn->query($sql);
if($row=$result->fetch_assoc()){
	$cityname=$row['cityname'];
}else $cityname='';
?>
<h3>Nordic Guides - Guides in <?php echo $cityname ?></h3>
<table class="table table-hover">
    <thead>
      <tr>
        <th>Name</th>
        <th></th>
        <th>Languages</th>
		<th></th>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql="SELECT members.memberID, firstname, lastname FROM members INNER JOIN membergroups ON members.memberID=membergroups.memberID ";
		$sql.="INNER JOIN groups ON membergroups.groupID=groups.groupID INNER JOIN groupcities ";
		$sql.="ON groups.groupID=groupcities.groupID WHERE groupcities.cityID=".$_GET['cityID'];
		$result=$conn->query($sql); //run the query in $sql-variable with $conn-object created in dbConnect.php
        //display the rows -> records coming as result of the SQL-query
        while($row=$result->fetch_assoc()){
            echo '<tr>';
            echo '<td>';
            echo $row['firstname'].' '.$row['lastname'];
            echo '</td>';
            echo '<td>';
            echo '<button onclick="getCard('.$row['memberID'].')"type="button" class="btn btn-info btn-lg m-1" data-toggle="modal" data-target="#myModal">Contact guide</button>';
            echo '</td>';
			$sql1="SELECT language FROM memberlanguages INNER JOIN members ON memberlanguages.memberID=members.memberID ";
			$sql1.="WHERE memberlanguages.memberID=".$row['memberID'];
			$result1=$conn->query($sql1); //run the query in $sql-variable with $conn-object created in dbConnect.php
			//display the rows -> records coming as result of the SQL-query
			while($row1=$result1->fetch_assoc()){
				echo '<td>'.$row1['language'].'</td>';
			}
			echo '</tr>';
        }
        $conn->close(); //close the database connection, when it is not needed anymore in the script
      ?>
    </tbody>
</table>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" id="cards" align="center">
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>