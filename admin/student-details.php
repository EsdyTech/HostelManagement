<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();
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
	<title>Hostel Details</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">

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
				<div class="row" id="print">


					<div class="col-md-12">
						<h2 class="page-title" style="margin-top:4%">Hostel Details</h2>
						<div class="panel panel-default">
							<div class="panel-heading">All Hostel Details</div>
							<div class="panel-body">
			<table id="zctb" class="table table-bordered " cellspacing="0" width="100%" border="1">
									
						 <span style="float:left" ><i class="fa fa-print fa-2x" aria-hidden="true" OnClick="CallPrint(this.value)" style="cursor:pointer" title="Print the Report"></i></span>			
									<tbody>
<?php	
$aid=intval($_GET['regno']);


$rett="select * from userregistration where regno=?";
$stmtt= $mysqli->prepare($rett) ;
$stmtt->bind_param('s',$aid);
$stmtt->execute() ;
$ress=$stmtt->get_result();
$rows=$ress->fetch_object();
	  

	$ret="select * from registration where regno=?";
$stmt= $mysqli->prepare($ret) ;
$stmt->bind_param('s',$aid);
$stmt->execute() ;
$res=$stmt->get_result();
$cnt=1;
while($row=$res->fetch_object())
	  {


		
	  	?>

<tr>
<td colspan="6" style="text-align:center; color:blue"><h3>Hostel Registration
 Status: <?php if($row->isApproved == "No"){?></h3>
	<h3 style="color: red" align="center">Pending Approval</h3>
<?php
}
else{
?>
<h3 style="color: green" align="center">Approved</h3>
<?php
}
?>

</td>
</tr>
<tr>
	<th>Registration Number :</th>
<td><?php echo $row->regNo;?></td>
<th>Date Applied:</th>
<td colspan="3"><?php echo $row->dateRegistered;?></td>
</tr>

<?php
$hostelId = $row->hostelId;
$stmtt=$mysqli->prepare("SELECT hostelName FROM hostels WHERE id=?");
$stmtt->bind_param('s',$hostelId);
$stmtt->execute();
$stmtt -> bind_result($hostelName);
$rs=$stmtt->fetch();
$stmtt->close();
?>

<tr>
<td><b>Hostel Name:</b></td>
<td><?php echo $hostelName;?></td>


<td><b>Room Alloted :</b></td>
<td><?php if($row->roomAllotedId == ""){ echo "No Room Alloted Yet!";} else{
	
	
	$rmId = $row->roomAllotedId;

	$ret="select * from hostelrooms where Id=?";
	$stmt= $mysqli->prepare($ret) ;
	$stmt->bind_param('i',$rmId);
	$stmt->execute() ;
	$res=$stmt->get_result();
	$roww=$res->fetch_object();

	echo $roww->roomName;
	
	
	}?></td>
<td><b>Fees Per Month:</b></td>
<td><?php echo $fpm=$row->feespm;?></td>
</tr>


<?php
$reslt="select cost from feedingfee";
$stmmt= $mysqli->prepare($reslt) ;
$stmmt->execute() ;
$ress=$stmmt->get_result();
$rss=$ress->fetch_object();
$feedingCost = $rss->cost;
?>

<tr>
<td><b>Food Status:</b></td>
<td>
<?php if($row->foodstatus==0)
{
echo "Without Food";
}
else
{
	echo "With Food (".$feedingCost." Per Month)";
}
;?></td>
<td><b>Stay From :</b></td>
<td><?php echo $row->stayfrom;?></td>
<td><b>Duration:</b></td>
<td><?php echo $dr=$row->duration;?> Months</td>
</tr>

<tr><th>Hostel Fee:</th>
<td><?php echo  $dr." Months x ".$fpm." = ". $hf=$dr*$fpm?></td>

<th>Food Fee:</th>
<td colspan="3"><?php 
if($row->foodstatus==1)
{ 
	echo $dr." Months x ".$feedingCost." = ". $ff=($feedingCost * $dr);
} else { 
echo $ff=0;
echo "<span style='padding-left:2%; color:red;'>(You booked hostel without food).<span>";
}?></td>
</tr>
<tr>
<th>Total Fee :</th>
<th colspan="5"><?php echo $hf+$ff;?></th>
</tr>

<tr>
<td colspan="6" style="color:red"><h4>Personal Info</h4></td>
</tr>

<tr>
<td><b>Reg No. :</b></td>
<td><?php echo $row->regNo;?></td>
<td><b>Full Name :</b></td>
<td><?php echo $rows->firstName;?>  <?php echo $rows->middleName;?>  <?php echo $rows->lastName;?></td>
<td><b>Email :</b></td>
<td><?php echo $rows->email;?></td>
</tr>


<tr>
<td><b>Contact No. :</b></td>
<td><?php echo $rows->contactNo;?></td>
<td><b>Gender :</b></td>
<td><?php echo $rows->gender;?></td>
<td><b>Class :</b></td>
<td><?php echo $rows->class;?></td>
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
 <script>
$(function () {
$("[data-toggle=tooltip]").tooltip();
    });
function CallPrint(strid) {
var prtContent = document.getElementById("print");
var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
WinPrint.document.write(prtContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
}
</script>
</body>

</html>
