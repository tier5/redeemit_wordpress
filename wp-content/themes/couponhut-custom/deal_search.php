<?php 
/*Template Name:Deal Search Results
*/
$deal_category = $_POST['deal_category'];
$deal_location =  $_POST['deal_location'];



$deal_catid =  $_POST['deal_categoryid'];
$deal_subcatid =  $_POST['deal_subcatid'];
$deal_createdby =  $_POST['dealcreatedby'];

$deal_all = $_POST['deal_search'];


$side_categoryid = $_POST['side_categoryid'];
$side_subcatid = $_POST['side_subcatid'];


$search_all = "SELECT rc.parent_id, rc.cat_name, rc.status, ro.*, rp.price_range_id, rp.status, rp.created_by FROM reedemer_category AS rc, reedemer_offer AS ro, reedemer_partner_settings AS rp WHERE rc.id = ro.cat_id AND rc.status = 1 AND ro.status= 1 AND rc.parent_id= 0 AND ro.created_by = rp.created_by ORDER BY RAND()";
$offers_alldata = $wpdb->get_results($search_all);



$categoryBySearch =  "SELECT ro.*, rp.price_range_id, rp.status, rp.created_by FROM reedemer_offer AS ro INNER JOIN reedemer_partner_settings AS rp ON ro.created_by = rp.created_by WHERE ro.status='1' AND ro.cat_id='".$_POST['category_id']."'";



$categoryByData = $wpdb->get_results($categoryBySearch);

$numRowsData = count($categoryByData);


$brandBySearch = "SELECT ro.*, rp.price_range_id, rp.status, rp.created_by FROM reedemer_offer AS ro INNER JOIN reedemer_partner_settings AS rp ON ro.created_by = rp.created_by WHERE ro.status='1' AND ro.created_by='".$_POST['BrandId']."'";

$brandByData = $wpdb->get_results($brandBySearch);

$numRowsBrand = count($brandByData); 


?>

<?php


