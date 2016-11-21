<?php
/* Template Name: Category Panel Template
*/
$deal_catid =  $_POST['deal_categoryid'];
$deal_subcatid =  $_POST['deal_subcatid'];
$deal_createdby =  $_POST['dealcreatedby'];
$sub_sub_parent_id = $_POST['sub_sub_parent_id'];

if(isset($_POST['uer_location'])) {
	$default_loc = $_POST['uer_location'];
}else if(isset($_POST['default_location'])) {
	$default_loc = $_POST['default_location'];
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



if($_POST['cat_id']!='-1')
{

$id = explode(',',$_POST['cat_id']);


$TabcatName =  "SELECT cat_name,id FROM reedemer_category WHERE status='1' AND parent_id='0' AND id='".$_POST['cat_id']."'";
$CategoryTab = $wpdb->get_results($TabcatName);	
	

$offers_recordbycat="select max(id) as id, distance from (select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer where cat_id = '".$_POST['cat_id']."' && status = 1 && published = 'true' && end_date >= CURDATE() ) x group by`created_by` HAVING distance < $min_distance order by distance ASC LIMIT 4";

$offers_databycat = $wpdb->get_results($offers_recordbycat);

?>

<div class="tab-pane content_block" id="tab_<?php echo $_POST['cat_id']; ?>">


<?php foreach($CategoryTab as $CTab) { ?>
 <h4><?php echo $CTab->cat_name; ?></h4>
	<span class="search-loading" style="display:none;"><img src="<?php echo get_template_directory_uri();?>/images/ajax.gif" height="50" width="50" id="home-loader"/></span>
 <?php } ?>



<?php
if($offers_databycat)
{ ?>
	
    <a href="<?php echo home_url(); ?>/index.php/deals/?cat_id=<?php echo $CTab->id; ?>" class="viewall">view all</a>
	 <div class="img-panel"> 
<?php
   
 	//if($offers_databycat > 0) {
    foreach($offers_databycat as $databycats)
   

        { 
			$total_res = $wpdb->get_results("SELECT * FROM `reedemer_offer` where id = '".$databycats->id."'");						
				foreach($total_res as $databycat){ 
		 
		 	
		?>		
           <!-- IMAGE PANEL DIV OF CATEGORY TAB BASE BEGIN -->
       <div class="col-md-3 col-sm-3 img-column product-view">
					<a href="<?php echo home_url(); ?>/index.php/deal-details/?offer=<?php echo $databycat->id; ?>">
						<div class="home-search-wrap">
					<?php $img_logo = $wpdb->get_results("select logo_name from reedemer_logo where reedemer_id = '".$databycat->created_by."' && default_logo = 1");
					foreach($img_logo as $new_img_logo){
					if($new_img_logo !=""){
						$new_pic_logo=$new_img_logo->logo_name;
						$str = $new_pic_logo;
						$tes = explode(".",$str);
						if($tes[1]=='jpg'){$final_logo_image= $tes[0].".png";}
						else{$final_logo_image=$new_pic_logo ;}
					echo '<span class="floate-pic"><img src="'.home_url().'/filemanager/userfiles/small/'.$final_logo_image.'" alt="img"></span>';
					}
					}?>
					<?php $img_explod = explode('/',$databycat->offer_image_path);
						if($img_explod[0] == 'http:'){
							$img_offers = $databycat->offer_image_path;									
						}else{
							$img_offers = home_url().'/'.$databycat->offer_image_path;
						}
					if($databycat->on_demand == 1) {
						echo '<div class="ondemand">on demand</div>';
					}
					?>	
					<img src="<?php echo $img_offers; ?>" alt="img01" class="img-responsive" />
					</div>
					<div class="product">
						<div class="product-title">
							<?php 
								if(strlen($databycat->offer_description) > 40) {
									echo substr($databycat->offer_description,0,40).'...';	
								}else {
									echo $databycat->offer_description;
								}
							?>

						</div>

						<div class="product-savings home-location">

							<?php 		 		
								//echo "SELECT * FROM `reedemer_offer` WHERE id = $offers->id";
								$offer_prc = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE id = $databycat->id && status = 1");
							foreach($offer_prc as $off_prc){

								$offer_lat = $off_prc->latitude;
								$offer_lon = $off_prc->longitude;
								$cmp_id = $off_prc->created_by;	

							$cmp_id = $off_prc->created_by;										
							

							?>
							<span class="savings">
								<?php 
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
								echo $tot_per."% ".$offer_type_value;
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
								echo "$".$tot_per." ".$offer_type_value;
								}
								?>
							</span>
							<?php if(strlen($off_prc->pay_value) > 6){ ?>
									<span class="pricesection" style="font-size:14px;">
										<color><?php echo "$".$off_prc->retails_value; ?></color>
										<?php echo "$".$off_prc->pay_value; ?>
									</span>
									<?php }else{?>
									<span class="pricesection">
										<color><?php echo "$".$off_prc->retails_value; ?></color>
										<?php echo "$".$off_prc->pay_value; ?>
									</span>
									<?php }?>

							<?php 

							}?>
						</div>

						<div class="col-expires">
						<img src="<?php echo get_template_directory_uri(); ?>/images/location.png" alt="location" class="img-responsive" /><?php 
						$cmp_nam = $wpdb->get_results("SELECT `location` FROM `users` WHERE id = $cmp_id");	
						foreach($cmp_nam as $cmp_nms) {         
                  			echo $cmp_nms->location." (";  
                		}             
						if($default_loc != ''){

							$address = $default_loc;
							$latLong = getLatLong($address);
							$lat = $latLong['latitude'];
							$lon = $latLong['longitude'];

						}else {

						  $lat = "40.9312099";
						  $lon = "-73.89874689999999";
						}
						echo floor(distance($lat, $lon, $offer_lat, $offer_lon, "M"))." Miles)";
				
						?>
						</div>
					</div>
				</a>		
		</div>
                        
<?php
				}

} 
 echo '</div> <!-- IMAGE PANEL DIV OF CATEGORY TAB BASE END -->';

}


 
}

