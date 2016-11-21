<?php
/* Template Name: Deal Left Category Template
*/
global $wpdb; 
		 
		$default_loc = $_POST['default_location'];
		$open_cat = $_POST['cat_id'];
		/*if (!is_numeric($default_loc)) {
		$default_loc = explode(',',$default_loc);
		$default_loc = $default_loc[0];
		}*/
		$min_distance = 150;

		$address_dis = $default_loc;
		$latLong = getLatLong($address_dis);
		$lat_dis = $latLong['latitude'];
		$lon_dis = $latLong['longitude'];
 
	$main_catagory = "select id,parent_id,cat_name from reedemer_category where status = 1 && visibility = 1 && parent_id = 0";
	$main_catagory_data = $wpdb->get_results($main_catagory ,ARRAY_A);
	if(count($main_catagory_data) > 0)
		{
				
		}
		$data['list_cat_data']='';
		//$data['list_cat_data'].='<ul id="cat_data" curr_cat_id="-" curr_sub_cat_id="-" curr_sub_sub_cat_id="-">';
		foreach($main_catagory_data as $category)
			{ 
			echo($category->id);
			
			$total_dat = "select *,SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer where cat_id = ".$category['id']." &&  status = 1 && published= true && end_date >= CURDATE() group by created_by HAVING distance < $min_distance";
			$total_dat_count = $wpdb->get_results($total_dat ,ARRAY_A);
			$total_count = count($total_dat_count);
			$data['list_cat_data'].="<li>  <a href='#' class='catagory_section cat' cat_id=".$category['id']." >".$category['cat_name']."(".$total_count.")</a>";
					$sub_catagory = "select * from reedemer_category where status = 1 && visibility = 1 && parent_id = ".$category['id'];
					$sub_catagory_data = $wpdb->get_results($sub_catagory ,ARRAY_A);
					
							if(count($sub_catagory_data) > 0){
								if ($open_cat==$category['id']){
								$data['list_cat_data'].='<ul class="subcat-dropdown openSubcat">';
								}
								else{$data['list_cat_data'].='<ul class="subcat-dropdown ">';}
						foreach($sub_catagory_data as $new_sub_category){
								$total_subcat_dat = "select *,SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer where cat_id = ".$category['id']." && subcat_id = ".$new_sub_category['id']." && status = 1 && published= true group by created_by HAVING distance < $min_distance";
								$total_subcat_dat_count = $wpdb->get_results($total_subcat_dat ,ARRAY_A);
								$total_subcat_count = count($total_subcat_dat_count);	
								$data['list_cat_data'].= '<li ><a href="#" class="catagory_section sub_cat" cat_id="'.$category['id'].'"  sub_cat_id="'.$new_sub_category['id'].'" >'.$new_sub_category['cat_name'].'('.$total_subcat_count.')</a>'; 
								$data['list_cat_data'].='<ul class="sub-subcat-dropdown">';
										$sub_cat_id = $new_sub_category['id'];
										$sub_sub_cats = $wpdb->get_results("SELECT * FROM reedemer_category where parent_id = ".$sub_cat_id."&& status = 1 && visibility = 1");
										foreach($sub_sub_cats  as $sub_sub_cat) {
											$sub_sub_cat_id = $sub_sub_cat->id;
											$sub_sub_cat_name= $sub_sub_cat->cat_name;
											//$sub_pr_num = $wpdb->get_results("SELECT * FROM reedemer_offer_categories WHERE cat_id=$sub_sub_cat_id");
											$sub_pr_num = $wpdb->get_results("select ro.*,of_cat.*, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from `reedemer_offer` as ro INNER JOIN reedemer_offer_categories as of_cat on ro.id = of_cat.offer_id where ro.status = 1 && ro.published = 'true' && of_cat.cat_id = ".$sub_sub_cat_id." && ro.end_date >= CURDATE() group by created_by HAVING distance < $min_distance ");
											
											$data['list_cat_data'].= '<li><a href="#" class="catagory_section sub_sub_cat" cat_id="'.$category['id'].'"  sub_cat_id="'.$new_sub_category['id'].'" sub_sub_cat_id ="'.$sub_sub_cat_id.'"  >'.$sub_sub_cat->cat_name.'('.count($sub_pr_num).')</a></li>';
										}
									$data['list_cat_data'].= '</ul>';
								$data['list_cat_data'].='</li>';
							}
							$data['list_cat_data'].='</ul>';
							}
					$data['list_cat_data'].='</li>';
          }
             //$data['list_cat_data'].='</ul>';
              echo json_encode($data);
?>