if($_POST['deal_categoryid']!="" || $_POST['deal_subcatid']!="" || $_POST['dealcreatedby']!="" || $deal_all!="" || $numRowsData!=0 || $numRowsBrand!=0 || $deal_all!=0)
{

//echo $catandsubcatid[0];

?>


<?php

    if($side_categoryid!=0 || $side_subcatid!=0)
    {
        //echo $catandsubcatid[0]."<br/>";
         //echo $catandsubcatid[1]."<br/>";

       

       $categoryandSubcategoryBySearch="SELECT ro.*, rp.price_range_id, rp.status, rp.created_by FROM reedemer_offer AS ro INNER JOIN reedemer_partner_settings AS rp ON ro.created_by = rp.created_by WHERE ro.status='1' AND ro.cat_id='".$side_categoryid."' AND ro.subcat_id='".$side_subcatid."'";


       // echo $categoryandSubcategoryBySearch;

       $CatSubCatByData = $wpdb->get_results($categoryandSubcategoryBySearch);

       
            $totalSubCatByData = count($CatSubCatByData);
       
            if( count($CatSubCatByData) > 0 )
            {

            foreach($CatSubCatByData as $catsubcatsearch)
            { ?>

                

               

                <div class="col-md-4 col-sm-4 product-view" >
                    <a href="<?php echo home_url(); ?>/index.php/deal-details/?offer=<?php echo $catsubcatsearch->id; ?>">
                        <div class="deal-d-mid">
						<?php $img_logo = $wpdb->get_results("select logo_name from reedemer_logo where reedemer_id = '".$catsubcatsearch->created_by."' && default_logo = 1");
						foreach($img_logo as $new_img_logo){
						echo '<span class="deal-d-float2"><img src="'.home_url().'/filemanager/userfiles/medium/'.$new_img_logo->logo_name.'" alt="img"></span>';
						}?>
						
						<img src="<?php echo $catsubcatsearch->offer_image_path; ?>" alt="img01" class="img-responsive" />
                       </div>
						<div class="product">
                            <div class="product-title">
							<?php if(strlen($catsubcatsearch->offer_description) > 35) { 
								echo substr($catsubcatsearch->offer_description,0,35)."....";
							} else { 
								echo $catsubcatsearch->offer_description;
							} ?> 
						</div>
                        <div class="product-savings">
							<?php 		 		
								//echo "SELECT * FROM `reedemer_offer` WHERE id = $offers->id";
								$offer_prc = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE id = $catsubcatsearch->id && status = 1");
							foreach($offer_prc as $off_prc){

							if($off_prc->discount > 0) {

							?>
							<span class="savings">
								<?php 
								$prc_val = ($off_prc->pay_value/$off_prc->retails_value); 
								$percent_friendly = number_format( $prc_val * 100, 2 ) . '%';
								$tot_per = ceil(100 - $percent_friendly);
								echo $tot_per."%OFF";
								?>
							</span>
							<span class="pricesection">
								<color><?php echo "$".$off_prc->retails_value; ?></color>
								<?php echo "$".$off_prc->pay_value; ?>
							</span>

							<?php }else { ?>

							<span class="pricesection">
								<?php echo "$".$off_prc->pay_value; ?>
							</span>

							<?php } 

							}?>
                        </div>
                        <div class="col-expires">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
FBBC Hillcrest (1.8 miles) 
                        </div>
                        </div>
                    </a>
                </div>

                <?php     }
}else
{
    echo "<h4>No Offer Available !</h4>";
}

    }


?>

  

<?php


/* HOME CATEGORY BY SEARCH BEGIN */

if($deal_all!=0)
{
$homecategoryBySearch =  "SELECT ro.*, rp.price_range_id, rp.status, rp.created_by FROM reedemer_offer AS ro INNER JOIN reedemer_partner_settings AS rp ON ro.created_by = rp.created_by WHERE ro.status='1' AND ro.cat_id='".$deal_all."'";

    $homecategoryByData = $wpdb->get_results($homecategoryBySearch);

    $homenumRowsData = count($homecategoryByData);

   


foreach($homecategoryByData as $homecategoryData)  
        { ?>
      <div class="col-md-4 col-sm-4 product-view">
                    <a href="<?php echo home_url(); ?>/index.php/deal-details/?offer=<?php echo $homecategoryData->id; ?>">
                        <div class="deal-d-mid">
						<?php $img_logo = $wpdb->get_results("select logo_name from reedemer_logo where reedemer_id = '".$homecategoryData->created_by."' && default_logo = 1");
						foreach($img_logo as $new_img_logo){
						echo '<span class="deal-d-float2"><img src="'.home_url().'/filemanager/userfiles/medium/'.$new_img_logo->logo_name.'" alt="img"></span>';
						}?>
						
						<img src="<?php echo $homecategoryData->offer_image_path; ?>" alt="img01" class="img-responsive" />
                        </div>
							<div class="product">
                            <div class="product-title">
							<?php if(strlen($homecategoryData->offer_description) > 35) { 
								echo substr($homecategoryData->offer_description,0,35)."....";
							} else { 
								echo $homecategoryData->offer_description;
							} ?> 
						</div>
                        <div class="product-savings">
							<?php 		 		
								//echo "SELECT * FROM `reedemer_offer` WHERE id = $offers->id";
								$offer_prc = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE id = $homecategoryData->id && status = 1");
							foreach($offer_prc as $off_prc){

							if($off_prc->discount > 0) {

							?>
							<span class="savings">
								<?php 
								$prc_val = ($off_prc->pay_value/$off_prc->retails_value); 
								$percent_friendly = number_format( $prc_val * 100, 2 ) . '%';
								$tot_per = ceil(100 - $percent_friendly);
								echo $tot_per."%OFF";
								?>
							</span>
							<span class="pricesection">
								<color><?php echo "$".$off_prc->retails_value; ?></color>
								<?php echo "$".$off_prc->pay_value; ?>
							</span>

							<?php }else { ?>

							<span class="pricesection">
								<?php echo "$".$off_prc->pay_value; ?>
							</span>

							<?php } 

							}?>
                        </div>
                        <div class="col-expires">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
FBBC Hillcrest (1.8 miles) 
                        </div>
                        </div>
                    </a>

              </div>
      <?php     }


    } 



/* HOME CATEGORY BY SEARCH END */





?>

    

<?php
                //$partner =  "SELECT ro.*, rp.created_by, ru.*, rc.id, rc.cat_name, rc.parent_id, rc.status FROM users AS ru, reedemer_partner_settings AS rp, reedemer_category AS rc, reedemer_offer AS ro WHERE ru.id=rp.created_by AND ru.id=ro.created_by AND ru.type='2' OR rc.cat_name LIKE '%".$deal_category."%' AND ru.zipcode='".$deal_location."'";




                //$partner = "SELECT ro.*, ru.id, ru.zipcode, rc.*, rp.created_by, rp.status FROM users AS ru INNER JOIN reedemer_offer AS ro ON ru.id=ro.created_by INNER JOIN reedemer_partner_settings AS rp ON ro.created_by=rp.created_by INNER JOIN reedemer_category AS rc ON rc.id=ro.cat_id WHERE rc.cat_name LIKE '%".$deal_category."%' OR ru.zipcode='%".$deal_location."%'";


// ALL FIELDS FILL UP



if($_POST['category_id']!=0)
{
    //echo $numRowsData."DATA Found";

        foreach($categoryByData as $categoryData)  
        { ?>
      <div class="col-md-4 col-sm-4 product-view">
                    <a href="<?php echo home_url(); ?>/index.php/deal-details/?offer=<?php echo $categoryData->id; ?>">
                       <div class="deal-d-mid">
						<?php $img_logo = $wpdb->get_results("select logo_name from reedemer_logo where reedemer_id = '".$categoryData->created_by."' && default_logo = 1");
						foreach($img_logo as $new_img_logo){
						echo '<span class="deal-d-float2"><img src="'.home_url().'/filemanager/userfiles/medium/'.$new_img_logo->logo_name.'" alt="img"></span>';
						}?>
						<img src="<?php echo $categoryData->offer_image_path; ?>" alt="img01" class="img-responsive" />
                        </div>
						   <div class="product">
                            <div class="product-title">
							<?php if(strlen($categoryData->offer_description) > 35) { 
								echo substr($categoryData->offer_description,0,35)."....";
							} else { 
								echo $categoryData->offer_description;
							} ?> 
						</div>
                        <div class="product-savings">
							<?php 		 		
								//echo "SELECT * FROM `reedemer_offer` WHERE id = $offers->id";
								$offer_prc = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE id = $categoryData->id && status = 1");
							foreach($offer_prc as $off_prc){

							if($off_prc->discount > 0) {

							?>
							<span class="savings">
								<?php 
								$prc_val = ($off_prc->pay_value/$off_prc->retails_value); 
								$percent_friendly = number_format( $prc_val * 100, 2 ) . '%';
								$tot_per = 100 - $percent_friendly;
								echo $tot_per."%OFF";
								?>
							</span>
							<span class="pricesection">
								<color><?php echo "$".$off_prc->retails_value; ?></color>
								<?php echo "$".$off_prc->pay_value; ?>
							</span>

							<?php }else { ?>

							<span class="pricesection">
								<?php echo "$".$off_prc->pay_value; ?>
							</span>

							<?php } 

							}?>
                        </div>
                        <div class="col-expires">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
FBBC Hillcrest (1.8 miles) 
                        </div>
                        </div>
                    </a>

              </div>
      <?php     }
}




if($_POST['BrandId']!=0)
{
    //echo $numRowsData."DATA Found";

        foreach($brandByData as $brandOffer)  
        { ?>
      <div class="col-md-4 col-sm-4 product-view">
                    <a href="<?php echo home_url(); ?>/index.php/deal-details/?offer=<?php echo $brandOffer->id; ?>">
                       <div class="deal-d-mid">
						<?php $img_logo = $wpdb->get_results("select logo_name from reedemer_logo where reedemer_id = '".$brandOffer->created_by."' && default_logo = 1");
						foreach($img_logo as $new_img_logo){
						echo '<span class="deal-d-float2"><img src="'.home_url().'/filemanager/userfiles/medium/'.$new_img_logo->logo_name.'" alt="img"></span>';
						}?>
						<img src="<?php echo $brandOffer->offer_image_path; ?>" alt="img01" class="img-responsive" />
                        </div>
						   <div class="product">
                            <div class="product-title">
							<?php if(strlen($brandOffer->offer_description) > 35) { 
								echo substr($brandOffer->offer_description,0,35)."....";
							} else { 
								echo $brandOffer->offer_description;
							} ?> 
						</div>
                        <div class="product-savings">
							<?php 		 		
								//echo "SELECT * FROM `reedemer_offer` WHERE id = $offers->id";
								$offer_prc = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE id = $brandOffer->id && status = 1");
							foreach($offer_prc as $off_prc){

							if($off_prc->discount > 0) {

							?>
							<span class="savings">
								<?php 
								$prc_val = ($off_prc->pay_value/$off_prc->retails_value); 
								$percent_friendly = number_format( $prc_val * 100, 2 ) . '%';
								$tot_per = ceil(100 - $percent_friendly);
								echo $tot_per."%OFF";
								?>
							</span>
							<span class="pricesection">
								<color><?php echo "$".$off_prc->retails_value; ?></color>
								<?php echo "$".$off_prc->pay_value; ?>
							</span>

							<?php }else { ?>

							<span class="pricesection">
								<?php echo "$".$off_prc->pay_value; ?>
							</span>

							<?php } 

							}?>
                        </div>
                        <div class="col-expires">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
FBBC Hillcrest (1.8 miles) 
                        </div>
                        </div>
                    </a>
                </div>
     <?php   }
}






if($deal_all==-1)
{
    


    foreach($offers_alldata as $poffers0)  { ?>
      
      <div class="col-md-4 col-sm-4 product-view">
                   <a href="<?php echo home_url(); ?>/index.php/deal-details/?offer=<?php echo $poffers0->id; ?>">
                        
					   <div class="deal-d-mid">
					   <?php $img_logo = $wpdb->get_results("select logo_name from reedemer_logo where reedemer_id = '".$poffers0->created_by."' && default_logo = 1");
						foreach($img_logo as $new_img_logo){
						echo '<span class="deal-d-float2"><img src="'.home_url().'/filemanager/userfiles/medium/'.$new_img_logo->logo_name.'" alt="img"></span>';
						}?>
					   
					   
					   <img src="<?php echo $poffers0->offer_image_path; ?>" alt="img01" class="img-responsive" />
                        </div>
						   <div class="product">
                            <div class="product-title">
							<?php if(strlen($poffers0->offer_description) > 35) { 
								echo substr($poffers0->offer_description,0,35)."....";
							} else { 
								echo $poffers0->offer_description;
							} ?> 
						</div>
                        <div class="product-savings">
							<?php 		 		
								//echo "SELECT * FROM `reedemer_offer` WHERE id = $offers->id";
								$offer_prc = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE id = $poffers0->id && status = 1");
							foreach($offer_prc as $off_prc){

							if($off_prc->discount > 0) {

							?>
							<span class="savings">
								<?php 
								$prc_val = ($off_prc->pay_value/$off_prc->retails_value); 
								$percent_friendly = number_format( $prc_val * 100, 2 ) . '%';
								$tot_per = ceil(100 - $percent_friendly);
								echo $tot_per."%OFF";
								?>
							</span>
							<span class="pricesection">
								<color><?php echo "$".$off_prc->retails_value; ?></color>
								<?php echo "$".$off_prc->pay_value; ?>
							</span>

							<?php }else { ?>

							<span class="pricesection">
								<?php echo "$".$off_prc->pay_value; ?>
							</span>

							<?php } 

							}?>
                        </div>
                        <div class="col-expires">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
FBBC Hillcrest (1.8 miles) 
                        </div>
                        </div>
                    </a>
                </div>
   <?php  }


         
}







if($deal_createdby!=0&&$deal_catid!=0&&$deal_subcatid!=0)
{

$partner = "SELECT ro.*, rp.* FROM reedemer_offer AS ro INNER JOIN reedemer_partner_settings AS rp ON ro.created_by = rp.created_by WHERE ro.status='1' AND ro.created_by='".$deal_createdby."' AND ro.cat_id='".$deal_catid."' AND ro.subcat_id='".$deal_subcatid."'";

    //echo $partner;

    $partner_offers = $wpdb->get_results($partner);

if(count($partner_offers) > 0){
    
    foreach($partner_offers as $poffers)
    {
        //echo $poffers->offer_description."<br/>";

?>

        <div class="col-md-4 col-sm-4 product-view">
                    <a href="<?php echo home_url(); ?>/index.php/deal-details/?offer=<?php echo $poffers->id; ?>">
                        <div class="deal-d-mid">
						<?php $img_logo = $wpdb->get_results("select logo_name from reedemer_logo where reedemer_id = '".$poffers->created_by."' && default_logo = 1");
						foreach($img_logo as $new_img_logo){
						echo '<span class="deal-d-float2"><img src="'.home_url().'/filemanager/userfiles/medium/'.$new_img_logo->logo_name.'" alt="img"></span>';
						}?>
						
						<img src="<?php echo $poffers->offer_image_path; ?>" alt="img01" class="img-responsive" />
                       </div>
							<div class="product">
                            <div class="product-title">
							<?php if(strlen($poffers->offer_description) > 35) { 
								echo substr($poffers->offer_description,0,35)."....";
							} else { 
								echo $poffers->offer_description;
							} ?> 
						</div>
                        <div class="product-savings">
							<?php 		 		
								//echo "SELECT * FROM `reedemer_offer` WHERE id = $offers->id";
								$offer_prc = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE id = $poffers->id && status = 1");
							foreach($offer_prc as $off_prc){

							if($off_prc->discount > 0) {

							?>
							<span class="savings">
								<?php 
								$prc_val = ($off_prc->pay_value/$off_prc->retails_value); 
								$percent_friendly = number_format( $prc_val * 100, 2 ) . '%';
								$tot_per = ceil(100 - $percent_friendly);
								echo $tot_per."%OFF";
								?>
							</span>
							<span class="pricesection">
								<color><?php echo "$".$off_prc->retails_value; ?></color>
								<?php echo "$".$off_prc->pay_value; ?>
							</span>

							<?php }else { ?>

							<span class="pricesection">
								<?php echo "$".$off_prc->pay_value; ?>
							</span>

							<?php } 

							}?>
                        </div>
                        <div class="col-expires">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
FBBC Hillcrest (1.8 miles) 
                        </div>
                        </div>
                    </a>
                </div>




  <?php  }

}else
{
echo "<h4>No Offer Available !</h4>";
}

}



if($deal_catid!=0&&$deal_subcatid!=0)
{

$partner2 = "SELECT * FROM reedemer_offer WHERE status='1' AND cat_id='".$deal_subcatid."' AND subcat_id='".$deal_catid."'";

 //echo $partner2;

    $partner_offers2 = $wpdb->get_results($partner2);
    
if(count($partner_offers2) > 0){

    foreach($partner_offers2 as $poffers2)
    {
        //echo $poffers2->offer_description."<br/>";

?>

        <div class="col-md-4 col-sm-4 product-view">
                    <a href="<?php echo home_url(); ?>/index.php/deal-details/?offer=<?php echo $poffers2->id; ?>">
                        
						<div class="deal-d-mid">
						<?php $img_logo = $wpdb->get_results("select logo_name from reedemer_logo where reedemer_id = '".$poffers2->created_by."' && default_logo = 1");
						foreach($img_logo as $new_img_logo){
						echo '<span class="deal-d-float2"><img src="'.home_url().'/filemanager/userfiles/medium/'.$new_img_logo->logo_name.'" alt="img"></span>';
						}?>
						
						<img src="<?php echo $poffers2->offer_image_path; ?>" alt="img01" class="img-responsive" />
                        </div>
							<div class="product">
                            <div class="product-title">
							<?php if(strlen($poffers2->offer_description) > 35) { 
								echo substr($poffers2->offer_description,0,35)."....";
							} else { 
								echo $poffers2->offer_description;
							} ?> 
						</div>
                        <div class="product-savings">
							<?php 		 		
								//echo "SELECT * FROM `reedemer_offer` WHERE id = $offers->id";
								$offer_prc = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE id = $poffers2->id && status = 1");
							foreach($offer_prc as $off_prc){

							if($off_prc->discount > 0) {

							?>
							<span class="savings">
								<?php 
								$prc_val = ($off_prc->pay_value/$off_prc->retails_value); 
								$percent_friendly = number_format( $prc_val * 100, 2 ) . '%';
								$tot_per = ceil(100 - $percent_friendly);
								echo $tot_per."%OFF";
								?>
							</span>
							<span class="pricesection">
								<color><?php echo "$".$off_prc->retails_value; ?></color>
								<?php echo "$".$off_prc->pay_value; ?>
							</span>

							<?php }else { ?>

							<span class="pricesection">
								<?php echo "$".$off_prc->pay_value; ?>
							</span>

							<?php } 

							}?>
                        </div>
                        <div class="col-expires">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
FBBC Hillcrest (1.8 miles) 
                        </div>
                        </div>
                    </a>
                </div>

  


<?php
    }

}else
{

echo "<h4>No Offer Available !</h4>";

}

}



if($deal_catid!=0&&$deal_subcatid==0)
{

$partner3 = "SELECT * FROM reedemer_offer WHERE status='1' AND cat_id='".$deal_catid."'";

 //echo $partner3;

    $partner_offers3 = $wpdb->get_results($partner3);

    if(count($partner_offers3) > 0){
    
    foreach($partner_offers3 as $poffers3)
    {
        //echo $poffers3->offer_description."<br/>";
?>

        <div class="col-md-4 col-sm-4 product-view">
                    <a href="<?php echo home_url(); ?>/index.php/deal-details/?offer=<?php echo $poffers3->id; ?>">
                        <div class="deal-d-mid">
						
						<?php $img_logo = $wpdb->get_results("select logo_name from reedemer_logo where reedemer_id = '".$poffers3->created_by."' && default_logo = 1");
						foreach($img_logo as $new_img_logo){
						echo '<span class="deal-d-float2"><img src="'.home_url().'/filemanager/userfiles/medium/'.$new_img_logo->logo_name.'" alt="img"></span>';
						}?>
						
						
						<img src="<?php echo $poffers3->offer_image_path; ?>" alt="img01" class="img-responsive" />
                       
							</div>
							<div class="product">
                            <div class="product-title">
							<?php if(strlen($poffers3->offer_description) > 35) { 
								echo substr($poffers3->offer_description,0,35)."....";
							} else { 
								echo $poffers3->offer_description;
							} ?> 
						</div>
                        <div class="product-savings">
							<?php 		 		
								//echo "SELECT * FROM `reedemer_offer` WHERE id = $offers->id";
								$offer_prc = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE id = $poffers3->id && status = 1");
							foreach($offer_prc as $off_prc){

							if($off_prc->discount > 0) {

							?>
							<span class="savings">
								<?php 
								$prc_val = ($off_prc->pay_value/$off_prc->retails_value); 
								$percent_friendly = number_format( $prc_val * 100, 2 ) . '%';
								$tot_per = ceil(100 - $percent_friendly);
								echo $tot_per."%OFF";
								?>
							</span>
							<span class="pricesection">
								<color><?php echo "$".$off_prc->retails_value; ?></color>
								<?php echo "$".$off_prc->pay_value; ?>
							</span>

							<?php }else { ?>

							<span class="pricesection">
								<?php echo "$".$off_prc->pay_value; ?>
							</span>

							<?php } 

							}?>
                        </div>
                        <div class="col-expires">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
FBBC Hillcrest (1.8 miles) 
                        </div>
                        </div>
                    </a>
                </div>
          


  <?php   }
}else
{

echo "<h4>No Offer Available !</h4>";

}



}



if($deal_createdby!=0&&$deal_catid==0&&$deal_subcatid==0)
{

$partner4 = "SELECT * FROM reedemer_offer WHERE status='1' AND created_by='".$deal_createdby."'";

 //echo $partner4;

    $partner_offers4 = $wpdb->get_results($partner4);
    
    foreach($partner_offers4 as $poffers4)
    {
        //echo $poffers4->offer_description."<br/>";

?>

       <div class="col-md-4 col-sm-4 product-view">
                    <a href="<?php echo home_url(); ?>/index.php/deal-details/?offer=<?php echo $poffers4->id; ?>">
						
						<div class="deal-d-mid">
						<?php $img_logo = $wpdb->get_results("select logo_name from reedemer_logo where reedemer_id = '".$poffers4->created_by."' && default_logo = 1");
						foreach($img_logo as $new_img_logo){
						echo '<span class="deal-d-float2"><img src="'.home_url().'/filemanager/userfiles/medium/'.$new_img_logo->logo_name.'" alt="img"></span>';
						}?>
                        <img src="<?php echo $poffers4->offer_image_path; ?>" alt="img01" class="img-responsive" />
                        </div>
							<div class="product">
                            <div class="product-title">
							<?php if(strlen($poffers4->offer_description) > 35) { 
								echo substr($poffers4->offer_description,0,35)."....";
							} else { 
								echo $poffers4->offer_description;
							} ?> 
						</div>
                        <div class="product-savings">
							<?php 		 		
								//echo "SELECT * FROM `reedemer_offer` WHERE id = $offers->id";
								$offer_prc = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE id = $poffers4->id && status = 1");
							foreach($offer_prc as $off_prc){

							if($off_prc->discount > 0) {

							?>
							<span class="savings">
								<?php 
								$prc_val = ($off_prc->pay_value/$off_prc->retails_value); 
								$percent_friendly = number_format( $prc_val * 100, 2 ) . '%';
								$tot_per = ceil(100 - $percent_friendly);
								echo $tot_per."%OFF";
								?>
							</span>
							<span class="pricesection">
								<color><?php echo "$".$off_prc->retails_value; ?></color>
								<?php echo "$".$off_prc->pay_value; ?>
							</span>

							<?php }else { ?>

							<span class="pricesection">
								<?php echo "$".$off_prc->pay_value; ?>
							</span>

							<?php } 

							}?>
                        </div>
                        <div class="col-expires">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
FBBC Hillcrest (1.8 miles) 
                        </div>
                        </div>
                    </a>
                </div>
            

<?php
    }

}



?>

  <?php          
            
           
 if($totalSubCatByData==0 && $deal_all!=-1 && $deal_all!=0)
    {
        echo "<h4>No results 'FOUND3'!</h4>"; 
    }                
               
                

        
 } 

    else { echo "<h4>No results 'FOUND2'!</h4>"; }




?>
<div class="clear"></div>