// ALL Offers Data shown by Last Updated BEGIN

if($_POST['cat_id']=='-1')
{

 /* $offers_rec="SELECT rc.parent_id, rc.cat_name, rc.status, rc.visibility, ro.*, rp.price_range_id, rp.status, rp.created_by FROM reedemer_category AS rc, reedemer_offer AS ro, reedemer_partner_settings AS rp WHERE rc.id=ro.cat_id AND rc.status='1' AND ro.status='1' AND ro.created_by=rp.created_by ORDER BY ro.id DESC LIMIT 4"; */	
	
$offers_rec="select max(id) as id, distance from (select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer where status = 1 && published = 'true' && end_date >= CURDATE()) x group by`created_by` HAVING distance < $min_distance order by distance ASC LIMIT 4";
	

$offers_data = $wpdb->get_results($offers_rec);

?>

        <div class="tab-pane active content_block" id="tab_a">
            <h4>Top Picks</h4>
          	<span class="search-loading" style="display:none;"><img src="<?php echo get_template_directory_uri();?>/images/ajax.gif" height="50" width="50" id="home-loader"/></span>
            <a href="<?php echo home_url(); ?>/index.php/deals/" class="viewall">view all</a>
			
            <div class="img-panel">

              <?php
			
				foreach($offers_data as $offers_new)
                { 
					$total_res = $wpdb->get_results("SELECT * FROM `reedemer_offer` where id = '".$offers_new->id."'");						
				foreach($total_res as $offers){ 
					
					if(count($offers_data) > 0) {
				
				?>
                        <div class="col-md-3 col-sm-3 img-column product-view">
                            <a href="<?php echo home_url(); ?>/index.php/deal-details/?offer=<?php echo $offers->id; ?>">
							<div class="home-search-wrap">
                            <?php $img_logo = $wpdb->get_results("select logo_name from reedemer_logo where reedemer_id = '".$offers->created_by."' && default_logo = 1");
							foreach($img_logo as $new_img_logo){
								$new_pic_logo=$new_img_logo->logo_name;
								$str = $new_pic_logo;
								$tes = explode(".",$str);
								if($tes[1]=='jpg'){$final_logo_image= $tes[0].".png";}
								else{$final_logo_image=$new_pic_logo ;}
							echo '<span class="floate-pic"><img src="'.home_url().'/filemanager/userfiles/small/'.$final_logo_image.'" alt="img"></span>';
							}?>
							<?php $img_explod = explode('/',$offers->offer_image_path);
								if($img_explod[0] == 'http:'){
									$img_offers = $offers->offer_image_path;									
								}else{
									$img_offers = home_url().'/'.$offers->offer_image_path;
								}
							if($offers->on_demand == 1) {
								echo '<div class="ondemand">on demand</div>';
							}
							?>	
                            <img src="<?php echo $img_offers; ?>" alt="img01" class="img-responsive" />
                            </div>
                            <div class="product">
                                <div class="product-title">
									<?php 
				 						if(strlen($offers->offer_description) > 40 ){
											echo substr($offers->offer_description,0,40).'...';
										}else {
				 
				 							echo $offers->offer_description; 
									
										}?>
								</div>
                                <div class="product-savings home-location">
									
									<?php 		 		
				 						
		 								//echo "SELECT * FROM `reedemer_offer` WHERE id = $offers->id && status = 1";
				 						$offer_prc = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE id = $offers->id && status = 1");
				 					
		 							foreach($offer_prc as $off_prc){
										
									$offer_lat = $off_prc->latitude;	
		 							$offer_lon = $off_prc->longitude;
									$cmp_id = $off_prc->created_by;		
										
									//if($off_prc->discount > 0) {
									   
									?>
									<span class="savings">
									<?php 										
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
										echo $tot_per."% ".$offer_type_value;
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
										echo "$".$tot_per." ".$offer_type_value;
										}
									?>
									</span>
									<?php if(strlen($off_prc->pay_value) > 6){ ?>
									<span class="pricesection" style="font-size:14px;">
										<color><?php echo "$".$off_prc->retails_value; ?></color>
										<?php echo "$".$off_prc->pay_value; ?>
									</span>
									<?php }else{?>
									<span class="pricesection">
										<color><?php echo "$".$off_prc->retails_value; ?></color>
										<?php echo "$".$off_prc->pay_value; ?>
									</span>
									<?php }?>
									
									
									
									<?php
										
									}?>
								</div>
								
                                <div class="col-expires">
                                 <img src="<?php echo get_template_directory_uri(); ?>/images/location.png" alt="location" class="img-responsive" /><?php 
								$cmp_nam = $wpdb->get_results("SELECT `location` FROM `users` WHERE id = $cmp_id");
				 				foreach($cmp_nam as $cmp_nms) {         
									echo $cmp_nms->location." (";  
								}             
								if($default_loc != ''){

									$address = $default_loc;
									$latLong = getLatLong($address);
									$lat = $latLong['latitude'];
									$lon = $latLong['longitude'];

								}else {

								  $lat = "40.9312099";
								  $lon = "-73.89874689999999";
								}
								echo floor(distance($lat, $lon, $offer_lat, $offer_lon, "M"))." Miles)";
						?>


                                </div>
                            </div>
							</a>	
                        </div>

                        <?php 
				}else {
						echo '<h2>No Result found with your search</h2>';	
					}
				}
			}?>
                         
                        
                </div>
        

<?php }

// ALL Offers Data shown by Last Updated END

?>

</div>

<!-- TAB SEARCH DATA END -->



<!-- SEARCH PANEL BEGIN -->

<div class="tab-pane active content_block">


<?php 

// ALL FIELDS FILL UP 

