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
			
			$sql="SELECT * FROM video";
			$rs=mysqli_query($con,$sql);
			echo "<h2 class='page-header'>Videos Details</h2>";
			echo "<table class='table table-striped table-hover' style='width:100%'>
			<tr>
				<th>#</th>
				<th>Video Title</th>
				<th>Description</th>
				<th>View</th>		
			</tr>";
			$count=1;
			while($row=mysqli_fetch_array($rs))
			{
			?>
		<tr>
			<td>
				<?PHP echo $count;?>
			</td>
			<td>
				<?PHP echo $row['V_Title'];?>
			</td>
			<td>
				<?PHP echo $row['V_Remarks'];?>
			</td>
							
			<td><a href="viewvideos2.php?viewid=<?php echo $row['V_id']; ?>"> <input type="button" Value="View" style="border-radius:0%"  class="btn btn-info btn-sm"  data-toggle="modal" data-target="#myModal"></a>
			</td>
		</tr>
		<?php
		$count++;}
		?>	
		</table>
		
	</div>
			</div>
		</main>
		<script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
		<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>