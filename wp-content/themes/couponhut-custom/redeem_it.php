<?php
/* Template Name: Redeem It
*/
if(isset($_POST) && !empty($_POST))
{$user_id = $_POST['user_id'];
 $offer_id = $_POST['offer_id'];
 $query_builder = "SELECT * FROM `reedemer_offer` WHERE `id` = $offer_id";
 $query_builder = $wpdb->get_results($query_builder ,ARRAY_A);
 foreach ($query_builder as  $bank_val)
  {
	//$offer_val_after=$bank_val['validate_after'];
	 
	//$time=strtotime("+{$offer_val_after} hours"); 
	//$final=date("Y-m-d H:i:s",$time); 
	$new_query = "SELECT * FROM `reedemer_user_bank_offer` WHERE `offer_id` = $offer_id && `user_id`= $user_id";
	$new_query = $wpdb->get_results($new_query ,ARRAY_A);
	$new_count= count($new_query);
	foreach ($new_query as $offer_id_val){
	$banked_offer_id= $offer_id_val['id'];	
	}
  
	if ($new_count > 0){
		$banked_offer_id;
		$current_time=date('Y-m-d H:i:s');	
			$newquery_builder = "UPDATE `reedemer_user_bank_offer` SET `status`='0' WHERE `id`=$banked_offer_id"; 
			$wpdb->query($newquery_builder);
			$count_qury= "INSERT INTO `reedemer_redeemption`(`user_id`, `offer_id`, `created_at`, `updated_at`) VALUES ('$user_id', '$offer_id', '$current_time', '$current_time')";
			 $wpdb->query($count_qury);
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
