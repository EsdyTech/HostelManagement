<?php
include('includes/config.php');



if(!empty($_POST["hostelId"])) 
{
$id=$_POST["hostelId"];
 $query ="SELECT * FROM hostels WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('i',$id);
$stmt->execute();
$res=$stmt->get_result();
while($row=$res->fetch_object())
{  echo htmlentities($row->noOfRooms);
 
 }
}


if(!empty($_POST["rid"])) 
{
$id=$_POST["rid"];
 $query ="SELECT * FROM hostels WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('i',$id);
$stmt->execute();
$res=$stmt->get_result();
while($row=$res->fetch_object())
{  echo htmlentities($row->fees);
 
 }
}

if(!empty($_POST["aid"])) 
{
$id=$_POST["aid"];
 $query ="SELECT * FROM hostels WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('i',$id);
$stmt->execute();
$res=$stmt->get_result();
while($row=$res->fetch_object())
{  echo htmlentities($row->noOfAvailableRooms);
 
 }
}

if(!empty($_POST["lid"])) 
{
$id=$_POST["lid"];
 $query ="SELECT * FROM hostels WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('i',$id);
$stmt->execute();
$res=$stmt->get_result();
while($row=$res->fetch_object())
{  echo htmlentities($row->location);
 
 }
}

?>