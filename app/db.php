

<?php 

	session_start();

	/** Database Conncection **/

	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$db = 'auth&crud_full';


	$way = new mysqli($host, $user, $pass, $db);


 ?>