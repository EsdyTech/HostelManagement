<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

if(isset($_GET['del']))
{
	$id=intval($_GET['del']);
	$adn="delete from hostelrooms where Id=?";
		$stmt= $mysqli->prepare($adn);
		$stmt->bind_param('i',$id);
        $stmt->execute();
        $stmt->close();	   
        echo "<script>alert('Hostel Room Deleted Successfully');</script>" ;
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
	<title>Manage Hostel Rooms</title>
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
						<h2 class="page-title" style="margin-top: 4%">Manage Hostel Rooms</h2>
						<div class="panel panel-default">
							<div class="panel-heading">All Hostel Rooms Details</div>
							<div class="panel-body">
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Sno.</th>
											<th>Hostel Name</th>
											<th>Room Name</th>
                                            <th>Room Description</th>
                                            <th>Allotted?</th>
                                            <th>Student Allotted To</th>
                                            <th>Date Allotted</th>
											<th>Date Created</th>
											<th>Edit</th>
											<th>Delete</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
                                        <th>Sno.</th>
											<th>Hostel Name</th>
											<th>Room Name</th>
                                            <th>Room Description</th>
                                            <th>Allotted?</th>
                                            <th>Student Allotted To</th>
                                            <th>Date Allotted</th>
											<th>Date Created</th>
											<th>Edit</th>
											<th>Delete</th>
										</tr>
									</tfoot>
									<tbody>
<?php	
$aid=$_SESSION['id'];
$ret="select * from hostelrooms";
$stmt= $mysqli->prepare($ret) ;
$stmt->execute() ;//ok
$res=$stmt->get_result();
$cnt=1;
while($row=$res->fetch_object())
	  {

        $hosteldId = $row->hostelId;
        $studentRegNo = "";
        $studentFullName = "";
        if($row->studentAllottedTo == ""){
            $studentRegNo = "";
        }
        else{
            $studentRegNo = $row->studentAllottedTo;
            //student
            $rets="select * from userregistration where regNo=?";
            $stmts= $mysqli->prepare($rets);
            $stmts->bind_param('s',$studentRegNo);
            $stmts->execute() ;//ok
            $ress=$stmts->get_result();
            $rows=$ress->fetch_object();

            $studentFullName = $rows->lastName." ".$rows->firstName." ".$rows->middleName;
        }

        //hostels
        $reth="select * from hostels where Id=?";
        $stmth= $mysqli->prepare($reth);
        $stmth->bind_param('i',$hosteldId);
        $stmth->execute() ;//ok
        $resh=$stmth->get_result();
        $rowh=$resh->fetch_object();

        

	  	?>
<tr><td><?php echo $cnt;?></td>
<td><?php echo $rowh->hostelName;?></td>
<td><?php echo $row->roomName;?></td>
<td><?php echo $row->roomDescription;?></td>
<td><?php echo $row->isAllotted;?></td>
<td><?php echo $studentFullName;?></td>
<td><?php echo $row->dateAllotted;?></td>
<td><?php echo $row->dateCreated;?></td>
<td><a href="edit-hostelrooms.php?id=<?php echo $row->Id;?>"><i class="fa fa-edit"></i></a></td>
<td><a href="manage-hostelrooms.php?del=<?php echo $row->Id;?>" onclick="return confirm("Do you want to delete");"><i class="fa fa-close"></i></a></td>
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
