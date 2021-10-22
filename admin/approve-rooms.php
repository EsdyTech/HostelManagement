<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

if(isset($_GET['app']))
{
	$id=intval($_GET['app']);
    $status = "Yes";
    $adn="update registration set isApproved=? where id=?";
		$stmt= $mysqli->prepare($adn);
		$stmt->bind_param('si',$status,$id);
        $stmt->execute();
        $stmt->close();	   
        echo "<script>alert('Hostel Approved Successfully!');</script>" ;
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
	<title>Approve Hostels</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<?php include('includes/header.php');?>

	<div class="ts-main-content">
			<?php include('includes/sidebar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title" style="margin-top: 4%">Approve Hostels</h2>
						<div class="panel panel-default">
							<div class="panel-heading">All Hostels Details</div>
							<div class="panel-body">
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
                                        <th>Sno.</th>
											<th>Hostel Name</th>
											<th>Student FullName</th>
											<th>Fees (PM) </th>
                                            <th>Duration</th>
                                            <th>Food Status</th>
                                            <th>Total Fees</th>
											<th>Status</th>
											<th>Date Registered</th>
											<th>Approve</th>
											<th>Allot Room</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Sno.</th>
											<th>Hostel Name</th>
											<th>Student FullName</th>
											<th>Fees (PM) </th>
                                            <th>Duration</th>
                                            <th>Food Status</th>
                                            <th>Total Fees</th>
											<th>Status</th>
											<th>Date Registered</th>
											<th>Approve</th>
											<th>Allot Room</th>
										</tr>
									</tfoot>
									<tbody>
<?php	
$aid=$_SESSION['id'];
$ret="select * from registration";
$stmt= $mysqli->prepare($ret) ;
//$stmt->bind_param('i',$aid);
$stmt->execute() ;//ok
$res=$stmt->get_result();
$cnt=1;
while($row=$res->fetch_object())
	  {

        $hostelId = $row->hostelId;
        $stmtt=$mysqli->prepare("SELECT hostelName FROM hostels WHERE id=?");
        $stmtt->bind_param('s',$hostelId);
        $stmtt->execute();
        $stmtt -> bind_result($hostelName);
        $rs=$stmtt->fetch();
        $stmtt->close();


        $regNo = $row->regNo;
        $stmtt1=$mysqli->prepare("SELECT firstName,middleName,lastName FROM userregistration WHERE regNo=?");
        $stmtt1->bind_param('s',$regNo);
        $stmtt1->execute();
        $stmtt1 -> bind_result($firstName,$middleName,$lastName);
        $rs=$stmtt1->fetch();
        $stmtt1->close();


	  	?>
<tr><td><?php echo $cnt;;?></td>
<td><?php echo $hostelName;?></td>
<td><?php echo $lastName ." ".$firstName." ".$middleName;?></td>
<td><?php echo $row->feespm;?></td>
<td><?php echo $row->duration;?></td>
<td><?php if($row->foodstatus == 1){echo "With Food (N2000 Per Month)";}else{ echo "Without Food";}?></td>
<td><?php echo $totlafees = (($row->feespm * $row->duration) + (2000 * $row->duration));?></td>
<td><?php if($row->isApproved == "No"){echo "Pending Approval";}else{ echo "Approved";}?></td>
<td><?php echo $row->dateRegistered;?></td>
<td>
<a href="approve-rooms.php?app=<?php echo $row->id;?>" onclick="return confirm("Do you want to Approve!");"><i class="fa fa-check"></i></a></td>
<td><a href="allot-hostelrooms.php?id=<?php echo $row->id;?>"><i class="fa fa-room">Click to Allot Room</i></a></td>
										</tr>
									<?php
$cnt=$cnt+1;
									 } ?>
											
										
									</tbody>
								</table>

								
							</div>
						</div>

					
					</div>
				</div>

			

			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
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

</html>
