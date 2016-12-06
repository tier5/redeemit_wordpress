<?php
/*
Template Name: New Home Page
*/

global $wpdb; 
$category_tab="SELECT * FROM reedemer_category WHERE status='1' AND parent_id='0' ORDER BY id DESC LIMIT 9";
$categories = $wpdb->get_results($category_tab);



if($_COOKIE['location_input'] != '') {
	$default_loc = $_COOKIE['location_input'];
}else {
	$default_loc = 'Yonkers';
}
// SHOWING PARTNER LOGO
$partner_logos ="SELECT * FROM reedemer_logo WHERE status='1' LIMIT 14";
$partner_logo =  $wpdb->get_results($partner_logos);
//
get_header(); ?>
<!-- Header End -->
<div class="clear"></div>
<!-- Banner Start -->
<section class="banner">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-sm-8 banner-img noleftpadding"><img src="<?php echo get_template_directory_uri(); ?>/images/1.jpg" class="img-responsive"></div>
			<div class="col-md-4 col-sm-4 banner-content">
				<h1>10% cash back at <color>trem</color> red hots</h1>
				<p>Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam sit amet quam vehicula elementum sed sit.  </p>
				<p>Vivamus magna justo, lacinia eget consectetur sed.</p>
				<a href="#" class="black-btn">Order now</a>
			</div>
		</div>
	</div>