if($default_loc!=''&&$deal_catid==0&&$deal_subcatid==0&&$_POST['cat_id']==''&&$_POST['dealtag']==''&&$_POST['dealkey']=='' && $_POST['deal_created_by']=='')
{

    echo '<h4>Search Results</h4>
	<span class="search-loading" style="display:none;"><img src="'.get_template_directory_uri().'/images/ajax.gif" height="50" width="50" id="home-loader"/></span>
          <a href="'.home_url().'/index.php/deals/" class="viewall">view all</a>
        <div class="img-panel">';

$partner = "select max(id) as id, distance from (select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer where status = 1 && published = 'true' && end_date >= CURDATE()) x group by`created_by` HAVING distance < $min_distance order by distance ASC LIMIT 4";

    //echo $partner;

    $partner_offers = $wpdb->get_results($partner);
	
    if(count($partner_offers) > 0) {
		
		foreach($partner_offers as $poffers_new)
		{
			$total_res = $wpdb->get_results("SELECT * FROM `reedemer_offer` where id = '".$poffers_new->id."'");						
			foreach($total_res as $poffers){ 

			echo '<div class="col-md-3 col-sm-3 img-column product-view">
						 <a href="'.home_url().'/index.php/deal-details/?offer='.$poffers->id.'"><div class="home-search-wrap">'; ?>
							
						 <?php $img_logo = $wpdb->get_results("select logo_name from reedemer_logo where reedemer_id = '".$poffers->created_by."' && default_logo = 1");
							foreach($img_logo as $new_img_logo){
							$new_pic_logo=$new_img_logo->logo_name;
								$str = $new_pic_logo;
								$tes = explode(".",$str);
								if($tes[1]=='jpg'){$final_logo_image= $tes[0].".png";}
								else{$final_logo_image=$new_pic_logo ;}
							echo '<span class="floate-pic"><img src="'.home_url().'/filemanager/userfiles/small/'.$final_logo_image.'" alt="img"></span>';
							}?>
							<?php $img_explod = explode('/',$poffers->offer_image_path);
									if($img_explod[0] == 'http:'){
										$img_offers = $poffers->offer_image_path;
									}else{									
										$img_offers = home_url().'/'.$poffers->offer_image_path;
									}
									if($poffers->on_demand == 1) {
										echo '<div class="ondemand">on demand</div>';
									}
								?>	
								<img src="<?php echo $img_offers; ?>" alt="img01" class="img-responsive" />
				   <?php  echo  '</div><div class="product">'; ?>
								<div class="product-title">
									<?php 
		 								if(strlen($poffers->offer_description) > 40) {
											echo substr($poffers->offer_description,0,40).'...';	
										}else {
											echo $poffers->offer_description;
										}
									?>
									
								</div>
								<div class="product-savings home-location">
								<?php 		 		
								//echo "SELECT * FROM `reedemer_offer` WHERE id = $offers->id";
								$offer_prc = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE id = $poffers->id && status = 1");
							foreach($offer_prc as $off_prc){

							$offer_lat = $off_prc->latitude;	
							$offer_lon = $off_prc->longitude;
							$cmp_id = $off_prc->created_by;	

							

							?>
							<span class="savings">
								<?php 
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
										echo $tot_per."% ".$offer_type_value;
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
										echo "$".$tot_per." ".$offer_type_value;
										}
								?>
							</span>
							<?php if(strlen($off_prc->pay_value) > 6){ ?>
									<span class="pricesection" style="font-size:14px;">
										<color><?php echo "$".$off_prc->retails_value; ?></color>
										<?php echo "$".$off_prc->pay_value; ?>
									</span>
									<?php }else{?>
									<span class="pricesection">
										<color><?php echo "$".$off_prc->retails_value; ?></color>
										<?php echo "$".$off_prc->pay_value; ?>
									</span>
									<?php }?>

							<?php 

							}?></div>
								<div class="col-expires" style="border-top:none;">
									<img src="<?php echo get_template_directory_uri(); ?>/images/location.png" alt="location" class="img-responsive" /><?php 
									
									$cmp_nam = $wpdb->get_results("SELECT `location` FROM `users` WHERE id = $cmp_id");
				 				foreach($cmp_nam as $cmp_nms) {         
									echo $cmp_nms->location." (";  
								}             
								if($default_loc != ''){

									$address = $default_loc;
									$latLong = getLatLong($address);
									$lat = $latLong['latitude'];
									$lon = $latLong['longitude'];

								}else {

								  $lat = "40.9312099";
								  $lon = "-73.89874689999999";
								}
								echo floor(distance($lat, $lon, $offer_lat, $offer_lon, "M"))." Miles)";
									
									?>	
									
								</div>
						   <?php echo'</div>
						</a>
					</div>';
			}
					
		}

		}else {
		echo '<h2>No Result found with your search</h2>';	
	}
		

    echo '</div>';

}



