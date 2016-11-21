<?php 
/*Template Name:Home Map
*/

if($_COOKIE['location_input'] != '') {
	$default_loc = $_COOKIE['location_input'];
}else {
	$default_loc = 'Yonkers';
}
//
// SHOWING PARTNER LOGO

if (!is_numeric($default_loc)) {
	
$default_loc = explode(',',$default_loc);
	$default_loc = $default_loc[0];	
}

$address_dis = $default_loc;
$latLong = getLatLong($address_dis);
$lat_dis = $latLong['latitude'];
$lon_dis = $latLong['longitude'];

if(isset($_POST['user_id']) && !empty($_POST['user_id']) && $_POST['user_id'] != "-"){
	
	$cat_id = $_POST['user_id'];
	
	$query_builder = "SELECT ro.*, rp.price_range_id, rp.status, rp.created_by, usr.location,usr.membership_level FROM reedemer_offer AS ro INNER JOIN reedemer_partner_settings AS rp ON ro.created_by = rp.created_by INNER JOIN users AS usr ON usr.id = ro.created_by  WHERE ro.status = 1 && ro.published = 'true'";
	
	
	
	$query_builder = $wpdb->get_results($query_builder ,ARRAY_A);	
	
	
	$marker = array();
	
	if(count($query_builder) > 0)
	{
		$result["status"] = "true";
		$result["res_data"] = "";
		
foreach ($query_builder as  $val1) {
	
	/*========Marker===================*/
	
	
	if($val1['membership_level'] == 5 && $val1['created_by'] == $cat_id ) {
		$client_id = $val1['created_by'];
		$get_icons = $wpdb->get_results("SELECT * FROM `reedemer_logo` WHERE id = $client_id");
		if($get_icons > 0) {
			foreach($get_icons as $get_icon) {
				if($get_icon->logo_name != ''){
					$icon = site_url()."/admin/uploads/thumb/".$get_icon->logo_name;					
				}else {
					$icon = "http://labs.google.com/ridefinder/images/mm_20_red.png";
				}
			}
		}else {
			$icon = "http://maps.google.com/mapfiles/ms/micons/blue.png";
		}
	}else {
		$icon = "http://maps.google.com/mapfiles/ms/micons/green.png";
	}
	
	$lat= $val1['latitude']; //latitude
	$lng= $val1['longitude']; //longitude
	
	array_push($marker,array('lat' => $lat,'lng' => $lng, 'icon' => $icon,'cent_lat' => "$lat_dis",'cent_lon' => "$lon_dis"));
		
		
		
		
		$result['marker'] = $marker;
}
	
	}else
	{
		$result["status"] = "false";
		$result["res_data"] ="";
		$result["res_data"].= "<h2>Sorry No Data are available</h2>";
	}
	$result["post_data"] = $_POST;
	echo json_encode($result);
	
}else {
		$query_builder = "SELECT ro.*, rp.price_range_id, rp.status, rp.created_by, usr.location,usr.membership_level FROM reedemer_offer AS ro INNER JOIN reedemer_partner_settings AS rp ON ro.created_by = rp.created_by INNER JOIN users AS usr ON usr.id = ro.created_by  WHERE ro.status = 1 && ro.published = 'true'";

	
	$query_builder = $wpdb->get_results($query_builder ,ARRAY_A);	
	
	
	$marker = array();
	
	if(count($query_builder) > 0)
	{
		$result["status"] = "true";
		$result["res_data"] = "";
		
foreach ($query_builder as  $val1) {
	
	/*========Marker===================*/
	
	
	//$result['marker'] .=array_push($marker,$val1['latitude'],$val1['longitude']);
	
	$lat= $val1['latitude']; //latitude
	$lng= $val1['longitude']; //longitude	
	$client_id = $val1['created_by'];
	
	if($val1['membership_level'] == 5) {
		$client_id = $val1['created_by'];
		$get_icons = $wpdb->get_results("SELECT * FROM `reedemer_logo` WHERE id = $client_id");
		if($get_icons > 0) {
			foreach($get_icons as $get_icon) {
				if($get_icon->logo_name != ''){
					$icon = site_url()."/admin/uploads/thumb/".$get_icon->logo_name;					
				}else {
					$icon = "http://labs.google.com/ridefinder/images/mm_20_red.png";
				}
			}
		}else {
			$icon = "http://maps.google.com/mapfiles/ms/micons/blue.png";
		}
	}else {
		$icon = "http://maps.google.com/mapfiles/ms/micons/green.png";
	}

	array_push($marker,array('lat' => $lat,'lng' => $lng, 'icon' => $icon));
		
		
		//$result["res_data"] .= "SELECT * FROM `reedemer_logo` WHERE id = $client_id";
	
		$result["res_data"] = $lat_dis.','.$lon_dis;
		
		$result['marker'] = $marker;
}
	
	}else
	{
		$result["status"] = "false";
		$result["res_data"] ="";
		$result["res_data"].= "<h2>Sorry No Data are available</h2>";
	}
	$result["post_data"] = $_POST;
	echo json_encode($result);
	
}

?>
