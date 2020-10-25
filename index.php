<?php include_once "app/autoload.php"; ?>


<?php 

	// You can not access index page while you are loged in

	if( isset($_SESSION['user_id']) ){

		header('location:profile.php');
	}
	

	// we can directly access profile page after reopening browser

	if ( isset($_COOKIE['user_login_id']) ) {
		
		$id = $_COOKIE['user_login_id'];

		$sql = "SELECT * FROM users WHERE id='$id'";
		$data = $way -> query($sql);

		$user_login_data = $data -> fetch_assoc();


		$_SESSION['user_id'] = $user_login_data['id'];

		// Redirect to profile page while reopening browser

		header('location:profile.php');

	}



	// login form recent login users

	if ( isset($_GET['login_id'])) {
		
		$login_id = $_GET['login_id'];

		$sql = "SELECT * FROM users WHERE id='$login_id' ";
		$info = $way -> query($sql);

		$single_info = $info -> fetch_assoc();

		$_SESSION['user_id'] = $single_info['id'];

		header('location:profile.php');


	}



 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<title>Auth & Crud Full</title>
</head>
<body>



<?php 

	/**
	 *  From isseting
	 */
	
	if ( isset($_POST['submit'])) {
		
		//Get values

		$login = $_POST['login'];
		$user_pass = $_POST['pass'];



		/**
		 *  From Validation
		 */

		if ( empty($login) || empty($user_pass) ) {
			
			$mess = validate('All feilds are required');
		}else{

			// Email Checking

			$sql = "SELECT * FROM users WHERE email='$login' OR uname='$login' ";
			$data = $way -> query($sql);

			$login_data = $data -> num_rows;

			$login_info = $data -> fetch_assoc();

			

			if ( $login_data == 1 ) {
				
				// Password Checking

				if ( password_verify($user_pass, $login_info['pass']) ) {
					
					// keep the value in session memory

					$_SESSION['user_id'] = $login_info['id']; 

					// Setting cookies for getting profile after reopening browser

					setcookie('user_login_id', $login_info['id'] , time() + (60*60*24*30*12) );

					// Redirect to profile page after login
					header('location:profile.php');


				}else{

					$mess = validate('Wrong password');
				}

			}else{

				$mess = validate('Wrong user name or email');
			}

		}

	}




 ?>



<div class="container">
<form class="form text-black" method="POST">
	<div class="row top">
		<div class="col-md-6">
			<div class="student_form_left">
				<div class="recent-login">
					<h3>The Biggest Social Media is FaceBook.</h3><br>
					

					<!-- Title of recent login users -->

					<?php if( isset($_COOKIE['user_recent_login'])) : ?>

						<h3>Recent logIn users</h3>


					<?php endif; ?>

					

					<?php 


					// Showing Recent users here

					if ( isset($_COOKIE['user_recent_login'])) :
						
						$id = $_COOKIE['user_recent_login'];


						$sql = "SELECT * FROM users WHERE id IN($id)";
						$data = $way -> query($sql);



						while ( $recent_info = $data -> fetch_assoc() ) :
				
				

					 ?>
					
					
					<div class="card rl-item shadow-lg p-2">
						<img src="photo/students/<?php echo $recent_info['photo']; ?>" alt="">
						<h4><?php echo $recent_info['uname']; ?></h4>

						<div class="card-body">
							<a href="?login_id=<?php echo $recent_info['id']; ?>" name="recent_login" class="btn btn-sm btn-primary">Login</a>
						</div>
					</div>

				<?php endwhile; endif; ?>
			
				</div>
			</div>
		</div>
		

	

	
		<div class="col-md-6">
			<div class="student_form_right shadow-lg p-5">

				<!-- <form class="form px-5 py-5 text-black"> -->
					<h1 class="text-center font-weight-bold pb-2"> LogIn Here</h1>

					<?php include_once "templates/message.php"; ?>

				  <div class="form-group ">
				    <input name="login" type="text" class="form-control text-black h-25 p-2" placeholder="UserName or Email">
				  </div>

				  <div class="form-group ">
				    <input name="pass" type="password" class="form-control text-black h-25 p-2" placeholder="Password">
				  </div>

				  <button name="submit" type="submit" class="btn btn-primary bttn">LogIn</button>
				  
				  <div class="card-footer mt-4 border-white bg-white">
				  	<a class="card-link text-white btn btn-sm btn-success button" href="register.php">Create an account</a>
				  </div>
				<!-- </form> -->

			</div>
		</div>

	</div>
	
	
</form>
	
</div>






	<script src="assets/js/jquery-3.5.1.slim.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script>
		


	</script>


	
</body>
</html> 



