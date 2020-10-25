<?php include_once "app/autoload.php"; ?>



<?php 

  // Data taking from URL for VIEW button



    if ( isset($_GET['profile_id']) ) {
        
        $profile_id = $_GET['profile_id'];

        $sql = "SELECT * FROM users WHERE id='$profile_id' ";

        $profile = $way ->query($sql);

       

        $all_profile = $profile -> fetch_assoc();



    }



 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Class 14</title>

	<!-- All CSS Files -->

	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	
</head>
<body>


<div class="student_form shadow-lg pb-5">
	<a href="students.php" class="btn btn-primary rounded-0">Back</a>
	<div class="profile form p-3 text-white ">

		
		<img src="photo/students/<?php echo $all_profile['photo']; ?>" alt="">
		<h2><?php echo $all_profile['name']; ?></h2>

		<table class="profileTwo text-white">
			<tr>
				<td>name</td>
				<td><?php echo $all_profile['name']; ?></td>
			</tr>

			<tr>
				<td>User Name</td>
				<td><?php echo $all_profile['uname']; ?></td>
			</tr>

			<tr>
				<td>Email</td>
				<td><?php echo $all_profile['email']; ?></td>
			</tr>

			<tr>
				<td>Cell</td>
				<td><?php echo $all_profile['cell']; ?></td>
			</tr>

			<tr>
				<td>Gender</td>
				<td><?php echo $all_profile['gender']; ?></td>
			</tr>

			<tr>
				<td>Age</td>
				<td><?php echo $all_profile['age']; ?></td>
			</tr>

		</table>
		
	
	</div>
</div>






	<script src="assets/js/jquery-3.5.1.slim.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script>
		


	</script>


	
</body>
</html> 



