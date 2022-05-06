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
		<div class="col-md-8">

			<?PHP
		if ( isset( $_POST[ 'submit' ] ) ) {
			$Aname = $_POST[ 'AssessmentName' ];
			$q1 = $_POST[ 'Q1' ];
			$q2 = $_POST[ 'Q2' ];
			$q3 = $_POST[ 'Q3' ];
			$q4 = $_POST[ 'Q4' ];
			$q5 = $_POST[ 'Q5' ];

			$done = "
					<center>
					<br>
                    Assessment added Sucessfully.
                    <br><br>
					</center>
					";

			$sql = "INSERT INTO `ExamDetails` (`ExamName`, `Q1`, `Q2`, `Q3`, `Q4`, `Q5`) VALUES ('$Aname','$q1','$q2','$q3','$q4','$q5')";
			//close the connection
			mysqli_query( $con, $sql );

			echo $done;
		}

		?>
		
			<fieldset>
				<legend><a href="addassessment.php">Add Assessment</a></legend>
				<form action="" method="POST" name="AddAssessment">
					<table class="table table-hover">

						<tr>
							<td><strong>Assessment Name  </strong>
							</td>
							<td>
								<input type="text" name="AssessmentName">
							</td>

						</tr>
						<tr>
							<td><strong>Question 1</strong> </td>
							<td>
								<textarea name="Q1" rows="5" cols="150"></textarea>
							</td>
						</tr>
						<tr>
							<td><strong>Question 2</strong> </td>
							<td>
								<textarea name="Q2" rows="5" cols="150"></textarea>
							</td>
						</tr>
						<tr>
							<td><strong>Question 3</strong> </td>
							<td>
								<textarea name="Q3" rows="5" cols="150"></textarea>
							</td>
						</tr>
						<tr>
							<td><strong>Question 4</strong> </td>
							<td>
								<textarea name="Q4" rows="5" cols="150"></textarea>
							</td>
						</tr>
						<tr>
							<td><strong>Question 5</strong> </td>
							<td>
								<textarea name="Q5" rows="5" cols="150"></textarea>
							</td>
						</tr>
						
						<td><button type="submit" name="submit" class="btn btn-success" style="border-radius:0%">Add Assessment</button>
						</td>
						
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