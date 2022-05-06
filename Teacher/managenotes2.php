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
			$sql = "SELECT * FROM notes WHERE N_id=$make";
			$rs = mysqli_query( $con, $sql );
			while ( $row = mysqli_fetch_array( $rs ) ) {
				?>
			<fieldset>
				<legend><a href="managenotes.php" >Update Notes</a></legend>
				<form action="" method="POST" name="UpdateVideo">
					<table class="table table-hover">

						<tr>
							<td><strong>Notes ID</strong>
							</td>
							<td>
								<?php $N_id=$row['N_id']; echo $N_id; ?>
							</td>

						</tr>
						<tr>
						<td><strong>Notes Title</strong>
							</td>
							<td>
							<textarea name="N_Title" rows="1" cols="50" class="form-control"><?php $N_Title=$row['N_Title']; echo $N_Title; ?></textarea>
							</td>
							
						</tr>	
						<tr>
							<td><strong>Notes URL</strong>
							</td>
							<td>
							<textarea name="N_Url" rows="5" cols="150" class="form-control"><?php $N_Url=$row['N_Url']; echo $N_Url; ?></textarea>
							</td>
						</tr>
						<tr>
							<td><strong>Notes Description</strong>
							</td>
							<td>
							<textarea name="N_Remarks" rows="5" cols="150" class="form-control"><?php $N_Remarks=$row['N_Remarks']; echo $N_Remarks; ?></textarea>
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
							
							$N_Title= $_POST['N_Title'];
							$N_Url= $_POST['N_Url'];
							$N_Remarks= $_POST['N_Remarks'];
							
							$sql = "UPDATE `notes` SET N_Title='$N_Title' , N_Url='$N_Url' , N_Remarks='$N_Remarks' WHERE N_id=$make";

							if (mysqli_query($con, $sql)) {
								echo "
								<br>
								Notes Updated.
								<br><br>
								
								";
								} else {
								//error message if SQL query fails
								echo "<br><Strong>Notes Updation Faliure. Try Again</strong><br> Error Details: " . $sql . "<br>" . mysqli_error($con);

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