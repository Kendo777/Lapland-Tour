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
        
<h3>Nordic Guides - Cities</h3>
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
        include('../php/dbConnect.php');
        $sql="SELECT cityID,cityname,country FROM cities ORDER BY cityname";
        $result=$conn->query($sql); //run the query in $sql-variable with $conn-object created in dbConnect.php
        //display the rows -> records coming as result of the SQL-query
        while($row=$result->fetch_assoc()){
            echo '<tr>';
            echo '<td>';
            echo $row['cityname'];
            echo '</td>';
            echo '<td><a href="index.php?page=countryCities&country='.$row['country'].'">'.$row['country'].'</a></td>';
			echo '<td><a href="index.php?page=cityguides&cityID='.$row['cityID'].'">Show guides</a></td>';
            echo '</tr>';
        }
        $conn->close(); //close the database connection, when it is not needed anymore in the script
      ?>
    </tbody>
</table>