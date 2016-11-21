<?php
/* Template Name: Pass It
*/
if(isset($_POST) && !empty($_POST))
{$user_id = $_POST['user_id'];
 $offer_id = $_POST['offer_id'];
 
	
	
	
	
			$current_time=date('Y-m-d H:i:s');	
			$newquery_builder = "INSERT INTO `reedemer_user_passed_offer`(`user_id`, `offer_id`, `created_at`, `updated_at`) 
			VALUES ('$user_id','$offer_id','$current_time','$current_time')"; 
			$wpdb->query($newquery_builder);
			$data['status_result'] = 'R01001';
	}
		else
	{
		$data['status_result'] = 'R01002';	
	}
	$data["post_data"] = $_POST;
	echo json_encode($data);
 
	
?>
