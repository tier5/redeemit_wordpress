<?php
/* Template Name: Home Search Template
*/

global $wpdb; 

if($_COOKIE['location_input'] != '') {
	$default_loc = $_COOKIE['location_input'];
}else if(isset($_POST['location']))  {
	$default_loc = $_POST['location'];
}else {
	$default_loc = 'Yonkers';
}

/*if (!is_numeric($default_loc)) {
	
$default_loc = explode(',',$default_loc);
	$default_loc = $default_loc[0];	
}*/

$min_distance = 150;

$address_dis = $default_loc;
$latLong = getLatLong($address_dis);
$lat_dis = $latLong['latitude'];
$lon_dis = $latLong['longitude'];


/*==============Food Category================*/


  $TabcatName2 =  "SELECT id, cat_name, status, visibility FROM reedemer_category WHERE status='1' AND parent_id='0' AND id='44' && status = 1 && visibility = 1";
$CategoryTab2 = $wpdb->get_results($TabcatName2);

$offers_recordbycat2="select max(id) as id, distance from (select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer where cat_id = 44 && status = 1 && published = 'true' && end_date >= CURDATE()) x group by`created_by` HAVING distance < $min_distance order by distance ASC LIMIT 3";

$offers_databycat2 = $wpdb->get_results($offers_recordbycat2);

/*==========Partner========*/

$partner =  "SELECT ro.*, rp.created_by, ru.* FROM users AS ru, reedemer_partner_settings AS rp, reedemer_offer AS ro WHERE ru.id=rp.created_by AND ru.id=ro.created_by AND ru.type='2' ORDER BY RAND() ";

$partner_offers = $wpdb->get_results($partner);



/*========Travel Category============*/

$tavelTab3 =  $wpdb->get_results("SELECT id, cat_name, status, visibility FROM reedemer_category WHERE status='1' AND parent_id='0' AND id='72' && status = 1 && visibility = 1");

$tavel_recordbycat5="select max(id) as id, distance from (select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer where cat_id = 72 && status = 1 && published = 'true' && end_date >= CURDATE()) x group by`created_by` HAVING distance < $min_distance order by distance ASC LIMIT 4";

$tavel_recordbycat5 = $wpdb->get_results($tavel_recordbycat5);


/*========Health & Fitness Category============*/

$popular_cats =  $wpdb->get_results("SELECT id, cat_name, status, visibility FROM reedemer_category WHERE status='1' AND parent_id='0' AND id='193' && status = 1 visibility = 1");

$popular_data ="select max(id) as id, distance from (select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer where cat_id = 193 && status = 1 && published = 'true' && end_date >= CURDATE()) x group by`created_by` HAVING distance < $min_distance order by distance ASC LIMIT 4";

$popular_datas = $wpdb->get_results($popular_data);

/*========Shopping Category============*/

$entertainment_cats =  $wpdb->get_results("SELECT id, cat_name, status, visibility FROM reedemer_category WHERE status='1' AND parent_id='0' AND id='88' && status = 1 && visibility = 1");

$entertainment_data ="select max(id) as id, distance from (select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer where cat_id = 88 && status = 1 && published = 'true' && end_date >= CURDATE()) x group by`created_by` HAVING distance < $min_distance order by distance ASC LIMIT 4";
//echo $entertainment_data;exit();
$entertainment_datas = $wpdb->get_results($entertainment_data);


/*========BAR & TREND Category============*/

$bar_cats =  $wpdb->get_results("SELECT id, cat_name, status, visibility FROM reedemer_category WHERE status='1' AND parent_id='0' AND id='56' && status = 1 && visibility = 1");

$bar_data ="select max(id) as id, distance from (select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer where cat_id = 56 && status = 1 && published = 'true' && end_date >= CURDATE()) x group by`created_by` HAVING distance < $min_distance order by distance ASC LIMIT 4";

$bar_datas = $wpdb->get_results($bar_data);

/*========Beauty & Spas Category============*/

$beauty_cats =  $wpdb->get_results("SELECT id, cat_name, status, visibility FROM reedemer_category WHERE status='1' AND parent_id='0' AND id='34' && status = 1 && visibility = 1");

$beauty_data ="select max(id) as id, distance from (select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer where cat_id = 34 && status = 1 && published = 'true' && end_date >= CURDATE()) x group by`created_by` HAVING distance < $min_distance order by distance ASC LIMIT 4";

$beauty_datas = $wpdb->get_results($beauty_data);

/*========Sporting Goods Category============*/

$sport_cats =  $wpdb->get_results("SELECT id, cat_name, status, visibility FROM reedemer_category WHERE status='1' AND parent_id='0' AND id='64' && status = 1 && visibility = 1");

$sport_data ="select max(id) as id, distance from (select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer where cat_id = 64 && status = 1 && published = 'true' && end_date >= CURDATE()) x group by`created_by` HAVING distance < $min_distance order by distance ASC LIMIT 4";

$sport_datas = $wpdb->get_results($sport_data);


/*========Automotive Category============*/

$auto_cats =  $wpdb->get_results("SELECT id, cat_name, status, visibility FROM reedemer_category WHERE status='1' AND parent_id='0' AND id='24' && status = 1 && visibility = 1");

$auto_data ="select max(id) as id, distance from (select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer where cat_id = 24 && status = 1 && published = 'true' && end_date >= CURDATE()) x group by`created_by` HAVING distance < $min_distance order by distance ASC LIMIT 4";

$auto_datas = $wpdb->get_results($auto_data);

/*========Things To Do Category============*/

$things_cats =  $wpdb->get_results("SELECT id, cat_name, status, visibility FROM reedemer_category WHERE status='1' AND parent_id='0' AND id='196' && status = 1 && visibility = 1");

$things_data ="select max(id) as id, distance from (select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer where cat_id = 196 && status = 1 && published = 'true' && end_date >= CURDATE()) x group by`created_by` HAVING distance < $min_distance order by distance ASC LIMIT 4";

$things_datas = $wpdb->get_results($things_data);

/*========Retail & Services Category============*/

$retail_cats =  $wpdb->get_results("SELECT id, cat_name, status, visibility FROM reedemer_category WHERE status='1' AND parent_id='0' AND id='195' && status = 1 && visibility = 1");

$retail_data ="select max(id) as id, distance from (select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer where cat_id = 195 && status = 1 && published = 'true' && end_date >= CURDATE()) x group by`created_by` HAVING distance < $min_distance order by distance ASC LIMIT 4";

$retail_datas = $wpdb->get_results($retail_data);

$video_args = array(
'post_type' => 'homevideos',
'posts_per_page' => 1,
'order_by' => 'date',
'order' => 'DESC',
'tax_query' => array(
array(
'taxonomy' => 'category',
'field' => 'slug',
'terms' => 'home-single-video',
),
),
);

$video_query = new WP_Query($video_args);

$result["res_data"] = '';

//$result["res_data"] .=$offers_recordbycat2;