if($default_loc!=''&&$deal_catid!=0&&$deal_subcatid!=0&&$sub_sub_parent_id==0)
{

	
    echo '<h4>Search Results</h4>
	<span class="search-loading" style="display:none;"><img src="'.get_template_directory_uri().'/images/ajax.gif" height="50" width="50" id="home-loader"/></span>
          <a href="'.home_url().'/index.php/deals/" class="viewall">view all</a>
        <div class="img-panel">';

$partner2 = "select max(id) as id, distance from (select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer where cat_id = '".$deal_subcatid."' && subcat_id='".$deal_catid."' && status = 1 && published = 'true' && end_date >= CURDATE()) x group by`created_by` HAVING distance < $min_distance order by distance ASC LIMIT 4";
	
 //echo $partner2;

    $partner_offers2 = $wpdb->get_results($partner2);
    
	if(count($partner_offers2) > 0) {
		foreach($partner_offers2 as $poffers2s)
		{
			$total_res = $wpdb->get_results("SELECT * FROM `reedemer_offer` where id = '".$poffers2s->id."'");						
			foreach($total_res as $poffers2){ 

			echo '<div class="col-md-3 col-sm-3 img-column product-view">
						<a href="'.home_url().'/index.php/deal-details/?offer='.$poffers2->id.'"><div class="home-search-wrap">'; ?>
						<?php $img_logo = $wpdb->get_results("select logo_name from reedemer_logo where reedemer_id = '".$poffers2->created_by."' && default_logo = 1");
							foreach($img_logo as $new_img_logo){
							$new_pic_logo=$new_img_logo->logo_name;
								$str = $new_pic_logo;
								$tes = explode(".",$str);
								if($tes[1]=='jpg'){$final_logo_image= $tes[0].".png";}
								else{$final_logo_image=$new_pic_logo ;}
							echo '<span class="floate-pic"><img src="'.home_url().'/filemanager/userfiles/small/'.$final_logo_image.'" alt="img"></span>';
							}?>
							<?php $img_explod = explode('/',$poffers2->offer_image_path);
									if($img_explod[0] == 'http:'){
										$img_offers = $poffers2->offer_image_path;
									}else {
										$img_offers = home_url().'/'.$poffers2->offer_image_path;
									}
									if($poffers2->on_demand == 1) {
										echo '<div class="ondemand">on demand</div>';
									}
								?>	
								<img src="<?php echo $img_offers; ?>" alt="img01" class="img-responsive" />
				   <?php  echo  '</div><div class="product">'; ?>
								<div class="product-title">
									<?php 
		 								if(strlen($poffers2->offer_description) > 40) {
											echo substr($poffers2->offer_description,0,40).'...';	
										}else {
											echo $poffers2->offer_description;
										}
									?>
								</div>
								<div class="product-savings home-location">
								<?php 		 		
								//echo "SELECT * FROM `reedemer_offer` WHERE id = $offers->id";
								$offer_prc = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE id = $poffers2->id && status = 1");
							foreach($offer_prc as $off_prc){

							$offer_lat = $off_prc->latitude;	
							$offer_lon = $off_prc->longitude;
							$cmp_id = $off_prc->created_by;	

							

							?>
							<span class="savings">
								<?php 
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
										echo $tot_per."% ".$offer_type_value;
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
										echo "$".$tot_per." ".$offer_type_value;
										}
								?>
							</span>
							<?php if(strlen($off_prc->pay_value) > 6){ ?>
									<span class="pricesection" style="font-size:14px;">
										<color><?php echo "$".$off_prc->retails_value; ?></color>
										<?php echo "$".$off_prc->pay_value; ?>
									</span>
									<?php }else{?>
									<span class="pricesection">
										<color><?php echo "$".$off_prc->retails_value; ?></color>
										<?php echo "$".$off_prc->pay_value; ?>
									</span>
									<?php }?>

							<?php  

							}?></div>
								<div class="col-expires">
									<img src="<?php echo get_template_directory_uri(); ?>/images/location.png" alt="location" class="img-responsive" /><?php 
									$cmp_nam = $wpdb->get_results("SELECT `location` FROM `users` WHERE id = $cmp_id");
				 				foreach($cmp_nam as $cmp_nms) {         
									echo $cmp_nms->location." (";  
								}             
								if($default_loc != ''){

									$address = $default_loc;
									$latLong = getLatLong($address);
									$lat = $latLong['latitude'];
									$lon = $latLong['longitude'];

								}else {

								  $lat = "40.9312099";
								  $lon = "-73.89874689999999";
								}
								echo floor(distance($lat, $lon, $offer_lat, $offer_lon, "M"))." Miles)";?>	

									
								</div>
						   <?php echo'</div>
						</a>
					</div>';
					
			}
		}
	}else {
		echo '<h2>No Result found with your search</h2>';	
	}

        echo '</div>';

}


if($default_loc!=''&&$deal_catid!=0&&$deal_createdby==0&&$deal_subcatid==0&&$sub_sub_parent_id==0)

