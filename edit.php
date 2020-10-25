<?php include_once "app/autoload.php"; ?>


<?php 

	/**
	 * From isseting
	 */

	if ( isset($_POST['add']) ) {

		$edit_id = $_GET['edit_id'];
		
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





		/**
		 * From Vlidation
		 */


		if ( empty($name) || empty($email) || empty($cell) || empty($uname) || empty($pass) || empty($age) || empty($gender) || empty($shift) || empty($location) ) {

			$mess = validate('All feilds are required');
			
		}elseif( filter_var($email, FILTER_VALIDATE_EMAIL) == false){

			$mess = validate('Invalid email','warning');

		}elseif ( $pass != $cpass ) {
			
			$mess = validate('Invalid password','warning');

		}else{


			// Image updating system

			$photo_name = "";

			if ( empty($_FILES['new_photo']['name'])) {
				
				$photo_name = $_POST['old_photo'];

			}else{

				$file_name = $_FILES['new_photo']['name'];
				$file_tmp_name = $_FILES['new_photo']['tmp_name'];

				$photo_name = md5( time() . rand() ) . $file_name;


				move_uploaded_file($file_tmp_name, 'photo/students/' .  $photo_name);

			}



			// Updating data to database

			$sql ="UPDATE users SET name='$name', email='$email', cell='$cell', uname='$uname', pass='$hash_pass', age='$age', gender='$gender', shift='$shift', location='$location', photo='$photo_name' WHERE id='$edit_id' ";

			$way ->query($sql);

			$mess = validate('Registration Completed','success');

		}
	

	}


 ?>

<?php 

	// Data taking from URL for EDIT PAGE

	if ( isset($_GET['edit_id'])) {
		
		$edit_id = $_GET['edit_id'];

		$sql = "SELECT * FROM users WHERE id= '$edit_id' ";
		$edit_value = $way -> query($sql);

		$single_edit_value = $edit_value -> fetch_assoc();

	}






 ?>



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




<div class="container">
	<div class="registration-from">
		<form class="form p-5 text-white shadow-lg" method="POST" enctype="multipart/form-data">
		<div class="row">

			<div class="col-md-6">
				<div class="student_form_one p-5">
					
						<h1 class="text-center">Edit Student Info </h1>

						<?php include "templates/message.php"; ?>
						
					  <div class="form-group ">
					    <label for="exampleInputEmail1">Name</label>
					    <input value="<?php echo $single_edit_value['name']; ?>" name="name" type="text" class="form-control text-white h-25">
					  </div>

					  <div class="form-group ">
					    <label for="exampleInputEmail1">Email</label>
					    <input value="<?php echo $single_edit_value['email']; ?>" name="email" type="text" class="form-control text-white h-25">
					  </div>

					  <div class="form-group ">
					    <label for="exampleInputEmail1">Cell</label>
					    <input value="<?php echo $single_edit_value['cell']; ?>" name="cell" type="text" class="form-control text-white h-25">
					  </div>

					  <div class="form-group ">
					    <label for="exampleInputEmail1">User Name</label>
					    <input value="<?php echo $single_edit_value['uname']; ?>" name="uname" type="text" class="form-control text-white h-25">
					  </div>

					  <div class="form-group ">
					    <label for="exampleInputEmail1">Password</label>
					    <input value="<?php echo $single_edit_value['pass']; ?>" name="pass" type="password" class="form-control text-white h-25">
					  </div>

					  <div class="form-group ">
					    <label for="exampleInputEmail1">Confirm Password</label>
					    <input value="<?php echo $single_edit_value['pass']; ?>" name="cpass" type="password" class="form-control text-white h-25">
					  </div>

					<!-- </form> -->
				</div>

			</div>


			<div class="col-md-6">
				<div class="student_form_two p-5">
					<!-- <form class="form p-5 text-white shadow-lg"> -->
						
					  <div class="form-group ">
					    <label for="exampleInputEmail1">Age</label>
					    <input value="<?php echo $single_edit_value['age']; ?>" name="age" type="text" class="form-control text-white h-25">
					  </div>

					  <div class="form-group ">
					    <label for="exampleInputEmail1">Gender</label><br>

					    <input <?php if( $single_edit_value['gender'] == 'male'){ echo "checked";} ?> name="gender" value="male" type="radio" class="text-white p-2" id="male"><label class="p-1" for="male"> Male</label>

					    <input <?php if( $single_edit_value['gender'] == 'female'){ echo "checked";} ?> name="gender" value="female" type="radio" class="text-white" id="female"><label class="p-1" for="female"> Female</label>
					  </div>

					  <div class="form-group ">
					    <label for="exampleInputEmail1">Shift</label>
					    <select name="shift" class="form-control h-25 text-white">
					    	<option class="text-dark">--Select--</option>
					    	<option <?php if( $single_edit_value['shift'] == 'Day'){ echo "selected";} ?> class="text-dark">Day</option>
					    	<option <?php if( $single_edit_value['shift'] == 'Evening'){ echo "selected";} ?> class="text-dark">Evening</option>
					    </select>
					  </div>


					  <div class="form-group ">
					    <label for="exampleInputEmail1">Location</label>
					    <select name="location" class="form-control h-25 text-white">
					    	<option class="text-dark" value="">--Select--</option>
					    	<option <?php if( $single_edit_value['location'] == 'Dhaka'){ echo "selected";} ?> class="text-dark" value="Dhaka">Dhaka</option>
					    	<option <?php if( $single_edit_value['location'] == 'Barisal'){ echo "selected";} ?> class="text-dark" value="Barisal">Barisal</option>
					    	<option <?php if( $single_edit_value['location'] == 'chittagong'){ echo "selected";} ?> class="text-dark" value="chittagong">chittagong</option>
					    	<option <?php if( $single_edit_value['location'] == 'Khulna'){ echo "selected";} ?> class="text-dark" value="Khulna">Khulna</option>
					    	<option <?php if( $single_edit_value['location'] == 'Mymensignh'){ echo "selected";} ?> class="text-dark" value="Mymensignh">Mymensignh</option>
					    	<option <?php if( $single_edit_value['location'] == 'Rangpur'){ echo "selected";} ?> class="text-dark" value="Rangpur">Rangpur</option>
					    	<option <?php if( $single_edit_value['location'] == 'Sylhet'){ echo "selected";} ?> class="text-dark" value="Sylhet">Sylhet</option>
					    </select>
					  </div>


					  <div class="form-group ">
					  	<img style="width: 100px;" src="photo/students/<?php echo $single_edit_value['photo']; ?>" alt="">
					    <input value="<?php echo $single_edit_value['photo']; ?>" name="old_photo" type="hidden" class="form-control-file text-white">
					  </div> 
					  
					  <div class="form-group ">
					    <label for="exampleInputEmail1">Photo</label>
					    <input name="new_photo" type="file" class="form-control-file text-white">
					  </div>

					  

					  <div class="form-group ">					    
					    <input <?php if( $single_edit_value['status'] == 'agree'){ echo "checked";} ?> name="status" value="agree" type="checkbox"> <label>Active</label>
					  </div>

					  <button name="add" type="submit" class="btn btn-primary">Update</button>

					  <a href="students.php" class="btn btn-primary rounded-0 register">All Students</a>

					
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





