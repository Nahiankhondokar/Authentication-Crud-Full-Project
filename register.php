<?php include_once "app/autoload.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<title>Register Page</title>
</head>
<body>


<?php 

	/**
	 * From isseting
	 */

	if ( isset($_POST['add']) ) {
		
		// Get values

		$name = $_POST['name'];
		$email = $_POST['email'];
		$cell = $_POST['cell'];
		$uname = $_POST['uname'];
		$pass = $_POST['pass'];
		$cpass = $_POST['cpass'];
		$age = $_POST['age'];

		// Gender isseting

		if ( isset($_POST['gender']) ) {
			
			$gender = $_POST['gender'];
		}
		
		$shift = $_POST['shift'];
		$location = $_POST['location'];

		// Aggrement Confirm (we can set defualt value like this of any values)(it is using like active, inactive)

		$status = 'disagree';
		if ( isset($_POST['status'])) {
			$status = $_POST['status'];
		}






		// Hash Password

		$hash_pass = password_hash($pass, PASSWORD_DEFAULT);


		// Email Checking System

		$email_check = valueCheck('users', 'email', $email);


		// Cell Checking System

		$cell_check = valueCheck('users', 'cell', $cell);


		// UserName Checking System

		$uname_check = valueCheck('users', 'uname', $uname);



		// File Management System


		$file_name = $_FILES['photo']['name'];
		$file_tmp_name = $_FILES['photo']['tmp_name'];

		$unique_file_name =  md5( time() . rand() ) . $file_name;




		


		/**
		 * From Vlidation
		 */


		if ( empty($name) || empty($email) || empty($cell) || empty($uname) || empty($pass) || empty($age) || empty($gender) || empty($shift) || empty($location) ) {

			$mess = validate('All feilds are required');
			
		}elseif( filter_var($email, FILTER_VALIDATE_EMAIL) == false){

			$mess = validate('Invalid email','warning');

		}elseif ( $pass != $cpass ) {
			
			$mess = validate('Invalid password','warning');

		}elseif ( $email_check > 0 ) {
			
			$mess = validate('This email already exists','warning');

		}elseif ( $cell_check > 0 ) {
			
			$mess = validate('This cell already exists','warning');

		}elseif ( $uname_check > 0 ) {
			
			$mess = validate('This user name already exists','warning');

		}else{

			insert("INSERT INTO users (name, email, cell, uname, pass, age, gender, shift, location, photo, status) VALUES (
			'$name', '$email', '$cell', '$uname', '$hash_pass', '$age', '$gender', '$shift', '$location', '$unique_file_name', '$status' )");
			
			// File move to folder
			move_uploaded_file($file_tmp_name, 'photo/students/' . $unique_file_name);

			header('location:index.php');

		}
	

	}


 ?>


<div class="container">
	<div class="registration-from">
		<form class="form p-5 text-white shadow-lg" method="POST" enctype="multipart/form-data">
		<div class="row">

			<div class="col-md-6">
				<div class="student_form_one p-5">
					
						<h1 class="text-center">Add New Student </h1>

						<?php include "templates/message.php"; ?>
						
					  <div class="form-group ">
					    <label for="exampleInputEmail1">Name</label>
					    <input name="name" type="text" class="form-control text-white h-25">
					  </div>

					  <div class="form-group ">
					    <label for="exampleInputEmail1">Email</label>
					    <input name="email" type="text" class="form-control text-white h-25">
					  </div>

					  <div class="form-group ">
					    <label for="exampleInputEmail1">Cell</label>
					    <input name="cell" type="text" class="form-control text-white h-25">
					  </div>

					  <div class="form-group ">
					    <label for="exampleInputEmail1">User Name</label>
					    <input name="uname" type="text" class="form-control text-white h-25">
					  </div>

					  <div class="form-group ">
					    <label for="exampleInputEmail1">Password</label>
					    <input name="pass" type="password" class="form-control text-white h-25">
					  </div>

					  <div class="form-group ">
					    <label for="exampleInputEmail1">Confirm Password</label>
					    <input name="cpass" type="password" class="form-control text-white h-25">
					  </div>

					<!-- </form> -->
				</div>

			</div>


			<div class="col-md-6">
				<div class="student_form_two p-5">
					<!-- <form class="form p-5 text-white shadow-lg"> -->
						
					  <div class="form-group ">
					    <label for="exampleInputEmail1">Age</label>
					    <input name="age" type="text" class="form-control text-white h-25">
					  </div>

					  <div class="form-group ">
					    <label for="exampleInputEmail1">Gender</label><br>
					    <input name="gender" value="male" type="radio" class="text-white p-2" id="male"><label class="p-1" for="male"> Male</label>
					    <input name="gender" value="female" type="radio" class="text-white" id="female"><label class="p-1" for="female"> Female</label>
					  </div>

					  <div class="form-group ">
					    <label for="exampleInputEmail1">Shift</label>
					    <select name="shift" class="form-control h-25 text-white">
					    	<option class="text-dark">--Select--</option>
					    	<option class="text-dark">Day</option>
					    	<option class="text-dark">Evening</option>
					    </select>
					  </div>


					  <div class="form-group ">
					    <label for="exampleInputEmail1">Location</label>
					    <select name="location" class="form-control h-25 text-white">
					    	<option class="text-dark" value="">--Select--</option>
					    	<option class="text-dark" value="Dhaka">Dhaka</option>
					    	<option class="text-dark" value="Barisal">Barisal</option>
					    	<option class="text-dark" value="chittagong">chittagong</option>
					    	<option class="text-dark" value="Khulna">Khulna</option>
					    	<option class="text-dark" value="Mymensignh">Mymensignh</option>
					    	<option class="text-dark" value="Rangpur">Rangpur</option>
					    	<option class="text-dark" value="Sylhet">Sylhet</option>
					    </select>
					  </div>
					  
					  <div class="form-group ">
					    <label for="exampleInputEmail1">Photo</label>
					    <input name="photo" type="file" class="form-control-file text-white">
					  </div>

					  <div class="form-group ">					    
					    <input name="status" value="agree" type="checkbox"> <label>Active</label>
					  </div>

					  <button name="add" type="submit" class="btn btn-primary">Add new student</button>

					  <a href="index.php" class="btn btn-primary rounded-0 register">Login</a>

					
				</div>

			</div>
			</div>
		</form>
	</div>
</div>








	<script src="assets/js/jquery-3.5.1.slim.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script>
		


	</script>


	
</body>
</html> 