{

	
    echo '<h4>Search Results</h4>
	<span class="search-loading" style="display:none;"><img src="'.get_template_directory_uri().'/images/ajax.gif" height="50" width="50" id="home-loader"/></span>
          <a href="'.home_url().'/index.php/deals/" class="viewall">view all</a>
        <div class="img-panel">';
	
		

$partner4 = "select max(id) as id, distance from (select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer where cat_id = '".$deal_catid."' && status = 1 && published = 'true' && end_date >= CURDATE()) x group by`created_by` HAVING distance < $min_distance order by distance ASC LIMIT 4";

 //echo $partner4;

    $partner_offers4 = $wpdb->get_results($partner4);
    
	if(count($partner_offers4) > 0) {
		
		foreach($partner_offers4 as $poffers4s)
		{
			$total_res = $wpdb->get_results("SELECT * FROM `reedemer_offer` where id = '".$poffers4s->id."'");						
			foreach($total_res as $poffers4){ 	
			//echo $poffers4->offer_description."<br/>";

			echo '<div class="col-md-3 col-sm-3 img-column product-view">
						<a href="'.home_url().'/index.php/deal-details/?offer='.$poffers4->id.'"><div class="home-search-wrap">'; ?>
						<?php $img_logo = $wpdb->get_results("select logo_name from reedemer_logo where reedemer_id = '".$poffers4->created_by."' && default_logo = 1");
							foreach($img_logo as $new_img_logo){
							$new_pic_logo=$new_img_logo->logo_name;
								$str = $new_pic_logo;
								$tes = explode(".",$str);
								if($tes[1]=='jpg'){$final_logo_image= $tes[0].".png";}
								else{$final_logo_image=$new_pic_logo ;}
							echo '<span class="floate-pic"><img src="'.home_url().'/filemanager/userfiles/small/'.$final_logo_image.'" alt="img"></span>';
							}?>
							<?php $img_explod = explode('/',$poffers4->offer_image_path);
									if($img_explod[0] == 'http:'){
										$img_offers = $poffers4->offer_image_path;
									}else {									
										$img_offers = home_url().'/'.$poffers4->offer_image_path;
									}
									if($poffers4->on_demand == 1) {
										echo '<div class="ondemand">on demand</div>';
									}
								?>	
								<img src="<?php echo $img_offers; ?>" alt="img01" class="img-responsive" />
				   <?php  echo  '</div><div class="product">'; ?>
								<div class="product-title">
									<?php 
		 								if(strlen($poffers4->offer_description) > 40) {
											echo substr($poffers4->offer_description,0,40).'...';	
										}else {
											echo $poffers4->offer_description;
										}
									?>
								</div>
								<div class="product-savings home-location">
								<?php 		 		
								//echo "SELECT * FROM `reedemer_offer` WHERE id = $offers->id";
								$offer_prc = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE id = $poffers4->id && status = 1");
							foreach($offer_prc as $off_prc){

							$offer_lat = $off_prc->latitude;	
							$offer_lon = $off_prc->longitude;
							$cmp_id = $poffers4->created_by;	

							

							?>
							<span class="savings">
								<?php 
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
										echo $tot_per."% ".$offer_type_value;
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
										echo "$".$tot_per." ".$offer_type_value;
										}
								?>
							</span>
							<?php if(strlen($off_prc->pay_value) > 6){ ?>
									<span class="pricesection" style="font-size:14px;">
										<color><?php echo "$".$off_prc->retails_value; ?></color>
										<?php echo "$".$off_prc->pay_value; ?>
									</span>
									<?php }else{?>
									<span class="pricesection">
										<color><?php echo "$".$off_prc->retails_value; ?></color>
										<?php echo "$".$off_prc->pay_value; ?>
									</span>
									<?php }?>

							<?php 

							}?></div>
								<div class="col-expires">
									<img src="<?php echo get_template_directory_uri(); ?>/images/location.png" alt="location" class="img-responsive" /><?php 


									$cmp_nam = $wpdb->get_results("SELECT `location` FROM `users` WHERE id = $cmp_id");
				 				foreach($cmp_nam as $cmp_nms) {         
									echo $cmp_nms->location." (";  
								}             
								if($default_loc != ''){

									$address = $default_loc;
									$latLong = getLatLong($address);
									$lat = $latLong['latitude'];
									$lon = $latLong['longitude'];

								}else {

								  $lat = "40.9312099";
								  $lon = "-73.89874689999999";
								}
								echo floor(distance($lat, $lon, $offer_lat, $offer_lon, "M"))." Miles)";
									
									?>
									 
								</div>
						   <?php echo'</div>
						</a>
					</div>';
			}
			
		}
	}else {
		echo '<h2>No Result found with your search</h2>';	
	}	


        echo '</div>';

}


if($_POST['dealtag'] != '' && $deal_catid==0&&$deal_subcatid==0&&$sub_sub_parent_id==0 )

{
$lasttag = $_POST['dealtag'];
	
    echo '<h4>Search Results </h4>
	<span class="search-loading" style="display:none;"><img src="'.get_template_directory_uri().'/images/ajax.gif" height="50" width="50" id="home-loader"/></span>
          <a href="'.home_url().'/index.php/deals/" class="viewall">view all</a>
        <div class="img-panel">';
	
		

$partner4 = "select max(id) as id, distance from (select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer where FIND_IN_SET('$lasttag', more_information) && status = 1 && published = 'true' && end_date >= CURDATE()) x group by`created_by` HAVING distance < $min_distance order by distance ASC LIMIT 4";


 //echo $partner4;

    $partner_offers4 = $wpdb->get_results($partner4);
    
	if(count($partner_offers4) > 0) {
		
		foreach($partner_offers4 as $poffers4s)
		{
			$total_res = $wpdb->get_results("SELECT * FROM `reedemer_offer` where id = '".$poffers4s->id."'");						
			foreach($total_res as $poffers4){ 	
			//echo $poffers4->offer_description."<br/>";

			echo '<div class="col-md-3 col-sm-3 img-column product-view">
						<a href="'.home_url().'/index.php/deal-details/?offer='.$poffers4->id.'"><div class="home-search-wrap">'; ?>
						<?php $img_logo = $wpdb->get_results("select logo_name from reedemer_logo where reedemer_id = '".$poffers4->created_by."' && default_logo = 1");
							foreach($img_logo as $new_img_logo){
							$new_pic_logo=$new_img_logo->logo_name;
								$str = $new_pic_logo;
								$tes = explode(".",$str);
								if($tes[1]=='jpg'){$final_logo_image= $tes[0].".png";}
								else{$final_logo_image=$new_pic_logo ;}
							echo '<span class="floate-pic"><img src="'.home_url().'/filemanager/userfiles/small/'.$final_logo_image.'" alt="img"></span>';
							}?>
							<?php $img_explod = explode('/',$poffers4->offer_image_path);
									if($img_explod[0] == 'http:'){
										$img_offers = $poffers4->offer_image_path;
									}else {									
										$img_offers = home_url().'/'.$poffers4->offer_image_path;
									}
									if($poffers4->on_demand == 1) {
										echo '<div class="ondemand">on demand</div>';
									}
								?>	
								<img src="<?php echo $img_offers; ?>" alt="img01" class="img-responsive" />
				   <?php  echo  '</div><div class="product">'; ?>
								<div class="product-title">
									<?php 
		 								if(strlen($poffers4->offer_description) > 40) {
											echo substr($poffers4->offer_description,0,40).'...';	
										}else {
											echo $poffers4->offer_description;
										}
									?>
								</div>
								<div class="product-savings home-location">
								<?php 		 		
								//echo "SELECT * FROM `reedemer_offer` WHERE id = $offers->id";
								$offer_prc = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE id = $poffers4->id && status = 1");
							foreach($offer_prc as $off_prc){

							$offer_lat = $off_prc->latitude;	
							$offer_lon = $off_prc->longitude;
							$cmp_id = $poffers4->created_by;	

							

							?>
							<span class="savings">
								<?php 
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
										echo $tot_per."% ".$offer_type_value;
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
										echo "$".$tot_per." ".$offer_type_value;
										}
								?>
							</span>
							<?php if(strlen($off_prc->pay_value) > 6){ ?>
									<span class="pricesection" style="font-size:14px;">
										<color><?php echo "$".$off_prc->retails_value; ?></color>
										<?php echo "$".$off_prc->pay_value; ?>
									</span>
									<?php }else{?>
									<span class="pricesection">
										<color><?php echo "$".$off_prc->retails_value; ?></color>
										<?php echo "$".$off_prc->pay_value; ?>
									</span>
									<?php }?>

							<?php 

							}?></div>
								<div class="col-expires">
									<img src="<?php echo get_template_directory_uri(); ?>/images/location.png" alt="location" class="img-responsive" /><?php 


									$cmp_nam = $wpdb->get_results("SELECT `location` FROM `users` WHERE id = $cmp_id");
				 				foreach($cmp_nam as $cmp_nms) {         
									echo $cmp_nms->location." (";  
								}             
								if($default_loc != ''){

									$address = $default_loc;
									$latLong = getLatLong($address);
									$lat = $latLong['latitude'];
									$lon = $latLong['longitude'];

								}else {

								  $lat = "40.9312099";
								  $lon = "-73.89874689999999";
								}
								echo floor(distance($lat, $lon, $offer_lat, $offer_lon, "M"))." Miles)";
									
									?>
									 
								</div>
						   <?php echo'</div>
						</a>
					</div>';
			}
			
		}
	}else {
		echo '<h2>No Result found with your search</h2>';	
	}	


        echo '</div>';

}
///////////////////////For Keywords search///////////////////
if($_POST['dealkey'] != '')