</section>
<!-- Banner End -->
<div class="clear"></div>
<section class="main-content">
	<div class="container">
		<div class="row">
			<div class="firstgrid">
				<div class="col-md-6 col-sm-6 noleftpadding deal-left">
					<div class="two-product">
						<div class="row">
							<div class="col-md-6 col-sm-6">
								<div class="offer-product">
									<div class="pro-img">
										<img src="<?php echo get_template_directory_uri(); ?>/images/3.jpg" class="img-responsive">
									</div>
									<div class="pro-descr">
										<span class="limited-time"></span>
										<h2>Heels only <span class="price">Rs 642</span></h2>
										<a href="#" class="black-btn">Claim the deal</a>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 noleftpadding">
								<div class="offer-product">
									<div class="pro-img">
										<img src="<?php echo get_template_directory_uri(); ?>/images/2.jpg" class="img-responsive">
									</div>
									<div class="pro-descr">
										<span class="limited-time">limited time</span>
										<h2>straw hat only <span class="price">Rs 230</span></h2>
										<a href="#" class="black-btn">save 75%</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="clear"></div>
					<div class="subscribe">
						<div class="row">
							<div class="col-md-12">
								<h2>get the offer sign up!</h2>
								<strong>No junk. Just exclusive offer and latest trends</strong>
								<form>
									<input type="email" placeholder="Enter email address">
									<input type="submit" value="subscribe">
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6  col-sm-6">
					<div class="row">
						<div class="excl-deal">
							<img src="<?php echo get_template_directory_uri(); ?>/images/4.jpg" class="img-responsive">
							<div class="deals-link">
								<h3>Exclusive deals</h3>
								<h4>Up to 70% Off</h4>
								<a href="#" class="grabit">Grab it now</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<div class="row">
			<div class="secondgrid">
				<div class="col-md-6 col-sm-6 noleftpadding summer-essen-left">
					<div class="summer-essen">
						<div class="row">
							<div class="col-md-6 col-sm-4"></div>
							<div class="col-md-6 col-sm-8">
								<div class="product-descr">
									<span class="jst-arrived">Just arrived</span>
									<h2>summer essentials</h2>
									<p>Capture the last moment of summer with us</p>
									<a href="#" class="black-btn">get it now</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<div class="row">
						<div class="excl-deal-summer">
							<img src="<?php echo get_template_directory_uri(); ?>/images/7.jpg" class="img-responsive">
							<div class="deals-link">
								<span class="limited-time">limited deals</span>
								<h2>dining <br> now <span class="price">Rs 420</span></h2>
								<a href="#" class="no-btn">order now</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<div class="row">
			<div class="thirdgrid">
				<div class="content">
				    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				        <!-- Indicators -->
				        <ol class="carousel-indicators">
				            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
				            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
				            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
				        </ol>
				        <!-- Wrapper for slides -->
				        <div class="carousel-inner">
				            <div class="item active">
				                <div class="row">
				                    <div class="col-xs-12">
				                        <div class="thumbnail adjust1">
				                            <div class="col-md-6 col-sm-6 col-xs-12">
				                            	<div class="row">
				                            		<img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/8.jpg">
				                            	</div>  
				                            </div>
				                            <div class="col-md-6 col-sm-6 col-xs-12">
					                            <div class="slide-content">
					                            	<h1>summer heats</h1>
					                            	<p>The hottest styles for summer are here. Shop beach-ready bikinis in your favorite fits, colors and patterns.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
					                            	<a href="#" class="black-btn">shop collection now</a>
					                            </div>
				                            </div>
				                        </div>
				                    </div>
				                </div>
				            </div>
				            <div class="item">
				                <div class="row">
				                    <div class="col-xs-12">
				                        <div class="thumbnail adjust1">
				                            <div class="col-md-6 col-sm-6 col-xs-12">
				                            	<div class="row">
				                            		<img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/8.jpg">
				                            	</div>  
				                            </div>
				                            <div class="col-md-6 col-sm-6 col-xs-12">
					                            <div class="slide-content">
					                            	<h1>summer heats</h1>
					                            	<p>The hottest styles for summer are here. Shop beach-ready bikinis in your favorite fits, colors and patterns.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
					                            	<a href="#" class="black-btn">shop collection now</a>
					                            </div>
				                            </div>
				                        </div>
				                    </div>
				                </div>
				            </div>
				            <div class="item">
				                <div class="row">
				                    <div class="col-xs-12">
				                        <div class="thumbnail adjust1">
				                            <div class="col-md-6 col-sm-6 col-xs-12">
				                            	<div class="row">
				                            		<img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/8.jpg">
				                            	</div>  
				                            </div>
				                            <div class="col-md-6 col-sm-6 col-xs-12">
					                            <div class="slide-content">
					                            	<h1>summer heats</h1>
					                            	<p>The hottest styles for summer are here. Shop beach-ready bikinis in your favorite fits, colors and patterns.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
					                            	<a href="#" class="black-btn">shop collection now</a>
					                            </div>
				                            </div>
				                        </div>
				                    </div>
				                </div>
				            </div>
				        </div>
				        <!-- Controls -->
				        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev"> <i class="fa fa-chevron-left" aria-hidden="true"></i></a>
				        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next"> <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
				    </div>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<div class="row">
			<div class="fourthgrid">
				<div class="col-md-4">
					<div class="shopping">
						<h2>shopping</h2>
						<p>The hottest styles for summer are here. Shop beach-ready bikinis in your favorite fits, colors and patterns </p>
					</div>	
				</div>
				<div class="col-md-4">
					<div class="store">
						<div class="store-img">
							<img src="<?php echo get_template_directory_uri(); ?>/images/9.jpg" class="img-responsive">
						</div>
						<div class="pro-details">
							<p class="price">Only Rs 2,310</p>
							<p class="store-name">straw hat</p>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="store">
						<div class="store-img">
							<img src="<?php echo get_template_directory_uri(); ?>/images/10.jpg" class="img-responsive">
						</div>
						<div class="pro-details">
							<p class="price">Only Rs 5,200</p>
							<p class="store-name">straw hat</p>
						</div>
					</div>
				</div>	
			</div>
		</div>
		<div class="clear"></div>
		<div class="row">
			<div class="topdeals">
				<div class="row">
					<img src="<?php echo get_template_directory_uri(); ?>/images/heading.png" class="img-responsive heading">
					<h2>top deals</h2>
					<p>Lorem Ipsum dolers amet delsteremses</p>
					<ul>
						<li class="latest active">latest</li>
						<li class="bestseller">best seller</li>
						<li class="special">special</li>
						<li class="featured">featured</li>
					</ul>
				</div>
				<div class="row topproduct">
					<?php
						
						$default_loc = 'kolkata';
						$min_distance = 150;
						$address_dis = $default_loc;
						$latLong = getLatLong($address_dis);
						$lat_dis = $latLong['latitude'];
						$lon_dis = $latLong['longitude'];
						//if($_POST['cat_id']=='-1')