if(count($CategoryTab2) > 0) { 
 $result["res_data"].= '<div class="section-most-banked">
        <div class="row">
            <div class="col-md-12 nopadding">';
                 foreach($CategoryTab2 as $cattab2){
                $result["res_data"].= '<h2>'.$cattab2->cat_name.'</h2>';
                 } 
                $result["res_data"].= '<a href="'.home_url().'/index.php/deals/?cat_id='.$cattab2->id.'" class="viewall">view all</a>';


					foreach($offers_databycat2 as $offers_cat2s) { 
						
					$total_res = $wpdb->get_results("SELECT * FROM `reedemer_offer` where id = '".$offers_cat2s->id."'");						
					foreach($total_res as $offers_cat2){ 	

					$today12 = date('Y-m-d');
					//echo $today;
					$exp_date12 = $offers_cat2->end_date; 
					$expiry12 = new DateTime($exp_date12);
					$ex_date12 = $expiry12->format('Y-m-d');
					//echo $ex_date;

    			

                $result["res_data"].= '<div class="col-md-3 col-sm-3 product-view">';  
                
                $result["res_data"].= '<a href="'.home_url().'/index.php/deal-details/?offer='.$offers_cat2->id.'"><div class="home-page-deal-pic">';
          		$result["res_data"].= '<div class="home-page-deal-pic">';
				$img_logo = $wpdb->get_results("select logo_name from reedemer_logo where reedemer_id = '".$offers_cat2->created_by."' && default_logo = 1");
				foreach($img_logo as $new_img_logo){
					$new_pic_logo=$new_img_logo->logo_name;
								$str = $new_pic_logo;
								$tes = explode(".",$str);
								if($tes[1]=='jpg'){$final_logo_image= $tes[0].".png";}
								else{$final_logo_image=$new_pic_logo ;}				
				$result["res_data"].='<span class="deal-d-float2"><img src="'.home_url().'/filemanager/userfiles/medium/'.$final_logo_image.'" alt="img"></span>';
				}
				$img_explod = explode('/',$offers_cat2->offer_medium_image_path);
				if($img_explod[0] == 'http:'){
				  $img_offers = $offers_cat2->offer_medium_image_path;
				}else {                 
				  $img_offers = home_url().'/'.$offers_cat2->offer_medium_image_path;
				}
						
				  if($offers_cat2->on_demand == 1) {
						$result["res_data"].= '<div class="ondemand">on demand</div>';
					}
          
          
                    $result["res_data"].= '<img src="'.$img_offers.'" alt="img01" class="img-responsive" /></div>';
						$result["res_data"].='</div>';
                    $result["res_data"].= '<div class="banked-product">
                        <div class="product-title">';
        		if(strlen($offers_cat2->offer_description) > 55) { 
                $desc = substr($offers_cat2->offer_description,0,55)."....";
              } else { 
                $desc = $offers_cat2->offer_description;
              } 
						$result["res_data"].= $desc;
      			$result["res_data"].= '</div>
                        <div class="product-savings">';
            
                //echo "SELECT * FROM `reedemer_offer` WHERE id = $offers->id";
                $offer_prc = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE id = $offers_cat2->id && status = 1");
              foreach($offer_prc as $off_prc){

				               
                $offer_lat = $off_prc->latitude;
                $offer_lon = $off_prc->longitude;
				$cmp_id = $off_prc->created_by; 
				  
             

              
              $result["res_data"].= '<span class="savings">';
                $offer_mode= $off_prc->value_calculate;
										if ($offer_mode=='2') {
										$prc_val = ($off_prc->pay_value/$off_prc->retails_value); 
										$percent_friendly = number_format( $prc_val * 100, 2 ) . '%';
										$tot_per = round(100 - $percent_friendly);	
										$offer_type= $off_prc->value_text;
										$offer_mode= $off_prc->value_calculate;
										if ($offer_type=='1'){$offer_type_value='OFF';}
										elseif ($offer_type=='2'){$offer_type_value='DISCOUNT';}
										elseif ($offer_type=='3'){$offer_type_value='SAVINGS';}
										else{$offer_type_value='OFF';}
										//echo $tot_per."%".$offer_type_value;
										$result["res_data"].= $tot_per."% ".$offer_type_value;
										}
										else{
										$prc_val = ($off_prc->retails_value - $off_prc->pay_value); 
										$tot_per = round($prc_val);	
										$offer_type= $off_prc->value_text;
										$offer_mode= $off_prc->value_calculate;
										if ($offer_type=='1'){$offer_type_value='OFF';}
										elseif ($offer_type=='2'){$offer_type_value='DISCOUNT';}
										elseif ($offer_type=='3'){$offer_type_value='SAVINGS';}
										else{$offer_type_value='OFF';}
										//echo "$".$tot_per."".$offer_type_value;
										$result["res_data"].= "$".$tot_per." ".$offer_type_value;
										}	  
              $result["res_data"].= '</span>
              <span class="pricesection">
                <color>$'.$off_prc->retails_value.'</color>';
                $result["res_data"].= '$'.$off_prc->pay_value;
              $result["res_data"].= '</span>';


              }
               $result["res_data"].= '</div>
                        <div class="col-expires">
                           <img src="'.get_template_directory_uri().'/images/location.png" alt="location" class="img-responsive" />';
						
                $cmp_nam = $wpdb->get_results("SELECT `location` FROM `users` WHERE id = $cmp_id");       
                foreach($cmp_nam as $cmp_nms) {         
                  $result["res_data"].= $cmp_nms->location." (";  
                }             
                if($default_loc != ''){
                  
					$address = $default_loc;
					$latLong = getLatLong($address);
					$lat = $latLong['latitude'];
					$lon = $latLong['longitude'];
					
                  /*$loc_id = $default_loc; 
                  $deal_id = $offers_cat2->id;
                  $loc_defs = $wpdb->get_results("SELECT usr.location,usr.lat,usr.lng FROM users AS usr INNER JOIN reedemer_offer AS ro ON ro.created_by = usr.id WHERE usr.location = '$loc_id' && ro.id = '$deal_id'");
                  foreach($loc_defs as $loc_def){
                    $lat = $loc_def->lat;
                    $lon = $loc_def->lng;
                  }*/
                  
                }else {
                  
                  $lat = "40.9312099";
                  $lon = "-73.89874689999999";
                }
                $result["res_data"].= floor(distance($lat, $lon, $offer_lat, $offer_lon, "M"))." Miles)";
                 $result["res_data"].= '       </div>
                    </div>
                </a>
                

                </div>';	
					}

 				} 
				$result["res_data"].= '<div class="col-md-3 col-sm-3 product-view" style="float:right;">
					<a href="'.home_url().'/admin/public/index.php/partner">
						<img src="'.get_template_directory_uri().'/images/most-pop-third.jpg" alt="img01" class="img-responsive" />
				  </a>  
                </div>
			</div>
        </div>
</div> 
<div class="clear"></div>';
	
}

if(count($bar_cats) > 0) {
$result["res_data"].= '<div class="section-most-banked">
        <div class="row">
            <div class="col-md-12 nopadding">';
               foreach($bar_cats as $cattab3){
               $result["res_data"].= '<h2>'.$cattab3->cat_name.'</h2>';
                } 
                $result["res_data"].= '<a href="'.home_url().'/index.php/deals/?cat_id='.$cattab3->id.'" class="viewall">view all</a>';

				foreach($bar_datas as $offers_cat3s) { 
					
				$total_res = $wpdb->get_results("SELECT * FROM `reedemer_offer` where id = '".$offers_cat3s->id."'");						
					foreach($total_res as $offers_cat3){ 	
				

				$today = date('Y-m-d');
				//echo $today;
				$exp_date = $offers_cat3->end_date; 
				$expiry = new DateTime($exp_date);
				$ex_date = $expiry->format('Y-m-d');
				//echo $ex_date;

                $result["res_data"].= '<div class="col-md-3 col-sm-3 product-view">';
                $result["res_data"].= '<a href="'.home_url().'/index.php/deal-details/?offer='.$offers_cat3->id.'"><div class="home-page-deal-pic">';
          		
				
          		$img_explod = explode('/',$offers_cat3->offer_medium_image_path);
				if($img_explod[0] == 'http:'){
				  $img_offers = $offers_cat3->offer_medium_image_path;
				}else {                 
				  $img_offers = home_url().'/'.$offers_cat3->offer_medium_image_path;
				}
						
				$img_logo = $wpdb->get_results("select logo_name from reedemer_logo where reedemer_id = '".$offers_cat3->created_by."' && default_logo = 1");
				foreach($img_logo as $new_img_logo){
				$new_pic_logo=$new_img_logo->logo_name;
								$str = $new_pic_logo;
								$tes = explode(".",$str);
								if($tes[1]=='jpg'){$final_logo_image= $tes[0].".png";}
								else{$final_logo_image=$new_pic_logo ;}				
				$result["res_data"].='<span class="deal-d-float2"><img src="'.home_url().'/filemanager/userfiles/medium/'.$final_logo_image.'" alt="img"></span>';
				}
						
				if($offers_cat3->on_demand == 1) {
						$result["res_data"].= '<div class="ondemand">on demand</div>';
					}
          
          
                   $result["res_data"].= '<img src="'.$img_offers.'" alt="img01" class="img-responsive" /></div>
				    <div class="banked-product">
                        <div class="product-title">';
        			if(strlen($offers_cat3->offer_description) > 55) { 
                $result["res_data"].= substr($offers_cat3->offer_description,0,55)."....";
				  } else { 
					$result["res_data"].= $offers_cat3->offer_description;
				  } 
      			$result["res_data"].= '</div>
                        <div class="product-savings">';
					
                //echo "SELECT * FROM `reedemer_offer` WHERE id = $offers->id";
                $offer_prc = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE id = $offers_cat3->id && status = 1");
              foreach($offer_prc as $off_prc){
				  
				  
                $offer_lat = $off_prc->latitude;
                $offer_lon = $off_prc->longitude;
				$cmp_id = $off_prc->created_by; 

              
              $result["res_data"].= '<span class="savings">';
				  
                $offer_mode= $off_prc->value_calculate;
										if ($offer_mode=='2') {
										$prc_val = ($off_prc->pay_value/$off_prc->retails_value); 
										$percent_friendly = number_format( $prc_val * 100, 2 ) . '%';
										$tot_per = round(100 - $percent_friendly);	
										$offer_type= $off_prc->value_text;
										$offer_mode= $off_prc->value_calculate;
										if ($offer_type=='1'){$offer_type_value='OFF';}
										elseif ($offer_type=='2'){$offer_type_value='DISCOUNT';}
										elseif ($offer_type=='3'){$offer_type_value='SAVINGS';}
										else{$offer_type_value='OFF';}
										//echo $tot_per."%".$offer_type_value;
										$result["res_data"].= $tot_per."% ".$offer_type_value;
										}
										else{
										$prc_val = ($off_prc->retails_value - $off_prc->pay_value); 
										$tot_per = round($prc_val);	
										$offer_type= $off_prc->value_text;
										$offer_mode= $off_prc->value_calculate;
										if ($offer_type=='1'){$offer_type_value='OFF';}
										elseif ($offer_type=='2'){$offer_type_value='DISCOUNT';}
										elseif ($offer_type=='3'){$offer_type_value='SAVINGS';}
										else{$offer_type_value='OFF';}
										//echo "$".$tot_per."".$offer_type_value;
										$result["res_data"].= "$".$tot_per." ".$offer_type_value;
										}
				  
              $result["res_data"].= '</span>
              <span class="pricesection">
                <color>$'.$off_prc->retails_value.'</color>
                $'.$off_prc->pay_value.'
              </span>';

              

              }
               $result["res_data"].= '</div>
                        <div class="col-expires">
        			<img src="'.get_template_directory_uri().'/images/location.png" alt="location" class="img-responsive" />';            $cmp_nam = $wpdb->get_results("SELECT `location` FROM `users` WHERE id = $cmp_id");       
                foreach($cmp_nam as $cmp_nms) {         
                  $result["res_data"].= $cmp_nms->location." (";        
                }               
                
                if($default_loc != ''){
					
					$address = $default_loc;
					$latLong = getLatLong($address);
					$lat = $latLong['latitude'];
					$lon = $latLong['longitude'];
                  
                  /*$loc_id = $default_loc; 
                  $deal_id = $offers_cat3->id;
                  $loc_defs = $wpdb->get_results("SELECT usr.location,usr.lat,usr.lng FROM users AS usr INNER JOIN reedemer_offer AS ro ON ro.created_by = usr.id WHERE usr.location = '$loc_id' && ro.id = '$deal_id'");
                  foreach($loc_defs as $loc_def){
                    $lat = $loc_def->lat;
                    $lon = $loc_def->lng;
                  }*/
                  
                }else {
                  
                  $lat = "40.9312099";
                  $lon = "-73.89874689999999";
                }
                $result["res_data"].= floor(distance($lat, $lon, $offer_lat, $offer_lon, "M"))." Miles)";
                 $result["res_data"].= '</div>
                    </div>
                </a>
                

                </div>';
					}
				}
		$result["res_data"].= '
            </div>
        </div>
</div>
<div class="clear"></div>';
	
}

