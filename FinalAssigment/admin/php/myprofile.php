<?php
/*
    file:   admin/php/myprofile.php
    desc:   User can change password, add profile picture and edit all
            the personal information here
*/
include('../../php/dbConnect.php');
$sql="SELECT * FROM members WHERE memberID=".$_SESSION['userID'];
$result=$conn->query($sql);
$row=$result->fetch_assoc();
?>
<div class="row">
  <div class="col-sm-8">
   <div class="row">
     <div class="col-sm-6">
	  <div class="card"><!--PASSWORD CHANGE STARTS-->
        <div class="card-header bg-info"><h4>Change password</h4></div>
		<div class="card-body">
        <?php
        if(isset($_SESSION['msg'])) echo $_SESSION['msg'];
        $_SESSION['msg']=''; //remove session variable msg
        ?>
        <form action='php/updatepassword.php' method='post'>
        <div class="form-group">
            <label for="pwd">Old password:</label>
            <input type="password" class="form-control" id="pwd" name="oldpwd">
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
	  </div><!--PROFILE IMAGE ENDS-->
     </div>	 
        <div class="col-sm-6">
       <div class="card"><!--PASSWORD CHANGE STARTS-->
        <div class="card-header bg-info"><h4>Change email</h4></div>
		<div class="card-body">
        <?php
        if(isset($_SESSION['emailmsg'])) echo $_SESSION['emailmsg'];
        $_SESSION['emailmsg']=''; //remove session variable msg
        ?>
        <form action='php/updateEmail.php' method='post'>
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
	  </div><!--PROFILE IMAGE ENDS-->
     </div>
     <div class="col-sm-6">
	    <div class="card"><!--PROFILE IMAGE STARTS-->
         <div class="card-header bg-info"><h4>Update profile image</h4></div>
         <div class="card-body"><?php
            if(isset($_SESSION['imgMsg'])) echo $_SESSION['imgMsg'];
            $_SESSION['imgMsg']='';
             
            if(!empty($row['profileimage'])){
                //display image
                echo '<img src="../../images/members/'.$row['profileimage'].'" class="media-object" style="width:100px">';
            }else echo '<p>No image found in database</p>';
             ?>
            <form action="php/saveProfileImg.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="img" value="ok">
                <div class="form-group">
                <label for="imgFile">Select your profile image:</label>
                <input type="file" class="form-control" name="imgFile"></div>
                <button type="submit" class="btn btn-primary">Upload file</button>
            </form>          
        
		 </div>
	    </div><!--PROFILE IMAGE ENDS-->
       </div>
		<p></p>
		<div class="col-sm-6">
				<div class="card"><!--LANGUAGE SKILLS-->
			<div class="card-header bg-info"><h4>Your language skills</h4></div>
			<div class="card-body">
			 <ul class="list-group">
			 <?php
			 //code here for listing existing languages for current user
			 $sql="SELECT memberlanguagesID,language,level FROM memberlanguages WHERE memberID=".$_SESSION['userID'];
             $result1=$conn->query($sql);
             while($row1=$result1->fetch_assoc()){
                echo '<li class="list-group-item">';
                echo $row1['language'];
                echo ' - ';
                echo $row1['level'];
                echo ' - ';
                echo '<a href="php/removeLanguage.php?mrlngID='.$row1['memberlanguagesID'].'">Remove</a>';
                echo '</li>';
             }
			 ?>
			 </ul>
             <?php
                if(isset($_SESSION['lngInfo'])) echo $_SESSION['lngInfo'];
                $_SESSION['lngInfo']='';
             ?>
			</div>
			<div class="card-footer">
				<h4>Add language</h4>
				<form action="php/addLanguage.php" method="post">
					<div class="form-group">
						<label for="language">Language:</label>
						<select name="language">
							<option value="">-Select language-</option>
							<?php
							//code here for selecting those languages, that current user does not have in previous list
							$sql="SELECT language FROM languages WHERE language NOT IN";
                            $sql.="(SELECT language FROM memberlanguages ";
                            $sql.=" WHERE memberID=".$_SESSION['userID'].")";
                            $result2=$conn->query($sql);
                            while($row2=$result2->fetch_assoc()){
                              echo '<option value="'.$row2['language'].'">'.$row2['language'].'</option>';
                            }
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="level">Level:</label>
						<select name="level">
							<option value="">-Select level-</option>
							<option value="Basic">Basic</option>
							<option value="Good">Good</option>
							<option value="Excellent">Excellent</option>
						</select>
					</div>
					<button type="submit" class="btn btn-primary">Update</button>
				</form>
			</div>
		</div><!--LANGUAGE SKILLS ENDS-->
    </div>
       <p></p>

            <div class="col-sm-6">
	    <div class="card"><!--PROFILE GROUPS STARTS-->
         <div class="card-header bg-info"><h4>Current groups</h4></div>
         <div class="card-body">
                   <?php
                if(isset($_SESSION['grpInfo'])) echo $_SESSION['grpInfo'];
                $_SESSION['grpInfo']='';
             ?>
                <table class="table table-hover">
                <thead>
      <tr>
        <th>Group name</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql="SELECT * FROM groups INNER JOIN membergroups ON groups.groupID=membergroups.groupID INNER JOIN members ON membergroups.memberID=members.memberID WHERE members.memberID=".$_SESSION['userID'];
        $result4=$conn->query($sql); //run the query in $sql-variable with $conn-object created in dbConnect.php
        //display the rows -> records coming as result of the SQL-query
        while($row3=$result4->fetch_assoc()){
            echo '<tr>';
            echo '<td>';
            echo '<form action="php/updateGroup.php" method="post">';
            echo '<input type="hidden" class="form-control" name="membergroupID" value="'.$row3['membergroupID'].'">';
            //create a link to current member by memberID
            echo '<button type="submit" class="btn btn-info btn-lg">'.$row3['groupname'].'</button>';
            echo '</form> ';
            echo '</td>';
            echo '</tr>';
        }
       ?>
    </tbody>
    </table>
                     
        
		 </div>
	    </div>
       </div>
       <div class="col-sm-6">
	    <div class="card"><!--PROFILE GROUPS STARTS-->
         <div class="card-header bg-info"><h4>Non-member groups</h4></div>
         <div class="card-body">
            
                <table class="table table-hover">
                <thead>
      <tr>
        <th>Group name</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql = "SELECT DISTINCT(membergroups.groupID), groupname FROM groups INNER JOIN membergroups ON groups.groupID=membergroups.groupID WHERE membergroups.groupID NOT IN (SELECT groupID FROM membergroups WHERE membergroups.memberID = '".$_SESSION['userID']."')";
        $result5=$conn->query($sql); //run the query in $sql-variable with $conn-object created in dbConnect.php
        //display the rows -> records coming as result of the SQL-query
        while($row4=$result5->fetch_assoc()){
            echo '<tr>';
            echo '<td>';
             echo '<form action="php/updateGroup.php" method="post">';
            echo '<input type="hidden" class="form-control" name="groupID" value="'.$row4['groupID'].'">';
            //create a link to current member by memberID
            echo '<button type="submit" class="btn btn-info btn-lg">'.$row4['groupname'].'</button>';
            echo '</form> ';
            echo '</td>';
            echo '</tr>';
        }
       ?>
    </tbody>
    </table>
                     
        
		 </div>
	    </div>
       </div>
   </div>
  </div>
  <div class="col-sm-4">
	   <div class="card">
        <div class="card-header bg-info"><h4>Edit your information</h4></div>
		<div class="card-body">
		<?php if(isset($_SESSION['infoMsg'])) echo $_SESSION['infoMsg'];$_SESSION['infoMsg']='';?>
        <form action="php/updateMyInfo.php" method="post">
            <div class="form-group">
                <label for="firstname">Firstname:</label>
                <input type="text" class="form-control" name="firstname"
                value="<?php echo $row['firstname']?>">
            </div>
            <div class="form-group">
                <label for="lastname">Lastname:</label>
                <input type="text" class="form-control" name="lastname"
                value="<?php echo $row['lastname']?>">
            </div>
            <div class="form-group">
                <label for="birthdate">Birthdate:</label>
                <input type="date" class="form-control" name="birthdate"
                value="<?php echo $row['birthdate']?>">
            </div>
            <div class="form-group">
                <label for="street">Street address:</label>
                <input type="text" class="form-control" name="street"
                value="<?php echo $row['street']?>">
            </div>
			<div class="form-group">
                <label for="city">City:</label>
                <input type="text" class="form-control" name="city"
                value="<?php echo $row['city']?>">
            </div>
			<div class="form-group">
                <label for="zip">Zip:</label>
                <input type="text" class="form-control" name="zip"
                value="<?php echo $row['zip']?>">
            </div>
			<div class="form-group">
                <label for="phone">Phone:</label>
                <input type="phone" class="form-control" name="phone"
                value="<?php echo $row['phone']?>">
            </div>
			<div class="form-group">
                <label for="drivesl">Driverslicense:</label>
                <input type="checkbox" class="form-control" name="driversl" value="ok"
				<?php if($row['driverslicense']=='ok') echo 'checked' ?>>       
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
      </form>
	  </div>
	 </div>
  </div>
</div>