{
$lastkey = $_POST['dealkey'];
	
    echo '<h4>Search Results</h4>
	<span class="search-loading" style="display:none;"><img src="'.get_template_directory_uri().'/images/ajax.gif" height="50" width="50" id="home-loader"/></span>
          <a href="'.home_url().'/index.php/deals/" class="viewall">view all</a>
        <div class="img-panel">';
	$partner4 = "SELECT max(id) as id, distance from (select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `reedemer_offer` WHERE (`offer_description` LIKE '%" .strtolower($_POST['dealkey']). "%' OR `what_you_get` LIKE 
'%" .strtolower($_POST['dealkey']). "%') && status = 1 && published = 'true' && end_date >= CURDATE())x group by`created_by` HAVING distance < $min_distance order by distance ASC LIMIT 4";
		

//$partner4 = "select max(id) as id, distance from (select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer where FIND_IN_SET('$lasttag', more_information) && status = 1 && published = 'true' ) x group by`created_by` HAVING distance < $min_distance order by distance ASC LIMIT 4";


 //echo $partner4;

    $partner_offers4 = $wpdb->get_results($partner4);
    
	if(count($partner_offers4) > 0) {
		
		foreach($partner_offers4 as $poffers4s)
		{
			$total_res = $wpdb->get_results("SELECT * FROM `reedemer_offer` where id = '".$poffers4s->id."'");						
			foreach($total_res as $poffers4){ 	
			//echo $poffers4->offer_description."<br/>";

			echo '<div class="col-md-3 col-sm-3 img-column product-view">
						<a href="'.home_url().'/index.php/deal-details/?offer='.$poffers4->id.'"><div class="home-search-wrap">'; ?>
						<?php $img_logo = $wpdb->get_results("select logo_name from reedemer_logo where reedemer_id = '".$poffers4->created_by."' && default_logo = 1");
							foreach($img_logo as $new_img_logo){
							$new_pic_logo=$new_img_logo->logo_name;
								$str = $new_pic_logo;
								$tes = explode(".",$str);
								if($tes[1]=='jpg'){$final_logo_image= $tes[0].".png";}
								else{$final_logo_image=$new_pic_logo ;}
							echo '<span class="floate-pic"><img src="'.home_url().'/filemanager/userfiles/small/'.$final_logo_image.'" alt="img"></span>';
							}?>
							<?php $img_explod = explode('/',$poffers4->offer_image_path);
									if($img_explod[0] == 'http:'){
										$img_offers = $poffers4->offer_image_path;
									}else {									
										$img_offers = home_url().'/'.$poffers4->offer_image_path;
									}
									if($poffers4->on_demand == 1) {
										echo '<div class="ondemand">on demand</div>';
									}
								?>	
								<img src="<?php echo $img_offers; ?>" alt="img01" class="img-responsive" />
				   <?php  echo  '</div><div class="product">'; ?>
								<div class="product-title">
									<?php 
		 								if(strlen($poffers4->offer_description) > 40) {
											echo substr($poffers4->offer_description,0,40).'...';	
										}else {
											echo $poffers4->offer_description;
										}
									?>
								</div>
								<div class="product-savings home-location">
								<?php 		 		
								//echo "SELECT * FROM `reedemer_offer` WHERE id = $offers->id";
								$offer_prc = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE id = $poffers4->id && status = 1");
							foreach($offer_prc as $off_prc){

							$offer_lat = $off_prc->latitude;	
							$offer_lon = $off_prc->longitude;
							$cmp_id = $poffers4->created_by;	

							

							?>
							<span class="savings">
								<?php 
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
										echo $tot_per."% ".$offer_type_value;
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
										echo "$".$tot_per." ".$offer_type_value;
										}
								?>
							</span>
							<?php if(strlen($off_prc->pay_value) > 6){ ?>
									<span class="pricesection" style="font-size:14px;">
										<color><?php echo "$".$off_prc->retails_value; ?></color>
										<?php echo "$".$off_prc->pay_value; ?>
									</span>
									<?php }else{?>
									<span class="pricesection">
										<color><?php echo "$".$off_prc->retails_value; ?></color>
										<?php echo "$".$off_prc->pay_value; ?>
									</span>
									<?php }?>

							<?php 

							}?></div>
								<div class="col-expires">
									<img src="<?php echo get_template_directory_uri(); ?>/images/location.png" alt="location" class="img-responsive" /><?php 


									$cmp_nam = $wpdb->get_results("SELECT `location` FROM `users` WHERE id = $cmp_id");
				 				foreach($cmp_nam as $cmp_nms) {         
									echo $cmp_nms->location." (";  
								}             
								if($default_loc != ''){

									$address = $default_loc;
									$latLong = getLatLong($address);
									$lat = $latLong['latitude'];
									$lon = $latLong['longitude'];

								}else {

								  $lat = "40.9312099";
								  $lon = "-73.89874689999999";
								}
								echo floor(distance($lat, $lon, $offer_lat, $offer_lon, "M"))." Miles)";
									
									?>
									 
								</div>
						   <?php echo'</div>
						</a>
					</div>';
			}
			
		}
	}else {
		echo '<h2>No Result found with your search</h2>';	
	}	


        echo '</div>';

}

