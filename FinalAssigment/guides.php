<nav id="sidebar-wrapper">
    <ul class="sidebar-nav">
      <li class="sidebar-brand">
        <a class="js-scroll-trigger" href="#page-top">Guides</a>
      </li>
      <li class="sidebar-nav-item">
        <a class="js-scroll-trigger" href="#page-top">Home</a>
      </li>
      <li class="sidebar-nav-item">
        <a class="js-scroll-trigger" href="#guides">Guides</a>
      </li>
    </ul>
  </nav>
  <!-- Header -->
  <header class="masthead d-flex" id="guide-page">
    <div class="container text-center my-auto">
      <h1 class="mb-1" >GUIDES</h1>
      <h3 class="mb-5">
        <em id="text">The best and prepared guides</em>
      </h3>
      <a class="btn btn-primary btn-xl js-scroll-trigger" href="#guides">Find your guide</a>
    </div>
    <div class="overlay"></div>
  </header>

  <!-- About -->
  <section class="content-section bg-light" id="guides">
    <div class="container text-center">
        
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
<h3>Nordic Guides - Guideslist</h3><br>
        
<table class="table table-hover">

      <?php
        include('../php/dbConnect.php');
        $sql="SELECT memberID,firstname,lastname,email FROM members ORDER BY lastname";
        $result=$conn->query($sql); //run the query in $sql-variable with $conn-object created in dbConnect.php
        //display the rows -> records coming as result of the SQL-query
        $count=1;
        while($row=$result->fetch_assoc()){

            //create a link to current member by memberID
            echo '<button onclick="getCard('.$row['memberID'].')"type="button" class="btn btn-info btn-lg m-4" data-toggle="modal" data-target="#myModal">';
            echo $row['firstname'].' '.$row['lastname'];
            echo '</button>'; //closes the memberlink
            if($count>2)
            {
                echo '<br><br>';
                $count = 0;
            }
            $count++;
        }
        $conn->close(); //close the database connection, when it is not needed anymore in the script
      ?>
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












      </div>
  </section>


