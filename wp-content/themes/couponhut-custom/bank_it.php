<?php
/* Template Name: Bank It
*/
if(isset($_POST) && !empty($_POST))
{$user_id = $_POST['user_id'];
 $offer_id = $_POST['offer_id'];
 $query_builder = "SELECT * FROM `reedemer_offer` WHERE `id` = $offer_id";
 $query_builder = $wpdb->get_results($query_builder ,ARRAY_A);
 foreach ($query_builder as  $bank_val)
  {
	$offer_val_after=$bank_val['validate_after'];
	 
	$time=strtotime("+{$offer_val_after} hours"); 
	$final=date("Y-m-d H:i:s",$time); 
	$new_query = "SELECT * FROM `reedemer_user_bank_offer` WHERE `offer_id` = $offer_id && `user_id`= $user_id";
	$new_query = $wpdb->get_results($new_query ,ARRAY_A);
	$new_count= count($new_query);
	
	if ($new_count == 0){
			$current_time=date('Y-m-d H:i:s');	
			$newquery_builder = "INSERT INTO `reedemer_user_bank_offer`(`user_id`, `offer_id`, `validate_after`, `created_at`) 
			VALUES ('$user_id','$offer_id','$final','$current_time')"; 
			$wpdb->query($newquery_builder);
			 $count_qury= "SELECT * FROM `reedemer_user_bank_offer` WHERE `offer_id`= $offer_id && `status`= '1'";
			 $saved_count_qury = $wpdb->get_results($count_qury ,ARRAY_A);
			 $new_saved_count= count($saved_count_qury);
			 $data['new_saved_count'] = $new_saved_count." Saved It"; 
			 $data['status_result'] = 'R01001';
	}
		else
	{
		$data['status_result'] = 'R01002';	
	}
		$data["post_data"] = $_POST;
	echo json_encode($data);
  }
}	
?>
