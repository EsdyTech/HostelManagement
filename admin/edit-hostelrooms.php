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
$id=$_GET['id'];
$query="update hostelrooms set hostelId=?,roomName=?,roomDescription=? where Id=?";
$stmt = $mysqli->prepare($query);
$rc=$stmt->bind_param('issi',$hostelId,$roomName,$roomDescription,$id);
$stmt->execute();
echo"<script>alert('Hostel Room Details has been Updated successfully');</script>";
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
	<title>Edit Hostel Room Details</title>
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
					
						<h2 class="page-title">Edit Hostel Room Details </h2>
	
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Edit Hostel Room Details</div>
									<div class="panel-body">
										<form method="post" class="form-horizontal">
												<?php	
												$id=$_GET['id'];
	$ret="select * from hostelrooms where Id=?";
		$stmt= $mysqli->prepare($ret) ;
	 $stmt->bind_param('i',$id);
	 $stmt->execute() ;//ok
	 $res=$stmt->get_result();
	 //$cnt=1;
	   while($row=$res->fetch_object())
	  {
	  	?>
						<div class="hr-dashed"></div>
						<div class="form-group">
<label class="col-sm-2 control-label">Hostel:</label>
<div class="col-sm-8">
<select name="hostelId" class="form-control" required="required">
<option value="">Select Hostel</option>
<?php	
$rets="select * from hostels";
$stmts= $mysqli->prepare($rets) ;
$stmts->execute() ;//ok
$ress=$stmts->get_result();
while($rows=$ress->fetch_object())
	  {
	  	?>
<option value="<?php echo $rows->id;?>"><?php echo $rows->hostelName;?></option>
<?php }?>
</select>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Room Name</label>
<div class="col-sm-8">
<input type="text" class="form-control" name="roomName" id="roomName" value="<?php echo $row->roomName;?>" required="required">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Room Description</label>
<div class="col-sm-8">
<input type="text" class="form-control" name="roomDescription" id="roomDescription" value="<?php echo $row->roomDescription;?>" required="required">
</div>
</div>


<?php } ?>
												<div class="col-sm-8 col-sm-offset-2">
													
													<input class="btn btn-primary" type="submit" name="submit" value="Update Room Details ">
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