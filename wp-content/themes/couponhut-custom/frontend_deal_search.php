<?php 
/*Template Name:FrontEnd Deal Search Results
*/
$deal_category = $_POST['deal_category'];
$deal_location =  $_POST['deal_location'];



$deal_catid =  $_POST['deal_categoryid'];
$deal_subcatid =  $_POST['deal_subcatid'];
$deal_createdby =  $_POST['dealcreatedby'];

$deal_all = $_POST['deal_search'];

?>

<?php


if($_POST['deal_categoryid']!="" || $_POST['deal_subcatid']!="" || $_POST['dealcreatedby']!="")
{

?>

  
   <div class="col-md-9 col-sm-9 search-result-view nopadding">      

<?php
                //$partner =  "SELECT ro.*, rp.created_by, ru.*, rc.id, rc.cat_name, rc.parent_id, rc.status FROM users AS ru, reedemer_partner_settings AS rp, reedemer_category AS rc, reedemer_offer AS ro WHERE ru.id=rp.created_by AND ru.id=ro.created_by AND ru.type='2' OR rc.cat_name LIKE '%".$deal_category."%' AND ru.zipcode='".$deal_location."'";




                //$partner = "SELECT ro.*, ru.id, ru.zipcode, rc.*, rp.created_by, rp.status FROM users AS ru INNER JOIN reedemer_offer AS ro ON ru.id=ro.created_by INNER JOIN reedemer_partner_settings AS rp ON ro.created_by=rp.created_by INNER JOIN reedemer_category AS rc ON rc.id=ro.cat_id WHERE rc.cat_name LIKE '%".$deal_category."%' OR ru.zipcode='%".$deal_location."%'";


// ALL FIELDS FILL UP 

if($deal_createdby!=0&&$deal_catid!=0&&$deal_subcatid!=0)
{

$partner = "SELECT ro.*, rp.* FROM reedemer_offer AS ro INNER JOIN reedemer_partner_settings AS rp ON ro.created_by = rp.created_by WHERE ro.created_by='".$deal_createdby."' AND ro.cat_id='".$deal_catid."' AND ro.subcat_id='".$deal_subcatid."'";

    //echo $partner;

    $partner_offers = $wpdb->get_results($partner);
    
    foreach($partner_offers as $poffers)
    {
        //echo $poffers->offer_description."<br/>";



        echo '<div class="col-md-6 col-sm-6 product-view">
                    <a href="#">
                        <img src="'.$poffers->offer_image_path.'" alt="img01" class="img-responsive" />
                        <div class="product">
                            <div class="product-title">'.$poffers->offer_description.'</div>
                            <div class="product-savings">
                            <p>$$$</p>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <span class="savings">';


                            '</span></div>
                            <div class="col-expires">*expires in 2 days</div>
                        </div>
                    </a>
                </div>';




    }

}



if($deal_catid!=0&&$deal_subcatid!=0)
{

$partner2 = "SELECT * FROM reedemer_offer WHERE cat_id='".$deal_subcatid."' AND subcat_id='".$deal_catid."'";

 //echo $partner2;

    $partner_offers2 = $wpdb->get_results($partner2);
    
    foreach($partner_offers2 as $poffers2)
    {
        //echo $poffers2->offer_description."<br/>";



        echo '<div class="col-md-6 col-sm-6 product-view">
                    <a href="#">
                        <img src="'.$poffers2->offer_image_path.'" alt="img01" class="img-responsive" />
                        <div class="product">
                            <div class="product-title">'.$poffers2->offer_description.'</div>
                            <div class="product-savings">
                            <p>'.$poffers2->price_range_id.'</p>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <span class="savings">'; 
                            ?>

                            <?php $savings1 = $poffers2->value_calculate%2==0 ? "$".$poffers2->discount : $poffers2->discount."%"; 

                                    echo $savings1;

                                    if($poffers2->value_calculate==1 || $poffers2->value_calculate==2)
                                    {
                                        echo " OFF";
                                    }

                                    if($poffers2->value_calculate==3 || $poffers2->value_calculate==4)
                                    {
                                        echo " DISCOUNT";
                                    }

                                    if($poffers2->value_calculate==5 || $poffers2->value_calculate==6)
                                    {
                                        echo " SAVING";
                                    }

                                ?>


                            <?php echo '</span></div>
                            <div class="col-expires">*expires in 2 days</div>
                        </div>
                    </a>
                </div>';

  



    }

}



if($deal_catid!=0&&$deal_subcatid==0)
{

$partner3 = "SELECT * FROM reedemer_offer WHERE cat_id='".$deal_catid."'";

 //echo $partner3;

    $partner_offers3 = $wpdb->get_results($partner3);
    
    foreach($partner_offers3 as $poffers3)
    {
        //echo $poffers3->offer_description."<br/>";


        echo '<div class="col-md-6 col-sm-6 product-view">
                    <a href="#">
                        <img src="'.$poffers3->offer_image_path.'" alt="img01" class="img-responsive" />
                        <div class="product">
                            <div class="product-title">'.$poffers3->offer_description.'</div>
                            <div class="product-savings">
                            <p>'.$poffers3->price_range_id.'</p>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <span class="savings">'; 
                            ?>

                            <?php $savings1 = $poffers3->value_calculate%2==0 ? "$".$poffers3->discount : $poffers4->discount."%"; 

                                    echo $savings1;

                                    if($poffers3->value_calculate==1 || $poffers3->value_calculate==2)
                                    {
                                        echo " OFF";
                                    }

                                    if($poffers3->value_calculate==3 || $poffers3->value_calculate==4)
                                    {
                                        echo " DISCOUNT";
                                    }

                                    if($poffers3->value_calculate==5 || $poffers3->value_calculate==6)
                                    {
                                        echo " SAVING";
                                    }

                                ?>


                            <?php echo '</span></div>
                            <div class="col-expires">*expires in 2 days</div>
                        </div>
                    </a>
                </div>';

          


    }

}



if($deal_createdby!=0&&$deal_catid==0&&$deal_subcatid==0)
{

$partner4 = "SELECT * FROM reedemer_offer WHERE created_by='".$deal_createdby."'";

 //echo $partner4;

    $partner_offers4 = $wpdb->get_results($partner4);
    
    foreach($partner_offers4 as $poffers4)
    {
        //echo $poffers4->offer_description."<br/>";



        echo '<div class="col-md-6 col-sm-6 product-view">
                    <a href="#">
                        <img src="'.$poffers4->offer_image_path.'" alt="img01" class="img-responsive" />
                        <div class="product">
                            <div class="product-title">'.$poffers4->offer_description.'</div>
                            <div class="product-savings">
                            <p>'.$poffers4->price_range_id.'</p>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <span class="savings">'; 
                            ?>

                            <?php $savings1 = $poffers4->value_calculate%2==0 ? "$".$poffers4->discount : $poffers4->discount."%"; 

                                    echo $savings1;

                                    if($poffers4->value_calculate==1 || $poffers4->value_calculate==2)
                                    {
                                        echo " OFF";
                                    }

                                    if($poffers4->value_calculate==3 || $poffers4->value_calculate==4)
                                    {
                                        echo " DISCOUNT";
                                    }

                                    if($poffers4->value_calculate==5 || $poffers4->value_calculate==6)
                                    {
                                        echo " SAVING";
                                    }

                                ?>


                            <?php echo '</span></div>
                            <div class="col-expires">*expires in 2 days</div>
                        </div>
                    </a>
                </div>';

            


    }

}



?>

            
            
           
                
               
                
            
            </div>
        
<?php } 

    else { ?>


            <h4>No results 'FOUND'!</h4>

            

<?php }

?>
<div class="clear"></div>
