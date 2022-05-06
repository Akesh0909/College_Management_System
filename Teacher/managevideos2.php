 <!---------------- Session starts form here ----------------------->
 <?php  
	session_start();
	if (!$_SESSION["LoginTeacher"])
	{
		header('location:../login/login.php');
	}
		require_once "../connection/connection.php";
	?>
<!---------------- Session Ends form here ------------------------>

<?php
	$_SESSION["LoginAdmin"]="";
	$teacher_email=$_SESSION['LoginTeacher'];
	$query1="select * from teacher_info where email='$teacher_email'";
	$run1=$run=mysqli_query($con,$query1);
	while($row=mysqli_fetch_array($run1)) {
		$teacher_id=$row["teacher_id"];
	}
	$_SESSION['teacher_id']=$teacher_id;
?>


<html lang="en">
	<head>
		<title>Teacher - Dashboard</title>
	</head>
	<body>
		<?php include('../common/common-header.php') ?>
		<?php include('../common/teacher-sidebar.php') ?>  

		<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 main-background mb-2 w-100">
			<div class="sub-main">
				<div class="text-center d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
					<h4 class="">Welcome To <?php $roll_no=$_SESSION['LoginTeacher'];
					$query="select * from teacher_info where email='$teacher_email'";
					$run=mysqli_query($con,$query);
					while ($row=mysqli_fetch_array($run)) {
						echo $row['first_name']." ".$row['middle_name']." ".$row['last_name'];
					}
					?> Dashboard </h4> </h4>
				</div>
                <div class="row">
		<div class="col-md-12">


			<?php
			$make = $_GET[ 'editassid' ];
			//selecting data form Video details table form database
			$sql = "SELECT * FROM video WHERE V_id=$make";
			$rs = mysqli_query( $con, $sql );
			while ( $row = mysqli_fetch_array( $rs ) ) {
				?>
			<fieldset>
				<legend><a href="managevideos.php" >Update Videos</a></legend>
				<form action="" method="POST" name="UpdateVideo">
					<table class="table table-hover">

						<tr>
							<td><strong>Video ID</strong>
							</td>
							<td>
								<?php $V_id=$row['V_id']; echo $V_id; ?>
							</td>

						</tr>
						<tr>
						<td><strong>Video Title</strong>
							</td>
							<td>
							<textarea name="V_Title" rows="1" cols="50" class="form-control"><?php $V_Title=$row['V_Title']; echo $V_Title; ?></textarea>
							</td>
							
						</tr>	
						<tr>
							<td><strong>Video URL</strong>
							</td>
							<td>
							<textarea name="V_Url" rows="5" cols="150" class="form-control"><?php $V_Url=$row['V_Url']; echo $V_Url; ?></textarea>
							</td>
						</tr>
						<tr>
							<td><strong>Video Description</strong>
							</td>
							<td>
							<textarea name="V_Remarks" rows="5" cols="150" class="form-control"><?php $V_Remarks=$row['V_Remarks']; echo $V_Remarks; ?></textarea>
							</td>
						</tr>							
						<td><button type="submit" name="update" class="btn btn-success" style="border-radius:0%">Update</button>
						</td>
						<?php
						}
						?>
						<?php 

							if(isset($_POST['update']))
							{
							
							$V_Title= $_POST['V_Title'];
							$V_Url= $_POST['V_Url'];
							$V_Remarks= $_POST['V_Remarks'];
							
							$sql = "UPDATE `video` SET V_Title='$V_Title' , V_Url='$V_Url' , V_Remarks='$V_Remarks' WHERE V_id=$make";

							if (mysqli_query($con, $sql)) {
								echo "
								<br>
								Videos Updated.
								<br><br>
								
								";
								} else {
								//error message if SQL query fails
								echo "<br><Strong>Video Updation Faliure. Try Again</strong><br> Error Details: " . $sql . "<br>" . mysqli_error($con);

								}
							}
							?> 
					</table>
				</form>
			</fieldset>
		</div>
	</div>
			</div>
		</main>
		<script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
		<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>