if(count($entertainment_cats) > 0) {

$result["res_data"].= '<div class="section-most-banked">
        <div class="row">
            <div class="col-md-12 nopadding">';
               foreach($entertainment_cats as $cattab3){
               $result["res_data"].= '<h2>'.$cattab3->cat_name.'</h2>';
                } 
                $result["res_data"].= '<a href="'.home_url().'/index.php/deals/?cat_id='.$cattab3->id.'" class="viewall">view all</a>';

				foreach($entertainment_datas as $offers_cat3s) {					
					
				$total_res = $wpdb->get_results("SELECT * FROM `reedemer_offer` where id = '".$offers_cat3s->id."'");						
					foreach($total_res as $offers_cat3){ 

				$today = date('Y-m-d');
				//echo $today;
				$exp_date = $offers_cat3->end_date; 
				$expiry = new DateTime($exp_date);
				$ex_date = $expiry->format('Y-m-d');
				//echo $ex_date;

                $result["res_data"].= '<div class="col-md-3 col-sm-3 product-view">';
                $result["res_data"].= '<a href="'.home_url().'/index.php/deal-details/?offer='.$offers_cat3->id.'"><div class="home-page-deal-pic">';
          
          		$img_explod = explode('/',$offers_cat3->offer_medium_image_path);
				if($img_explod[0] == 'http:'){
				  $img_offers = $offers_cat3->offer_medium_image_path;
				}else {                 
				  $img_offers = home_url().'/'.$offers_cat3->offer_medium_image_path;
				}
          		
						
			$img_logo = $wpdb->get_results("select logo_name from reedemer_logo where reedemer_id = '".$offers_cat3->created_by."' && default_logo = 1");
				foreach($img_logo as $new_img_logo){
				$new_pic_logo=$new_img_logo->logo_name;
								$str = $new_pic_logo;
								$tes = explode(".",$str);
								if($tes[1]=='jpg'){$final_logo_image= $tes[0].".png";}
								else{$final_logo_image=$new_pic_logo ;}				
				$result["res_data"].='<span class="deal-d-float2"><img src="'.home_url().'/filemanager/userfiles/medium/'.$final_logo_image.'" alt="img"></span>';
				}
						
						if($offers_cat3->on_demand == 1) {
						$result["res_data"].= '<div class="ondemand">on demand</div>';
					}
          
                   $result["res_data"].= '<img src="'.$img_offers.'" alt="img01" class="img-responsive" /></div>
                    <div class="banked-product">
                        <div class="product-title">';
        			if(strlen($offers_cat3->offer_description) > 55) { 
                $result["res_data"].= substr($offers_cat3->offer_description,0,55)."....";
				  } else { 
					$result["res_data"].= $offers_cat3->offer_description;
				  } 
      			$result["res_data"].= '</div>
                        <div class="product-savings">';
					
                //echo "SELECT * FROM `reedemer_offer` WHERE id = $offers->id";
                $offer_prc = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE id = $offers_cat3->id && status = 1");
              foreach($offer_prc as $off_prc){
				  
				  
                $offer_lat = $off_prc->latitude;
                $offer_lon = $off_prc->longitude;
				$cmp_id = $off_prc->created_by; 

              

              $result["res_data"].= '<span class="savings">';
				  
                $offer_mode= $off_prc->value_calculate;
										if ($offer_mode=='2') {
										$prc_val = ($off_prc->pay_value/$off_prc->retails_value); 
										$percent_friendly = number_format( $prc_val * 100, 2 ) . '%';
										$tot_per = round(100 - $percent_friendly);	
										$offer_type= $off_prc->value_text;
										$offer_mode= $off_prc->value_calculate;
										if ($offer_type=='1'){$offer_type_value='OFF';}
										elseif ($offer_type=='2'){$offer_type_value='DISCOUNT';}
										elseif ($offer_type=='3'){$offer_type_value='SAVINGS';}
										else{$offer_type_value='OFF';}
										//echo $tot_per."%".$offer_type_value;
										$result["res_data"].= $tot_per."% ".$offer_type_value;
										}
										else{
										$prc_val = ($off_prc->retails_value - $off_prc->pay_value); 
										$tot_per = round($prc_val);	
										$offer_type= $off_prc->value_text;
										$offer_mode= $off_prc->value_calculate;
										if ($offer_type=='1'){$offer_type_value='OFF';}
										elseif ($offer_type=='2'){$offer_type_value='DISCOUNT';}
										elseif ($offer_type=='3'){$offer_type_value='SAVINGS';}
										else{$offer_type_value='OFF';}
										//echo "$".$tot_per."".$offer_type_value;
										$result["res_data"].= "$".$tot_per." ".$offer_type_value;
										}
				  
              $result["res_data"].= '</span>
              <span class="pricesection">
                <color>$'.$off_prc->retails_value.'</color>
                $'.$off_prc->pay_value.'
              </span>';

               

              }
               $result["res_data"].= '</div>
                        <div class="col-expires">
        			<img src="'.get_template_directory_uri().'/images/location.png" alt="location" class="img-responsive" />';            $cmp_nam = $wpdb->get_results("SELECT `location` FROM `users` WHERE id = $cmp_id");       
                foreach($cmp_nam as $cmp_nms) {         
                  $result["res_data"].= $cmp_nms->location." (";        
                }               
                
                if($default_loc != ''){
					
					$address = $default_loc;
					$latLong = getLatLong($address);
					$lat = $latLong['latitude'];
					$lon = $latLong['longitude'];
                  
                  /*$loc_id = $default_loc; 
                  $deal_id = $offers_cat3->id;
                  $loc_defs = $wpdb->get_results("SELECT usr.location,usr.lat,usr.lng FROM users AS usr INNER JOIN reedemer_offer AS ro ON ro.created_by = usr.id WHERE usr.location = '$loc_id' && ro.id = '$deal_id'");
                  foreach($loc_defs as $loc_def){
                    $lat = $loc_def->lat;
                    $lon = $loc_def->lng;
                  }*/
                  
                }else {
                  
                  $lat = "40.9312099";
                  $lon = "-73.89874689999999";
                }
                $result["res_data"].= floor(distance($lat, $lon, $offer_lat, $offer_lon, "M"))." Miles)";
                 $result["res_data"].= '</div>
                    </div>
                </a>
                

                </div>';
						
					}
 } $result["res_data"].= '
            </div>
        </div>
</div>
<div class="clear"></div>';
	
}


$result["res_data"].= '<div class="section-most-banked">
        <div class="row">
            <div class="col-md-12">
                <img src="'.get_template_directory_uri().'/images/banner_mid.jpg" alt="img01" class="img-responsive bannermiddle" />
                <a href="'.home_url().'/index.php/signup/" class="signup-btn">Sign up</a>
            </div>
        </div>
</div>
<div class="clear"></div>';

