<?php
/*
    file:   php/showguide.php
    desc:   Shows the information about selected memberID. Selects the member from db
            by members.memberID. Check that the information was found. Displays the
            result of SQL-query
*/
if(!isset($_GET['memberID'])) header('location:index.php?page=guides');
include('../../php/dbConnect.php');
$sql="SELECT firstname, lastname, email, city FROM members WHERE memberID=".$_GET['memberID'];
$result=$conn->query($sql);
if($row=$result->fetch_assoc()){
    //found the member -> display information
    echo '<h3>Nordic Guides - ';
    echo $row['firstname'].' '.$row['lastname'];
    echo '</h3>';
    //list of languages spoken by this guide
    $sql="SELECT language FROM memberlanguages WHERE memberID=".$_GET['memberID'];
    $result1=$conn->query($sql);
    $languagelist='<ul>';
    while($row1=$result1->fetch_assoc()){
        $languagelist.='<li>'.$row1['language'].'</li>';
    }
    $languagelist.='</ul>';
    //get membergroups for this member
    $sql="SELECT groupname FROM  groups ";
    $sql.="INNER JOIN membergroups ON groups.groupID=membergroups.groupID ";
    $sql.=" WHERE membergroups.memberID=".$_GET['memberID'];
    $result1=$conn->query($sql);
    $grouplist='<ul>';
    while($row1=$result1->fetch_assoc()){
        $grouplist.='<li>'.$row1['groupname'].'</li>';
    }
    $grouplist.='</ul>';
    echo '
    <div class="card" style="width:300px">
        <img class="card-img-top" src="images/avatar.png" alt="Card image">
        <div class="card-body">
            <h4 class="card-title">'.$row['firstname'].' '.$row['lastname'].'</h4>
            <p class="card-text">'.$row['email'].'</p>
            <p class="card-text">'.$row['city'].'</p>
            <p class="card-text">Speaks: '.$languagelist.' </p>
            <P class="card-text">Member in groups: '.$grouplist.'</p>
        </div>
    </div>';
}else echo '<h3>Nordic Guides - Member not found!</h3>';
?>
    