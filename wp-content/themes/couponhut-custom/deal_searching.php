<?php
/*Template Name: deal searching
*/
if(isset($_POST) && !empty($_POST))
{
	
	if($_POST['deal_cat'] != '' && $_POST['deal_cat_sub'] != '' && $_POST['deal_cat_sub'] != 0) {
		$cat_id = $_POST['deal_cat_sub'];
		$sub_cat_id = $_POST['deal_cat'];
		
	}else if($_POST['deal_cat'] != ''){
		
		$cat_id = $_POST['deal_cat'];
	}
	
	if($_POST['def_loc'] != '') {
		$loc = $_POST['def_loc'];
	}else {
		$loc = $_POST['location'];
	}
	
	
	
	$min_distance = 150;

	$address_dis = $loc;
	$latLong = getLatLong($address_dis);
	$lat_dis = $latLong['latitude'];
	$lon_dis = $latLong['longitude'];
	
	if(isset($_POST['part_id'])){

			$part_id = $_POST['part_id'];
		
			if(isset($_POST['sub_sub_cat_id']) && !empty($_POST['sub_sub_cat_id']) && $_POST['sub_sub_cat_id'] != "-")
			{
				$sub_sub_cat_id = $_POST['sub_sub_cat_id'];
				$query_builder = "SELECT ro.*, rp.price_range_id, rp.status, rp.created_by, usr.location, ofr_cat.cat_id, ofr_cat.offer_id, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM reedemer_offer AS ro INNER JOIN reedemer_partner_settings AS rp ON ro.created_by = rp.created_by INNER JOIN users AS usr ON usr.id = ro.created_by INNER JOIN reedemer_offer_categories as ofr_cat ON ro.id = ofr_cat.offer_id WHERE ro.status = 1 && ro.published = 'true' && ro.created_by = $part_id && ofr_cat.cat_id = ".$sub_sub_cat_id ;

			}else {

				$query_builder = "SELECT ro.*, rp.price_range_id, rp.status, rp.created_by, usr.location, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM reedemer_offer AS ro INNER JOIN reedemer_partner_settings AS rp ON ro.created_by = rp.created_by INNER JOIN users AS usr ON usr.id = ro.created_by WHERE ro.status = 1 && ro.published = 'true' && ro.created_by = $part_id";
			}

		}
		else 
		{
			
			
			if(isset($_POST['sub_sub_cat_id']) && !empty($_POST['sub_sub_cat_id']) && $_POST['sub_sub_cat_id'] != "-")
			{
				$sub_sub_cat_id = $_POST['sub_sub_cat_id'];
				$query_builder = "SELECT DISTINCT ofr_cat.offer_id,ro.*, rp.price_range_id, rp.status, rp.created_by, usr.location, ofr_cat.cat_id, ofr_cat.offer_id, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM reedemer_offer AS ro INNER JOIN reedemer_partner_settings AS rp ON ro.created_by = rp.created_by INNER JOIN users AS usr ON usr.id = ro.created_by INNER JOIN reedemer_offer_categories as ofr_cat ON ro.id = ofr_cat.offer_id  WHERE ro.status = 1 && ro.published = 'true' && ofr_cat.cat_id = ".$sub_sub_cat_id;

			}else {
				
				$query_builder = "SELECT ro.*, rp.price_range_id, rp.status, rp.created_by, usr.location, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM reedemer_offer AS ro INNER JOIN reedemer_partner_settings AS rp ON ro.created_by = rp.created_by INNER JOIN users AS usr ON usr.id = ro.created_by WHERE ro.status = 1 && ro.published = 'true'";
				
			}

		}
	
	if(isset($_POST['deal_tag']) && !empty($_POST['deal_tag']))
			{
				 
				$lasttag= $_POST['deal_tag'];
				$query_builder = "select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer as ro where FIND_IN_SET('$lasttag', more_information) && status = 1 && published = 'true'";
				
			}
	if(isset($_POST['dealkey']) && !empty($_POST['dealkey']))
			{
				 
				$lastkey = $_POST['dealkey'];
				$query_builder = "select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `reedemer_offer` as ro WHERE (`offer_description` LIKE '%" .strtolower($_POST['dealkey']). "%' OR `what_you_get` LIKE 
'%" .strtolower($_POST['dealkey']). "%') && status = 1 && published = 'true'";
				
			}
	if(isset($_POST['deal_created_by']) && !empty($_POST['deal_created_by']))
			{
				 
				$created_by = $_POST['deal_created_by'];
				$query_builder = "select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer as ro where status = 1 && published = 'true' && created_by =".$created_by;
				
			}
	
	$offer_dis = "SELECT * FROM `reedemer_offer` WHERE status = 1 ";
	
	/*if($loc != '')
	{
		$query_builder.=" && usr.location = '$loc'";		
		
	}*/
	if(isset($_POST['cat_id']) && !empty($_POST['cat_id']) && $_POST['cat_id'] != "-" && $_POST['cat_id'] != 0)
	{
		$query_builder.=" && ro.cat_id = ".$_POST['cat_id'];
		
		$offer_dis .= " && cat_id =  ".$_POST['cat_id'];
		
		
	}else if(isset($_POST['deal_cat']) && !empty($_POST['deal_cat']) && $_POST['deal_cat'] != "-")
	{
		$query_builder.=" && ro.cat_id = ".$cat_id;
		
		$offer_dis .= " && cat_id =  ".$cat_id;
		
		
	}

	if(isset($_POST['sub_cat_id']) && !empty($_POST['sub_cat_id']) && $_POST['sub_cat_id'] != "-")
	{
		$query_builder.=" && ro.subcat_id = ".$_POST['sub_cat_id'];
		
		$offer_dis .= " && subcat_id = ".$_POST['sub_cat_id'];
		
	}else if(isset($_POST['deal_cat_sub']) && !empty($_POST['deal_cat_sub']) && $_POST['deal_cat_sub'] != "-")
	{
		$query_builder.=" && ro.subcat_id = ".$sub_cat_id;
		
		$offer_dis .= " && subcat_id = ".$sub_cat_id;
		
	}
	
	if(isset($_POST['min_value']) && !empty($_POST['min_value']) )
	{
		$query_builder.=" && ro.pay_value >= ".$_POST['min_value'];
		
		$offer_dis .= " && pay_value >= ".$_POST['min_value']; 
	}

	if(isset($_POST['max_value']) && !empty($_POST['max_value']) )
	{
		$query_builder.=" && ro.pay_value <= ".$_POST['max_value'];
		
		$offer_dis .= " && pay_value <= ".$_POST['max_value'];
	}
	
	if(isset($_POST['curr_src_panel']) && $_POST['curr_src_panel'] == 'Off'){
		$query_builder.=" && ro.value_text = 1";
		
		$offer_dis .= " && value_text = 1";
	}
	
	if(isset($_POST['curr_src_panel']) && $_POST['curr_src_panel'] == 'Discount'){
		$query_builder.=" && ro.value_text = 2";
		
		$offer_dis .= " && value_text = 2";
	}

	if(isset($_POST['curr_src_panel']) && $_POST['curr_src_panel'] == 'savings'){
		$query_builder.=" && ro.value_text = 3";
		
		$offer_dis .= " && value_text = 3";
	}
	if(isset($_POST['curr_src_panel']) && $_POST['curr_src_panel'] == 'Off_dol'){
		$query_builder.=" && ro.value_text = 1";
		
		$offer_dis .= " && value_text = 1";
	}
	
	if(isset($_POST['curr_src_panel']) && $_POST['curr_src_panel'] == 'Discount_dol'){
		$query_builder.=" && ro.value_text = 2";
		
		$offer_dis .= " && value_text = 2";
	}

	if(isset($_POST['curr_src_panel']) && $_POST['curr_src_panel'] == 'savings_dol'){
		$query_builder.=" && ro.value_text = 3";
		
		$offer_dis .= " && value_text = 3";
	}
	
	if(isset($_POST['curr_percent']) && !empty($_POST['curr_percent']) && $_POST['curr_percent'] != "-" )
	{
		if(($_POST['curr_percent'] == '5p') || ($_POST['curr_percent'] == '10p') || ($_POST['curr_percent'] == '20p') || ($_POST['curr_percent'] == '30p')) {
			
			$query_builder.=" && ro.value_calculate = 2 ";
			
		}else {
			$query_builder.=" && ro.value_calculate = 1 ";
		}	
	}
	
	
	
	$query_builder.= " && end_date >= CURDATE()";

	/*if($_POST['cat_id'] == "-")
	{
		$query_builder.=" GROUP BY rand()";
	}*/
	
	 $query_builder.= " group by ro.created_by HAVING distance < $min_distance ORDER BY distance ASC";
	
		$qur_val = $query_builder;	
	
	$query_builder = $wpdb->get_results($query_builder ,ARRAY_A);
	
	$offer_dis = $wpdb->get_results($offer_dis);
	$marker = array();
	
	if(count($query_builder) > 0)
	{
		$result["status"] = "true";
		$result["res_data"] = "";
		
		//$result["res_data"].=$qur_val;	
		
		$v = 1;
		$max_val = 0;
		$min_val = 0;
		$k = 0;
	foreach ($query_builder as  $val1) {
	
		$offer_mode= $val1['value_calculate'];
		if ($offer_mode=='2') {
		$prc_val = ($val1['pay_value']/$val1['retails_value']); 
		$percent_friendly = number_format( $prc_val * 100,2) . '%';
		$tot_per = round(100 - $percent_friendly);	
		$offer_type= $val1['value_text'];
		$offer_mode= $val1['value_calculate'];
		if ($offer_type=='1'){$offer_type_value='OFF';}
		elseif ($offer_type=='2'){$offer_type_value='DISCOUNT';}
		elseif ($offer_type=='3'){$offer_type_value='SAVINGS';}
		else{$offer_type_value='OFF';}
		//echo $tot_per."%".$offer_type_value;
		$tot_per = $tot_per." % ".$offer_type_value;
		}else{
		$prc_val = ($val1['retails_value'] - $val1['pay_value']); 
		$tot_per = round($prc_val);	
		$offer_type= $val1['value_text'];
		$offer_mode= $val1['value_calculate'];
		if ($offer_type=='1'){$offer_type_value='OFF';}
		elseif ($offer_type=='2'){$offer_type_value='DISCOUNT';}
		elseif ($offer_type=='3'){$offer_type_value='SAVINGS';}
		else{$offer_type_value='OFF';}
		//echo "$".$tot_per."".$offer_type_value;
		$tot_per = "$ ".$tot_per." ".$offer_type_value;
		}
		$cmp_id = $val1['created_by'];
	
		/*==============Image Path===========*/	
		
		$img_explod = explode('/',$val1["offer_image_path"]);
		if($img_explod[0] == 'http:'){
			$img_offers = $val1["offer_image_path"];
		}else{
			$img_offers = home_url().'/'.$val1["offer_image_path"];
			
		}
	
	
		/*=================Logo Path====================*/
	
		$img_logo = $wpdb->get_results("select logo_name from reedemer_logo where reedemer_id = '".$val1['created_by']."' && default_logo = 1");
		
	
	
		/*==============End Image Path===========*/
	
	
		/*=========Percent Calulate=========*/
			
		$five_count = 1;
		$ten_count = 1;
		$twen_count = 1;
		$therty_count = 1;
		foreach($offer_dis as $off_dis){
			$prc_vals = ($off_dis->pay_value/$off_dis->retails_value); 
			$percent_friendly_val = number_format( $prc_vals * 100, 2 ) . '%';
			$tot_per_val = 100 - $percent_friendly_val;
			if($tot_per_val <=10){
				$fivep_val = $five_count;
				$five_count++;
			}
			if($tot_per_val >10 && $tot_per_val <=20){
				$tenp_val = $ten_count;
				$ten_count++;
			}
			if($tot_per_val >20 && $tot_per_val <=30){
				$twenp_val = $twen_count;
				$twen_count++;
			}
			if($tot_per_val >30){
				$thirtyp_val = $therty_count;
				$therty_count++;
			}
		} 	
	
		$five_count = 1;
		$ten_count = 1;
		$twen_count = 1;
		$therty_count = 1;
		/*==============Dolar Calculate=============*/
		foreach($offer_dis as $off_dis){
			if($off_dis->discount <= 10) {
				$five_val = $five_count;
				$five_count++;
			}
			if($off_dis->discount <= 20) {
				$twen_val = $ten_count;
				$ten_count++;
			}
			if($off_dis->discount <= 30) {
				$thirty_val = $twen_count;
				$twen_count++;
			}
			if($off_dis->discount >= 31) {
				$thirty_more_val = $therty_count;
				$therty_count++;
			}

		}
	
	
	
	
	/*========Marker===================*/
	
	
	//$result['marker'] .=array_push($marker,$val1['latitude'],$val1['longitude']);
	
	
				
	            $offer_description = substr($val1['offer_description'],0,15);
				$offer_mode= $val1['value_calculate'];
				if ($offer_mode=='2') {
					$prc_val = ($val1['pay_value']/$val1['retails_value']); 
					$percent_friendly = number_format( $prc_val * 100,2) . '%';
					$tot_per = round(100 - $percent_friendly);	
					$offer_type= $val1['value_text'];
					$offer_mode= $val1['value_calculate'];
				if ($offer_type=='1'){$offer_type_value='OFF';}
				elseif ($offer_type=='2'){$offer_type_value='DISCOUNT';}
				elseif ($offer_type=='3'){$offer_type_value='SAVINGS';}
				else{$offer_type_value='OFF';}
				//echo $tot_per."%".$offer_type_value;
				$tot_per = $tot_per."% ".$offer_type_value;
				}
				else{
				$prc_val = ($val1['retails_value'] - $val1['pay_value']); 
				$tot_per = round($prc_val);	
				$offer_type= $val1['value_text'];
				$offer_mode= $val1['value_calculate'];
				if ($offer_type=='1'){$offer_type_value='OFF';}
				elseif ($offer_type=='2'){$offer_type_value='DISCOUNT';}
				elseif ($offer_type=='3'){$offer_type_value='SAVINGS';}
				else{$offer_type_value='OFF';}
				//echo "$".$tot_per."".$offer_type_value;
				$tot_per = "$".$tot_per." ".$offer_type_value;
				}
				//$prc_val = ($val1['pay_value']/$val1['retails_value']); 
				//$percent_friendly = number_format( $prc_val * 100, 2 ) . '%';
				//$total_per = round(100 - $percent_friendly);
				//$total_per = $total_per."%OFF";

				$retail_val = $val1['retails_value'];
				$pay_val = $val1['pay_value'];

				$lat= $val1['latitude']; //latitude
				$lng= $val1['longitude']; //longitude
	
				//$address= getaddress($lat,$lng);
	
				$urr_id = $val1['created_by'];
				$cmp_nam = $wpdb->get_results("SELECT `location` FROM `users` WHERE id = $urr_id");       
				foreach($cmp_nam as $cmp_nms) {         
				  $address= $cmp_nms->location; 		
				}  
				$offer_img_path = base64_encode($val1['offer_image_path']);


		
	            array_push($marker,array('address'=>$address,'lat' => $lat,'lng' => $lng,'offer_image_path' => $offer_img_path,'offer_desc' => $offer_description,'total_per' => $tot_per,'retail_val' => $retail_val ,'pay_val' => $pay_val));
	
	
			if(strlen($val1["offer_description"]) > 50) { 
                $description = substr($val1["offer_description"],0,50)."....";
              } else { 
                $description = $val1["offer_description"];
              } 
		
		
		if($_POST['curr_percent'] == '5p') {			
			
			if($tot_per > 1) {
				$result["res_data"].='<div class="col-md-4 col-sm-4 product-view '.$loc.'">';

				$result["res_data"].='<a href="'.home_url().'/index.php/deal-details/?offer='.$val1["id"].'"><div class="deal-d-mid">';
				foreach($img_logo as $new_img_logo){
				$new_pic_logo=$new_img_logo->logo_name;
								$str = $new_pic_logo;
								$tes = explode(".",$str);
								if($tes[1]=='jpg'){$final_logo_image= $tes[0].".png";}
								else{$final_logo_image=$new_pic_logo ;}				
				$result["res_data"].='<span class="deal-d-float2"><img src="'.home_url().'/filemanager/userfiles/medium/'.$final_logo_image.'" alt="img"></span>';
				}
				

				$result["res_data"].='<img src="'.$img_offers.'" alt="img01" class="img-responsive" /></div><div class="product">';

				$desc = $val1["offer_description"];
				

				$result["res_data"].='<div class="product-title">'.$description.'</div>
				<div class="product-savings">';

				
					$result["res_data"].='<span class="savings">';
				
				$result["res_data"].=$tot_per;
				$result["res_data"].= '</span>
				<span class="pricesection">
					<color>';
				$result["res_data"].="$".$val1["retails_value"].'</color>';
				$result["res_data"].="$".$val1["pay_value"].'</span>';

				


			$result["res_data"].= '</div><div class="col-expires"><i class="fa fa-map-marker" aria-hidden="true"></i>';
			$offer_lat = $val1["latitude"];
			$offer_lon = $val1["longitude"];
				
			$cmp_id = $val1["created_by"]; 	
			$cmp_nam = $wpdb->get_results("SELECT `location` FROM `users` WHERE id = $cmp_id");       
			foreach($cmp_nam as $cmp_nms) {         
			  $result["res_data"].= $cmp_nms->location." (";  
			}             
			if($loc != ''){

				
				$address = $loc;
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
			
			$result["res_data"].= '</div></div></a></div>';

			if(isset($_POST['max_value']) && !empty($_POST['max_value']))
				{
					$max_val = $_POST['max_value'];
				}


			if($val1['pay_value'] >= $max_val )
			{
				$max_val = $val1['pay_value'];
			}



			if($k == 0)
			{
				$k = 1;
				$min_val = $val1['pay_value'];
				if(isset($_POST['min_value']) && !empty($_POST['min_value']))
				{
					$min_val = $_POST['min_value'];
				}
			}
				
			


			if($val1['pay_value'] < $min_val )
			{
				$min_val = $val1['pay_value'];
			}

			if($v%3 == 0)
			{
				$result["res_data"].='<div class="clearboth">&nbsp</div>';
			}
			$v++;
			}
			
		}
		else if($_POST['curr_percent'] == '10p' ) {			
			
			if($tot_per > 10) {
				$result["res_data"].='<div class="col-md-4 col-sm-4 product-view">';

				$result["res_data"].='<a href="'.home_url().'/index.php/deal-details/?offer='.$val1["id"].'"><div class="deal-d-mid">';
				
				foreach($img_logo as $new_img_logo){
				$new_pic_logo=$new_img_logo->logo_name;
								$str = $new_pic_logo;
								$tes = explode(".",$str);
								if($tes[1]=='jpg'){$final_logo_image= $tes[0].".png";}
								else{$final_logo_image=$new_pic_logo ;}				
				$result["res_data"].='<span class="deal-d-float2"><img src="'.home_url().'/filemanager/userfiles/medium/'.$final_logo_image.'" alt="img"></span>';
				}
				
				$result["res_data"].='<img src="'.$img_offers.'" alt="img01" class="img-responsive" /></div><div class="product">';

				$desc = $val1["offer_description"];
				
				$result["res_data"].='<div class="product-title">'.$description.'</div>
				<div class="product-savings">';

				
					$result["res_data"].='<span class="savings">';
				
				$result["res_data"].=$tot_per;
				$result["res_data"].= '</span>
				<span class="pricesection">
					<color>';
				$result["res_data"].="$".$val1["retails_value"].'</color>';
				$result["res_data"].="$".$val1["pay_value"].'</span>';

				


			$result["res_data"].= '</div><div class="col-expires"><i class="fa fa-map-marker" aria-hidden="true"></i>';
			$offer_lat = $val1["latitude"];
			$offer_lon = $val1["longitude"];
		
			$cmp_id = $val1["created_by"]; 	
			$cmp_nam = $wpdb->get_results("SELECT `location` FROM `users` WHERE id = $cmp_id");       
			foreach($cmp_nam as $cmp_nms) {         
			  $result["res_data"].= $cmp_nms->location." (";  
			}             
			if($loc != ''){

				
				$address = $loc;
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
			
			$result["res_data"].= '</div></div></a></div>';

			if(isset($_POST['max_value']) && !empty($_POST['max_value']))
				{
					$max_val = $_POST['max_value'];
				}


			if($val1['pay_value'] >= $max_val )
			{
				$max_val = $val1['pay_value'];
			}



			if($k == 0)
			{
				$k = 1;
				$min_val = $val1['pay_value'];
				if(isset($_POST['min_value']) && !empty($_POST['min_value']))
				{
					$min_val = $_POST['min_value'];
				}
			}


			if($val1['pay_value'] < $min_val )
			{
				$min_val = $val1['pay_value'];
			}

			if($v%3 == 0)
			{
				$result["res_data"].='<div class="clearboth">&nbsp</div>';
			}
			$v++;
			}
			
		}
		else if($_POST['curr_percent'] == '20p') {			
			
			/*$dis_val = ($new_dis_query->pay_value/$new_dis_query->retails_value);
			$dis_friendly = number_format( $dis_val * 100, 2 ) . '%';
			$dis_tot_per = 100 - $dis_friendly;	*/		
			
			if($tot_per > 20) {
				$result["res_data"].='<div class="col-md-4 col-sm-4 product-view">';

				$result["res_data"].='<a href="'.home_url().'/index.php/deal-details/?offer='.$val1["id"].'"><div class="deal-d-mid">';
				
				foreach($img_logo as $new_img_logo){
				$new_pic_logo=$new_img_logo->logo_name;
								$str = $new_pic_logo;
								$tes = explode(".",$str);
								if($tes[1]=='jpg'){$final_logo_image= $tes[0].".png";}
								else{$final_logo_image=$new_pic_logo ;}				
				$result["res_data"].='<span class="deal-d-float2"><img src="'.home_url().'/filemanager/userfiles/medium/'.$final_logo_image.'" alt="img"></span>';
				}
				
				$result["res_data"].='<img src="'.$img_offers.'" alt="img01" class="img-responsive" /></div><div class="product">';

				$desc = $val1["offer_description"];

				$result["res_data"].='<div class="product-title">'.$description.'</div>
				<div class="product-savings">';

				
					$result["res_data"].='<span class="savings">';
				
				$result["res_data"].=$tot_per;
				$result["res_data"].= '</span>
				<span class="pricesection">
					<color>';
				$result["res_data"].="$".$val1["retails_value"].'</color>';
				$result["res_data"].="$".$val1["pay_value"].'</span>';

				


			$result["res_data"].= '</div><div class="col-expires"><i class="fa fa-map-marker" aria-hidden="true"></i>';
			$offer_lat = $val1["latitude"];
			$offer_lon = $val1["longitude"];
		
			$cmp_id = $val1["created_by"]; 	
			$cmp_nam = $wpdb->get_results("SELECT `location` FROM `users` WHERE id = $cmp_id");       
			foreach($cmp_nam as $cmp_nms) {         
			  $result["res_data"].= $cmp_nms->location." (";  
			}             
			if($loc != ''){

				
				$address = $loc;
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
			
			$result["res_data"].= '</div></div></a></div>';

			if(isset($_POST['max_value']) && !empty($_POST['max_value']))
				{
					$max_val = $_POST['max_value'];
				}


			if($val1['pay_value'] >= $max_val )
			{
				$max_val = $val1['pay_value'];
			}



			if($k == 0)
			{
				$k = 1;
				$min_val = $val1['pay_value'];
				if(isset($_POST['min_value']) && !empty($_POST['min_value']))
				{
					$min_val = $_POST['min_value'];
				}
			}

			if($val1['pay_value'] < $min_val )
			{
				$min_val = $val1['pay_value'];
			}

			if($v%3 == 0)
			{
				$result["res_data"].='<div class="clearboth">&nbsp</div>';
			}
			$v++;
			}
		}
		else if($_POST['curr_percent'] == '30p') {			
			
			/*$dis_val = ($new_dis_query->pay_value/$new_dis_query->retails_value);
			$dis_friendly = number_format( $dis_val * 100, 2 ) . '%';
			$dis_tot_per = 100 - $dis_friendly;	*/		
			
			if($tot_per > 30) {
				$result["res_data"].='<div class="col-md-4 col-sm-4 product-view">';

				$result["res_data"].='<a href="'.home_url().'/index.php/deal-details/?offer='.$val1["id"].'"><div class="deal-d-mid">';
				
				foreach($img_logo as $new_img_logo){
				$new_pic_logo=$new_img_logo->logo_name;
								$str = $new_pic_logo;
								$tes = explode(".",$str);
								if($tes[1]=='jpg'){$final_logo_image= $tes[0].".png";}
								else{$final_logo_image=$new_pic_logo ;}				
				$result["res_data"].='<span class="deal-d-float2"><img src="'.home_url().'/filemanager/userfiles/medium/'.$final_logo_image.'" alt="img"></span>';
				}
				
				$result["res_data"].='<img src="'.$img_offers.'" alt="img01" class="img-responsive" /></div><div class="product">';

				$desc = $val1["offer_description"];
				
				$result["res_data"].='<div class="product-title">'.$description.'</div>
				<div class="product-savings">';

				
					$result["res_data"].='<span class="savings">';
				
				$result["res_data"].=$tot_per;
				$result["res_data"].= '</span>
				<span class="pricesection">
					<color>';
				$result["res_data"].="$".$val1["retails_value"].'</color>';
				$result["res_data"].="$".$val1["pay_value"].'</span>';

				


			$result["res_data"].= '</div><div class="col-expires"><i class="fa fa-map-marker" aria-hidden="true"></i>';
			$offer_lat = $val1["latitude"];
			$offer_lon = $val1["longitude"];
		
			$cmp_id = $val1["created_by"]; 	
			$cmp_nam = $wpdb->get_results("SELECT `location` FROM `users` WHERE id = $cmp_id");       
			foreach($cmp_nam as $cmp_nms) {         
			  $result["res_data"].= $cmp_nms->location." (";  
			}             
			if($loc != ''){

				
				$address = $loc;
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
			
			$result["res_data"].= '</div></div></a></div>';

			if(isset($_POST['max_value']) && !empty($_POST['max_value']))
				{
					$max_val = $_POST['max_value'];
				}


			if($val1['pay_value'] >= $max_val )
			{
				$max_val = $val1['pay_value'];
			}



			if($k == 0)
			{
				$k = 1;
				$min_val = $val1['pay_value'];
				if(isset($_POST['min_value']) && !empty($_POST['min_value']))
				{
					$min_val = $_POST['min_value'];
				}
			}


			if($val1['pay_value'] < $min_val )
			{
				$min_val = $val1['pay_value'];
			}

			if($v%3 == 0)
			{
				$result["res_data"].='<div class="clearboth">&nbsp</div>';
			}
			$v++;
			}
		}
		else if($_POST['curr_percent'] == 10 || $_POST['curr_percent'] == 20 || $_POST['curr_percent'] == 30 || $_POST['curr_percent'] == 31){
			
				$dis_val = ($val1['retails_value'] - $val1['pay_value']);
				if($_POST['curr_percent'] == 31) {
					$dis_con = $dis_val >= $_POST['curr_percent'];
				}else {
					$dis_con = $dis_val <= $_POST['curr_percent'];					
				}
					
				if($val1['value_text'] == $_POST['value_text'] && $val1['value_calculate'] == $_POST['value_calculate'] && $dis_con ) {
				//$result["res_data"].=$qur_val;
					
				$result["res_data"].='<div class="col-md-4 col-sm-4 product-view">';

				$result["res_data"].='<a href="'.home_url().'/index.php/deal-details/?offer='.$val1["id"].'"><div class="deal-d-mid">';
				
				
				foreach($img_logo as $new_img_logo){
				$new_pic_logo=$new_img_logo->logo_name;
								$str = $new_pic_logo;
								$tes = explode(".",$str);
								if($tes[1]=='jpg'){$final_logo_image= $tes[0].".png";}
								else{$final_logo_image=$new_pic_logo ;}				
				$result["res_data"].='<span class="deal-d-float2"><img src="'.home_url().'/filemanager/userfiles/medium/'.$final_logo_image.'" alt="img"></span>';
				}
				
				$result["res_data"].='<img src="'.$img_offers.'" alt="img01" class="img-responsive" /></div><div class="product">';

				$desc = $val1["offer_description"];

				$result["res_data"].='<div class="product-title">'.$description.'</div>
				<div class="product-savings">';

				
					$result["res_data"].='<span class="savings">';
					
					
				$prc_val = ($val1['retails_value'] - $val1['pay_value']); 
				$tot_per = round($prc_val);	
				$offer_type= $val1['value_text'];
				$offer_mode= $val1['value_calculate'];
				if ($offer_type=='1'){$offer_type_value='OFF';}
				elseif ($offer_type=='2'){$offer_type_value='DISCOUNT';}
				elseif ($offer_type=='3'){$offer_type_value='SAVINGS';}
				else{$offer_type_value='OFF';}
				//echo "$".$tot_per."".$offer_type_value;
				$tot_per = "$".$tot_per." ".$offer_type_value;	
				
				$result["res_data"].=$tot_per;
				$result["res_data"].= '</span>
				<span class="pricesection">
					<color>';
				$result["res_data"].="$".$val1["retails_value"].'</color>';
				$result["res_data"].="$".$val1["pay_value"].'</span>';

				


			$result["res_data"].= '</div><div class="col-expires"><i class="fa fa-map-marker" aria-hidden="true"></i>';
			$offer_lat = $val1["latitude"];
			$offer_lon = $val1["longitude"];
		
			$cmp_id = $val1["created_by"]; 	
			$cmp_nam = $wpdb->get_results("SELECT `location` FROM `users` WHERE id = $cmp_id");       
			foreach($cmp_nam as $cmp_nms) {         
			  $result["res_data"].= $cmp_nms->location." (";  
			}             
			if($loc != ''){

				
				$address = $loc;
				$latLong = getLatLong($address);
				$lat = $latLong['latitude'];
				$lon = $latLong['longitude'];

			}else {

			  $lat = "40.9312099";
			  $lon = "-73.89874689999999";
			}
			$result["res_data"].= floor(distance($lat, $lon, $offer_lat, $offer_lon, "M"))." Miles)";
			
			$result["res_data"].= '</div></div></a></div>';

			if(isset($_POST['max_value']) && !empty($_POST['max_value']))
				{
					$max_val = $_POST['max_value'];
				}


			if($val1['pay_value'] >= $max_val )
			{
				$max_val = $val1['pay_value'];
			}



			if($k == 0)
			{
				$k = 1;
				$min_val = $val1['pay_value'];
				if(isset($_POST['min_value']) && !empty($_POST['min_value']))
				{
					$min_val = $_POST['min_value'];
				}
			}


			if($val1['pay_value'] < $min_val )
			{
				$min_val = $val1['pay_value'];
			}
				
			if($v%3 == 0)
			{
				$result["res_data"].='<div class="clearboth">&nbsp</div>';
			}
			$v++;
					}
				
			}
		else {
			$result["res_data"].='<div class="col-md-4 col-sm-4 product-view">';

				$result["res_data"].='<a href="'.home_url().'/index.php/deal-details/?offer='.$val1["id"].'"><div class="deal-d-mid">';
				
			
				foreach($img_logo as $new_img_logo){
					
				$new_pic_logo=$new_img_logo->logo_name;
								$str = $new_pic_logo;
								$tes = explode(".",$str);
								if($tes[1]=='jpg'){$final_logo_image= $tes[0].".png";}
								else{$final_logo_image=$new_pic_logo ;}				
				$result["res_data"].='<span class="deal-d-float2"><img src="'.home_url().'/filemanager/userfiles/medium/'.$final_logo_image.'" alt="img"></span>';
				}
				$result["res_data"].='<img src="'.$img_offers.'" alt="img01" class="img-responsive" /></div><div class="product">';

				$desc = $val1["offer_description"];
				
				$result["res_data"].='<div class="product-title">'.$description.'</div>
				<div class="product-savings">';

				
					$result["res_data"].='<span class="savings">';
				
				$result["res_data"].=$tot_per;
				$result["res_data"].= '</span>
				<span class="pricesection">
					<color>';
				$result["res_data"].="$".$val1["retails_value"].'</color>';
				$result["res_data"].="$".$val1["pay_value"].'</span>';

				


			$result["res_data"].= '</div><div class="col-expires"><i class="fa fa-map-marker" aria-hidden="true"></i>';
			$offer_lat = $val1["latitude"];
			$offer_lon = $val1["longitude"];

			$cmp_id = $val1["created_by"]; 	
			$cmp_nam = $wpdb->get_results("SELECT `location` FROM `users` WHERE id = $cmp_id");       
			foreach($cmp_nam as $cmp_nms) {         
			  $result["res_data"].= $cmp_nms->location." (";  
			}             
			if($loc != ''){

				
				$address = $loc;
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
			
			$result["res_data"].= '</div></div></a></div>';

			if(isset($_POST['max_value']) && !empty($_POST['max_value']))
				{
					$max_val = $_POST['max_value'];
				}


			if($val1['pay_value'] >= $max_val )
			{
				$max_val = $val1['pay_value'];
			}



			if($k == 0)
			{
				$k = 1;
				$min_val = $val1['pay_value'];
				if(isset($_POST['min_value']) && !empty($_POST['min_value']))
				{
					$min_val = $_POST['min_value'];
				}
			}


			if($val1['pay_value'] < $min_val )
			{
				$min_val = $val1['pay_value'];
			}

			if($v%3 == 0)
			{
				$result["res_data"].='<div class="clearboth">&nbsp</div>';
			}
			$v++;
			
		}
	
	
	}
		
		
		$result['max_val'] = $max_val; 
		$result['min_val'] = $min_val;
		$result['fivep_val'] = $fivep_val;		
		$result['tenp_val'] = $tenp_val;
		$result['twenp_val'] = $twenp_val;
		$result['thirtyp_val'] = $thirtyp_val;

		$result['five_val'] = $five_val;
		$result['ten_val'] = $twen_val;
		$result['twen_val'] = $thirty_val;
		$result['thirty_val'] = $thirty_more_val;
		
		$result['marker'] = $marker;
		
	
	}
	else
	{
		$result["status"] = "false";
		$result["res_data"] ="";
		$result["res_data"].= "<h2>Sorry No Data are available</h2>";
		//$result["res_data"].= $qur_val;
	}
	$result["post_data"] = $_POST;
	echo json_encode($result);

}
?>