////////////////////////ends Keywords search///////////////
 if($default_loc!=''&&$deal_catid!=0&&$deal_subcatid!=0&&$sub_sub_parent_id!=0)
{


echo '<h4>Search Results</h4>
<span class="search-loading" style="display:none;"><img src="'.get_template_directory_uri().'/images/ajax.gif" height="50" width="50" id="home-loader"/></span>
<a href="'.home_url().'/index.php/deals/" class="viewall">view all</a>
<div class="img-panel">';
	 
	 
	 
/*$gt_cats = $wpdb->get_results("SELECT * FROM reedemer_offer_categories where cat_id = $deal_catid");
//$partner2 =[];	 
foreach($gt_cats as $gt_cat) {
	print_r($gt_cat->offer_id);
echo $partner2 .= "select max(id) as id, distance from (select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer where id = '".$gt_cat->offer_id."' && status = 1 && published = 'true' ) x group by`created_by` HAVING distance < $min_distance order by distance ASC LIMIT 4;";
	
	
}

$val_prt = explode(";",$partner2);*/

//if(count($val_prt) > 0) {	 
//echo count($val_prt);	
	
//$k_count = 0;	
	 
//for($i=0; $i<=count($val_prt); $i++)	 {
	
//$partner_offers2 = $wpdb->get_results($val_prt[$i]); 	
	
//foreach($partner_offers2 as $poffers2)
//{
	
	//if($partner_offers2 > 0) {
	//	$k_count++;	
	//}

$total_res = $wpdb->get_results("SELECT DISTINCT ofr_cat.offer_id,ro.*, rp.price_range_id, rp.status, rp.created_by, usr.location, ofr_cat.cat_id, ofr_cat.offer_id, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM reedemer_offer AS ro INNER JOIN reedemer_partner_settings AS rp ON ro.created_by = rp.created_by INNER JOIN users AS usr ON usr.id = ro.created_by INNER JOIN reedemer_offer_categories as ofr_cat ON ro.id = ofr_cat.offer_id  WHERE ro.status = 1 && ro.published = 'true' && ro.end_date >= CURDATE() && ofr_cat.cat_id = $deal_catid group by ro.created_by HAVING distance < $min_distance ORDER BY distance ASC");
$k_count= count($total_res);
if($k_count > 0) {		
foreach($total_res as $poffers2){ 

echo '<div class="col-md-3 col-sm-3 img-column product-view">
<a href="'.home_url().'/index.php/deal-details/?offer='.$poffers2->id.'"><div class="home-search-wrap">'; ?>
<?php $img_logo = $wpdb->get_results("select logo_name from reedemer_logo where reedemer_id = '".$poffers2->created_by."' && default_logo = 1");
foreach($img_logo as $new_img_logo){
$new_pic_logo=$new_img_logo->logo_name;
$str = $new_pic_logo;
$tes = explode(".",$str);
if($tes[1]=='jpg'){$final_logo_image= $tes[0].".png";}
else{$final_logo_image=$new_pic_logo ;}
echo '<span class="floate-pic"><img src="'.home_url().'/filemanager/userfiles/small/'.$final_logo_image.'" alt="img"></span>';
}?>
<?php $img_explod = explode('/',$poffers2->offer_image_path);
if($img_explod[0] == 'http:'){
$img_offers = $poffers2->offer_image_path;
}else {
$img_offers = home_url().'/'.$poffers2->offer_image_path;
}
if($poffers2->on_demand == 1) {
	echo '<div class="ondemand">on demand</div>';
}
?>	
<img src="<?php echo $img_offers; ?>" alt="img01" class="img-responsive" />
<?php echo '</div><div class="product">'; ?>
<div class="product-title">
<?php 
if(strlen($poffers2->offer_description) > 40) {
echo substr($poffers2->offer_description,0,40).'...';	
}else {
echo $poffers2->offer_description;
}
?>
</div>
<div class="product-savings home-location">
<?php 
//echo "SELECT * FROM `reedemer_offer` WHERE id = $offers->id";
$offer_prc = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE id = $poffers2->id && status = 1");
foreach($offer_prc as $off_prc){

$offer_lat = $off_prc->latitude;	
$offer_lon = $off_prc->longitude;
$cmp_id = $off_prc->created_by;	



?>
<span class="savings">
<?php 
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
echo $tot_per."% ".$offer_type_value;
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
echo "$".$tot_per." ".$offer_type_value;
}
?>
</span>
<?php if(strlen($off_prc->pay_value) > 6){ ?>
									<span class="pricesection" style="font-size:14px;">
										<color><?php echo "$".$off_prc->retails_value; ?></color>
										<?php echo "$".$off_prc->pay_value; ?>
									</span>
									<?php }else{?>
									<span class="pricesection">
										<color><?php echo "$".$off_prc->retails_value; ?></color>
										<?php echo "$".$off_prc->pay_value; ?>
									</span>
									<?php }?>

<?php 

}?></div>
<div class="col-expires">
<img src="<?php echo get_template_directory_uri(); ?>/images/location.png" alt="location" class="img-responsive" /><?php 
$cmp_nam = $wpdb->get_results("SELECT `location` FROM `users` WHERE id = $cmp_id");
foreach($cmp_nam as $cmp_nms) { 
echo $cmp_nms->location." ("; 
} 
if($default_loc != ''){

$address = $default_loc;
$latLong = getLatLong($address);
$lat = $latLong['latitude'];
$lon = $latLong['longitude'];

}else {

$lat = "40.9312099";
$lon = "-73.89874689999999";
}
echo floor(distance($lat, $lon, $offer_lat, $offer_lon, "M"))." Miles)";?>	


</div>
<?php echo'</div>
</a>
</div>';

}
	//}
//}
	
//}
//echo $k_count;
//}
}
else 
{
echo '<h2>No Result found with your search</h2>';	
}

