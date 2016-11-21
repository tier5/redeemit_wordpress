<?php
/*
*Template Name:User Register
*/
global $wpdb;
if(isset($_POST) && !empty($_POST))
{
	
	$first_name = $_POST['first_name'];
	$last_name = $_POST['lastname'];
	$email = $_POST['email'];
	$pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
	
	$status = 1;
	$approve = 1;
	$type = 3;
	
	
	
	$get_user_query = "SELECT * from users WHERE email='$email'";
	
	$get_user = $wpdb->get_results($get_user_query, ARRAY_N);
	
	
	
	
	if(is_array($get_user) && count($get_user) > 0){
		
		echo 'R01002';
		
	}else{
		
		
		
		$userdata = array(
         'user_login'  =>  $email,
         'user_email'    =>  $email,
         'user_pass'   =>  $_POST['password']  // When creating an user, `user_pass` is expected.
         );

         $user_id = wp_insert_user( $userdata ) ;
		 update_user_meta($user_id,'first_name',$first_name);
		 update_user_meta($user_id,'last_name',$last_name);
		
		if($user_id){
			$user_insert_query = "INSERT INTO `users`(`first_name`, `last_name`,`email`, `password`, `status`, `approve`, `type`) VALUES ('$first_name','$last_name','$email','$pass',$status,$approve,$type)";
			$wpdb->query($user_insert_query);
		}
		
		echo 'R01001';
		
	}
	
	exit;
	
}
?>
