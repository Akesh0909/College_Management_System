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
		if ( isset( $_REQUEST[ 'deleteid' ] ) ) {

			//getting data from another page
			$deleteid = $_GET[ 'deleteid' ];
			$sql = "DELETE FROM `notes` WHERE N_id = $deleteid";
			if ( mysqli_query( $con, $sql ) ) {
				echo "
						<br>
                        Notes details deleted.
                        <br><br>
						
						";
			} else {
				//error message if SQL query fails
				echo "<br><Strong>Notes Details Updation Faliure. Try Again</strong><br> Error Details: " . $sql . "<br>" . mysqli_error( $con );
			}
		}
		?>
			
			<?php 
				
				$sql="SELECT * FROM notes";
				$rs=mysqli_query($con,$sql);
				echo "<h2 class='page-header'>Notes Details</h2>";
				echo "<table class='table table-striped' style='width:100%'>
				<tr>
					<th>#</th>
					<th>Notes Title</th>
					<th>Notes URL</th>
					<th>Description</th>
					<th>Actions</th>		
				</tr>";
				$count = 1;
				while( $row = mysqli_fetch_array($rs) )
				{
				?>
			<tr>
				<td>
					<?PHP echo $count;?>
				</td>
				<td>
					<?PHP echo $row['N_Title'];?>
				</td>
				<td>
					<?PHP echo $row['N_Url'];?>
				</td>
				<td>
					<?PHP echo $row['N_Remarks'];?>
				</td>
								
				<td><a href="managenotes.php?deleteid=<?php echo $row['N_id']; ?>"> <input type="button" Value="Delete"  class="btn btn-danger btn-sm" style="border-radius:0%" data-toggle="modal" data-target="#myModal"></a>
				<a href="managenotes2.php?editassid=<?php echo $row['N_id']; ?>"> <input type="button" Value="Edit"  class="btn btn-success btn-sm" style="border-radius:0%" data-toggle="modal" data-target="#myModal"></a>
				
				</td>
			</tr>
			<?php
		$count++;	}
			?>	
			</table>
			
		</div>
	</div>
			</div>
		</main>
		<script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
		<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>