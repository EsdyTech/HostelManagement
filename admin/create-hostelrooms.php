<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();
//code for add courses
if(isset($_POST['submit']))
{
	$hostelId=$_POST['hostelId'];
	$roomName=$_POST['roomName'];
	$roomDescription =$_POST['roomDescription'];
	$isAllotted = "No";
	$dateAllotted = "";
	$studentAllottedTo = "";
	$dateCreated = Date("d-m-Y");

	$sql="SELECT hostelId,roomName FROM hostelrooms where roomName=? and hostelId=?";
	$stmt1 = $mysqli->prepare($sql);
	$stmt1->bind_param('si',$roomName,$hostelId);
	$stmt1->execute();
	$stmt1->store_result(); 
	$row_cnt=$stmt1->num_rows;

	if($row_cnt>0)
	{
		echo"<script>alert('Hostel Room with this name ".$roomName." already exist');</script>";
	}
	else
	{
		//query to get the total numbers of rooms for the hostel
		$sql2="SELECT * FROM hostels where id=?";
		$stmt2 = $mysqli->prepare($sql2);
		$stmt2->bind_param('i',$hostelId);
		$stmt2->execute();
		$resh=$stmt2->get_result();
		$rowh=$resh->fetch_object();

		$noOfRooms = $rowh->noOfRooms;

		//query to count the number of rooms already added
		$sql11="SELECT * FROM hostelrooms where hostelId=?";
		$stmt11 = $mysqli->prepare($sql11);
		$stmt11->bind_param('i',$hostelId);
		$stmt11->execute();
		$stmt11->store_result(); 
		$row_cnts=$stmt11->num_rows;

		$noOfAddedRooms = $row_cnts;

		if($noOfRooms > $noOfAddedRooms){

			$query="insert into  hostelrooms (hostelId,roomName,roomDescription,isAllotted,studentAllottedTo,dateAllotted,dateCreated) values(?,?,?,?,?,?,?)";
			$stmt = $mysqli->prepare($query);
			$rc=$stmt->bind_param('issssss',$hostelId,$roomName,$roomDescription,$isAllotted,$studentAllottedTo,$dateAllotted,$dateCreated);
			$stmt->execute();

			echo"<script>alert('Hostel Room has been added successfully');</script>";
		}
		else{

			echo"<script>alert('You cant Create More Rooms: The number of Rooms Added Cant Exceed the Number of Rooms in the Hostel Created!');</script>";

		}
	}
}
?>
<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	<title>Create Hostel Rooms</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">>
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="js/validation.min.js"></script>
</head>
<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
		<?php include('includes/sidebar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					
						<h2 class="page-title">Add Hostel Rooms </h2>
	
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Add Hostel Rooms</div>
									<div class="panel-body">
									<?php if(isset($_POST['submit']))
{ ?>
<!-- <p style="color: red"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg']=""); ?></p> -->
<?php } ?>
										<form method="post" class="form-horizontal">
											
											<div class="hr-dashed"></div>
											
<div class="form-group">
<label class="col-sm-2 control-label">Hostel : </label>
<div class="col-sm-8">
<select name="hostelId" class="form-control" required="required">
<option value="">Select Hostel</option>
<?php	
$aid=$_SESSION['id'];
$ret="select * from hostels";
$stmt= $mysqli->prepare($ret) ;
$stmt->execute() ;//ok
$res=$stmt->get_result();
while($row=$res->fetch_object())
	  {
	  	?>
<option value="<?php echo $row->id;?>"><?php echo $row->hostelName;?></option>
<?php }?>
</select>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Room Name</label>
<div class="col-sm-8">
<input type="text" class="form-control" name="roomName" id="roomName" value="" required="required">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Room Description</label>
<div class="col-sm-8">
<input type="text" class="form-control" name="roomDescription" id="roomDescription" value="" required="required">
</div>
</div>

<div class="col-sm-8 col-sm-offset-2">
<input class="btn btn-primary" type="submit" name="submit" value="Create Room">
												</div>
											</div>

										</form>

									</div>
								</div>
									
							
							</div>
						
									
							

							</div>
						</div>

					</div>
				</div> 	
				

			</div>
		</div>
	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</script>
</body>

</html>