if(count($popular_cats) > 0) {
	
$result["res_data"].= '<div class="section-most-banked">
        <div class="row">
            <div class="col-md-12 nopadding">';
               foreach($popular_cats as $cattab3){
               $result["res_data"].= '<h2>'.$cattab3->cat_name.'</h2>';
                } 
                $result["res_data"].= '<a href="'.home_url().'/index.php/deals/?cat_id='.$cattab3->id.'" class="viewall">view all</a>';

				foreach($popular_datas as $offers_cat3s) { 
					
					$total_res = $wpdb->get_results("SELECT * FROM `reedemer_offer` where id = '".$offers_cat3s->id."'");						
					foreach($total_res as $offers_cat3){ 
					
				$today = date('Y-m-d');
				//echo $today;
				$exp_date = $offers_cat3->end_date; 
				$expiry = new DateTime($exp_date);
				$ex_date = $expiry->format('Y-m-d');
				//echo $ex_date;

                $result["res_data"].= '<div class="col-md-3 col-sm-3 product-view">';
                $result["res_data"].= '<a href="'.home_url().'/index.php/deal-details/?offer='.$offers_cat3->id.'"><div class="home-page-deal-pic">';
          
          		$img_explod = explode('/',$offers_cat3->offer_medium_image_path);
				if($img_explod[0] == 'http:'){
				  $img_offers = $offers_cat3->offer_medium_image_path;
				}else {                 
				  $img_offers = home_url().'/'.$offers_cat3->offer_medium_image_path;
				}
          		
				$img_logo = $wpdb->get_results("select logo_name from reedemer_logo where reedemer_id = '".$offers_cat3->created_by."' && default_logo = 1");
				foreach($img_logo as $new_img_logo){
				$new_pic_logo=$new_img_logo->logo_name;
								$str = $new_pic_logo;
								$tes = explode(".",$str);
								if($tes[1]=='jpg'){$final_logo_image= $tes[0].".png";}
								else{$final_logo_image=$new_pic_logo ;}				
				$result["res_data"].='<span class="deal-d-float2"><img src="'.home_url().'/filemanager/userfiles/medium/'.$final_logo_image.'" alt="img"></span>';
				}
						
						if($offers_cat3->on_demand == 1) {
						$result["res_data"].= '<div class="ondemand">on demand</div>';
					}
          
                   $result["res_data"].= '<img src="'.$img_offers.'" alt="img01" class="img-responsive" /></div>
                    <div class="banked-product">
                        <div class="product-title">';
        			if(strlen($offers_cat3->offer_description) > 55) { 
                $result["res_data"].= substr($offers_cat3->offer_description,0,55)."....";
				  } else { 
					$result["res_data"].= $offers_cat3->offer_description;
				  } 
      			$result["res_data"].= '</div>
                        <div class="product-savings">';
					
                //echo "SELECT * FROM `reedemer_offer` WHERE id = $offers->id";
                $offer_prc = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE id = $offers_cat3->id && status = 1");
              foreach($offer_prc as $off_prc){
				  
				  
                $offer_lat = $off_prc->latitude;
                $offer_lon = $off_prc->longitude;
				$cmp_id = $off_prc->created_by; 

              

              $result["res_data"].= '<span class="savings">';
				  
               $offer_mode= $off_prc->value_calculate;
										if ($offer_mode=='2') {
										$prc_val = ($off_prc->pay_value/$off_prc->retails_value); 
										$percent_friendly = number_format( $prc_val * 100, 2 ) . '%';
										$tot_per = round(100 - $percent_friendly);	
										$offer_type= $off_prc->value_text;
										$offer_mode= $off_prc->value_calculate;
										if ($offer_type=='1'){$offer_type_value='OFF';}
										elseif ($offer_type=='2'){$offer_type_value='DISCOUNT';}
										elseif ($offer_type=='3'){$offer_type_value='SAVINGS';}
										else{$offer_type_value='OFF';}
										//echo $tot_per."%".$offer_type_value;
										$result["res_data"].= $tot_per."% ".$offer_type_value;
										}
										else{
										$prc_val = ($off_prc->retails_value - $off_prc->pay_value); 
										$tot_per = round($prc_val);	
										$offer_type= $off_prc->value_text;
										$offer_mode= $off_prc->value_calculate;
										if ($offer_type=='1'){$offer_type_value='OFF';}
										elseif ($offer_type=='2'){$offer_type_value='DISCOUNT';}
										elseif ($offer_type=='3'){$offer_type_value='SAVINGS';}
										else{$offer_type_value='OFF';}
										//echo "$".$tot_per."".$offer_type_value;
										$result["res_data"].= "$".$tot_per." ".$offer_type_value;
										}
				  
              $result["res_data"].= '</span>
              <span class="pricesection">
                <color>$'.$off_prc->retails_value.'</color>
                $'.$off_prc->pay_value.'
              </span>';

             

              }
               $result["res_data"].= '</div>
                        <div class="col-expires">
        			<img src="'.get_template_directory_uri().'/images/location.png" alt="location" class="img-responsive" />';            $cmp_nam = $wpdb->get_results("SELECT `location` FROM `users` WHERE id = $cmp_id");       
                foreach($cmp_nam as $cmp_nms) {         
                  $result["res_data"].= $cmp_nms->location." (";        
                }               
                
                if($default_loc != ''){
					
					$address = $default_loc;
					$latLong = getLatLong($address);
					$lat = $latLong['latitude'];
					$lon = $latLong['longitude'];
                  
                  /*$loc_id = $default_loc; 
                  $deal_id = $offers_cat3->id;
                  $loc_defs = $wpdb->get_results("SELECT usr.location,usr.lat,usr.lng FROM users AS usr INNER JOIN reedemer_offer AS ro ON ro.created_by = usr.id WHERE usr.location = '$loc_id' && ro.id = '$deal_id'");
                  foreach($loc_defs as $loc_def){
                    $lat = $loc_def->lat;
                    $lon = $loc_def->lng;
                  }*/
                  
                }else {
                  
                  $lat = "40.9312099";
                  $lon = "-73.89874689999999";
                }
                $result["res_data"].= floor(distance($lat, $lon, $offer_lat, $offer_lon, "M"))." Miles)";
                 $result["res_data"].= '</div>
                    </div>
                </a>
                

                </div>';
					}
						

 } $result["res_data"].= '
            </div>
        </div>
</div>
<div class="clear"></div>';
	
}



if($video_query->have_posts()):
while($video_query->have_posts()):$video_query->the_post();
$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
if($image[0]!=''){$image_url = $image[0];}else{$image_url = get_template_directory_uri().'/images/contentvdo.jpg';}
$link = get_the_content();
$video_id = explode("?v=", $link);
if($video_id[1] != ''){
$video = $video_id[1];
}
$video_url = "https://www.youtube.com/embed/".$video."?enablejsapi=1&version=3&playerapiid=ytplayer&rel=0&controls=0&showinfo=0";
$result["res_data"].= '<div class="section-most-banked contentvdo-section">
<div class="row">
<img src="'.$image_url.'" class="img-responsive bannermiddle">
<div class="col-md-1 contentvdo"></div>
<div class="col-md-10 contentvdo">
<div class="vdo">
<a href="#" class="vdo-start">
<i class="fa fa-caret-right vdo-starticon" aria-hidden="true"></i>
<i class="fa fa-pause vdo-paused" aria-hidden="true"></i>
</a>
<iframe class="video" width="560" height="313" src="'.$video_url.'" frameborder="0" marginwidth="0" marginheight="0" hspace="0" vspace="0" scrolling="no"allowfullscreen allowscriptaccess="always"></iframe>
</div>
</div>
<div class="col-md-1 contentvdo"></div>
</div>
</div>
<div class="clear"></div>';
endwhile;
endif;

