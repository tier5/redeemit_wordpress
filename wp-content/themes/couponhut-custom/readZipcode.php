<?php
/*Template Name:AutoCompleteBox2
*/
?>
<?php
if(!empty($_POST["keyword2"]))
 { 
	
$keyword = $_POST["keyword2"];	
/*$query ="SELECT distinct(location) FROM users WHERE 
location like '" . $_POST["keyword2"] . "%' ORDER BY location 
LIMIT 0,6";*/
	
if (strpos($keyword, ',') !== FALSE)
{
 $cats_key = explode(",", $keyword);	
	$query_location =$wpdb->get_results("select distinct location,state FROM `users` where location like '$cats_key[0]%'  && status = 1 order by location LIMIT 0,2");
	
	$query_city =$wpdb->get_results("select distinct city,state FROM `users` where city like '$cats_key[0]%' && status = 1 order by  city LIMIT 0,2");	
	
	$query_state =$wpdb->get_results("select distinct state,state FROM `users` where state like '$cats_key[0]%' && status = 1 order by state LIMIT 0,2");	

	$query_zipcode =$wpdb->get_results("select distinct zipcode FROM `users` where zipcode like '$cats_key[0]%' && status = 1 order by zipcode LIMIT 0,2");	
	
}else {
	
	$query_location =$wpdb->get_results("select distinct location,state FROM `users` where location like '$keyword%' && status = 1 order by location LIMIT 0,2");	
	
	$query_city =$wpdb->get_results("select distinct city,state FROM `users` where city like '$keyword%' && status = 1 order by  city LIMIT 0,2");	
	
	$query_state =$wpdb->get_results("select distinct state FROM `users` where state like '$keyword%' && status = 1 order by state LIMIT 0,2");	

	$query_zipcode =$wpdb->get_results("select distinct zipcode FROM `users` where zipcode like '$keyword%' && status = 1 order by zipcode LIMIT 0,2");	
	
}
	

	
		

$result = $wpdb->get_results($query);
/*if(!empty($result)) 
{ ?>

<ul id="zipcode-list">
<?php foreach($result as $user) { ?> 
<li onClick="selectZipcode('<?php echo $user->location; ?>', '<?php echo $user->id; ?>');"><?php echo $user->location; ?></li>
<?php } ?>
</ul> 
<?php }
 }*/



$data['loc_data']='';
/*if(!empty($result)) 
{ echo($result->id);
*/
$data['loc_data'] .='<ul id="loc_list_id" class="loc-list">';
foreach($query_city as $loc_city) { 	

$location= "'".$loc_city->city.",".$loc_city->state."'";
$user_id= "'".$loc->id."'";
	if($loc_city->state != '') {
		$data['loc_data'].='<li class="" onClick="selectZipcode('.$location.','.$user_id.');">'.$loc_city->city.",".$loc_city->state."</li>";
	}else {
		$data['loc_data'].='<li class="" onClick="selectZipcode('.$location.','.$user_id.');">'.$loc_city->city."</li>";
	}
 } 
 
 foreach($query_state as $loc_state) { 	

 
$location= "'".$loc_state->state."'";
$user_id= "'".$loc->id."'"; 
	 $data['loc_data'].='<li class="" onClick="selectZipcode('.$location.','.$user_id.');">'.$loc_state->state."</li>";
	 
 } 
 
 foreach($query_zipcode as $loc_zipcode) { 	

$location= "'".$loc_zipcode->zipcode."'";
$user_id= "'".$loc->id."'";
$data['loc_data'].='<li class="" onClick="selectZipcode('.$location.','.$user_id.');">'.$loc_zipcode->zipcode."</li>";
 } 
 
 foreach($query_location as $loc_location) { 	

$location= "'".$loc_location->location.",".$loc_location->state."'";
$user_id= "'".$loc->id."'";
	 if($loc_location->state != '') {
		$data['loc_data'].='<li class="" onClick="selectZipcode('.$location.','.$user_id.');">'.$loc_location->location.",".$loc_location->state."</li>";
	 }else {
		$data['loc_data'].='<li class="" onClick="selectZipcode('.$location.','.$user_id.');">'.$loc_location->location."</li>"; 
	 }
 } 
$data['loc_data'].='</ul>'; 

//}
 $data['search_key'] = $_POST["keyword2"];
	
	
}
echo json_encode($data);exit;
?>
