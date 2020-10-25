<?php include_once "app/autoload.php"; ?>


<?php 


	
	// Taking data by using session 

	if( isset($_SESSION['user_id'])  ){

		$id = $_SESSION['user_id'];
		$sql = "SELECT * FROM users WHERE id ='$id' ";
		$data = $way -> query($sql);

		$single_data = $data -> fetch_assoc();

	}	
 

 	// You can not access profile page while you are loged out

	if( !isset($_SESSION['user_id']) ){

		header('location:index.php');
	}



	// LogOut system

	if ( isset($_GET['logout_id']) ) {
		
		$logout_id = $_GET['logout_id'];

		

		// Cookie destroy while logging out
		setcookie('user_login_id', $_SESSION['user_id'] , time() - (60*60*24*30*12) );



		// Recent user id showing system
		if ( isset($_COOKIE['user_recent_login'])) {
			
			$recent_old_value = $_COOKIE['user_recent_login'];

			// String to Array
			$rla = explode(',', $recent_old_value);

			// Add old value plus new value
			array_push($rla, $_SESSION['user_id'] );

			// Array to String
			$recent_final_list = implode( ',', $rla);

		}else{

			$recent_final_list = $_SESSION['user_id'];

		}



		// Again create Cookie memory for set Recent login users
		setcookie('user_recent_login', $recent_final_list , time() + (60*60*24*30*12) );






		// Session destroy while logging out
		session_destroy();

		// Redirect to index page after logOut
		header('location:index.php');


	}




 ?>






<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $single_data['name']; ?></title>

	<!-- All CSS Files -->

	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	
</head>
<body>


<div class="student_form shadow-lg pb-5">
	<a href="students.php" class="btn btn-primary rounded-0">All Students</a>
	<div class="profile form p-3 text-white ">

		
		<img src="photo/students/<?php echo $single_data['photo']; ?>" alt="">
		<h2><?php echo $single_data['name']; ?></h2>

		<table class="profileTwo text-white">
			<tr>
				<td>name</td>
				<td><?php echo $single_data['name']; ?></td>
			</tr>

			<tr>
				<td>User Name</td>
				<td><?php echo $single_data['uname']; ?></td>
			</tr>

			<tr>
				<td>Email</td>
				<td><?php echo $single_data['email']; ?></td>
			</tr>

			<tr>
				<td>Cell</td>
				<td><?php echo $single_data['cell']; ?></td>
			</tr>

			<tr>
				<td>Gender</td>
				<td><?php echo $single_data['gender']; ?></td>
			</tr>

			<tr>
				<td>Age</td>
				<td><?php echo $single_data['age']; ?></td>
			</tr>

		</table>
		<a href="?logout_id=<?php echo $single_data['id']; ?>" class="btn btn-sm btn-primary text-white logout-btn rounded-0 p-2 mt-1">Logout</a>
	
	</div>
</div>






	<script src="assets/js/jquery-3.5.1.slim.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script>
		


	</script>


	
</body>
</html> 



