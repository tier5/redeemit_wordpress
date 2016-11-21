<?php
/* Template Name: Deal Category Off Panel Template
*/
global $wpdb; 

$default_loc = $_POST['location'];



$min_distance = 150;

$address_dis = $default_loc;
$latLong = getLatLong($address_dis);
$lat_dis = $latLong['latitude'];
$lon_dis = $latLong['longitude'];

$ct_id = $_POST['cat_id'];
$sub_cat_id= $_POST['sub_cat_id'];
$sub_sub_cat_id= $_POST['sub_sub_cat_id'];
$deal_tag= $_POST['deal_tag'];
$deal_key= $_POST['deal_key'];
$deal_created_by= $_POST['deal_created_by'];
?>
<input type="hidden" name="deal_tag_name" id="deal_tag_name" value ="<?php echo $deal_tag; ?>" />
<input type="hidden" name="deal_key_name" id="deal_key_name" value ="<?php echo $deal_key; ?>" />
<input type="hidden" name="sel_cat_id" id="sel_cat_id" value ="<?php echo $ct_id; ?>" />
<input type="hidden" name="sel_sub_cat_id" id="sel_sub_cat_id" value ="<?php echo $sub_cat_id; ?>" />
<input type="hidden" name="sel_sub_sub_cat_id" id="sel_sub_sub_cat_id" value ="<?php echo $sub_sub_cat_id; ?>" />
<input type="hidden" name="deal_created_by" id="deal_created_by" value ="<?php echo $deal_created_by; ?>" />
<div id="accordion" curr_value_calculate="-" curr_percent="-" curr_src_panel="-">
						<h3>Off<i class="fa fa-plus plus" aria-hidden="true"></i><i class="fa fa-minus minus" aria-hidden="true"></i></h3>
						<div clk_data="roundedOne7">
						<div class="rounded-select">
						<div class="roundedOne">
						<input type="radio" name="value_calculate" value="1" id="roundedOne7" class="value_calculate_type" checked />
						<label for="roundedOne7"></label>
						</div>
						<p>%</p>
						</div>
						<div class="rounded-select">
						<div class="roundedOne">
						<input type="radio" name="value_calculate" value="2" id="roundedOne8" class="value_calculate_type" />
						<label for="roundedOne8"></label>
						</div>
						<p>$</p>
						</div>
						  <ul class="off_percent_view">
							<?php
							if($_POST['cat_id'] != 0 ) 
							{
								$ct_id = $_POST['cat_id'];
								if($_POST['sub_cat_id'] != 0)
								{
								$sub_cat_id= $_POST['sub_cat_id'];
									if($_POST['sub_sub_cat_id'] != 0 )
									{	
									$sub_sub_cat_id= $_POST['sub_sub_cat_id'];
									$offer_dis = $wpdb->get_results("SELECT DISTINCT ofr_cat.offer_id,ro.*, rp.price_range_id, rp.status, rp.created_by, usr.location, ofr_cat.cat_id, ofr_cat.offer_id, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM reedemer_offer AS ro INNER JOIN reedemer_partner_settings AS rp ON ro.created_by = rp.created_by INNER JOIN users AS usr ON usr.id = ro.created_by INNER JOIN reedemer_offer_categories as ofr_cat ON ro.id = ofr_cat.offer_id  WHERE ro.value_text = 1 && ro.value_calculate = 2 && ro.status = 1 && ro.published = 'true' && end_date >= CURDATE() && ofr_cat.cat_id =$sub_sub_cat_id && ro.cat_id = $ct_id && ro.subcat_id = $sub_cat_id group by ro.created_by HAVING distance < $min_distance order by distance ASC");
									//echo count($offer_dis);
									}
									else
									{
								     $offer_dis = $wpdb->get_results("SELECT *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `reedemer_offer` WHERE status = 1 && cat_id = $ct_id && subcat_id= $sub_cat_id && value_text = 1 && value_calculate = 2 && published = 'true' && end_date >= CURDATE() group by created_by HAVING distance < $min_distance order by distance ASC");  	
									}
								}
								else
								{	
								$offer_dis = $wpdb->get_results("SELECT *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `reedemer_offer` WHERE status = 1 && cat_id = $ct_id && value_text = 1 && value_calculate = 2 && published = 'true' && end_date >= CURDATE() group by created_by HAVING distance < $min_distance order by distance ASC");	
								}
							}
							elseif($_POST['deal_tag'] != '')
								{	
									$lasttag =$_POST['deal_tag'];
									$offer_dis = $wpdb->get_results("select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer as ro where FIND_IN_SET('$lasttag', more_information) && status = 1 && value_text = 1 && value_calculate = 2 && published = 'true' && end_date >= CURDATE() group by ro.created_by HAVING distance < $min_distance order by distance ASC");
								}
							elseif($_POST['deal_key'] != '')
								{	
									$lastkey = $_POST['deal_key'];
				$offer_dis = $wpdb->get_results("select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `reedemer_offer` as ro WHERE (`offer_description` LIKE '%" .strtolower($_POST['deal_key']). "%' OR `what_you_get` LIKE '%" .strtolower($_POST['deal_key']). "%') && status = 1 && value_text = 1 && value_calculate = 2 && published = 'true' && end_date >= CURDATE() group by ro.created_by HAVING distance < $min_distance order by distance ASC");
//print_r($offer_dis);
								}
								
							elseif($_POST['deal_created_by'] != '')
								{	
									$created_by = $_POST['deal_created_by'];
				$offer_dis = $wpdb->get_results("select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer as ro where status = 1 && value_text = 1 && value_calculate = 2  && published = 'true' && created_by =$created_by && end_date >= CURDATE() group by ro.created_by HAVING distance < $min_distance order by distance ASC");
//print_r($offer_dis);
								}
							else 
							{
								$offer_statge = "SELECT *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `reedemer_offer` WHERE status = 1 && value_text = 1 && value_calculate = 2 && published = 'true' && end_date >= CURDATE() group by created_by HAVING distance < $min_distance order by distance ASC";
								//echo $offer_statge;
								$offer_dis = $wpdb->get_results($offer_statge);
								
							}
							//print_r($offer_dis);
							$five_count = 1;
							$ten_count = 1;
							$twen_count = 1;
							$therty_count = 1;
							foreach($offer_dis as $off_dis){
								$prc_val = ($off_dis->pay_value/$off_dis->retails_value); 
								$percent_friendly = number_format( $prc_val * 100, 2 ) . '%';
								$tot_per = 100 - $percent_friendly;
								if($tot_per > 0){
									$five = $five_count;
									$five_count++;
								}
								if($tot_per >=10){
									$ten = $ten_count;
									$ten_count++;
								}
								if($tot_per >=20){
									$twen = $twen_count;
									$twen_count++;
								}
								if($tot_per >=30 ){
									$therty = $therty_count;
									$therty_count++;
								}
							} 
							?>
							<?php if($five != '') { ?>  
								<li>
									<a href="javascript:void(0);" class="get_data_filter" dta_val="5p" id="Off">
										5% Off or more (<?php echo $five; ?>)
									</a>
								</li>
							<?php } ?>  
							<?php if($ten != '') { ?>  
								<li>
									<a href="javascript:void(0);" class="get_data_filter" dta_val="10p" id="Off">
										10% Off or more (<?php echo $ten; ?>)
									</a>
								</li>
							<?php } ?>  
							<?php if($twen != '') { ?>  
								<li>
									<a href="javascript:void(0);" class="get_data_filter" dta_val="20p" id="Off">
										20% Off or more (<?php echo $twen; ?>)
									</a>
								</li>
							<?php } ?>  
							<?php if($therty != '') { ?>  
								<li>
									<a href="javascript:void(0);" class="get_data_filter" dta_val="30p" id="Off">
										30% Off or more (<?php echo $therty; ?>)
									</a>
								</li>
							<?php } ?>  
                        </ul>
						<ul class="off_doller_view" style="display:none;">
							
							<?php if($_POST['cat_id'] != 0) {
							 /*$ct_id = $_POST['cat_id'];
							 
							$offer_dis = $wpdb->get_results("SELECT *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `reedemer_offer` WHERE status = 1 && cat_id = $ct_id && value_text = 1 && value_calculate = 1 && published = 'true' && discount > 0 HAVING distance < $min_distance order by id desc");*/
							$ct_id = $_POST['cat_id'];
									if($_POST['sub_cat_id'] != 0)
									{
									$sub_cat_id= $_POST['sub_cat_id'];
										if($_POST['sub_sub_cat_id'] != 0 )
										{
											
										$sub_sub_cat_id= $_POST['sub_sub_cat_id'];
										$offer_dis = $wpdb->get_results("SELECT DISTINCT ofr_cat.offer_id,ro.*, rp.price_range_id, rp.status, rp.created_by, usr.location, ofr_cat.cat_id, ofr_cat.offer_id, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM reedemer_offer AS ro INNER JOIN reedemer_partner_settings AS rp ON ro.created_by = rp.created_by INNER JOIN users AS usr ON usr.id = ro.created_by INNER JOIN reedemer_offer_categories as ofr_cat ON ro.id = ofr_cat.offer_id  WHERE ro.value_text = 1 && ro.value_calculate = 1 && ro.status = 1 && ro.published = 'true' && ofr_cat.cat_id =$sub_sub_cat_id && ro.cat_id = $ct_id && ro.subcat_id = $sub_cat_id && ro.end_date >= CURDATE() group by ro.created_by HAVING distance < $min_distance order by distance ASC");
										//echo $new_qury;
										//echo count($offer_dis);
										}
										else
										{
										 $offer_dis = $wpdb->get_results("SELECT *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `reedemer_offer` WHERE status = 1 && cat_id = $ct_id && subcat_id= $sub_cat_id && value_text = 1 && value_calculate = 1 && published = 'true' && end_date >= CURDATE() group by created_by HAVING distance < $min_distance order by distance ASC");  	
										}	
									}
									else
									{	
									$offer_dis = $wpdb->get_results("SELECT *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `reedemer_offer` WHERE status = 1 && cat_id = $ct_id && value_text = 1 && value_calculate = 1 && published = 'true' && end_date >= CURDATE() group by created_by HAVING distance < $min_distance order by distance ASC");	
									}
								}
								else if($_POST['deal_tag'] !='')
								{	
									$lasttag =$_POST['deal_tag'];
									$offer_dis = $wpdb->get_results("select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer as ro where FIND_IN_SET('$lasttag', more_information) && status = 1 && value_text = 1 && value_calculate = 1 && published = 'true' && end_date >= CURDATE() group by created_by HAVING distance < $min_distance order by distance ASC");
								}
								elseif($_POST['deal_key'] != '')
								{	
									$lastkey = $_POST['deal_key'];
				$offer_dis = $wpdb->get_results("select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `reedemer_offer` as ro WHERE (`offer_description` LIKE '%" .strtolower($_POST['deal_key']). "%' OR `what_you_get` LIKE '%" .strtolower($_POST['deal_key']). "%') && status = 1 && value_text = 1 && value_calculate = 1 && published = 'true' && end_date >= CURDATE() group by ro.created_by HAVING distance < $min_distance order by distance ASC");
//print_r($offer_dis);
								}
								elseif($_POST['deal_created_by'] != '')
								{	
									$created_by = $_POST['deal_created_by'];
				$offer_dis = $wpdb->get_results("select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer as ro where ro.value_text = 1 && ro.value_calculate = 1 && ro.status = 1 && ro.published = 'true' && created_by =$created_by && end_date >= CURDATE() group by ro.created_by HAVING distance < $min_distance order by distance ASC");
//print_r($offer_dis);
								}
								else {
								
								$offer_dis = $wpdb->get_results("SELECT *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `reedemer_offer` WHERE status = 1 && value_text = 1 && value_calculate = 1 && published = 'true' && end_date >= CURDATE() group by created_by HAVING distance < $min_distance order by distance ASC");
								//echo "SELECT *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `reedemer_offer` WHERE status = 1 && value_text = 1 && value_calculate = 1 && published = 'true' && discount > 0 HAVING distance < $min_distance order by id desc";
								//echo count($offer_dis);
								
							} 
							$five_count_dol = 1;
							$ten_count_dol = 1;
							$twen_count_dol = 1;
							$therty_count_dol = 1;

							
							foreach($offer_dis as $off_dis){
								$dis_val = ($off_dis->retails_value - $off_dis->pay_value);
								if( $dis_val <= 10) {
									$ten_less = $five_count_dol;
									$five_count_dol++;
								}
								if($dis_val <= 20) {
									$twen_less = $ten_count_dol;
									$ten_count_dol++;
								}
								if($dis_val <= 30) {
									$thirty_less = $twen_count_dol;
									$twen_count_dol++;
								}
								if($dis_val >= 31) {
									$thirty_more = $therty_count_dol;
									$therty_count_dol++;
								}
								
							}
							
							
							?>
							<?php if($ten_less > 0) { ?>
							<li>
							
								<a href="javascript:void(0);" class="get_data_filter" dta_val="10" id="Off_dol">
									$10 Off or less (<?php echo $ten_less; ?>)
								</a>
							</li>
							<?php } 
							if($twen_less > 0) {
							?>
							<li>
								<a href="javascript:void(0);" class="get_data_filter" dta_val="20" id="Off_dol">
								$20 Off or less (<?php echo $twen_less; ?>)
								</a>
							</li>
							<?php }
							if($thirty_less > 0) {?>
							<li>
								<a href="javascript:void(0);" class="get_data_filter" dta_val="30" id="Off_dol">
								$30 Off or less (<?php echo $thirty_less; ?>)
								</a>
							</li>
							<?php }
							if ($thirty_more > 0 ) {
							?>
							<li>
								<a href="javascript:void(0);" class="get_data_filter" dta_val="31" id="Off_dol">
								$31 Off or more (<?php echo $thirty_more; ?>)
								</a>
							</li>
							<?php } ?>
						</ul> 
						</div>
                       <h3>Savings<i class="fa fa-plus plus" aria-hidden="true"></i><i class="fa fa-minus minus" aria-hidden="true"></i></h3>
						<div clk_data="roundedOne3">
						<div class="rounded-select">
						<div class="roundedOne">
						<input type="radio" name="value_calculate" value="5" id="roundedOne3" class="value_calculate_type" checked />
						<label for="roundedOne3"></label>
						</div>
						<p>%</p>
						</div>
						<div class="rounded-select">
						<div class="roundedOne">
						<input type="radio" name="value_calculate" value="6" id="roundedOne4" class="value_calculate_type" />
						<label for="roundedOne4"></label>
						</div>
						<p>$</p>
						</div>
						<ul class="savings_percent_view">
							<?php
							if($_POST['cat_id'] != 0) {
							 /*$ct_id = $_POST['cat_id'];
							$offer_dis = $wpdb->get_results("SELECT *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `reedemer_offer` WHERE status = 1 && cat_id = $ct_id && value_text = 3 && value_calculate = 2 && published = 'true' && discount > 0 HAVING distance < $min_distance order by id desc");*/
							$ct_id = $_POST['cat_id'];
								if($_POST['sub_cat_id'] != 0)
								{
								$sub_cat_id= $_POST['sub_cat_id'];
								if($_POST['sub_sub_cat_id'] != 0 )
									{
										
									$sub_sub_cat_id= $_POST['sub_sub_cat_id'];
									$offer_dis = $wpdb->get_results("SELECT DISTINCT ofr_cat.offer_id,ro.*, rp.price_range_id, rp.status, rp.created_by, usr.location, ofr_cat.cat_id, ofr_cat.offer_id, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM reedemer_offer AS ro INNER JOIN reedemer_partner_settings AS rp ON ro.created_by = rp.created_by INNER JOIN users AS usr ON usr.id = ro.created_by INNER JOIN reedemer_offer_categories as ofr_cat ON ro.id = ofr_cat.offer_id  WHERE ro.value_text = 3 && ro.value_calculate = 2 && ro.status = 1 && ro.published = 'true' && ofr_cat.cat_id =$sub_sub_cat_id && ro.cat_id = $ct_id && ro.subcat_id = $sub_cat_id && ro.end_date >= CURDATE() group by ro.created_by HAVING distance < $min_distance order by distance ASC");
									//echo count($offer_dis);
									}
									else
									{
								     $offer_dis = $wpdb->get_results("SELECT *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `reedemer_offer` WHERE status = 1 && cat_id = $ct_id && subcat_id= $sub_cat_id && value_text = 3 && value_calculate = 2 && published = 'true' && end_date >= CURDATE() group by created_by HAVING distance < $min_distance order by distance ASC");  	
									}	
								}
								else
								{	
								$offer_dis = $wpdb->get_results("SELECT *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `reedemer_offer` WHERE status = 1 && cat_id = $ct_id && value_text = 3 && value_calculate = 2 && published = 'true' && end_date >= CURDATE() HAVING distance < $min_distance order by distance ASC");	
								}
								}
								elseif($_POST['deal_tag'] != '')
								{	
									$lasttag =$_POST['deal_tag'];
									$offer_dis = $wpdb->get_results("select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer as ro where FIND_IN_SET('$lasttag', more_information) && status = 1 && value_text = 3 && value_calculate = 2 && published = 'true' && end_date >= CURDATE() group by created_by HAVING distance < $min_distance order by distance ASC");
								}
								elseif($_POST['deal_key'] != '')
								{	
									$lastkey = $_POST['deal_key'];
				$offer_dis = $wpdb->get_results("select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `reedemer_offer` as ro WHERE (`offer_description` LIKE '%" .strtolower($_POST['deal_key']). "%' OR `what_you_get` LIKE '%" .strtolower($_POST['deal_key']). "%') && status = 1 && value_text = 3 && value_calculate = 2 && published = 'true' && end_date >= CURDATE() group by ro.created_by HAVING distance < $min_distance order by distance ASC");
//print_r($offer_dis);
								}
								elseif($_POST['deal_created_by'] != '')
								{	
									$created_by = $_POST['deal_created_by'];
				$offer_dis = $wpdb->get_results("select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer as ro where ro.value_text = 3 && ro.value_calculate = 2 && status = 1 && published = 'true' && created_by =$created_by  && end_date >= CURDATE() group by ro.created_by HAVING distance < $min_distance order by distance ASC");
//print_r($offer_dis);
								}
								else 
								{
								$offer_statge = "SELECT *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `reedemer_offer` WHERE status = 1 && value_text = 3 && value_calculate = 2 && published = 'true' && end_date >= CURDATE() group by created_by HAVING distance < $min_distance order by distance ASC";
								
								//echo $offer_statge;
								
								$offer_dis = $wpdb->get_results($offer_statge);
							}
							$five_count_sav = 1;
							$ten_count_sav = 1;
							$twen_count_sav = 1;
							$therty_count_sav = 1;
							foreach($offer_dis as $off_dis){
								$prc_val = ($off_dis->pay_value/$off_dis->retails_value); 
								$percent_friendly = number_format( $prc_val * 100, 2 ) . '%';
								$tot_per = 100 - $percent_friendly;
								if($tot_per >=5){
									$five_sav = $five_count_sav;
									$five_count_sav++;
								}
								if($tot_per >=10){
									$ten_sav = $ten_count_sav;
									$ten_count_sav++;
								}
								if($tot_per >=20){
									$twen_sav = $twen_count_sav;
									$twen_count_sav++;
								}
								if($tot_per >=30){
									$therty_sav = $therty_count_sav;
									$therty_count_sav++;
								}
							} 
							?>
							<?php if($five_sav != '') { ?>
                            <li>								
								<a href="javascript:void(0);" class="get_data_filter" dta_val="5p" id="savings">
									5% Savings or more (<?php echo $five_sav; ?>)
								</a>								
							</li>
							<?php } ?>
							<?php if($ten_sav != '') { ?>
                            <li>								
								<a href="javascript:void(0);" class="get_data_filter" dta_val="10p" id="savings">
									10% Savings or more (<?php echo $ten_sav; ?>)
								</a>								
							</li>
							<?php } ?>
							<?php if($twen_sav != '') { ?>
                            <li>								
								<a href="javascript:void(0);" class="get_data_filter" dta_val="20p" id="savings">
									20% Savings or more (<?php echo $twen_sav; ?>)
								</a>
							</li>
							<?php } ?>
							<?php if($therty_sav != '') { ?>
                            <li>								
								<a href="javascript:void(0);" class="get_data_filter" dta_val="30p" id="savings">
									30% Savings or more (<?php echo $therty_sav; ?>)
								</a>								
							</li>
							<?php } ?>
                        </ul>						
						<?php wp_reset_postdata(); ?>
						<ul class="savings_doller_view" style="display:none;">
							
							<?php if($_POST['cat_id'] != 0) {
							 /*$ct_id = $_POST['cat_id'];
							$offer_dis = $wpdb->get_results("SELECT *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `reedemer_offer` WHERE status = 1 && cat_id = $ct_id && value_text = 3 && value_calculate = 1 && published = 'true' && discount > 0 HAVING distance < $min_distance order by id desc");*/
							$ct_id = $_POST['cat_id'];
								if($_POST['sub_cat_id'] != 0)
								{
								$sub_cat_id= $_POST['sub_cat_id'];
								if($_POST['sub_sub_cat_id'] != 0 )
									{
										
									$sub_sub_cat_id= $_POST['sub_sub_cat_id'];
									$offer_dis = $wpdb->get_results("SELECT DISTINCT ofr_cat.offer_id,ro.*, rp.price_range_id, rp.status, rp.created_by, usr.location, ofr_cat.cat_id, ofr_cat.offer_id, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM reedemer_offer AS ro INNER JOIN reedemer_partner_settings AS rp ON ro.created_by = rp.created_by INNER JOIN users AS usr ON usr.id = ro.created_by INNER JOIN reedemer_offer_categories as ofr_cat ON ro.id = ofr_cat.offer_id  WHERE ro.value_text = 3 && ro.value_calculate = 1 && ro.status = 1 && ro.published = 'true' && ofr_cat.cat_id =$sub_sub_cat_id && ro.cat_id = $ct_id && ro.subcat_id = $sub_cat_id && end_date >= CURDATE() group by ro.created_by HAVING distance < $min_distance order by distance ASC");
									//echo count($offer_dis);
									}
									else
									{
								     $offer_dis = $wpdb->get_results("SELECT *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `reedemer_offer` WHERE status = 1 && cat_id = $ct_id && subcat_id= $sub_cat_id && value_text = 3 && value_calculate = 1 && published = 'true' && end_date >= CURDATE() group by created_by HAVING distance < $min_distance order by distance ASC");  	
									}	
								}
								else
								{	
								$offer_dis = $wpdb->get_results("SELECT *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `reedemer_offer` WHERE status = 1 && cat_id = $ct_id && value_text = 3 && value_calculate = 1 && published = 'true' && end_date >= CURDATE() group by created_by HAVING distance < $min_distance order by distance ASC");	
								}
								}
							elseif($_POST['deal_tag'] != '')
								{	
									$lasttag =$_POST['deal_tag'];
									$offer_dis = $wpdb->get_results("select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer as ro where FIND_IN_SET('$lasttag', more_information) && status = 1 && value_text = 3 && value_calculate = 1 && published = 'true' && end_date >= CURDATE() group by created_by HAVING distance < $min_distance order by distance ASC");
								}
								elseif($_POST['deal_key'] != '')
								{	
									$lastkey = $_POST['deal_key'];
				$offer_dis = $wpdb->get_results("select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `reedemer_offer` as ro WHERE (`offer_description` LIKE '%" .strtolower($_POST['deal_key']). "%' OR `what_you_get` LIKE '%" .strtolower($_POST['deal_key']). "%') && status = 1 && value_text = 3 && value_calculate = 1 && published = 'true' && end_date >= CURDATE() group by ro.created_by HAVING distance < $min_distance order by distance ASC");

//print_r($offer_dis);

								}
								elseif($_POST['deal_created_by'] != '')
								{	
									$created_by = $_POST['deal_created_by'];
				$offer_dis = $wpdb->get_results("select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer as ro where ro.value_text = 3 && ro.value_calculate = 1 && status = 1 && published = 'true' && created_by =$created_by  && end_date >= CURDATE() group by ro.created_by HAVING distance < $min_distance order by distance ASC");
//print_r($offer_dis);
								}
							else 
							{
								$offer_dis = $wpdb->get_results("SELECT *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `reedemer_offer` WHERE status = 1 && value_text = 3 && value_calculate = 1 && published = 'true' && end_date >= CURDATE() group by created_by HAVING distance < $min_distance order by distance ASC");
								
							} 
							$five_count_sav_dol = 1;
							$ten_count_sav_dol = 1;
							$twen_count_sav_dol = 1;
							$therty_count_sav_dol = 1;
							foreach($offer_dis as $off_dis){
								$dis_val_sav_dol = ($off_dis->retails_value - $off_dis->pay_value);
								if($dis_val_sav_dol <= 10) {
									$ten_less_sav_dol = $five_count_sav_dol;
									$five_count_sav_dol++;
								}
								if($dis_val_sav_dol <= 20) {
									$twen_less_sav_dol = $ten_count_sav_dol;
									$ten_count_sav_dol++;
								}
								if($dis_val_sav_dol <= 30) {
									$thirty_less = $twen_count;
									$twen_count_sav_dol++;
								}
								if($dis_val_sav_dol >= 31) {
									$thirty_more_sav_dol = $therty_count_sav_dol;
									$therty_count_sav_dol++;
								}
								
							}
							
							
							?>
							<?php if($ten_less_sav_dol > 0) { ?>
								<li>
									<a href="javascript:void(0);" class="get_data_filter" dta_val="10" id="savings_dol">
									$10 Savings or less (<?php echo $ten_less_sav_dol; ?>)
									</a>
								</li>
							<?php } 
							if($twen_less_sav_dol > 0) { 
							?>
								<li>
									<a href="javascript:void(0);" class="get_data_filter" dta_val="20" id="savings_dol">
									$20 Savings or less (<?php echo $twen_less_sav_dol; ?>)
									</a>
								</li>
							<?php } 
							if($thirty_less_sav_dol > 0) { 
							?>
								<li>
									<a href="javascript:void(0);" class="get_data_filter" dta_val="30" id="savings_dol">
									$30 Savings or less (<?php echo $thirty_less_sav_dol; ?>)
									</a>
								</li>
							<?php } 
							if($thirty_more_sav_dol > 0) { 
							?>
								<li>
									<a href="javascript:void(0);" class="get_data_filter" dta_val="31" id="savings_dol">
									$31 Savings or more (<?php echo $thirty_more_sav_dol; ?>)
									</a>
								</li>
							<?php } ?>
						</ul>    
						</div>
                      <h3>Discount
						  <i class="fa fa-plus plus" aria-hidden="true"></i>
						  <i class="fa fa-minus minus" aria-hidden="true"></i>
					  </h3>
                      <div clk_data="roundedOne5">
                       <div class="rounded-select">
                            <div class="roundedOne">
                                <input type="radio" name="value_calculate" value=7 id="roundedOne5" class="value_calculate_type dis_per"  />
                                <label for="roundedOne5"></label>
                            </div>
                            <p>%</p>
                        </div>
                        <div class="rounded-select">
                            <div class="roundedOne">
                                <input type="radio" name="value_calculate" value=8 id="roundedOne6"  class="value_calculate_type dis_dol" />
                                <label for="roundedOne6"></label>
                            </div>
                            <p>$</p>
                        </div>
                        <ul class="discount_percent_view">
							<?php
							if($_POST['cat_id'] != 0) {
							 /*$ct_id = $_POST['cat_id'];
							$offer_dis = $wpdb->get_results("SELECT *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `reedemer_offer` WHERE status = 1 && cat_id = $ct_id && value_text = 2 && value_calculate = 2 && published = 'true' && discount > 0 HAVING distance < $min_distance order by id desc");*/
							$ct_id = $_POST['cat_id'];
								if($_POST['sub_cat_id'] != 0)
								{
								$sub_cat_id= $_POST['sub_cat_id'];
								if($_POST['sub_sub_cat_id'] != 0 )
									{
										
									$sub_sub_cat_id= $_POST['sub_sub_cat_id'];
									$offer_dis = $wpdb->get_results("SELECT DISTINCT ofr_cat.offer_id,ro.*, rp.price_range_id, rp.status, rp.created_by, usr.location, ofr_cat.cat_id, ofr_cat.offer_id, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM reedemer_offer AS ro INNER JOIN reedemer_partner_settings AS rp ON ro.created_by = rp.created_by INNER JOIN users AS usr ON usr.id = ro.created_by INNER JOIN reedemer_offer_categories as ofr_cat ON ro.id = ofr_cat.offer_id  WHERE ro.value_text = 2 && ro.value_calculate = 2 && ro.status = 1 && ro.published = 'true' && ofr_cat.cat_id =$sub_sub_cat_id && ro.cat_id = $ct_id && ro.subcat_id = $sub_cat_id && ro.end_date >= CURDATE() group by ro.created_by HAVING distance < $min_distance order by distance ASC");

									//echo count($offer_dis);

									}
									else
									{
								     $offer_dis = $wpdb->get_results("SELECT *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `reedemer_offer` WHERE status = 1 && cat_id = $ct_id && subcat_id= $sub_cat_id && value_text = 2 && value_calculate = 2 && published = 'true' && end_date >= CURDATE() group by created_by HAVING distance < $min_distance order by distance ASC");  	
									}	
								}
								else
								{	
								$offer_dis = $wpdb->get_results("SELECT *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `reedemer_offer` WHERE status = 1 && cat_id = $ct_id && value_text = 2 && value_calculate = 2 && published = 'true' && end_date >= CURDATE() group by created_by HAVING distance < $min_distance order by distance ASC");	
								}
								}
								elseif($_POST['deal_tag'] != '')
								{	
									$lasttag =$_POST['deal_tag'];
									$offer_dis = $wpdb->get_results("select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer as ro where FIND_IN_SET('$lasttag', more_information) && status = 1 && value_text = 2 && value_calculate = 2 && published = 'true' && end_date >= CURDATE()  group by created_by HAVING distance < $min_distance order by distance ASC");
								}
								elseif($_POST['deal_key'] != '')
								{	
									$lastkey = $_POST['deal_key'];
				$offer_dis = $wpdb->get_results("select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `reedemer_offer` as ro WHERE (`offer_description` LIKE '%" .strtolower($_POST['deal_key']). "%' OR `what_you_get` LIKE '%" .strtolower($_POST['deal_key']). "%') && status = 1 && value_text = 2 && value_calculate = 2 && published = 'true' && end_date >= CURDATE() group by ro.created_by HAVING distance < $min_distance order by distance ASC");
//print_r($offer_dis);
								}
								elseif($_POST['deal_created_by'] != '')
								{	
									$created_by = $_POST['deal_created_by'];
				$offer_dis = $wpdb->get_results("select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer as ro where ro.value_text = 2 && ro.value_calculate = 2 && status = 1 && published = 'true' && created_by =$created_by  && end_date >= CURDATE() group by ro.created_by HAVING distance < $min_distance order by distance ASC");
//print_r($offer_dis);
								}
							else 
							{
								$offer_dis = $wpdb->get_results("SELECT *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `reedemer_offer` WHERE status = 1 && value_text = 2 && value_calculate = 2 && published = 'true' && end_date >= CURDATE()  group by created_by HAVING distance < $min_distance order by distance ASC");								
							}
							$five_count_dis = 1;
							$ten_count_dis = 1;
							$twen_count_dis = 1;
							$therty_count_dis = 1;
							foreach($offer_dis as $off_dis){
								$prc_val = ($off_dis->pay_value/$off_dis->retails_value); 
								$percent_friendly = number_format( $prc_val * 100, 2 ) . '%';
								$tot_per = 100 - $percent_friendly;
								if($tot_per <=10){
									$five_dis = $five_count_dis;
									$five_count_dis++;
								}
								if($tot_per >10 && $tot_per <=20){
									$ten_dis = $ten_count_dis;
									$ten_count_dis++;
								}
								if($tot_per >20 && $tot_per <=30){
									$twen_dis = $twen_count_dis;
									$twen_count_dis++;
								}
								if($tot_per >30){
									$therty_dis = $therty_count_dis;
									$therty_count_dis++;
								}
							} 
							?>
							<?php if($five_dis != '') { ?>
								<li>								
									<a href="javascript:void(0);" class="get_data_filter" dta_val="5p" id="Discount">
										5% Discount or more (<?php echo $five_dis; ?>)
									</a>								
								</li>
							<?php } ?>
							<?php if($ten_dis != '') { ?>
								<li>								
									<a href="javascript:void(0);" class="get_data_filter" dta_val="10p" id="Discount">
										10% Discount or more (<?php echo $ten_dis; ?>)
									</a>								
								</li>
							<?php } ?>
							<?php if($twen_dis != '') { ?>
								<li>
									<a href="javascript:void(0);" class="get_data_filter" dta_val="20p" id="Discount">
										20% Discount or more (<?php echo $twen_dis; ?>)
									</a>
								</li>
							<?php } ?>							
							<?php if($therty_dis != '') { ?>
								<li>
									<a href="javascript:void(0);" class="get_data_filter" dta_val="30p" id="Discount">
										30% Discount or more (<?php echo $therty_dis; ?>)
									</a>
								</li>
							<?php } ?>
                        </ul>
						<ul class="discount_doller_view" style="display:none;">
							
							<?php if($_POST['cat_id'] != 0) {
							 /*$ct_id = $_POST['cat_id'];
							$offer_dis = $wpdb->get_results("SELECT *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `reedemer_offer` WHERE status = 1 && cat_id = $ct_id && value_text = 2 && value_calculate = 1 && published = 'true' && discount > 0 HAVING distance < $min_distance order by id desc");*/
							$ct_id = $_POST['cat_id'];
								if($_POST['sub_cat_id'] != 0)
								{
								$sub_cat_id= $_POST['sub_cat_id'];
								if($_POST['sub_sub_cat_id'] != 0 )
									{
										
									$sub_sub_cat_id= $_POST['sub_sub_cat_id'];
									$offer_dis = $wpdb->get_results("SELECT DISTINCT ofr_cat.offer_id,ro.*, rp.price_range_id, rp.status, rp.created_by, usr.location, ofr_cat.cat_id, ofr_cat.offer_id, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM reedemer_offer AS ro INNER JOIN reedemer_partner_settings AS rp ON ro.created_by = rp.created_by INNER JOIN users AS usr ON usr.id = ro.created_by INNER JOIN reedemer_offer_categories as ofr_cat ON ro.id = ofr_cat.offer_id  WHERE ro.value_text = 2 && ro.value_calculate = 1 && ro.status = 1 && ro.published = 'true' && ofr_cat.cat_id =$sub_sub_cat_id && ro.cat_id = $ct_id && ro.subcat_id = $sub_cat_id && ro.end_date >= CURDATE() group by ro.created_by HAVING distance < $min_distance order by distance ASC");
									//echo count($offer_dis);
									}
									else
									{
								     $offer_dis = $wpdb->get_results("SELECT *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `reedemer_offer` WHERE status = 1 && cat_id = $ct_id && subcat_id= $sub_cat_id && value_text = 2 && value_calculate = 1 && published = 'true' && end_date >= CURDATE()  group by created_by HAVING distance < $min_distance order by distance ASC");  	
									}	
								}
								else
								{	
								$offer_dis = $wpdb->get_results("SELECT *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `reedemer_offer` WHERE status = 1 && cat_id = $ct_id && value_text = 2 && value_calculate = 1 && published = 'true' && end_date >= CURDATE()  group by created_by HAVING distance < $min_distance order by distance ASC");	
								}	
							}
							elseif($_POST['deal_tag'] != '')
								{	
									$lasttag =$_POST['deal_tag'];
									$offer_dis = $wpdb->get_results("select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer as ro where FIND_IN_SET('$lasttag', more_information) && status = 1 && value_text = 2 && value_calculate = 1 && published = 'true' && end_date >= CURDATE()  group by created_by HAVING distance < $min_distance order by distance ASC");
								}
								elseif($_POST['deal_key'] != '')
								{	
									$lastkey = $_POST['deal_key'];
				$offer_dis = $wpdb->get_results("select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `reedemer_offer` as ro WHERE (`offer_description` LIKE '%" .strtolower($_POST['deal_key']). "%' OR `what_you_get` LIKE '%" .strtolower($_POST['deal_key']). "%') && status = 1 && value_text = 1 && value_calculate = 2 && published = 'true' && end_date >= CURDATE() group by ro.created_by HAVING distance < $min_distance order by distance ASC");
//print_r($offer_dis);
								}
								elseif($_POST['deal_created_by'] != '')
								{	
									$created_by = $_POST['deal_created_by'];
				$offer_dis = $wpdb->get_results("select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer as ro where ro.value_text = 1 && ro.value_calculate = 2 && status = 1 && published = 'true' && created_by =$created_by  && end_date >= CURDATE() group by ro.created_by HAVING distance < $min_distance order by distance ASC");
//print_r($offer_dis);
								}
							else 
							{
								$offer_dis = $wpdb->get_results("SELECT *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `reedemer_offer` WHERE status = 1 && value_text = 2 && value_calculate = 1 && published = 'true' && end_date >= CURDATE()  group by created_by HAVING distance < $min_distance order by distance ASC");
								
								
								
							} 
							$five_count_dis_dol = 1;
							$ten_count_dis_dol = 1;
							$twen_count_dis_dol = 1;
							$therty_count_dis_dol = 1;
							foreach($offer_dis as $off_dis){
								$dis_val_sav_dol = ($off_dis->retails_value - $off_dis->pay_value);
								if($dis_val_sav_dol <= 10) {
									$ten_less_dis_dol = $five_count_dis_dol;
									$five_count_dis_dol++;
								}
								if($dis_val_sav_dol <= 20) {
									$twen_less_dis_dol = $ten_count_dis_dol;
									$ten_count_dis_dol++;
								}
								if($dis_val_sav_dol <= 30) {
									$thirty_less_dis_dol = $twen_count_dis_dol;
									$twen_count_dis_dol++;
								}
								if($dis_val_sav_dol >= 31) {
									$thirty_more_dis_dol = $therty_count_dis_dol;
									$therty_count_dis_dol++;
								}
								
							}
							
							
							?>
							<?php if($ten_less_dis_dol >0 ) { ?>
								<li>							
									<a href="javascript:void(0);" class="get_data_filter" dta_val="10" id="Discount_dol">
									$10 Discount or less (<?php echo $ten_less_dis_dol; ?>)
									</a>
								</li>
							<?php } ?>
							<?php if($twen_less_dis_dol >0 ) { ?>
								<li>
									<a href="javascript:void(0);" class="get_data_filter" dta_val="20" id="Discount_dol">
									$20 Discount or less (<?php echo $twen_less_dis_dol; ?>)
									</a>
								</li>
							<?php } ?>							
							<?php if($thirty_less_dis_dol >0 ) { ?>
								<li>
									<a href="javascript:void(0);" class="get_data_filter" dta_val="30" id="Discount_dol">
									$30 Discount or less (<?php echo $thirty_less_dis_dol; ?>)
									</a>
								</li>
							<?php } ?>							
							<?php if($thirty_more_dis_dol >0 ) { ?>
								<li>
									<a href="javascript:void(0);" class="get_data_filter" dta_val="31" id="Discount_dol">
									$31 Discount or more (<?php echo $thirty_more_dis_dol; ?>)
									</a>
								</li>
							<?php } ?>
						</ul>    
                      </div>
                      
                    </div>	

