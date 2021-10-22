<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();
//code for registration
if(isset($_POST['submit']))
{
	$regNo=$_POST['regNo'];
	$hostel=$_POST['hostel'];
	$feespm=$_POST['fpm'];
	$foodstatus=$_POST['foodstatus'];
	$stayfrom=$_POST['stayf'];
	$duration=$_POST['duration'];
	$roomAllotedId= 0;
	$dateRegistered = Date("d-m-Y");
	$isApproved = "No";

	
	$ret12="select * from hostels where id=?";
	$stmt12= $mysqli->prepare($ret12) ;
	$stmt12->bind_param('i',$hostel);
	$stmt12->execute() ;//ok
	$res12=$stmt12->get_result();
	$rwws=$res12->fetch_object();

	if($rwws->noOfAvailableRooms == 0){

		echo"<script>alert('This hostel is fully Occupied, Kindly Select another Hostel');</script>";
	}
else{

$query="insert into  registration(regNo,hostelId,roomAllotedId,feespm,foodstatus,stayfrom,duration,dateRegistered,isApproved) values(?,?,?,?,?,?,?,?,?)";
$stmt = $mysqli->prepare($query);
$rc=$stmt->bind_param('ssiississ',$regNo,$hostel,$roomAllotedId,$feespm,$foodstatus,$stayfrom,$duration,$dateRegistered,$isApproved);

if($stmt->execute()){

		$ret="select * from hostels where id=?";
	$stmt1= $mysqli->prepare($ret) ;
	$stmt1->bind_param('i',$hostel);
	$stmt1->execute() ;//ok
	$res=$stmt1->get_result();
	$rows=$res->fetch_object();

		//deduct from available rooms and update the table
		$remRooms  = (intval($rows->noOfAvailableRooms) - 1);
		
		$con="update hostels set noOfAvailableRooms=? where id=?";
		$upd = $mysqli->prepare($con);
		$upd->bind_param('ii',$remRooms,$hostel);
		
		if($upd->execute()){
			echo"<script>alert('Successfully Booked Hostel!');</script>";
		}
		else{
			echo"<script>alert('An Error Occurred!');</script>";
		}
}
else{
	echo"<script>alert('An Error Occurred!');</script>";
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
	<title>Student Hostel Registration</title>
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
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script>
function getSeater(val) {
$.ajax({
type: "POST",
url: "get_seater.php",
data:'hostelId='+val,
success: function(data){
//alert(data);
$('#noOfRooms').val(data);
}
});

$.ajax({
type: "POST",
url: "get_seater.php",
data:'rid='+val,
success: function(data){
//alert(data);
$('#fpm').val(data);
}
});

$.ajax({
type: "POST",
url: "get_seater.php",
data:'aid='+val,
success: function(data){
//alert(data);
$('#noOfAvailableRooms').val(data);
}
});


$.ajax({
type: "POST",
url: "get_seater.php",
data:'lid='+val,
success: function(data){
//alert(data);
$('#location').val(data);
}
});
}
</script>

</head>
<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
		<?php include('includes/sidebar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					
						<h2 class="page-title">Hostel Registration</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-primary">
									<div class="panel-heading">Fill all Info</div>
									<div class="panel-body">
										<form method="post" action="" class="form-horizontal">
							<?php
				$uid=$_SESSION['login'];

				$stmt1=$mysqli->prepare("SELECT regNo FROM userregistration WHERE (email=? || regNo=?)");
				$stmt1->bind_param('ss',$uid,$uid);
				$stmt1->execute();
				$stmt1 -> bind_result($regNo);
				$rs=$stmt1->fetch();
				$stmt1->close();


				$stmt=$mysqli->prepare("SELECT regNo FROM registration WHERE regNo=? ");
				$stmt->bind_param('s',$regNo);
				$stmt->execute();
				$stmt -> bind_result($regNo);
				$rs=$stmt->fetch();
				$stmt->close();
				if($rs)
				{ ?>
			<h3 style="color: red" align="center">Hostel already booked by you</h3>
			<div align="center">
				<div class="col-md-4">&nbsp;</div>
			<div class="col-md-4">
										<div class="panel panel-default">
											<div class="panel-body bk-success text-light">
												<div class="stat-panel text-center">

												<div class="stat-panel-number h1 ">My Room</div>
													
												</div>
											</div>
											<a href="room-details.php" class="block-anchor panel-footer text-center">See All &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
								</div>
				<?php }
				else{
								
							?>	
<div class="form-group">
<label class="col-sm-4 control-label"><h4 style="color: green" align="left">Hostel Related info </h4> </label>
</div>

<?php	
$aid=$_SESSION['id'];
	$ret="select * from userregistration where id=?";
		$stmt= $mysqli->prepare($ret) ;
	 $stmt->bind_param('i',$aid);
	 $stmt->execute() ;//ok
	 $res=$stmt->get_result();
	 //$cnt=1;
	   while($row=$res->fetch_object())
	  {
	  	?>

<div class="form-group">
<label class="col-sm-2 control-label">Registration No:</label>
<div class="col-sm-8">
<input type="text" name="regNo" id="regNo"  class="form-control" value="<?php echo $row->regNo;?>" readonly >
</div>
</div>
<?php } ?>
<div class="form-group">
<label class="col-sm-2 control-label">Hostel</label>
<div class="col-sm-8">
<select name="hostel" id="hostel"class="form-control"  onChange="getSeater(this.value);" onBlur="checkAvailability()" required> 
<option value="">Select Hostel</option>
<?php $query ="SELECT * FROM hostels";
$stmt2 = $mysqli->prepare($query);
$stmt2->execute();
$res=$stmt2->get_result();
while($row=$res->fetch_object())
{
?>
<option value="<?php echo $row->id;?>"> <?php echo $row->hostelName;?></option>
<?php } ?>
</select> 
<span id="room-availability-status" style="font-size:12px;"></span>
</div>
</div>
											
<div class="form-group">
<label class="col-sm-2 control-label">Number of Rooms</label>
<div class="col-sm-8">
<input type="text" name="noOfRooms" id="noOfRooms"  class="form-control" readonly="true">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Number of Available Rooms</label>
<div class="col-sm-8">
<input type="text" name="noOfAvailableRooms" id="noOfAvailableRooms"  class="form-control" readonly="true">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Fees Per Month</label>
<div class="col-sm-8">
<input type="text" name="fpm" id="fpm"  class="form-control" readonly="true">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Location</label>
<div class="col-sm-8">
<input type="text" name="location" id="location"  class="form-control" readonly="true">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Food Status</label>
<div class="col-sm-8">
<input type="radio" value="0" name="foodstatus" checked="checked"> Without Food
<input type="radio" value="1" name="foodstatus"> With Food(N2000.00 Per Month Extra)
</div>
</div>	

<div class="form-group">
<label class="col-sm-2 control-label">Stay From</label>
<div class="col-sm-8">
<input type="date" name="stayf" id="stayf"  class="form-control" >
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Duration</label>
<div class="col-sm-8">
<select name="duration" id="duration" class="form-control">
<option value="">Select Duration in Month</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
</select>
</div>
</div>

<div class="col-sm-6 col-sm-offset-4">
<button class="btn btn-default" type="reset">Reset</button>
<input type="submit" name="submit" Value="Book Hostel" class="btn btn-primary">
</div>

</form>
<?php } ?>

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
</body>
<script type="text/javascript">
	$(document).ready(function(){
        $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                $('#paddress').val( $('#address').val() );
                $('#pcity').val( $('#city').val() );
                $('#pstate').val( $('#state').val() );
                $('#ppincode').val( $('#pincode').val() );
            } 
            
        });
    });
</script>
	<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'hostel='+$("#hostel").val(),
type: "POST",
success:function(data){
$("#room-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>


<script type="text/javascript">

$(document).ready(function() {
	$('#duration').keyup(function(){
		var fetch_dbid = $(this).val();
		$.ajax({
		type:'POST',
		url :"ins-amt.php?action=userid",
		data :{userinfo:fetch_dbid},
		success:function(data){
	    $('.result').val(data);
		}
		});
		

})});
</script>

</html>