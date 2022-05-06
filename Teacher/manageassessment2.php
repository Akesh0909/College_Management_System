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
			//selecting data form assessment details table form database
			$sql = "SELECT * FROM examdetails WHERE ExamID=$make";
			$rs = mysqli_query( $con, $sql );
			while ( $row = mysqli_fetch_array( $rs ) ) {
				?>
			<fieldset>
				<legend><a href="manageassessment.php" >Edit Assessment</a></legend>
				<form action="" method="POST" name="UpdateAssessment">
					<table class="table table-hover">

						<tr>
							<td><strong>Exam ID</strong>
							</td>
							<td>
								<?php $ExamID=$row['ExamID']; echo $ExamID; ?>
							</td>

						</tr>
						<tr>
						<td><strong>Exam Name</strong>
							</td>
							<td>
							<textarea name="ExamName" class="form-control" rows="1" cols="50"><?php $ExamName=$row['ExamName']; echo $ExamName; ?></textarea>
							</td>
							
						</tr>	
						<tr>
							<td><strong>Q1</strong>
							</td>
							<td>
							<textarea name="Q1" rows="5" class="form-control" cols="150"><?php $Q1=$row['Q1']; echo $Q1; ?></textarea>
							</td>
						</tr>	
							<tr>
							<td><strong>Q2</strong>
							</td>
							<td>
							<textarea name="Q2" rows="5" class="form-control" cols="150"><?php $Q2=$row['Q2']; echo $Q2; ?></textarea>
							</td>
						</tr>	
							<tr>
							<td><strong>Q3</strong>
							</td>
							<td>
							<textarea name="Q3" rows="5" class="form-control" cols="150"><?php $Q3=$row['Q3']; echo $Q3; ?></textarea>
							</td>
						</tr>	
							<tr>
							<td><strong>Q4</strong>
							</td>
							<td>
							<textarea name="Q4" rows="5" class="form-control" cols="150"><?php $Q4=$row['Q4']; echo $Q4; ?></textarea>
							</td>
						</tr>	
							<tr>
							<td><strong>Q5</strong>
							</td>
							<td>
							<textarea name="Q5" rows="5" class="form-control" cols="150"><?php $Q5=$row['Q5']; echo $Q5; ?></textarea>
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
							
							$E_name= $_POST['ExamName'];
							$Q_1= $_POST['Q1'];
							$Q_2= $_POST['Q2'];
							$Q_3= $_POST['Q3'];
							$Q_4= $_POST['Q4'];
							$Q_5= $_POST['Q5'];

							$sql = "UPDATE `examdetails` SET ExamName='$E_name' , Q1='$Q_1' , Q2='$Q_2' , Q3='$Q_3', Q4='$Q_4', Q5='$Q_5' WHERE ExamID=$make";

							if (mysqli_query($con, $sql)) {
								echo "
								<br>
								 Assessment Updated.
                                 <br><br>
								";
								} else {
								//error message if SQL query fails
								echo "<br><Strong>Assessment Updation Faliure. Try Again</strong><br> Error Details: " . $sql . "<br>" . mysqli_error($connect);

								//close the connection
								mysqli_close($con);
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