if(count($sport_cats) > 0) {

$result["res_data"].= '<div class="section-most-banked">
        <div class="row">
            <div class="col-md-12 nopadding">';
               foreach($sport_cats as $cattab3){
               $result["res_data"].= '<h2>'.$cattab3->cat_name.'</h2>';
                } 
                $result["res_data"].= '<a href="'.home_url().'/index.php/deals/?cat_id='.$cattab3->id.'" class="viewall">view all</a>';

				foreach($sport_datas as $offers_cat3s) { 
					$total_res = $wpdb->get_results("SELECT * FROM `reedemer_offer` where id = '".$offers_cat3s->id."'");						
					foreach($total_res as $offers_cat3){ 

				$today = date('Y-m-d');
				//echo $today;
				$exp_date = $offers_cat3->end_date; 
				$expiry = new DateTime($exp_date);
				$ex_date = $expiry->format('Y-m-d');
				//echo $ex_date;

                $result["res_data"].= '<div class="col-md-3 col-sm-3 product-view">';
                $result["res_data"].= '<a href="'.home_url().'/index.php/deal-details/?offer='.$offers_cat3->id.'"><div class="home-page-deal-pic">';
          
          		$img_explod = explode('/',$offers_cat3->offer_medium_image_path);
				if($img_explod[0] == 'http:'){
				  $img_offers = $offers_cat3->offer_medium_image_path;
				}else {                 
				  $img_offers = home_url().'/'.$offers_cat3->offer_medium_image_path;
				}
          $img_logo = $wpdb->get_results("select logo_name from reedemer_logo where reedemer_id = '".$offers_cat3->created_by."' && default_logo = 1");
				foreach($img_logo as $new_img_logo){
				$new_pic_logo=$new_img_logo->logo_name;
								$str = $new_pic_logo;
								$tes = explode(".",$str);
								if($tes[1]=='jpg'){$final_logo_image= $tes[0].".png";}
								else{$final_logo_image=$new_pic_logo ;}				
				$result["res_data"].='<span class="deal-d-float2"><img src="'.home_url().'/filemanager/userfiles/medium/'.$final_logo_image.'" alt="img"></span>';
				}
						
						if($offers_cat3->on_demand == 1) {
						$result["res_data"].= '<div class="ondemand">on demand</div>';
					}
          
                   $result["res_data"].= '<img src="'.$img_offers.'" alt="img01" class="img-responsive" /></div>
                    <div class="banked-product">
                        <div class="product-title">';
        			if(strlen($offers_cat3->offer_description) > 55) { 
                $result["res_data"].= substr($offers_cat3->offer_description,0,55)."....";
				  } else { 
					$result["res_data"].= $offers_cat3->offer_description;
				  } 
      			$result["res_data"].= '</div>
                        <div class="product-savings">';
					
                //echo "SELECT * FROM `reedemer_offer` WHERE id = $offers->id";
                $offer_prc = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE id = $offers_cat3->id && status = 1");
              foreach($offer_prc as $off_prc){
				  
				  
                $offer_lat = $off_prc->latitude;
                $offer_lon = $off_prc->longitude;
				$cmp_id = $off_prc->created_by; 

              

              $result["res_data"].= '<span class="savings">';
				  
               $offer_mode= $off_prc->value_calculate;
										if ($offer_mode=='2') {
										$prc_val = ($off_prc->pay_value/$off_prc->retails_value); 
										$percent_friendly = number_format( $prc_val * 100, 2 ) . '%';
										$tot_per = round(100 - $percent_friendly);	
										$offer_type= $off_prc->value_text;
										$offer_mode= $off_prc->value_calculate;
										if ($offer_type=='1'){$offer_type_value='OFF';}
										elseif ($offer_type=='2'){$offer_type_value='DISCOUNT';}
										elseif ($offer_type=='3'){$offer_type_value='SAVINGS';}
										else{$offer_type_value='OFF';}
										//echo $tot_per."%".$offer_type_value;
										$result["res_data"].= $tot_per."% ".$offer_type_value;
										}
										else{
										$prc_val = ($off_prc->retails_value - $off_prc->pay_value); 
										$tot_per = round($prc_val);	
										$offer_type= $off_prc->value_text;
										$offer_mode= $off_prc->value_calculate;
										if ($offer_type=='1'){$offer_type_value='OFF';}
										elseif ($offer_type=='2'){$offer_type_value='DISCOUNT';}
										elseif ($offer_type=='3'){$offer_type_value='SAVINGS';}
										else{$offer_type_value='OFF';}
										//echo "$".$tot_per."".$offer_type_value;
										$result["res_data"].= "$".$tot_per." ".$offer_type_value;
										}
				  
              $result["res_data"].= '</span>
              <span class="pricesection">
                <color>$'.$off_prc->retails_value.'</color>
                $'.$off_prc->pay_value.'
              </span>';

              }
               $result["res_data"].= '</div>
                        <div class="col-expires">
        			<img src="'.get_template_directory_uri().'/images/location.png" alt="location" class="img-responsive" />';            $cmp_nam = $wpdb->get_results("SELECT `location` FROM `users` WHERE id = $cmp_id");       
                foreach($cmp_nam as $cmp_nms) {         
                  $result["res_data"].= $cmp_nms->location." (";        
                }               
                
                if($default_loc != ''){
					
					$address = $default_loc;
					$latLong = getLatLong($address);
					$lat = $latLong['latitude'];
					$lon = $latLong['longitude'];
                  
                  /*$loc_id = $default_loc; 
                  $deal_id = $offers_cat3->id;
                  $loc_defs = $wpdb->get_results("SELECT usr.location,usr.lat,usr.lng FROM users AS usr INNER JOIN reedemer_offer AS ro ON ro.created_by = usr.id WHERE usr.location = '$loc_id' && ro.id = '$deal_id'");
                  foreach($loc_defs as $loc_def){
                    $lat = $loc_def->lat;
                    $lon = $loc_def->lng;
                  }*/
                  
                }else {
                  
                  $lat = "40.9312099";
                  $lon = "-73.89874689999999";
                }
                $result["res_data"].= floor(distance($lat, $lon, $offer_lat, $offer_lon, "M"))." Miles)";
                 $result["res_data"].= '</div>
                    </div>
                </a>
                

                </div>';
					}

 } $result["res_data"].= '
            </div>
        </div>
</div>
<div class="clear"></div>';
	
}

if(count($auto_cats) > 0) {

$result["res_data"].= '<div class="section-most-banked">
        <div class="row">
            <div class="col-md-12 nopadding">';
               foreach($auto_cats as $cattab3){
               $result["res_data"].= '<h2>'.$cattab3->cat_name.'</h2>';
                } 
                $result["res_data"].= '<a href="'.home_url().'/index.php/deals/?cat_id='.$cattab3->id.'" class="viewall">view all</a>';

				foreach($auto_datas as $offers_cat3s) { 
					$total_res = $wpdb->get_results("SELECT * FROM `reedemer_offer` where id = '".$offers_cat3s->id."'");						
					foreach($total_res as $offers_cat3){ 

				$today = date('Y-m-d');
				//echo $today;
				$exp_date = $offers_cat3->end_date; 
				$expiry = new DateTime($exp_date);
				$ex_date = $expiry->format('Y-m-d');
				//echo $ex_date;

                $result["res_data"].= '<div class="col-md-3 col-sm-3 product-view">';
                $result["res_data"].= '<a href="'.home_url().'/index.php/deal-details/?offer='.$offers_cat3->id.'"><div class="home-page-deal-pic">';
          
          		$img_explod = explode('/',$offers_cat3->offer_medium_image_path);
				if($img_explod[0] == 'http:'){
				  $img_offers = $offers_cat3->offer_medium_image_path;
				}else {                 
				  $img_offers = home_url().'/'.$offers_cat3->offer_medium_image_path;
				}
          $img_logo = $wpdb->get_results("select logo_name from reedemer_logo where reedemer_id = '".$offers_cat3->created_by."' && default_logo = 1");
				foreach($img_logo as $new_img_logo){
				$new_pic_logo=$new_img_logo->logo_name;
								$str = $new_pic_logo;
								$tes = explode(".",$str);
								if($tes[1]=='jpg'){$final_logo_image= $tes[0].".png";}
								else{$final_logo_image=$new_pic_logo ;}				
				$result["res_data"].='<span class="deal-d-float2"><img src="'.home_url().'/filemanager/userfiles/medium/'.$final_logo_image.'" alt="img"></span>';
				}
						
						if($offers_cat3->on_demand == 1) {
						$result["res_data"].= '<div class="ondemand">on demand</div>';
					}
          
                   $result["res_data"].= '<img src="'.$img_offers.'" alt="img01" class="img-responsive" /></div>
                    <div class="banked-product">
                        <div class="product-title">';
        			if(strlen($offers_cat3->offer_description) > 55) { 
                $result["res_data"].= substr($offers_cat3->offer_description,0,55)."....";
				  } else { 
					$result["res_data"].= $offers_cat3->offer_description;
				  } 
      			$result["res_data"].= '</div>
                        <div class="product-savings">';
					
                //echo "SELECT * FROM `reedemer_offer` WHERE id = $offers->id";
                $offer_prc = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE id = $offers_cat3->id && status = 1");
              foreach($offer_prc as $off_prc){
				  
				  
                $offer_lat = $off_prc->latitude;
                $offer_lon = $off_prc->longitude;
				$cmp_id = $off_prc->created_by; 

             

              $result["res_data"].= '<span class="savings">';
				  
                $offer_mode= $off_prc->value_calculate;
										if ($offer_mode=='2') {
										$prc_val = ($off_prc->pay_value/$off_prc->retails_value); 
										$percent_friendly = number_format( $prc_val * 100, 2 ) . '%';
										$tot_per = round(100 - $percent_friendly);	
										$offer_type= $off_prc->value_text;
										$offer_mode= $off_prc->value_calculate;
										if ($offer_type=='1'){$offer_type_value='OFF';}
										elseif ($offer_type=='2'){$offer_type_value='DISCOUNT';}
										elseif ($offer_type=='3'){$offer_type_value='SAVINGS';}
										else{$offer_type_value='OFF';}
										//echo $tot_per."%".$offer_type_value;
										$result["res_data"].= $tot_per."% ".$offer_type_value;
										}
										else{
										$prc_val = ($off_prc->retails_value - $off_prc->pay_value); 
										$tot_per = round($prc_val);	
										$offer_type= $off_prc->value_text;
										$offer_mode= $off_prc->value_calculate;
										if ($offer_type=='1'){$offer_type_value='OFF';}
										elseif ($offer_type=='2'){$offer_type_value='DISCOUNT';}
										elseif ($offer_type=='3'){$offer_type_value='SAVINGS';}
										else{$offer_type_value='OFF';}
										//echo "$".$tot_per."".$offer_type_value;
										$result["res_data"].= "$".$tot_per." ".$offer_type_value;
										}
				  
              $result["res_data"].= '</span>
              <span class="pricesection">
                <color>$'.$off_prc->retails_value.'</color>
                $'.$off_prc->pay_value.'
              </span>';

              

              }
               $result["res_data"].= '</div>
                        <div class="col-expires">
        			<img src="'.get_template_directory_uri().'/images/location.png" alt="location" class="img-responsive" />';            $cmp_nam = $wpdb->get_results("SELECT `location` FROM `users` WHERE id = $cmp_id");       
                foreach($cmp_nam as $cmp_nms) {         
                  $result["res_data"].= $cmp_nms->location." (";        
                }               
                
                if($default_loc != ''){
					
					$address = $default_loc;
					$latLong = getLatLong($address);
					$lat = $latLong['latitude'];
					$lon = $latLong['longitude'];
                  
                  /*$loc_id = $default_loc; 
                  $deal_id = $offers_cat3->id;
                  $loc_defs = $wpdb->get_results("SELECT usr.location,usr.lat,usr.lng FROM users AS usr INNER JOIN reedemer_offer AS ro ON ro.created_by = usr.id WHERE usr.location = '$loc_id' && ro.id = '$deal_id'");
                  foreach($loc_defs as $loc_def){
                    $lat = $loc_def->lat;
                    $lon = $loc_def->lng;
                  }*/
                  
                }else {
                  
                  $lat = "40.9312099";
                  $lon = "-73.89874689999999";
                }
                $result["res_data"].= floor(distance($lat, $lon, $offer_lat, $offer_lon, "M"))." Miles)";
                 $result["res_data"].= '</div>
                    </div>
                </a>
                

                </div>';
						
					}
 } $result["res_data"].= '
            </div>
        </div>
</div>
<div class="clear"></div>';
	
}

