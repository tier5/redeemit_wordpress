<?php
/* Template Name: Pay It
*/
if(isset($_POST) && !empty($_POST))
{

if(!is_user_logged_in()){
	$data['login_url'] = site_url().'/index.php/signin';
	$data['status_result'] = 'R01002';
}else{
 $user_id = $_POST['user_id'];
 $offer_id = $_POST['offer_id'];
 $query_builder = "SELECT * FROM `reedemer_offer` WHERE `id` = $offer_id";
 $query_builder = $wpdb->get_results($query_builder ,ARRAY_A);

 foreach ($query_builder as  $bank_val)
  {
	$offer_val_after=$bank_val['validate_after'];
	$current_time=date('Y-m-d H:i:s'); 
	$time=strtotime("+{$offer_val_after} hours"); 
	$final=date("Y-m-d H:i:s",$time); 
	 $amount = $bank_val['pay_value'];
	 $redeemar_id = $bank_val['created_by'];
	$new_query = "SELECT * FROM `reedemer_user_bank_offer` WHERE `offer_id` = $offer_id && `user_id`= $user_id";
	$new_query = $wpdb->get_results($new_query ,ARRAY_A);
	$new_count= count($new_query);
	
	if ($new_count == 0){
			$current_time=date('Y-m-d H:i:s');	
			$newquery_builder = "INSERT INTO `reedemer_user_bank_offer`(`user_id`, `offer_id`,`redeemar_id`,`validate_within`,`validate_after`,`created_at`,`updated_at`,`paid_amount`) 
			VALUES ($user_id,$offer_id,$redeemar_id,'$current_time','$final','$current_time','$current_time',$amount)";
		
		
			$wpdb->query($newquery_builder);
			 $count_qury= "SELECT * FROM `reedemer_user_bank_offer` WHERE `offer_id`= $offer_id && `status`= '1'";
			 $saved_count_qury = $wpdb->get_results($count_qury ,ARRAY_A);
			 $new_saved_count= count($saved_count_qury);
			 
	}
	 
		$data['payment_url'] = site_url().'/index.php/payment?off_id='.base64_encode($offer_id);
		$data['status_result'] = 'R01001';
		$data["post_data"] = $_POST;
		
  }
}
	echo json_encode($data);
}
 
	
?>
