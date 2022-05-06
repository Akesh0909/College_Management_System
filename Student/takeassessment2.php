<!---------------- Session starts form here ----------------------->
<?php  
	session_start();
	if (!$_SESSION["LoginStudent"])
	{
		header('location:../login/login.php');
	}
	if($_SESSION['LoginStudent']){
		$_SESSION['LoginAdmin'] = "";
	}
		require_once "../connection/connection.php";
		
	?>
<!---------------- Session Ends form here ------------------------>


<!doctype html>
<html lang="en">
	<head>
		<title>Student - Dashboard</title>
	</head>
	<body>
		<?php include('../common/common-header.php') ?>
		<?php include('../common/student-sidebar.php') ?>  

		<main role="main" class="col-xl-10 col-lg-9 col-md-8 ml-sm-auto px-md-4 mb-2 w-100">
			<div class="sub-main">
				<div class="text-center d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 text-white admin-dashboard pl-3">
					<h4 class="">Welcome To <?php $roll_no=$_SESSION['LoginStudent'];
					$query="select * from student_info where roll_no='$roll_no'";
					$run=mysqli_query($con,$query);
					while ($row=mysqli_fetch_array($run)) {
						echo $row['first_name']." ".$row['middle_name']." ".$row['last_name'];
					}
					?> Dashboard </h4> </h4>
				</div>
				<div class="row">
		<div class="col-md-12">

			<?php
			$exid = $_GET[ 'exid' ];
			$sql = "select * from  student_info where roll_no='$roll_no'";
			$sql2 = "select * from  examdetails where ExamID='$exid'";
			
			$result = mysqli_query( $con, $sql );
			$result2 = mysqli_query( $con, $sql2 );

			while ( $row = mysqli_fetch_array( $result ) ) {
				?>
			<!--exam question with student detalis-->
			<fieldset>
				<legend>Assessment Details</legend>
				<form action="" method="POST" name="update">
					<div class="col-md-6">
						<table>
							<tr>
								<td><strong>Roll Number :</strong>
								</td>
								<td>
									<?php $eno=$row['roll_no'];
						echo $roll_no; ?>
								</td>
							</tr>
							<tr>
								<td><strong>Student's Name :</strong>
								</td>
								<td>
									<?php $name=$row['first_name']." ".$row['last_name'];
									echo $name; ?>
								</td>
							</tr>
						</table>
					</div>

					<div class="col-md-6">
						<table>
							<tr>
								<td><strong>Course :</strong>
								</td>
								<td>
									<?PHP $cc=$row['course_code']; echo $cc; ?>
								</td>
							</tr>
							<tr>
								<td><strong>Applied For :</strong>
								</td>
								<td>
									<?PHP echo $exid; ?><br>
								</td>
							</tr>
						</table>
					</div>
					<br>
					<br>
					<hr>
					<?php
			if ( isset( $_POST[ 'done' ] ) ) {
				$Ex_id = $exid;
				$roll_no = $roll_no;
				$tempsname = $name;
				$tempq1 = $_POST[ 'Q1' ];
				$tempq2 = $_POST[ 'Q2' ];
				$tempq3 = $_POST[ 'Q3' ];
				$tempq4 = $_POST[ 'Q4' ];
				$tempq5 = $_POST[ 'Q5' ];
				$sql = "INSERT INTO `examans`(ExamID,Sname, roll_no, Ans1, Ans2, Ans3, Ans4, Ans5) VALUES ('$Ex_id','$tempsname','$roll_no','$tempq1','$tempq2','$tempq3','$tempq4','$tempq5')";
				if ( mysqli_query( $con, $sql ) ) {
					echo "<br>
					<br><br>
					 Assessment Have Submited.";
				} else {
					//error message if SQL query fails
					echo "<br><Strong>Assessment Submitting Faliure. Try Again</strong><br> Error Details: " . $sql . "<br>" . mysqli_error( $con );
				} 
			}
			?>
					<?php while ( $row = mysqli_fetch_array( $result2 ) ) {
				?>
					<div class="col-md-12">
						<span style="color: red;"><h3>Answer The Following Questions..</h3></span>

						<br>
						<div>
							<h4> <strong>Q1. <?php $Q_1=$row['Q1']; echo $Q_1; ?></strong></h4>
							<div><textarea name="Q1" rows="5" class="form-control" cols="150" required ></textarea></div>
						</div>
						<br>
						<div>
							<h4> <strong>Q2. <?php $Q_2=$row['Q2']; echo $Q_2; ?></strong></h4>
							<div><textarea name="Q2" rows="5" class="form-control" cols="150" required ></textarea></div>
						</div>
						<br>
						<div>
							<h4> <strong>Q3. <?php $Q_3=$row['Q3']; echo $Q_3; ?></strong></h4>
							<div><textarea name="Q3" rows="5" class="form-control" cols="150" required ></textarea></div>
						</div>
						<br>
						<div>
							<h4> <strong>Q4. <?php $Q_4=$row['Q4']; echo $Q_4; ?></strong></h4>
							<div><textarea name="Q4" rows="5" class="form-control" cols="150" required ></textarea></div>
						</div>
						<br>
						<div>
							<h4> <strong>Q5. <?php $Q_5=$row['Q5']; echo $Q_5; ?></strong></h4>
							<div><textarea name="Q5" rows="5" class="form-control" cols="150" required ></textarea></div>
						</div>
						<br>
						
						<?php 
					}
					?>
							
						<br><br>
						<button type="submit" name="done" class="btn btn-success" style="border-radius:0px;">Submit Answers</button>
					</div>
					
				</form>
			</fieldset>
			<?php
			}
			?>
			
		</div>
	</div>
			</div>
		</main>
		<script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
		<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>