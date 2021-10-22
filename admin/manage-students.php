<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

if(isset($_GET['del']))
{
	$id=intval($_GET['del']);
	$adn="delete from registration where regNo=?";
		$stmt= $mysqli->prepare($adn);
		$stmt->bind_param('i',$id);
        $stmt->execute();
        $stmt->close();	  
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
	<title>Manage Rooms</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
<script language="javascript" type="text/javascript">
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
 if(popUpWin)
{
if(!popUpWin.closed) popUpWin.close();
}
popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+510+',height='+430+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
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
						<h2 class="page-title" style="margin-top:4%">Manage Registred Students</h2>
						<div class="panel panel-default">
							<div class="panel-heading">All Room Details</div>
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
											<th>Edit</th>
											<th>Delete</th>
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
											<th>Edit</th>
											<th>Delete</th>
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
<a href="student-details.php?regno=<?php echo $row->regNo;?>" title="View Full Details"><i class="fa fa-desktop"></i></a></td>
<td><a href="manage-students.php?del=<?php echo $row->regNo;?>" title="Delete Record" onclick="return confirm('Do you want to delete');"><i class="fa fa-close"></i></a></td>
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
