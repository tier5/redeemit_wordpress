<?php
/* Template Name: User Login
*/

if(isset($_POST) && !empty($_POST))
{
	global $wpdb;
	
	$email = $_POST['email'];
	$pass = $_POST['password'];
	
	
	$user = get_user_by( 'email', $email );
	
	
	if(!email_exists($email)){
		
		echo 'R01002';
	}else if($user && !wp_check_password( $pass, $user->data->user_pass, $user->ID)){
		echo 'R01003';
	}else{
	
	$creds = array();
	$creds['user_login'] = $email;
	$creds['user_password'] = $pass;
	$creds['remember'] = true;
	$user = wp_signon( $creds, false );
	echo 'R01001';
	}
	
	
	exit;
	
}
?>