if(count($tavelTab3) > 0) {

$result["res_data"].= '<div class="section-most-banked">
        <div class="row">
            <div class="col-md-12 nopadding">';
               foreach($tavelTab3 as $cattab3){
               $result["res_data"].= '<h2>'.$cattab3->cat_name.'</h2>';
                } 
                $result["res_data"].= '<a href="'.home_url().'/index.php/deals/?cat_id='.$cattab3->id.'" class="viewall">view all</a>';

				foreach($tavel_recordbycat5 as $offers_cat3s) {
					$total_res = $wpdb->get_results("SELECT * FROM `reedemer_offer` where id = '".$offers_cat3s->id."'");						
					foreach($total_res as $offers_cat3){ 

				$today = date('Y-m-d');
				//echo $today;
				$exp_date = $offers_cat3->end_date; 
				$expiry = new DateTime($exp_date);
				$ex_date = $expiry->format('Y-m-d');
				//echo $ex_date;

                $result["res_data"].= '<div class="col-md-3 col-sm-3 product-view">';
                $result["res_data"].= '<a href="'.home_url().'/index.php/deal-details/?offer='.$offers_cat3->id.'"><div class="home-page-deal-pic">';
          
          		$img_explod = explode('/',$offers_cat3->offer_medium_image_path);
				if($img_explod[0] == 'http:'){
				  $img_offers = $offers_cat3->offer_medium_image_path;
				}else {                 
				  $img_offers = home_url().'/'.$offers_cat3->offer_medium_image_path;
				}
          
          $img_logo = $wpdb->get_results("select logo_name from reedemer_logo where reedemer_id = '".$offers_cat3->created_by."' && default_logo = 1");
				foreach($img_logo as $new_img_logo){
				$new_pic_logo=$new_img_logo->logo_name;
								$str = $new_pic_logo;
								$tes = explode(".",$str);
								if($tes[1]=='jpg'){$final_logo_image= $tes[0].".png";}
								else{$final_logo_image=$new_pic_logo ;}				
				$result["res_data"].='<span class="deal-d-float2"><img src="'.home_url().'/filemanager/userfiles/medium/'.$final_logo_image.'" alt="img"></span>';
				}
						
				if($offers_cat3->on_demand == 1) {
						$result["res_data"].= '<div class="ondemand">on demand</div>';
					}
                   $result["res_data"].= '<img src="'.$img_offers.'" alt="img01" class="img-responsive" /></div>
                    <div class="banked-product">
                        <div class="product-title">';
        			if(strlen($offers_cat3->offer_description) > 55) { 
                $result["res_data"].= substr($offers_cat3->offer_description,0,55)."....";
				  } else { 
					$result["res_data"].= $offers_cat3->offer_description;
				  } 
      			$result["res_data"].= '</div>
                        <div class="product-savings">';
					
                //echo "SELECT * FROM `reedemer_offer` WHERE id = $offers->id";
                $offer_prc = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE id = $offers_cat3->id && status = 1");
              foreach($offer_prc as $off_prc){
				  
				  
                $offer_lat = $off_prc->latitude;
                $offer_lon = $off_prc->longitude;
				$cmp_id = $off_prc->created_by; 

              

              $result["res_data"].= '<span class="savings">';
				  
               $offer_mode= $off_prc->value_calculate;
										if ($offer_mode=='2') {
										$prc_val = ($off_prc->pay_value/$off_prc->retails_value); 
										$percent_friendly = number_format( $prc_val * 100, 2 ) . '%';
										$tot_per = round(100 - $percent_friendly);	
										$offer_type= $off_prc->value_text;
										$offer_mode= $off_prc->value_calculate;
										if ($offer_type=='1'){$offer_type_value='OFF';}
										elseif ($offer_type=='2'){$offer_type_value='DISCOUNT';}
										elseif ($offer_type=='3'){$offer_type_value='SAVINGS';}
										else{$offer_type_value='OFF';}
										//echo $tot_per."%".$offer_type_value;
										$result["res_data"].= $tot_per."% ".$offer_type_value;
										}
										else{
										$prc_val = ($off_prc->retails_value - $off_prc->pay_value); 
										$tot_per = round($prc_val);	
										$offer_type= $off_prc->value_text;
										$offer_mode= $off_prc->value_calculate;
										if ($offer_type=='1'){$offer_type_value='OFF';}
										elseif ($offer_type=='2'){$offer_type_value='DISCOUNT';}
										elseif ($offer_type=='3'){$offer_type_value='SAVINGS';}
										else{$offer_type_value='OFF';}
										//echo "$".$tot_per."".$offer_type_value;
										$result["res_data"].= "$".$tot_per." ".$offer_type_value;
										}
				  
              $result["res_data"].= '</span>
              <span class="pricesection">
                <color>$'.$off_prc->retails_value.'</color>
                $'.$off_prc->pay_value.'
              </span>';

              

              }
               $result["res_data"].= '</div>
                        <div class="col-expires">
        			<img src="'.get_template_directory_uri().'/images/location.png" alt="location" class="img-responsive" />';            $cmp_nam = $wpdb->get_results("SELECT `location` FROM `users` WHERE id = $cmp_id");       
                foreach($cmp_nam as $cmp_nms) {         
                  $result["res_data"].= $cmp_nms->location." (";        
                }               
                
                if($default_loc != ''){
					
					$address = $default_loc;
					$latLong = getLatLong($address);
					$lat = $latLong['latitude'];
					$lon = $latLong['longitude'];
                  
                  /*$loc_id = $default_loc; 
                  $deal_id = $offers_cat3->id;
                  $loc_defs = $wpdb->get_results("SELECT usr.location,usr.lat,usr.lng FROM users AS usr INNER JOIN reedemer_offer AS ro ON ro.created_by = usr.id WHERE usr.location = '$loc_id' && ro.id = '$deal_id'");
                  foreach($loc_defs as $loc_def){
                    $lat = $loc_def->lat;
                    $lon = $loc_def->lng;
                  }*/
                  
                }else {
                  
                  $lat = "40.9312099";
                  $lon = "-73.89874689999999";
                }
                $result["res_data"].= floor(distance($lat, $lon, $offer_lat, $offer_lon, "M"))." Miles)";
                 $result["res_data"].= '</div>
                    </div>
                </a>
                

                </div>';
					}
						

 } $result["res_data"].= '
            </div>
        </div>
</div>
<div class="clear"></div>';

	
}

