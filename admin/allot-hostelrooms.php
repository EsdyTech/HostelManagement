<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();
//code for add courses
if(isset($_POST['submit']))
{
    $id=$_GET['id'];
    $hostelId=$_POST['hostelId'];
    $hostelroomId=$_POST['hostelroomId'];
    $isAllotted="Yes";
    $studentRegNo=$_POST['studentRegNo'];
    $dateAllotted = Date("d-m-Y");

    $sql="SELECT * FROM registration where regNo=? and roomAllotedId != 0";
    $stmt1 = $mysqli->prepare($sql);
    $stmt1->bind_param('s',$studentRegNo);
    $stmt1->execute();
    $stmt1->store_result(); 
    $row_cnt=$stmt1->num_rows;

    if($row_cnt > 0)
    {
        echo"<script>alert('A room has already been Alloted to this Student!');</script>";
    }
    else
    {
        $que="update registration set roomAllotedId=? where id=?";
        $stmst = $mysqli->prepare($que);
        $stmst->bind_param('ii',$hostelroomId,$id);

        if($stmst->execute()){

            $query="update hostelrooms set isAllotted=?,studentAllottedTo=?,dateAllotted=? where Id=?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('sssi',$isAllotted,$studentRegNo,$dateAllotted,$hostelroomId);

            if($stmt->execute()){
                echo "<script>alert('Room Allotted Successfully!');</script>";
            }
            else{
                echo "<script>alert('An Error Occurred!');</script>";
            }
        }
        else{
            echo "<script>alert('An Error Occurred!');</script>";
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
	<title>Allot Hostel Rooms</title>
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


<?php
	$id=$_GET['id'];
//
    $reth="select * from registration where id=?";
    $stmth= $mysqli->prepare($reth);
    $stmth->bind_param('i',$id);
    $stmth->execute() ;//ok
    $resh=$stmth->get_result();
    $rowh=$resh->fetch_object();

    $studentRegNo = $rowh->regNo;
    $hostelId = $rowh->hostelId;


    $rets="select * from userregistration where regNo=?";
    $stmts= $mysqli->prepare($rets);
    $stmts->bind_param('s',$studentRegNo);
    $stmts->execute() ;//ok
    $ress=$stmts->get_result();
    $rows=$ress->fetch_object();

    $studentFullName = $rows->lastName." ".$rows->firstName." ".$rows->middleName;

    //
    $retss="select * from hostels where id=?";
    $stmtss= $mysqli->prepare($retss);
    $stmtss->bind_param('i',$hostelId);
    $stmtss->execute() ;//ok
    $resss=$stmtss->get_result();
    $rowss=$resss->fetch_object();

    $hostelName = $rowss->hostelName;

?>



				<div class="row">
					<div class="col-md-12">
					
						<h2 class="page-title">Allot Hostel Room For <?php echo $studentFullName;?>  Hostel: (<?php echo $hostelName;?>)</h2>
	
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Allot Hostel Rooms For <?php echo $studentFullName;?></div>
									<div class="panel-body">
									<?php if(isset($_POST['submit']))
{ ?>
<!-- <p style="color: red"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg']=""); ?></p> -->
<?php } ?>
										<form method="post" class="form-horizontal">
											
											<div class="hr-dashed"></div>

        <div class="form-group">
<label class="col-sm-2 control-label">Hostel Name</label>
<div class="col-sm-8">
<input type="text" class="form-control" name="hostelName" id="hostelName" value="<?php echo $rowss->hostelName;?>" readonly>
<input type="hidden" class="form-control" name="hostelId" id="" value="<?php echo $hostelId;?>">
<input type="hidden" class="form-control" name="studentRegNo" id="" value="<?php echo $rows->regNo;?>">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Hostel Room:</label>
<div class="col-sm-8">
<select name="hostelroomId" class="form-control" required="required">
<option value="">Select Hostel Rooms</option>
<?php	
    $ret="select * from hostelrooms where hostelId=? and isAllotted='No'";
$stmt= $mysqli->prepare($ret);
$rc=$stmt->bind_param('i',$hostelId);
$stmt->execute() ;//ok
$res=$stmt->get_result();
while($row=$res->fetch_object())
	  {
	  	?>
<option value="<?php echo $row->Id;?>"><?php echo $row->roomName;?></option>
<?php }?>
</select>
</div>
</div>

<div class="col-sm-8 col-sm-offset-2">
<input class="btn btn-primary" type="submit" name="submit" value="Allot Room">
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