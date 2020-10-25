<?php 



	/**
	 *  Validation message
	 */


	function validate($text, $color_type = 'danger'){

		return "<p class='alert alert-$color_type'>$text !<button class='close' data-dismiss='alert'>&times;</button></p>";
	}



	/**
	 * Database Control (Data insert)
	 */


	function insert($sql){

		global $way;
		$way -> query($sql);

	}



	// Single data checking

	function valueCheck($table, $coloum, $value){

		global $way;

		$sql = "SELECT $coloum FROM $table WHERE $coloum='$value' ";
		$data = $way -> query($sql);
		return $data -> num_rows;

	}
	






 ?>