if(count($beauty_cats) > 0) {

$result["res_data"].= '<div class="section-most-banked">
        <div class="row">
            <div class="col-md-12 nopadding">';
               foreach($beauty_cats as $cattab3){
               $result["res_data"].= '<h2>'.$cattab3->cat_name.'</h2>';
                } 
                $result["res_data"].= '<a href="'.home_url().'/index.php/deals/?cat_id='.$cattab3->id.'" class="viewall">view all</a>';

				foreach($beauty_datas as $offers_cat3s) { 
					$total_res = $wpdb->get_results("SELECT * FROM `reedemer_offer` where id = '".$offers_cat3s->id."'");						
					foreach($total_res as $offers_cat3){ 
				

				$today = date('Y-m-d');
				//echo $today;
				$exp_date = $offers_cat3->end_date; 
				$expiry = new DateTime($exp_date);
				$ex_date = $expiry->format('Y-m-d');
				//echo $ex_date;

                $result["res_data"].= '<div class="col-md-3 col-sm-3 product-view">';
                $result["res_data"].= '<a href="'.home_url().'/index.php/deal-details/?offer='.$offers_cat3->id.'"><div class="home-page-deal-pic">';
          
          		$img_explod = explode('/',$offers_cat3->offer_medium_image_path);
				if($img_explod[0] == 'http:'){
				  $img_offers = $offers_cat3->offer_medium_image_path;
				}else {                 
				  $img_offers = home_url().'/'.$offers_cat3->offer_medium_image_path;
				}
          $img_logo = $wpdb->get_results("select logo_name from reedemer_logo where reedemer_id = '".$offers_cat3->created_by."' && default_logo = 1");
				foreach($img_logo as $new_img_logo){
				$new_pic_logo=$new_img_logo->logo_name;
								$str = $new_pic_logo;
								$tes = explode(".",$str);
								if($tes[1]=='jpg'){$final_logo_image= $tes[0].".png";}
								else{$final_logo_image=$new_pic_logo ;}				
				$result["res_data"].='<span class="deal-d-float2"><img src="'.home_url().'/filemanager/userfiles/medium/'.$final_logo_image.'" alt="img"></span>';
				}
						
						if($offers_cat3->on_demand == 1) {
						$result["res_data"].= '<div class="ondemand">on demand</div>';
					}
          
                   $result["res_data"].= '<img src="'.$img_offers.'" alt="img01" class="img-responsive" /></div>
                    <div class="banked-product">
                        <div class="product-title">';
        			if(strlen($offers_cat3->offer_description) > 55) { 
                $result["res_data"].= substr($offers_cat3->offer_description,0,55)."....";
				  } else { 
					$result["res_data"].= $offers_cat3->offer_description;
				  } 
      			$result["res_data"].= '</div>
                        <div class="product-savings">';
					
                //echo "SELECT * FROM `reedemer_offer` WHERE id = $offers->id";
                $offer_prc = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE id = $offers_cat3->id && status = 1");
              foreach($offer_prc as $off_prc){
				  
				  
                $offer_lat = $off_prc->latitude;
                $offer_lon = $off_prc->longitude;
				$cmp_id = $off_prc->created_by; 

              

              $result["res_data"].= '<span class="savings">';
				  
                $offer_mode= $off_prc->value_calculate;
										if ($offer_mode=='2') {
										$prc_val = ($off_prc->pay_value/$off_prc->retails_value); 
										$percent_friendly = number_format( $prc_val * 100, 2 ) . '%';
										$tot_per = round(100 - $percent_friendly);	
										$offer_type= $off_prc->value_text;
										$offer_mode= $off_prc->value_calculate;
										if ($offer_type=='1'){$offer_type_value='OFF';}
										elseif ($offer_type=='2'){$offer_type_value='DISCOUNT';}
										elseif ($offer_type=='3'){$offer_type_value='SAVINGS';}
										else{$offer_type_value='OFF';}
										//echo $tot_per."%".$offer_type_value;
										$result["res_data"].= $tot_per."% ".$offer_type_value;
										}
										else{
										$prc_val = ($off_prc->retails_value - $off_prc->pay_value); 
										$tot_per = round($prc_val);	
										$offer_type= $off_prc->value_text;
										$offer_mode= $off_prc->value_calculate;
										if ($offer_type=='1'){$offer_type_value='OFF';}
										elseif ($offer_type=='2'){$offer_type_value='DISCOUNT';}
										elseif ($offer_type=='3'){$offer_type_value='SAVINGS';}
										else{$offer_type_value='OFF';}
										//echo "$".$tot_per."".$offer_type_value;
										$result["res_data"].= "$".$tot_per." ".$offer_type_value;
										}
				  
              $result["res_data"].= '</span>
              <span class="pricesection">
                <color>$'.$off_prc->retails_value.'</color>
                $'.$off_prc->pay_value.'
              </span>';

              

              }
               $result["res_data"].= '</div>
                        <div class="col-expires">
        			<img src="'.get_template_directory_uri().'/images/location.png" alt="location" class="img-responsive" />';            $cmp_nam = $wpdb->get_results("SELECT `location` FROM `users` WHERE id = $cmp_id");       
                foreach($cmp_nam as $cmp_nms) {         
                  $result["res_data"].= $cmp_nms->location." (";        
                }               
                
                if($default_loc != ''){
					
					$address = $default_loc;
					$latLong = getLatLong($address);
					$lat = $latLong['latitude'];
					$lon = $latLong['longitude'];
                  
                  /*$loc_id = $default_loc; 
                  $deal_id = $offers_cat3->id;
                  $loc_defs = $wpdb->get_results("SELECT usr.location,usr.lat,usr.lng FROM users AS usr INNER JOIN reedemer_offer AS ro ON ro.created_by = usr.id WHERE usr.location = '$loc_id' && ro.id = '$deal_id'");
                  foreach($loc_defs as $loc_def){
                    $lat = $loc_def->lat;
                    $lon = $loc_def->lng;
                  }*/
                  
                }else {
                  
                  $lat = "40.9312099";
                  $lon = "-73.89874689999999";
                }
                $result["res_data"].= floor(distance($lat, $lon, $offer_lat, $offer_lon, "M"))." Miles)";
                 $result["res_data"].= '</div>
                    </div>
                </a>
                

                </div>';
					}
						

 } $result["res_data"].= '
            </div>
        </div>
</div>
<div class="clear"></div>';
	
}	

if(count($things_cats) > 0) {


$result["res_data"].= '<div class="show_all" style="display:none;">';

$result["res_data"].= '<div class="section-most-banked">
        <div class="row">
            <div class="col-md-12 nopadding">';
               foreach($things_cats as $cattab3){
               $result["res_data"].= '<h2>'.$cattab3->cat_name.'</h2>';
                } 
                $result["res_data"].= '<a href="'.home_url().'/index.php/deals/?cat_id='.$cattab3->id.'" class="viewall">view all</a>';

				foreach($things_datas as $offers_cat3s) { 
					
					$total_res = $wpdb->get_results("SELECT * FROM `reedemer_offer` where id = '".$offers_cat3s->id."'");						
					foreach($total_res as $offers_cat3){ 

				$today = date('Y-m-d');
				//echo $today;
				$exp_date = $offers_cat3->end_date; 
				$expiry = new DateTime($exp_date);
				$ex_date = $expiry->format('Y-m-d');
				//echo $ex_date;

                $result["res_data"].= '<div class="col-md-3 col-sm-3 product-view">';
                $result["res_data"].= '<a href="'.home_url().'/index.php/deal-details/?offer='.$offers_cat3->id.'"><div class="home-page-deal-pic">';
          
          		$img_explod = explode('/',$offers_cat3->offer_medium_image_path);
				if($img_explod[0] == 'http:'){
				  $img_offers = $offers_cat3->offer_medium_image_path;
				}else {                 
				  $img_offers = home_url().'/'.$offers_cat3->offer_medium_image_path;
				}
          		$img_logo = $wpdb->get_results("select logo_name from reedemer_logo where reedemer_id = '".$offers_cat3->created_by."' && default_logo = 1");
				foreach($img_logo as $new_img_logo){
				$new_pic_logo=$new_img_logo->logo_name;
								$str = $new_pic_logo;
								$tes = explode(".",$str);
								if($tes[1]=='jpg'){$final_logo_image= $tes[0].".png";}
								else{$final_logo_image=$new_pic_logo ;}				
				$result["res_data"].='<span class="deal-d-float2"><img src="'.home_url().'/filemanager/userfiles/medium/'.$final_logo_image.'" alt="img"></span>';
				}
						
						if($offers_cat3->on_demand == 1) {
						$result["res_data"].= '<div class="ondemand">on demand</div>';
					}
          
                   $result["res_data"].= '<img src="'.$img_offers.'" alt="img01" class="img-responsive" /></div>
                    <div class="banked-product">
                        <div class="product-title">';
        			if(strlen($offers_cat3->offer_description) > 55) { 
                $result["res_data"].= substr($offers_cat3->offer_description,0,55)."....";
				  } else { 
					$result["res_data"].= $offers_cat3->offer_description;
				  } 
      			$result["res_data"].= '</div>
                        <div class="product-savings">';
					
                //echo "SELECT * FROM `reedemer_offer` WHERE id = $offers->id";
                $offer_prc = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE id = $offers_cat3->id && status = 1");
              foreach($offer_prc as $off_prc){
				  
				  
                $offer_lat = $off_prc->latitude;
                $offer_lon = $off_prc->longitude;
				$cmp_id = $off_prc->created_by; 

              

              $result["res_data"].= '<span class="savings">';
				  
                $offer_mode= $off_prc->value_calculate;
										if ($offer_mode=='2') {
										$prc_val = ($off_prc->pay_value/$off_prc->retails_value); 
										$percent_friendly = number_format( $prc_val * 100, 2 ) . '%';
										$tot_per = round(100 - $percent_friendly);	
										$offer_type= $off_prc->value_text;
										$offer_mode= $off_prc->value_calculate;
										if ($offer_type=='1'){$offer_type_value='OFF';}
										elseif ($offer_type=='2'){$offer_type_value='DISCOUNT';}
										elseif ($offer_type=='3'){$offer_type_value='SAVINGS';}
										else{$offer_type_value='OFF';}
										//echo $tot_per."%".$offer_type_value;
										$result["res_data"].= $tot_per."% ".$offer_type_value;
										}
										else{
										$prc_val = ($off_prc->retails_value - $off_prc->pay_value); 
										$tot_per = round($prc_val);	
										$offer_type= $off_prc->value_text;
										$offer_mode= $off_prc->value_calculate;
										if ($offer_type=='1'){$offer_type_value='OFF';}
										elseif ($offer_type=='2'){$offer_type_value='DISCOUNT';}
										elseif ($offer_type=='3'){$offer_type_value='SAVINGS';}
										else{$offer_type_value='OFF';}
										//echo "$".$tot_per."".$offer_type_value;
										$result["res_data"].= "$".$tot_per." ".$offer_type_value;
										}
				  
              $result["res_data"].= '</span>
              <span class="pricesection">
                <color>$'.$off_prc->retails_value.'</color>
                $'.$off_prc->pay_value.'
              </span>';

              

              }
               $result["res_data"].= '</div>
                        <div class="col-expires">
        			<img src="'.get_template_directory_uri().'/images/location.png" alt="location" class="img-responsive" />';            $cmp_nam = $wpdb->get_results("SELECT `location` FROM `users` WHERE id = $cmp_id");       
                foreach($cmp_nam as $cmp_nms) {         
                  $result["res_data"].= $cmp_nms->location." (";        
                }               
                
                if($default_loc != ''){
					
					$address = $default_loc;
					$latLong = getLatLong($address);
					$lat = $latLong['latitude'];
					$lon = $latLong['longitude'];
                  
                  /*$loc_id = $default_loc; 
                  $deal_id = $offers_cat3->id;
                  $loc_defs = $wpdb->get_results("SELECT usr.location,usr.lat,usr.lng FROM users AS usr INNER JOIN reedemer_offer AS ro ON ro.created_by = usr.id WHERE usr.location = '$loc_id' && ro.id = '$deal_id'");
                  foreach($loc_defs as $loc_def){
                    $lat = $loc_def->lat;
                    $lon = $loc_def->lng;
                  }*/
                  
                }else {
                  
                  $lat = "40.9312099";
                  $lon = "-73.89874689999999";
                }
                $result["res_data"].= floor(distance($lat, $lon, $offer_lat, $offer_lon, "M"))." Miles)";
                 $result["res_data"].= '</div>
                    </div>
                </a>
                

                </div>';
					}
 } $result["res_data"].= '
            </div>
        </div>
</div>
<div class="clear"></div>';
	
}