//{	
$offers_rec="select max(id) as id, distance from (select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer where status = 1 && published = 'true' && end_date >= CURDATE()) x group by`created_by` HAVING distance < $min_distance order by distance ASC, created_at DESC LIMIT 4";

$offers_featured="select max(id) as id, distance from (select *, SQRT(POW(69.1 * (latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - longitude) * COS(latitude / 57.3), 2)) AS distance from reedemer_offer where status = 1 && published = 'true' && end_date >= CURDATE()) x group by`created_by` HAVING distance < $min_distance order by distance ASC, on_demand DESC LIMIT 4";	

$offers_data = $wpdb->get_results($offers_rec);
$offers_f_data = $wpdb->get_results($offers_featured);
?>
					<div class="product-section showproduct" id="latest">
						<!--New latest deals-->
						

        <div class="tab-pane active content_block" id="tab_a">
            
			
            <div class="img-panel">

              <?php
			
				foreach($offers_data as $offers_new)
                { 
					$total_res = $wpdb->get_results("SELECT * FROM `reedemer_offer` where id = '".$offers_new->id."'");						
				foreach($total_res as $offers){ 
					
					if(count($offers_data) > 0) {
				
				?>
                        <div class="col-md-3 col-sm-3 col-xs-3">
							<div class="product">
								<div class="pro-img">
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
                            
                            </div>
                            </div>
                          <div class="pro-descr">
									<span class="rating">
										<img src="<?php echo get_template_directory_uri(); ?>/images/rating.png" class="img-responsive">
									</span>
                                <p>
									<?php 
				 						if(strlen($offers->offer_description) > 40 ){
											echo substr($offers->offer_description,0,40).'...';
										}else {
				 
				 							echo $offers->offer_description; 
									
										}?>
								</p>
                                <div class="product-savings home-location">
									
									<?php 		 		
				 						
		 								
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
									
									
									
									
									<?php	
										}
									?>
									<p class="price"><?php if(strlen($off_prc->pay_value) > 6){ ?>
									<span class="pricesection" style="font-size:14px;">
										<color><?php echo "$".$off_prc->retails_value; ?></color>
										<?php echo "$".$off_prc->pay_value; ?>
									</span>
									<?php }else{?>
									<span class="pricesection">
										<color><?php echo "$".$off_prc->retails_value; ?></color>
										<?php echo "$".$off_prc->pay_value; ?>
									</span>
									<?php } ?></p>
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
						</div>
                        <?php 
					}
					
					else 
					{
						echo '<h2>No Result found with your search</h2>';	
					
					}
					}
					}
					?>
                </div>
			</div>
						
					
					</div>
					<div class="product-section" id="bestseller">
						<div class="col-md-3 col-sm-3 col-xs-3">
							<div class="product">
								<div class="pro-img">
									<img src="<?php echo get_template_directory_uri(); ?>/images/12.jpg" class="img-responsive">
									<a href="#" class="addtocart">Add to cart</a>
								</div>
								<div class="pro-descr">
									<span class="rating">
										<img src="<?php echo get_template_directory_uri(); ?>/images/rating.png" class="img-responsive">
									</span>
									<p>Arcu vitae imperdiet simply</p>
									<p class="price">Rs 3,220</p>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<div class="product">
								<div class="pro-img">
									<img src="<?php echo get_template_directory_uri(); ?>/images/11.jpg" class="img-responsive">
									<a href="#" class="addtocart">Add to cart</a>
								</div>
								<div class="pro-descr">
									<span class="rating">
										<img src="<?php echo get_template_directory_uri(); ?>/images/rating.png" class="img-responsive">
									</span>
									<p>Arcu vitae imperdiet simply</p>
									<p class="price">Rs 3,220</p>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<div class="product">
								<div class="pro-img">
									<img src="<?php echo get_template_directory_uri(); ?>/images/13.jpg" class="img-responsive">
									<a href="#" class="addtocart">Add to cart</a>
								</div>
								<div class="pro-descr">
									<span class="rating">
										<img src="<?php echo get_template_directory_uri(); ?>/images/rating.png" class="img-responsive">
									</span>
									<p>Arcu vitae imperdiet simply</p>
									<p class="price">Rs 3,220</p>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<div class="product">
								<div class="pro-img">
									<img src="<?php echo get_template_directory_uri(); ?>/images/14.jpg" class="img-responsive">
									<a href="#" class="addtocart">Add to cart</a>
								</div>
								<div class="pro-descr">
									<span class="rating">
										<img src="<?php echo get_template_directory_uri(); ?>/images/rating.png" class="img-responsive">
									</span>
									<p>Arcu vitae imperdiet simply</p>
									<p class="price">Rs 3,220</p>
								</div>
							</div>
						</div>
					</div>
					<div class="product-section" id="special">
						<div class="col-md-3 col-sm-3 col-xs-3">
							<div class="product">
								<div class="pro-img">
									<img src="<?php echo get_template_directory_uri(); ?>/images/11.jpg" class="img-responsive">
									<a href="#" class="addtocart">Add to cart</a>
								</div>
								<div class="pro-descr">
									<span class="rating">
										<img src="<?php echo get_template_directory_uri(); ?>/images/rating.png" class="img-responsive">
									</span>
									<p>Arcu vitae imperdiet simply</p>
									<p class="price">Rs 3,220</p>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<div class="product">
								<div class="pro-img">
									<img src="<?php echo get_template_directory_uri(); ?>/images/12.jpg" class="img-responsive">
									<a href="#" class="addtocart">Add to cart</a>
								</div>
								<div class="pro-descr">
									<span class="rating">
										<img src="<?php echo get_template_directory_uri(); ?>/images/rating.png" class="img-responsive">
									</span>
									<p>Arcu vitae imperdiet simply</p>
									<p class="price">Rs 3,220</p>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<div class="product">
								<div class="pro-img">
									<img src="<?php echo get_template_directory_uri(); ?>/images/13.jpg" class="img-responsive">
									<a href="#" class="addtocart">Add to cart</a>
								</div>
								<div class="pro-descr">
									<span class="rating">
										<img src="<?php echo get_template_directory_uri(); ?>/images/rating.png" class="img-responsive">
									</span>
									<p>Arcu vitae imperdiet simply</p>
									<p class="price">Rs 3,220</p>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<div class="product">
								<div class="pro-img">
									<img src="<?php echo get_template_directory_uri(); ?>/images/14.jpg" class="img-responsive">
									<a href="#" class="addtocart">Add to cart</a>
								</div>
								<div class="pro-descr">
									<span class="rating">
										<img src="images/rating.png" class="img-responsive">
									</span>
									<p>Arcu vitae imperdiet simply</p>
									<p class="price">Rs 3,220</p>
								</div>
							</div>
						</div>
					</div>
					<div class="product-section" id="featured">
						 <div class="tab-pane active content_block" id="tab_a">
            
			
            <div class="img-panel">

              <?php
			
				foreach($offers_f_data as $offers_f_new)
                { 
					$total_f_res = $wpdb->get_results("SELECT * FROM `reedemer_offer` where id = '".$offers_f_new->id."'");						
				foreach($total_f_res as $offers_f){ 
					
					if(count($offers_f_data) > 0) {
				
				?>
                        <div class="col-md-3 col-sm-3 col-xs-3">
							<div class="product">
								<div class="pro-img">
                            <a href="<?php echo home_url(); ?>/index.php/deal-details/?offer=<?php echo $offers_f->id; ?>">
							<div class="home-search-wrap">
                            <?php $img_logo = $wpdb->get_results("select logo_name from reedemer_logo where reedemer_id = '".$offers_f->created_by."' && default_logo = 1");
							foreach($img_logo as $new_img_logo){
								$new_pic_logo=$new_img_logo->logo_name;
								$str = $new_pic_logo;
								$tes = explode(".",$str);
								if($tes[1]=='jpg'){$final_logo_image= $tes[0].".png";}
								else{$final_logo_image=$new_pic_logo ;}
							echo '<span class="floate-pic"><img src="'.home_url().'/filemanager/userfiles/small/'.$final_logo_image.'" alt="img"></span>';
							}?>
							<?php $img_explod = explode('/',$offers_f->offer_image_path);
								if($img_explod[0] == 'http:'){
									$img_offers = $offers_f->offer_image_path;									
								}else{
									$img_offers = home_url().'/'.$offers_f->offer_image_path;
								}
							if($offers->on_demand == 1) {
								echo '<div class="ondemand">on demand</div>';
							}
							?>	
                            
                            </div>
                            </div>
                          <div class="pro-descr">
									<span class="rating">
										<img src="<?php echo get_template_directory_uri(); ?>/images/rating.png" class="img-responsive">
									</span>
                                <p>
									<?php 
				 						if(strlen($offers_f->offer_description) > 40 ){
											echo substr($offers_f->offer_description,0,40).'...';
										}else {
				 
				 							echo $offers_f->offer_description; 
									
										}?>
								</p>
                                <div class="product-savings home-location">
									
									<?php 		 		
				 						
		 								
				 						$offer_prc = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE id = $offers_f->id && status = 1");
				 					
		 							foreach($offer_f_prc as $off_f_prc){
										
									$offer_lat = $off_f_prc->latitude;	
		 							$offer_lon = $off_f_prc->longitude;
									$cmp_id = $off_f_prc->created_by;		
										
									//if($off_prc->discount > 0) {
									   
									?>
									<span class="savings">
									<?php 										
										$offer_f_mode= $off_f_prc->value_calculate;
										if ($offer_f_mode=='2') {
										$prc_f_val = ($off_f_prc->pay_value/$off_f_prc->retails_value); 
										$percent_friendly = number_format( $prc_f_val * 100, 2 ) . '%';
										$tot_per = round(100 - $percent_friendly);	
										$offer_type= $off_f_prc->value_text;
										$offer_mode= $off_f_prc->value_calculate;
										if ($offer_type=='1'){$offer_type_value='OFF';}
										elseif ($offer_type=='2'){$offer_type_value='DISCOUNT';}
										elseif ($offer_type=='3'){$offer_type_value='SAVINGS';}
										else{$offer_type_value='OFF';}
										echo $tot_per."% ".$offer_type_value;
										}
										else{
										$prc_val = ($off_f_prc->retails_value - $off_prc->pay_value); 
										$tot_per = round($prc_val);	
										$offer_type= $off_f_prc->value_text;
										$offer_mode= $off_f_prc->value_calculate;
										if ($offer_type=='1'){$offer_type_value='OFF';}
										elseif ($offer_type=='2'){$offer_type_value='DISCOUNT';}
										elseif ($offer_type=='3'){$offer_type_value='SAVINGS';}
										else{$offer_type_value='OFF';}
										echo "$".$tot_per." ".$offer_type_value;
										}
									?>
									<?php	
										}
									?>
									<p class="price"><?php if(strlen($off_f_prc->pay_value) > 6){ ?>
									<span class="pricesection" style="font-size:14px;">
										<color><?php echo "$".$off_f_prc->retails_value; ?></color>
										<?php echo "$".$off_f_prc->pay_value; ?>
									</span>
									<?php }else{?>
									<span class="pricesection">
										<color><?php echo "$".$off_f_prc->retails_value; ?></color>
										<?php echo "$".$off_f_prc->pay_value; ?>
									</span>
									<?php } ?></p>
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

								  $lat = "22.5697";
								  $lon = "-88.3697";
								}
								echo floor(distance($lat, $lon, $offer_lat, $offer_lon, "M"))." Miles)";
						?>

                                </div>
                            </div>
							</a>	
                        </div>	
						</div>
                        <?php 
					}
					
					else 
					{
						echo '<h2>No Result found with your search</h2>';	
					
					}
					}
					}
					?>
                </div>
						<!--<div class="col-md-3 col-sm-3 col-xs-3">
							<div class="product">
								<div class="pro-img">
									<img src="<?php echo get_template_directory_uri(); ?>/images/13.jpg" class="img-responsive">
									<a href="#" class="addtocart">Add to cart</a>
								</div>
								<div class="pro-descr">
									<span class="rating">
										<img src="<?php echo get_template_directory_uri(); ?>/images/rating.png" class="img-responsive">
									</span>
									<p>Arcu vitae imperdiet simply</p>
									<p class="price">Rs 3,220</p>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<div class="product">
								<div class="pro-img">
									<img src="<?php echo get_template_directory_uri(); ?>/images/14.jpg" class="img-responsive">
									<a href="#" class="addtocart">Add to cart</a>
								</div>
								<div class="pro-descr">
									<span class="rating">
										<img src="<?php echo get_template_directory_uri(); ?>/images/rating.png" class="img-responsive">
									</span>
									<p>Arcu vitae imperdiet simply</p>
									<p class="price">Rs 3,220</p>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<div class="product">
								<div class="pro-img">
									<img src="<?php echo get_template_directory_uri(); ?>/images/11.jpg" class="img-responsive">
									<a href="#" class="addtocart">Add to cart</a>
								</div>
								<div class="pro-descr">
									<span class="rating">
										<img src="images/rating.png" class="img-responsive">
									</span>
									<p>Arcu vitae imperdiet simply</p>
									<p class="price">Rs 3,220</p>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<div class="product">
								<div class="pro-img">
									<img src="<?php echo get_template_directory_uri(); ?>/images/12.jpg" class="img-responsive">
									<a href="#" class="addtocart">Add to cart</a>
								</div>
								<div class="pro-descr">
									<span class="rating">
										<img src="images/rating.png" class="img-responsive">
									</span>
									<p>Arcu vitae imperdiet simply</p>
									<p class="price">Rs 3,220</p>
								</div>
							</div>
						</div>
					</div>
				</div>-->
			</div>
			</div>
		<div class="clear"></div>
		
		<div class="row">
			<div class="blog">
				<h2>latest blog post</h2>
				<img src="<?php echo get_template_directory_uri(); ?>/images/heading.png" class="img-responsive heading">
				<div class="clear"></div>
				
				<div class="row">
					 <?php query_posts('post_type=post&post_status=publish&posts_per_page=10&paged='. get_query_var('paged')); ?>

			<?php if( have_posts() ):  
				while( have_posts() ): the_post(); 
				$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()));
				$thumb_id = get_post_thumbnail_id();
				$thumb_url = wp_get_attachment_image_src($thumb_id,'', true);
				
			?>
					<div class="col-md-4 col-sm-4 blog_list">
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<img src="<?php echo($thumb_url[0]!="")?$thumb_url[0]:''; ?>" class="img-responsive">
							</div>
							<div class="col-md-8  col-sm-6">
								<p><?php echo get_the_title();?></p>
						<a href="<?php echo get_permalink(); ?>" class="date"><?php echo the_date(); ?> / Read More</a>
							</div>
						</div>
					</div>
                  <?php endwhile;?>
                  <?php endif; wp_reset_query(); ?>
 				</div>
				
				<div class="clear"></div>
			</div>
		</div>
</section>
<?php get_footer(); ?>		
