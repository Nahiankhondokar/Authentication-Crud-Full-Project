<?php include_once "app/autoload.php"; ?>


<?php 

  // Data taking from URL for DELETE button

  if ( isset($_GET['delete_id'])) {
    
      $delete_id = $_GET['delete_id'];
      $delete_photo = $_GET['delete_photo'];

      $sql = "DELETE FROM users WHERE id='$delete_id' ";

      $way ->query($sql);

      // Photo Delete
      unlink('photo/students/' . $delete_photo);

      header('location:students.php');

  }



  // Data taking for URL for ACTIVE , INACTIVE button

  // Active user

  if ( isset($_GET['active_id'])) {
    
      $active_id = $_GET['active_id'];

      $sql = "UPDATE users SET status='agree'  WHERE id='$active_id' ";

      $way ->query($sql);

      header('location:students.php');

  }

  // Inactive user

   if ( isset($_GET['inactive_id'])) {
    
      $inactive_id = $_GET['inactive_id'];

      $sql = "UPDATE users SET status='disagree'  WHERE id='$inactive_id' ";

      $way ->query($sql);

      header('location:students.php');

  }










 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Class 14</title>

  <!-- All CSS Files -->

  <link rel="stylesheet" href="assets/fonts/font-awesome/css/all.css">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">

	
</head>
<body>


<div class="container shadow-lg p-3 mt-5 mb-3">
  <div class="students-table mt-5">
    <div class="row">
      <div class="col-md-12">
        

        <div class="table">
          <div class="student-top">
            <h2 class="p-3 text-white">All Students</h2>
            <a href="profile.php" class="btn p-2 text-white ">Your profile</a>
          </div>
         
          <div class="full-table">
            

          <table class="table-striped shadow-lg w-100 text-white mt-0">
            
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Cell</th>
                <th scope="col">Gender</th>
                <th scope="col">Location</th>
                <th scope="col">Photo</th>
                <th scope="col">Action</th>
              </tr>
            </thead>

            <tbody>

              <?php 

              $sql = "SELECT * FROM users";
              $data = $way -> query($sql);

              $i = 1;

              while ( $all_data = $data -> fetch_assoc() ) :


               ?>

              <tr>
                <td scope="row"><?php echo $i++; ?></td>
                <td><?php echo $all_data['name']; ?></td>
                <td><?php echo $all_data['email']; ?></td> 
                <td><?php echo $all_data['cell']; ?></td>
                <td><?php echo $all_data['gender']; ?></td>
                <td><?php echo $all_data['location']; ?></td>
                <td>

                  <?php if($all_data['status']=='agree') : ?>

                  <img style="border-radius: 50%; border:3px solid green;" src="photo/students/<?php echo $all_data['photo']; ?>" alt="">

                  <?php elseif($all_data['status']=='disagree') : ?>

                     <img style="border-radius: 50%; border:3px solid red;" src="photo/students/<?php echo $all_data['photo']; ?>" alt="">


                  <?php endif; ?>


                </td>
                <td>


                  <?php if( $all_data['id'] == $_SESSION['user_id'] ) : ?>



                         <!-- Active, Inactive -->
                      <?php if($all_data['status']=='agree') : ?>

                        <a href="?inactive_id=<?php echo $all_data['id']; ?>" class="btn btn-danger"><i class="far fa-thumbs-down"></i></a>

                      <?php elseif($all_data['status']=='disagree') : ?>

                        <a href="?active_id=<?php echo $all_data['id']; ?>" class="btn btn-success"><i class="far fa-thumbs-up"></i></a>

                      <?php endif; ?>




                      <!-- Edit -->
                      <a href="edit.php?edit_id=<?php echo $all_data['id']; ?>" class="btn btn-warning"><i class="far fa-edit"></i></a>

                      <!-- Delete-->
                      <a id="alert-msg" href="?delete_id=<?php echo $all_data['id']; ?>&delete_photo=<?php echo $all_data['photo']; ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>




                  <?php else :?>


                      <!-- View -->
                      <a href="user_profile.php?profile_id=<?php echo $all_data['id']; ?>" class="btn btn-info"><i class="fas fa-eye"></i></a>

                  <?php endif; ?>

                 

                </td>
              </tr>

                  <?php endwhile; ?>

            </tbody>
          </table>

          </div>

        </div>

      </div>
    </div>
  </div>
</div>









	<script src="assets/js/jquery-3.5.1.slim.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script>
		
    // Alert popup system for data Delete

    $('#alert-msg').click(function(){

      let conf = confirm('Are you sure ?');

      if ( conf == true ) {
        return true;
      }else{
        return false;
      }

    });



	</script>



</body>
</html>