if(count($retail_cats) > 0) {

$result["res_data"].= '<div class="section-most-banked">
        <div class="row">
            <div class="col-md-12 nopadding">';
               foreach($retail_cats as $cattab3){
               $result["res_data"].= '<h2>'.$cattab3->cat_name.'</h2>';
                } 
                $result["res_data"].= '<a href="'.home_url().'/index.php/deals/?cat_id='.$cattab3->id.'" class="viewall">view all</a>';

				foreach($retail_datas as $offers_cat3s) { 
					$total_res = $wpdb->get_results("SELECT * FROM `reedemer_offer` where id = '".$offers_cat3s->id."'");						
					foreach($total_res as $offers_cat3){ 
					
				$today = date('Y-m-d');
				//echo $today;
				$exp_date = $offers_cat3->end_date; 
				$expiry = new DateTime($exp_date);
				$ex_date = $expiry->format('Y-m-d');
				//echo $ex_date;

                $result["res_data"].= '<div class="col-md-3 col-sm-3 product-view">';
                $result["res_data"].= '<a href="'.home_url().'/index.php/deal-details/?offer='.$offers_cat3->id.'"><div class="home-page-deal-pic">';
          
          		$img_explod = explode('/',$offers_cat3->offer_medium_image_path);
				if($img_explod[0] == 'http:'){
				  $img_offers = $offers_cat3->offer_medium_image_path;
				}else {                 
				  $img_offers = home_url().'/'.$offers_cat3->offer_medium_image_path;
				}
						
          		$img_logo = $wpdb->get_results("select logo_name from reedemer_logo where reedemer_id = '".$offers_cat3->created_by."' && default_logo = 1");
				foreach($img_logo as $new_img_logo){
				$new_pic_logo=$new_img_logo->logo_name;
								$str = $new_pic_logo;
								$tes = explode(".",$str);
								if($tes[1]=='jpg'){$final_logo_image= $tes[0].".png";}
								else{$final_logo_image=$new_pic_logo ;}				
				$result["res_data"].='<span class="deal-d-float2"><img src="'.home_url().'/filemanager/userfiles/medium/'.$final_logo_image.'" alt="img"></span>';
				}
						
						if($offers_cat3->on_demand == 1) {
						$result["res_data"].= '<div class="ondemand">on demand</div>';
					}
          
                   $result["res_data"].= '<img src="'.$img_offers.'" alt="img01" class="img-responsive" /></div>
                    <div class="banked-product">
                        <div class="product-title">';
        			if(strlen($offers_cat3->offer_description) > 55) { 
                $result["res_data"].= substr($offers_cat3->offer_description,0,55)."....";
				  } else { 
					$result["res_data"].= $offers_cat3->offer_description;
				  } 
      			$result["res_data"].= '</div>
                        <div class="product-savings">';
					
                //echo "SELECT * FROM `reedemer_offer` WHERE id = $offers->id";
                $offer_prc = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE id = $offers_cat3->id && status = 1");
              foreach($offer_prc as $off_prc){
				  
				  
                $offer_lat = $off_prc->latitude;
                $offer_lon = $off_prc->longitude;
				$cmp_id = $off_prc->created_by; 

              

              $result["res_data"].= '<span class="savings">';
				  
                $offer_mode= $off_prc->value_calculate;
										if ($offer_mode=='2') {
										$prc_val = ($off_prc->pay_value/$off_prc->retails_value); 
										$percent_friendly = number_format( $prc_val * 100,2) . '%';
										$tot_per = round(100 - $percent_friendly);	
										$offer_type= $off_prc->value_text;
										$offer_mode= $off_prc->value_calculate;
										if ($offer_type=='1'){$offer_type_value='OFF';}
										elseif ($offer_type=='2'){$offer_type_value='DISCOUNT';}
										elseif ($offer_type=='3'){$offer_type_value='SAVINGS';}
										else{$offer_type_value='OFF';}
										//echo $tot_per."%".$offer_type_value;
										$result["res_data"].= $tot_per."% ".$offer_type_value;
										}
										else{
										$prc_val = ($off_prc->retails_value - $off_prc->pay_value); 
										$tot_per = round($prc_val);	
										$offer_type= $off_prc->value_text;
										$offer_mode= $off_prc->value_calculate;
										if ($offer_type=='1'){$offer_type_value='OFF';}
										elseif ($offer_type=='2'){$offer_type_value='DISCOUNT';}
										elseif ($offer_type=='3'){$offer_type_value='SAVINGS';}
										else{$offer_type_value='OFF';}
										//echo "$".$tot_per."".$offer_type_value;
										$result["res_data"].= "$".$tot_per." ".$offer_type_value;
										}
				  
              $result["res_data"].= '</span>
              <span class="pricesection">
                <color>$'.$off_prc->retails_value.'</color>
                $'.$off_prc->pay_value.'
              </span>';


              }
               $result["res_data"].= '</div>
                        <div class="col-expires">
        			<img src="'.get_template_directory_uri().'/images/location.png" alt="location" class="img-responsive" />';            $cmp_nam = $wpdb->get_results("SELECT `location` FROM `users` WHERE id = $cmp_id");       
                foreach($cmp_nam as $cmp_nms) {         
                  $result["res_data"].= $cmp_nms->location." (";        
                }               
                
                if($default_loc != ''){
					
					$address = $default_loc;
					$latLong = getLatLong($address);
					$lat = $latLong['latitude'];
					$lon = $latLong['longitude'];
                  
                  /*$loc_id = $default_loc; 
                  $deal_id = $offers_cat3->id;
                  $loc_defs = $wpdb->get_results("SELECT usr.location,usr.lat,usr.lng FROM users AS usr INNER JOIN reedemer_offer AS ro ON ro.created_by = usr.id WHERE usr.location = '$loc_id' && ro.id = '$deal_id'");
                  foreach($loc_defs as $loc_def){
                    $lat = $loc_def->lat;
                    $lon = $loc_def->lng;
                  }*/
                  
                }else {
                  
                  $lat = "40.9312099";
                  $lon = "-73.89874689999999";
                }
                $result["res_data"].= floor(distance($lat, $lon, $offer_lat, $offer_lon, "M"))." Miles)";
                 $result["res_data"].= '</div>
                    </div>
                </a>
                

                </div>';
						
					}
 } $result["res_data"].= '
            </div>
        </div>
</div>
<div class="clear"></div>
</div>';

}


$result["res_data"].= '<div class="section-most-banked">
        <div class="row">
            <div class="col-md-12 view-btn-container">
                <a href="#" class="view-btn view-all">View All</a>
				<a href="#" class="view-btn view-less" style="display:none;">View Less</a>
            </div>
        </div>
</div>
<div class="clear"></div>';

$result["res_data"].= '<script>
	
	$(".contentvdo-section").click(function(ev){

		$(this).find("img").hide();
		$(this).find(".vdo-start").hide();

		$(this).find(".video")[0].src += "&autoplay=1";
		ev.preventDefault();
	});
	$(".view-all").click(function(v){
        $(".view-all").hide("slow");
		$(".show_all").show("slow");
		$(".view-less").show("slow");
		v.preventDefault();
		
    });
    $(".view-less").click(function(av){
        $(".view-all").show("slow");
		$(".show_all").hide("slow");
		$(".view-less").hide("slow");
		av.preventDefault();
    });
</script>';	



?>


<?php echo json_encode($result); ?>
	