<!--Discount Show & Hide Start-->	
<script type="text/javascript">	
	
	$("#roundedOne3").click(function(){
		$(".savings_doller_view").hide();
		$(".savings_percent_view").show();
	});

	$("#roundedOne4").click(function(){
		$(".savings_percent_view").hide();
		$(".savings_doller_view").show();
	});
	$("#roundedOne5").click(function(){
		$(".discount_doller_view").hide();
		$(".discount_percent_view").show();
	});

	$("#roundedOne6").click(function(){
		$(".discount_percent_view").hide();
		$(".discount_doller_view").show();
	});
	$("#roundedOne7").click(function(){
		$(".off_doller_view").hide();
		$(".off_percent_view").show();
	});

	$("#roundedOne8").click(function(){
		$(".off_percent_view").hide();
		$(".off_doller_view").show();
	});
	
	$("li").delegate(".get_data_filter","click",function(){
		
		var cur_dv = $(this).parent().parent().parent().attr("clk_data");	
        $( "#accordion" ).attr("curr_percent",$(this).attr('dta_val'));	
        $( "#accordion" ).attr("curr_src_panel",$(this).attr('id'));	 
        $('#'+cur_dv).click();
	
		var def_loc = $("#deal_loc").val();
		 var curr_percent = $( "#accordion" ).attr("curr_percent");
	      var curr_src_panel =$( "#accordion" ).attr("curr_src_panel");			
	      var min_vl = "";
	      var max_vl = "";		  
		  var cat_id = $("#sel_cat_id").val();
		  var sub_cat_id = $("#sel_sub_cat_id").val();
		  var sub_sub_cat_id = $("#sel_sub_sub_cat_id").val();
		  var deal_tag = $("#deal_tag_name").val();
		  var deal_key = $("#deal_key_name").val();
		  var deal_created_by =$("#deal_created_by").val();
			if(cat_id != '' && typeof cat_id != 'undefined'){
				cat_id = cat_id;
			}else {
				cat_id = 0;	
			}
			if(sub_cat_id != '' && typeof sub_cat_id != 'undefined'){
				sub_cat_id = sub_cat_id;
			}else {
				sub_cat_id = 0;	
			}
		
			if(curr_src_panel == 'Off_dol') {
				$(".off_doller_view").css('display','block');
				$(".off_percent_view").css('display','none');
				var $radios = $('input:radio[name=value_calculate]');
				$radios.filter('[value=2]').prop('checked', true);
				var value_calculate = 1;
				var value_text = 1;

			}
			if(curr_src_panel == 'savings_dol') {
				$(".savings_doller_view").css('display','block');
				$(".savings_percent_view").css('display','none');
				var $radios = $('input:radio[name=value_calculate]');
				$radios.filter('[value=6]').prop('checked', true);
				var value_calculate = 1;
				var value_text = 3;

			}
			if(curr_src_panel == 'Discount_dol') {
				$(".discount_doller_view").css('display','block');
				$(".discount_percent_view").css('display','none');
				var $radios = $('input:radio[name=value_calculate]');
				$radios.filter('[value=8]').prop('checked', true);
				var value_calculate = 1;
				var value_text = 2;

			}
          $.ajax({
              type: "POST",
              url: "<?php echo site_url() ?>/index.php/deal-searching/",
              data: {"curr_percent":curr_percent,"curr_src_panel":curr_src_panel,"def_loc":def_loc,"value_calculate":value_calculate,"value_text":value_text,"cat_id":cat_id,"sub_cat_id":sub_cat_id,"sub_sub_cat_id":sub_sub_cat_id,"deal_tag":deal_tag , "dealkey":deal_key,"deal_created_by":deal_created_by },			  
              beforeSend: function(){
                  
              },
              success: function(data){
                  //console.log(data);			  
                  var obj = $.parseJSON(data);
                  $('#block_data').empty();
                  if(obj.status == "true")
                  {
         
                     $('#block_data').html(obj.res_data);
                     $( "#slider-range" ).slider( "option", "min", Math.round(obj.min_val) );
                     $( "#slider-range" ).slider( "option", "max", Math.round(obj.max_val) );
                     $( "#slider-range" ).slider( "values",  [ Math.round(obj.min_val), Math.round(obj.max_val ) ]  );

                     $('#l_bound').text(Math.round(obj.min_val));
                     $('#u_bound').text(Math.round(obj.max_val));					 
					 $('#min_pr').val(Math.round(obj.min_val));
					 $('#max_pr').val(Math.round(obj.max_val));  
					 $( "#accordion" ).attr("curr_percent","-");
					 $( "#accordion" ).attr("curr_src_panel","-");
					  var obj_markers = obj.marker;
					  
					  
					  
					  var markers = [];
                       $.each(obj_markers, function(i, obj) {
                       markers.push([obj.address,obj.lat, obj.lng,atob(obj.offer_image_path),obj.offer_desc,obj.total_per,obj.retail_val,obj.pay_val]);
                       });
					  
					  //console.log(markers);
					  
					 
				google.maps.event.addDomListener(window, 'load', initialize(markers));
					
                  }else if(obj.status == "false")
                  {
					 $('#block_data').html(obj.res_data); 
				  }
                 
              }

          });
		
		//e.preventDefault();
		
      });
	
	 $( "#accordion" ).accordion({
	 	active: false,
    	collapsible: true
	 });
</script>	
<!--Discount Show & Hide End-->	