echo '</div>';

}
//for brand search

if($default_loc != '' && $_POST['deal_created_by'] != '')
{


$created_by = $_POST['deal_created_by'];
	
    echo '<h4>Search Results </h4>
	<span class="search-loading" style="display:none;"><img src="'.get_template_directory_uri().'/images/ajax.gif" height="50" width="50" id="home-loader"/></span>
          <a href="'.home_url().'/index.php/deals/" class="viewall">view all</a>
        <div class="img-panel">';
	
		

$partnerB = "select max(id) as id, distance from (select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer where status = 1 && published = 'true' && end_date >= CURDATE() && created_by = '".$created_by."' ) x group by`created_by` HAVING distance < $min_distance order by distance ASC LIMIT 4";

	$partner_offersB = $wpdb->get_results($partnerB);
    
	if(count($partner_offersB) > 0) {
		
		foreach($partner_offersB as $poffersB)
		{
			$total_resB = $wpdb->get_results("SELECT * FROM `reedemer_offer` where id = '".$poffersB->id."'");						
			foreach($total_resB as $poffersb){ 	
			//echo $poffers4->offer_description."<br/>";

			echo '<div class="col-md-3 col-sm-3 img-column product-view">
						<a href="'.home_url().'/index.php/deal-details/?offer='.$poffersb->id.'"><div class="home-search-wrap">'; ?>
						<?php $img_logo = $wpdb->get_results("select logo_name from reedemer_logo where reedemer_id = '".$poffersb->created_by."' && default_logo = 1");
							foreach($img_logo as $new_img_logo){
							$new_pic_logo=$new_img_logo->logo_name;
								$str = $new_pic_logo;
								$tes = explode(".",$str);
								if($tes[1]=='jpg'){$final_logo_image= $tes[0].".png";}
								else{$final_logo_image=$new_pic_logo ;}
							echo '<span class="floate-pic"><img src="'.home_url().'/filemanager/userfiles/small/'.$final_logo_image.'" alt="img"></span>';
							}?>
							<?php $img_explod = explode('/',$poffersb->offer_image_path);
									if($img_explod[0] == 'http:'){
										$img_offers = $poffersb->offer_image_path;
									}else {									
										$img_offers = home_url().'/'.$poffersb->offer_image_path;
									}
									if($poffersb->on_demand == 1) {
										echo '<div class="ondemand">on demand</div>';
									}
								?>	
								<img src="<?php echo $img_offers; ?>" alt="img01" class="img-responsive" />
				   <?php  echo  '</div><div class="product">'; ?>
								<div class="product-title">
									<?php 
		 								if(strlen($poffersb->offer_description) > 40) {
											echo substr($poffersb->offer_description,0,40).'...';	
										}else {
											echo $poffersb->offer_description;
										}
									?>
								</div>
								<div class="product-savings home-location">
								<?php 		 		
								//echo "SELECT * FROM `reedemer_offer` WHERE id = $offers->id";
								$offer_prc = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE id = $poffersb->id && status = 1 && end_date > CURDATE()");
							foreach($offer_prc as $off_prc){

							$offer_lat = $off_prc->latitude;	
							$offer_lon = $off_prc->longitude;
							$cmp_id = $poffersb->created_by;	

							

							?>
							<span class="savings">
								<?php 
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
										echo $tot_per."% ".$offer_type_value;
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
										echo "$".$tot_per." ".$offer_type_value;
										}
								?>
							</span>
							<?php if(strlen($off_prc->pay_value) > 6){ ?>
									<span class="pricesection" style="font-size:15px;">
										<color><?php echo "$".$off_prc->retails_value; ?></color>
										<?php echo "$".$off_prc->pay_value; ?>
									</span>
									<?php }else{?>
									<span class="pricesection">
										<color><?php echo "$".$off_prc->retails_value; ?></color>
										<?php echo "$".$off_prc->pay_value; ?>
									</span>
									<?php }?>

							<?php 

							}?></div>
								<div class="col-expires">
									<img src="<?php echo get_template_directory_uri(); ?>/images/location.png" alt="location" class="img-responsive" /><?php 


									$cmp_nam = $wpdb->get_results("SELECT `location` FROM `users` WHERE id = $cmp_id");
				 				foreach($cmp_nam as $cmp_nms) {         
									echo $cmp_nms->location." (";  
								}             
								if($default_loc != ''){

									$address = $default_loc;
									$latLong = getLatLong($address);
									$lat = $latLong['latitude'];
									$lon = $latLong['longitude'];

								}else {

								  $lat = "40.9312099";
								  $lon = "-73.89874689999999";
								}
								echo floor(distance($lat, $lon, $offer_lat, $offer_lon, "M"))." Miles)";
									
									?>
									 
								</div>
						   <?php echo'</div>
						</a>
					</div>';
			}
			
		}
	}else {
		echo '<h2>No Result found with your search</h2>';	
	}	


        echo '</div>';

}
?>

    
</div>
<!-- SEARCH PANEL END -->
