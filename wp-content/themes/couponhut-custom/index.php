<?php 
/* CATEGORY SLIDER BEGIN */
//global $wpdb; 
$category_tab="SELECT * FROM reedemer_category WHERE status='1' AND parent_id='0' ORDER BY id DESC LIMIT 7";
$categories = $wpdb->get_results($category_tab);


/*
$submenu_tab="SELECT L1.id AS cat_id, L2.id AS subcat_id, L1.cat_name AS cat, L2.cat_name AS sub_cat 
  FROM reedemer_category L1 LEFT OUTER JOIN reedemer_category L2 ON L2.parent_id = L1.id WHERE L1.parent_id = 0 ORDER BY L1.id ASC";
  $categories = $wpdb->get_results($submenu_tab);

*/

  // Show Category1


  $TabcatName1 =  "SELECT id, cat_name FROM reedemer_category WHERE status='1' AND parent_id='0' AND id='24'";
$CategoryTab1 = $wpdb->get_results($TabcatName1);

  $offers_recordbycat1="SELECT rc.parent_id, rc.cat_name, rc.status, ro.*, rp.created_by FROM reedemer_category AS rc, reedemer_offer AS ro, reedemer_partner_settings AS rp WHERE rc.id=ro.cat_id AND rc.status='1' AND ro.status='1' AND rc.parent_id='0' AND ro.created_by=rp.created_by AND ro.cat_id='24' LIMIT 4";
$offers_databycat1 = $wpdb->get_results($offers_recordbycat1);

// Category1 END ****************************//



  // Show Category2


  $TabcatName2 =  "SELECT id, cat_name FROM reedemer_category WHERE status='1' AND parent_id='0' AND id='44'";
$CategoryTab2 = $wpdb->get_results($TabcatName2);

  $offers_recordbycat2="SELECT rc.parent_id, rc.cat_name, rc.status, ro.*, rp.created_by FROM reedemer_category AS rc, reedemer_offer AS ro, reedemer_partner_settings AS rp WHERE rc.id=ro.cat_id AND rc.status='1' AND ro.status='1' AND rc.parent_id='0' AND ro.created_by=rp.created_by AND ro.cat_id='44' LIMIT 4";
$offers_databycat2 = $wpdb->get_results($offers_recordbycat2);

// Category1 END ****************************//




  // Show Category3


  $TabcatName3 =  "SELECT id, cat_name FROM reedemer_category WHERE status='1' AND parent_id='0' AND id='88'";
$CategoryTab3 = $wpdb->get_results($TabcatName3);

  $offers_recordbycat3= "SELECT rc.parent_id, rc.cat_name, rc.status, ro.*, rp.created_by FROM reedemer_category AS rc, reedemer_offer AS ro, reedemer_partner_settings AS rp WHERE rc.id=ro.cat_id AND rc.status='1' AND ro.status='1' AND rc.parent_id='0' AND ro.created_by=rp.created_by AND ro.cat_id='88' LIMIT 4";
$offers_databycat3 = $wpdb->get_results($offers_recordbycat3);

// Category1 END ****************************//



  // Show Category1


  $TabcatName4 =  "SELECT id, cat_name FROM reedemer_category WHERE status='1' AND parent_id='0' AND id='21'";
$CategoryTab4 = $wpdb->get_results($TabcatName4);

  $offers_recordbycat4="SELECT rc.parent_id, rc.cat_name, rc.status, ro.*, rp.created_by FROM reedemer_category AS rc, reedemer_offer AS ro, reedemer_partner_settings AS rp WHERE rc.id=ro.cat_id AND rc.status='1' AND ro.status='1' AND rc.parent_id='0' AND ro.created_by=rp.created_by AND ro.cat_id='21' LIMIT 4";
$offers_databycat4 = $wpdb->get_results($offers_recordbycat4);

// Category1 END ****************************//



  // Show Category5


  $TabcatName5 =  "SELECT id, cat_name FROM reedemer_category WHERE status='1' AND parent_id='0' AND id='34'";
$CategoryTab5 = $wpdb->get_results($TabcatName5);

  $offers_recordbycat5="SELECT rc.parent_id, rc.cat_name, rc.status, ro.*, rp.* FROM reedemer_category AS rc, reedemer_offer AS ro, reedemer_partner_settings AS rp WHERE rc.id=ro.cat_id AND rc.status='1' AND ro.status='1' AND rc.parent_id='0' AND ro.created_by=rp.created_by AND ro.cat_id='34' LIMIT 4";
$offers_databycat5 = $wpdb->get_results($offers_recordbycat5);

// Category5 END ****************************//


// SHOWING THE PARTNER OFFER BEGIN 

/*
$partner =  "SELECT ro.*, rp.created_by, ru.* FROM users AS ru, reedemer_partner_settings AS rp, reedemer_offer AS ro WHERE ru.id=rp.created_by AND ru.id=ro.created_by AND ru.type='2' ORDER BY ru.id DESC LIMIT 4";
*/

$partner =  "SELECT ro.*, rp.created_by, ru.* FROM users AS ru, reedemer_partner_settings AS rp, reedemer_offer AS ro WHERE ru.id=rp.created_by AND ru.id=ro.created_by AND ru.type='2' ORDER BY RAND() DESC LIMIT 4";

$partner_offers = $wpdb->get_results($partner);


//

// SHOWING PARTNER LOGO


$partner_logos ="SELECT * FROM reedemer_logo WHERE status='1' LIMIT 14";
$partner_logo =  $wpdb->get_results($partner_logos);

//


get_header() ?>
<!-- Video banner Start --> 

<div class="banner">
    <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-3 side-vdo lesspadding">
                    <div class="vdo vdo-top">
                        <img src="<?php bloginfo('template_directory'); ?>/images/home_page_video_pic_b.jpg" class="img-responsive">
                        <a href="#" class="vdo-start"><i class="fa fa-caret-right" aria-hidden="true"></i></a>
                        <iframe class="video" width="200" height="" src="https://www.youtube.com/embed/K-H35Mpj4uk?enablejsapi=1&amp;version=3&amp;playerapiid=ytplayer&amp;rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" marginwidth="0" marginheight="0" hspace="0" vspace="0" scrolling="no"allowfullscreen allowscriptaccess="always"></iframe>
                    </div>
                    <div class="vdo vdo-bottom">
                        <img src="<?php bloginfo('template_directory'); ?>/images/home_page_video_pic_side.jpg" class="img-responsive">
                        <a href="#" class="vdo-start"><i class="fa fa-caret-right" aria-hidden="true"></i></a>
                        <iframe class="video" width="200" height="" src="https://www.youtube.com/embed/WCFZbl7lNvc?enablejsapi=1&amp;version=3&amp;playerapiid=ytplayer&amp;rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" marginwidth="0" marginheight="0" hspace="0" vspace="0" scrolling="no"allowfullscreen allowscriptaccess="always"></iframe>
                  

                    </div>
                </div>
                <div class="col-md-6 col-sm-6 middle-vdo nopadding">
                    <div class="vdo">
                        <img src="<?php bloginfo('template_directory'); ?>/images/home_page_video_pic_front.jpg" class="img-responsive">
                        <a href="#" class="vdo-start"><i class="fa fa-caret-right" aria-hidden="true"></i></a>
                        <iframe class="video" width="560" height="313" src="https://www.youtube.com/embed/_rPO-N11GrE?enablejsapi=1&amp;version=3&amp;playerapiid=ytplayer&amp;rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" marginwidth="0" marginheight="0" hspace="0" vspace="0" scrolling="no"allowfullscreen allowscriptaccess="always"></iframe>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 side-vdo lesspadding">
                    <div class="vdo vdo-top">
                        <img src="<?php bloginfo('template_directory'); ?>/images/home_page_video_pic_b.jpg" class="img-responsive">
                        <a href="#" class="vdo-start"><i class="fa fa-caret-right" aria-hidden="true"></i></a>
                        <iframe class="video" width="200" height="" src="https://www.youtube.com/embed/K-H35Mpj4uk?enablejsapi=1&amp;version=3&amp;playerapiid=ytplayer&amp;rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" marginwidth="0" marginheight="0" hspace="0" vspace="0" scrolling="no"allowfullscreen allowscriptaccess="always"></iframe>
                    </div>
                    <div class="vdo vdo-bottom">
                        <img src="<?php bloginfo('template_directory'); ?>/images/home_page_video_pic_b.jpg" class="img-responsive">
                        <a href="#" class="vdo-start"><i class="fa fa-caret-right" aria-hidden="true"></i></a>
                        <iframe class="video" width="200" height="" src="https://www.youtube.com/embed/K-H35Mpj4uk?enablejsapi=1&amp;version=3&amp;playerapiid=ytplayer&amp;rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" marginwidth="0" marginheight="0" hspace="0" vspace="0" scrolling="no"allowfullscreen allowscriptaccess="always"></iframe>
                    </div>
                </div>
            </div>
    </div>              
</div>
<!-- Video banner End --> 
<div class="clear"></div> 

          

<!-- Categorywise Begin -->

<div class="container">
  <div class="row category_box">
    <div class="col-md-12">
     <div class="col-md-3 col-sm-3 category-left-box">
       <h2>Categories</h2>

        <ul class="nav nav-tabs cat-nav">

          <li class="active cat_rows" id="-1"><a href="#tab_a" data-toggle="tab">Miscellaneous<em>
          <?php
            $offer_count = mysql_num_rows(mysql_query("select * from reedemer_offer where cat_id!=0"));
            echo $offer_count;
              ?>
            </em> </a> <span class="misc">&nbsp;</span>
                
          </li>
          

          <?php
          //print_r($categories);
foreach($categories as $category)
    {
        $offer_count = mysql_num_rows(mysql_query("select * from reedemer_offer where cat_id='".$category->id."'"));

        echo '<li class="cat_rows" id="'.$category->id.'"><a href="#tab_'.$category->id.'" data-toggle="tab">'.$category->cat_name.'<em>'.$offer_count.'</em></a><span class="food">&nbsp;</span></li>';
        
         /*
         if($category->subcat_id=="" && $category->sub_cat=="")
         {
            echo '<li class="cat_rows" id="'.$category->cat_id.'"><a href="#tab_'.$category->cat_id.'" data-toggle="tab">'.$category->cat.'<em>'.$offer_count.'</em></a><span class="food">&nbsp;</span></li>';
         }

         else {
         echo '<li><a href="#" data-toggle="tab">'.$category->cat.'<em>'.$offer_count.'</em></a><span class="food">&nbsp;</span>

           <ul class="subcat-list">
                    <li class="cat_rows" id="'.$category->cat_id.','.$category->subcat_id.'"><a href="#tab_'.$category->subcat_id.'">'.$category->sub_cat.'</a></li>
                   
                </ul>


         </li>';
            }
            */
    } 

            ?>

        </ul>
        <br/>
        <a href="<?php echo site_url(); ?>/index.php/deals/"><b>View All</b></a>
        </div>


        <!-- AJAX BEGIN -->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">

  $(document).ready(function()
    {


        $.ajax({

                type:"post",
                url:"<?php echo site_url(); ?>/index.php/category-tab/",
                data:"cat_id=-1",
                success:function(data)
                {
                    $('#info').html(data);
                }

            });


        $('.cat_rows').click(function(){

            var cat_id = this.id;


            //alert(cat_id);

            $.ajax({

                type:"post",
                url:"<?php echo site_url(); ?>/index.php/category-tab/",
                data:"cat_id="+cat_id,
                success:function(data)
                {
                    $('#info').html(data);
                }

            });

        });

   });



</script>





        <!-- AJAX END -->



<!-- ***************************SEARCH PANEL JQUERY *********************** -->


<script type="text/javascript">

// AJAX call for autocomplete for DEALS CATEGORIES AND SUBCATEGORIES 
$(document).ready(function(){
    $("#deal_cat").keyup(function(){
        $.ajax({
        type: "POST",
        url: "<?php echo site_url(); ?>/index.php/autosearch/",
        data:'keyword='+$(this).val(),
        beforeSend: function(){
            $("#suggesstion-box-cat").css("background","#FFF url(<?php echo site_url(); ?>/wp-content/uploads/2016/06/21.gif) no-repeat 165px");
        },
        success: function(data){
            $("#suggesstion-box-cat").show();
            $("#suggesstion-box-cat").html(data);
            $("#deal_cat").css("background","#FFF");
        }
        });
    });
});
//To select category name
function selectCategory(val, cid, subid) {
$("#deal_cat").val(val);
$("#deal_catid").val(cid);
$("#deal_subcatid").val(subid);
$("#suggesstion-box-cat").hide();
}

// END *******************************************




// AJAX call for autocomplete for DEALS LOCATION 
$(document).ready(function(){
    $("#deal_loc").keyup(function(){
        $.ajax({
        type: "POST",
        url: "<?php echo site_url(); ?>/index.php/autosearch-2/",
        data:'keyword2='+$(this).val(),
        beforeSend: function(){
            $("#suggesstion-box-loc").css("background","#FFF url(<?php echo site_url(); ?>/wp-content/uploads/2016/06/21.gif) no-repeat 165px");
        },
        success: function(data){
            $("#suggesstion-box-loc").show();
            $("#suggesstion-box-loc").html(data);
            $("#deal_loc").css("background","#FFF");
        }
        });
    });
});
//To select deal location
function selectZipcode(val2, createdby) {
$("#deal_loc").val(val2);
$("#deal_created").val(createdby);
$("#suggesstion-box-loc").hide();
}

// END *******************************************


// SEARCH DEALS AJAX METHOD *****************************
$(document).ready(function(){
    var dcat = $('#deal_cat').val();
    var dloc = $('#deal_loc').val();
/*
     $.ajax({

                type:"post",
                url:"<?php echo site_url(); ?>/index.php/deal-search/",
                data:'deal_search='+all,
                success:function(data)
                {
                    $('#deal_search_results').html(data);
                }

            });

    */


     $('#search_deal_btn').on('click', function(){

        var dcatid = $('#deal_catid').val();
        var dsubcatid = $('#deal_subcatid').val();
        var dcreated = $('#deal_created').val();

        $.ajax({

                type:"post",
                url:"<?php echo site_url(); ?>/index.php/category-tab/",
                data:'deal_categoryid='+dcatid+'&deal_subcatid='+dsubcatid+'&dealcreatedby='+dcreated,
                success:function(data)
                {
                     $('#info').html(data);
                    $('#deal_catid').val('');
                    $('#deal_subcatid').val('');
                    $('#deal_created').val('');
                }

            });

        });


     

});
</script>

<!-- Deal SEARCH METHOD END -->






    <div class="tab-content col-md-9 col-sm-9 nopadding">



        <!-- Header Search Box Start -->
            <div class="header-search col-md-12 col-sm-12">
                <div class="col-md-8 col-sm-7">
                    <input class="search-txt" id="deal_cat" type="text" placeholder="How can we help you"/>
                        <input type="hidden" id="deal_catid"/>
                        <input type="hidden" id="deal_subcatid"/>
                        
                        
                        <div id="suggesstion-box-cat"></div>
                </div>
                <div class="col-md-4 col-sm-5">
                   <input class="location" id="deal_loc" type="text" placeholder="Location"/>
                        <input type="hidden" id="deal_created"/>
                        
                        <div id="suggesstion-box-loc"></div>
                        <button class="search-btn-new" name="search_deal_btn" id="search_deal_btn" type="submit" value="Go"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
            </div>
            <!-- Header Search Box End -->
            <div class="clear"></div> 



        
        <!-- Category Ajax Call Begin -->
        
            <div id="info"> </div>

        <!-- Category Ajax Call End -->

         <div id="deal_search_results"> </div>

    </div><!-- tab content -->
</div>
</div>
<!-- Categorywise End -->
<div class="clear"></div>      
<div class="bodypart">
    <div class="row">
      <div class="col-md-12">  
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
        
          <!-- Wrapper for slides -->
          <div class="carousel-inner">
          

             
<?php foreach($partner_offers as $partner_data) { ?>

             <div class="item">
              <img src="<?php bloginfo('template_directory'); ?>/images/banner.jpg" alt="img">
               <div class="carousel-caption">
                <h3><?php echo wordwrap($partner_data->company_name, 7, "<br />\n"); ?></h3>
                
                <p><?php 

                // wordwrap($partner_data->company_name, 20, "<br />\n");
                //$what_you_get = wordwrap($partner_data->what_you_get, 20, "<br />\n");

                //echo $what_you_get; ?> Famiglia’s <br>
                Famous Pizza for 2</p>
                <div class="dollar">
                    <p><?php echo $partner_data->price_range_id; ?></p>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                </div>
                <h3>
                    
<?php $savings = $partner_data->value_calculate%2==0 ? "$".$partner_data->discount : $partner_data->discount."%"; 

                                    echo $savings;

                                    if($partner_data->value_calculate==1 || $partner_data->value_calculate==2)
                                    {
                                        echo " OFF";
                                    }

                                    if($partner_data->value_calculate==3 || $partner_data->value_calculate==4)
                                    {
                                        echo " DISCOUNT";
                                    }

                                    if($partner_data->value_calculate==5 || $partner_data->value_calculate==6)
                                    {
                                        echo " SAVING";
                                    }

                                ?>

                </h3>
                <p><a href="#">Bank It</a></p>
              </div>
            </div><!-- End Item -->

<?php } ?>

            
            
            
            
                    
          </div><!-- End Carousel Inner -->


            <ul class="nav nav-justified carousel-nav">
            
<?php $j=0; foreach($partner_offers as $partner_tab) { ?>

              <li data-target="#myCarousel" data-slide-to="<?php echo $j; ?>"><a href="#">
               <?php echo $partner_tab->company_name; $j++;?>
              </a></li>

              <?php } ?>
              
            </ul>
        </div><!-- End Carousel -->
      </div>
    </div>
</div>
<div class="clear"></div>  
<!--Most Popular Start-->
<div class="section-most">
        <div class="row">
            <div class="col-md-12 nopadding">
                <h2>Most Popular</h2>
                <a href="<?php echo site_url(); ?>/index.php/deals/" class="viewall">view all</a>
                <div class="col-md-4 col-sm-4 product-view">
                <a href="#">
                    <img src="<?php bloginfo('template_directory'); ?>/images/most-pop-first.jpg" alt="img01" class="img-responsive" />
                    <div class="product">
                        <div class="product-title">Lorem ipsum dolor sit amet </div>
                        <div class="product-savings">
                        <p>$$$</p>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <span class="savings">$3 SAVINGS</span></div>
                        <div class="col-expires">*expires in 2 days</div>
                    </div>
                </a>
                </div>
                <div class="col-md-4 col-sm-4 product-view">
                <a href="#">
                    <img src="<?php bloginfo('template_directory'); ?>/images/most-pop-second.jpg" alt="img01" class="img-responsive" />
                    <div class="product">
                        <div class="product-title">Lorem ipsum dolor sit amet </div>
                        <div class="product-savings">
                        <p>$$$</p>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <span class="savings">$3 SAVINGS</span></div>
                        <div class="col-expires">*expires in 2 days</div>
                    </div>
                </a>
                </div>
                <div class="col-md-4 col-sm-4 product-view">
                <a href="<?php echo site_url(); ?>/admin/public/index.php/partner">
                    <img src="<?php bloginfo('template_directory'); ?>/images/most-pop-third.jpg" alt="img01" class="img-responsive" />
                </a>
                </div>
            </div>
        </div>
</div>
<!-- Most Popular End -->
<div class="clear"></div>
<!-- Most Banked Start -->
<div class="section-most-banked">
        <div class="row">
            <div class="col-md-12 nopadding">
                <h2>Most Banked</h2>
                <a href="#" class="viewall">view all</a>
                <div class="col-md-3 col-sm-3 product-view">
                <a href="#">
                    <img src="<?php bloginfo('template_directory'); ?>/images/3.jpg" alt="img01" class="img-responsive" />
                    <div class="banked-product">
                        <div class="product-title">Lorem ipsum dolor sit amet </div>
                        <div class="product-savings">
                        <p>$$$</p>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <span class="savings">$3 SAVINGS</span></div>
                        <div class="col-expires">*expires in 2 days</div>
                    </div>
                </a>
                </div>
                <div class="col-md-3 col-sm-3 product-view">
                <a href="#">
                    <img src="<?php bloginfo('template_directory'); ?>/images/4.jpg" alt="img01" class="img-responsive" />
                    <div class="banked-product">
                        <div class="product-title">Lorem ipsum dolor sit amet </div>
                        <div class="product-savings">
                        <p>$$$</p>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <span class="savings">$3 SAVINGS</span></div>
                        <div class="col-expires">*expires in 2 days</div>
                    </div>
                </a>
                </div>
                <div class="col-md-3 col-sm-3 product-view">
                <a href="#">
                    <img src="<?php bloginfo('template_directory'); ?>/images/5.jpg" alt="img01" class="img-responsive" />
                    <div class="banked-product">
                        <div class="product-title">Lorem ipsum dolor sit amet </div>
                        <div class="product-savings">
                        <p>$$$</p>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <span class="savings">$3 SAVINGS</span></div>
                        <div class="col-expires">*expires in 2 days</div>
                    </div>
                </a>
                </div>
                <div class="col-md-3 col-sm-3 product-view">
                <a href="#">
                    <img src="<?php bloginfo('template_directory'); ?>/images/burger.jpg" alt="img01" class="img-responsive" />
                    <div class="banked-product">
                        <div class="product-title">Lorem ipsum dolor sit amet </div>
                        <div class="product-savings">
                        <p>$$$</p>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <span class="savings">$3 SAVINGS</span></div>
                        <div class="col-expires">*expires in 2 days</div>
                    </div>
                </a>
                </div>
            </div>
        </div>
</div>
<!-- Most Banked End -->
<div class="clear"></div>
<!-- Food and drink Start -->
<div class="section-most-banked">
        <div class="row">
            <div class="col-md-12 nopadding">

            <?php foreach($CategoryTab1 as $cattab1){?>
                <h2><?php echo $cattab1->cat_name; ?></h2>
                <?php } ?>
                <a href="<?php echo site_url(); ?>/index.php/deals/?cat_id=<?php echo $cattab1->id; ?>" class="viewall">view all</a>


<?php foreach($offers_databycat1 as $offers_cat1) { 

                                $today = date('Y-m-d');
                                //echo $today;
                                $exp_date = $offers_cat1->end_date; 
                                $expiry = new DateTime($exp_date);
                                $ex_date = $expiry->format('Y-m-d');
                                //echo $ex_date;

    ?>

                <div class="col-md-3 col-sm-3 product-view">
                

                
                <a href="<?php echo home_url()?>/index.php/deal-details/?offer=<?php echo $offers_cat1->id; ?>">
                    <img src="<?php echo $offers_cat1->offer_image_path; ?>" alt="img01" class="img-responsive" />
                    <div class="banked-product">
                        <div class="product-title"><?php echo $offers_cat1->offer_description; ?> </div>
                        <div class="product-savings">
                        <p><?php echo $offers_cat1->price_range_id; ?></p>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <span class="savings">
                            
<?php $savings1 = $offers_cat1->value_calculate%2==0 ? "$".$offers_cat1->discount : $offers_cat1->discount."%"; 

                                    echo $savings1;

                                    if($offers_cat1->value_calculate==1 || $offers_cat1->value_calculate==2)
                                    {
                                        echo " OFF";
                                    }

                                    if($offers_cat1->value_calculate==3 || $offers_cat1->value_calculate==4)
                                    {
                                        echo " DISCOUNT";
                                    }

                                    if($offers_cat1->value_calculate==5 || $offers_cat1->value_calculate==6)
                                    {
                                        echo " SAVING";
                                    }

                                ?>
                               

                                

                        </span></div>
                        <div class="col-expires">
                            
 <?php 

                                if($today < $ex_date)
                                {

                                $diff = round(abs(strtotime($today) - strtotime($ex_date))/86400);

                                    
                                //$days = date_diff($today, $ex_date);
                                //echo $days;
                                echo "*expires in".$diff."days";

                               

                                }

                                else
                                {
                                    echo "*already expires now!.";
                                }

                                ?>

                        </div>
                    </div>
                </a>
                

                </div>

<?php } ?>
               
               
                
            </div>
        </div>
</div>
<!-- Food and drink End -->
<div class="clear"></div>
<!-- Banner Start -->
<div class="section-most-banked">
        <div class="row">
            <div class="col-md-12">
                <img src="<?php bloginfo('template_directory'); ?>/images/banner_mid.jpg" alt="img01" class="img-responsive" />
                <a href="<?php echo site_url(); ?>/index.php/signup/" class="signup-btn">Sign up</a>
            </div>
        </div>
</div>
<!-- Banner End -->
<div class="clear"></div>
<!-- Saloons & Spa Start --> 
<div class="section-most-banked">
        <div class="row">
            <div class="col-md-12 nopadding">
                 <?php foreach($CategoryTab2 as $cattab2){?>
                <h2><?php echo $cattab2->cat_name; ?></h2>
                <?php } ?>
                <a href="<?php echo site_url(); ?>/index.php/deals/?cat_id=<?php echo $cattab2->id; ?>" class="viewall">view all</a>


<?php foreach($offers_databycat2 as $offers_cat2) { 

                                $today12 = date('Y-m-d');
                                //echo $today;
                                $exp_date12 = $offers_cat2->end_date; 
                                $expiry12 = new DateTime($exp_date12);
                                $ex_date12 = $expiry12->format('Y-m-d');
                                //echo $ex_date;

    ?>

                <div class="col-md-3 col-sm-3 product-view">
                

                
                <a href="<?php echo home_url()?>/index.php/deal-details/?offer=<?php echo $offers_cat2->id; ?>">
                    <img src="<?php echo $offers_cat2->offer_image_path; ?>" alt="img01" class="img-responsive" />
                    <div class="banked-product">
                        <div class="product-title"><?php echo $offers_cat2->offer_description; ?> </div>
                        <div class="product-savings">
                        <p><?php echo $offers_cat2->price_range_id; ?></p>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <span class="savings">
                            
<?php $savings12 = $offers_cat2->value_calculate%2==0 ? "$".$offers_cat2->discount : $offers_cat2->discount."%"; 

                                    echo $savings12;

                                    if($offers_cat2->value_calculate==1 || $offers_cat2->value_calculate==2)
                                    {
                                        echo " OFF";
                                    }

                                    if($offers_cat2->value_calculate==3 || $offers_cat2->value_calculate==4)
                                    {
                                        echo " DISCOUNT";
                                    }

                                    if($offers_cat2->value_calculate==5 || $offers_cat2->value_calculate==6)
                                    {
                                        echo " SAVING";
                                    }

                                ?>
                               

                                

                        </span></div>
                        <div class="col-expires">
                            
 <?php 

                                if($today < $ex_date)
                                {

                                $diff = round(abs(strtotime($today) - strtotime($ex_date))/86400);

                                    
                                //$days = date_diff($today, $ex_date);
                                //echo $days;
                                echo "*expires in".$diff."days";

                               

                                }

                                else
                                {
                                    echo "*already expires now!.";
                                }

                                ?>

                        </div>
                    </div>
                </a>
                

                </div>

<?php } ?>
            </div>
        </div>
</div> 
<!-- Saloons & Spa End -->
<div class="clear"></div>
<!-- Health & Fitness Start --> 
<div class="section-most-banked">
        <div class="row">
            <div class="col-md-12 nopadding">
                <?php foreach($CategoryTab3 as $cattab3){?>
                <h2><?php echo $cattab3->cat_name; ?></h2>
                <?php } ?>
                <a href="<?php echo site_url(); ?>/index.php/deals/?cat_id=<?php echo $cattab3->id; ?>" class="viewall">view all</a>


<?php foreach($offers_databycat3 as $offers_cat3) { 

                                $today = date('Y-m-d');
                                //echo $today;
                                $exp_date = $offers_cat3->end_date; 
                                $expiry = new DateTime($exp_date);
                                $ex_date = $expiry->format('Y-m-d');
                                //echo $ex_date;

    ?>

                <div class="col-md-3 col-sm-3 product-view">
                

                
                <a href="<?php echo home_url()?>/index.php/deal-details/?offer=<?php echo $offers_cat3->id; ?>">
                    <img src="<?php echo $offers_cat3->offer_image_path; ?>" alt="img01" class="img-responsive" />
                    <div class="banked-product">
                        <div class="product-title"><?php echo $offers_cat3->offer_description; ?> </div>
                        <div class="product-savings">
                        <p><?php echo $offers_cat1->price_range_id; ?></p>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <span class="savings">
                            
<?php $savings3 = $offers_cat3->value_calculate%2==0 ? "$".$offers_cat3->discount : $offers_cat3->discount."%"; 

                                    echo $savings3;

                                    if($offers_cat3->value_calculate==1 || $offers_cat3->value_calculate==2)
                                    {
                                        echo " OFF";
                                    }

                                    if($offers_cat3->value_calculate==3 || $offers_cat3->value_calculate==4)
                                    {
                                        echo " DISCOUNT";
                                    }

                                    if($offers_cat3->value_calculate==5 || $offers_cat3->value_calculate==6)
                                    {
                                        echo " SAVING";
                                    }

                                ?>
                               

                                

                        </span></div>
                        <div class="col-expires">
                            
 <?php 

                                if($today < $ex_date)
                                {

                                $diff = round(abs(strtotime($today) - strtotime($ex_date))/86400);

                                    
                                //$days = date_diff($today, $ex_date);
                                //echo $days;
                                echo "*expires in".$diff."days";

                               

                                }

                                else
                                {
                                    echo "*already expires now!.";
                                }

                                ?>

                        </div>
                    </div>
                </a>
                

                </div>

<?php } ?>
            </div>
        </div>
</div> 
<!-- Health & Fitness End --> 
<div class="clear"></div>
<!-- Banner Start -->
<div class="section-most-banked">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <img src="<?php bloginfo('template_directory'); ?>/images/banner3.jpg" alt="img01" class="img-responsive" />
            </div>
            <div class="col-md-1"></div>
        </div>
</div>
<!-- Banner End -->
<div class="clear"></div>
<!-- Travel Start --> 
<div class="section-most-banked">
        <div class="row">
            <div class="col-md-12 nopadding">
                 <?php foreach($CategoryTab4 as $cattab4){?>
                <h2><?php echo $cattab4->cat_name; ?></h2>
                <?php } ?>
                <a href="<?php echo site_url(); ?>/index.php/deals/?cat_id=<?php echo $cattab4->id; ?>" class="viewall">view all</a>


<?php foreach($offers_databycat4 as $offers_cat4) { 

                                $today = date('Y-m-d');
                                //echo $today;
                                $exp_date = $offers_cat4->end_date; 
                                $expiry = new DateTime($exp_date);
                                $ex_date = $expiry->format('Y-m-d');
                                //echo $ex_date;

    ?>

                <div class="col-md-3 col-sm-3 product-view">
                

                
                <a href="<?php echo home_url()?>/index.php/deal-details/?offer=<?php echo $offers_cat4->id; ?>">
                    <img src="<?php echo $offers_cat4->offer_image_path; ?>" alt="img01" class="img-responsive" />
                    <div class="banked-product">
                        <div class="product-title"><?php echo $offers_cat4->offer_description; ?> </div>
                        <div class="product-savings">
                        <p><?php echo $offers_cat4->price_range_id; ?></p>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <span class="savings">
                            
<?php $savings1 = $offers_cat4->value_calculate%2==0 ? "$".$offers_cat4->discount : $offers_cat4->discount."%"; 

                                    echo $savings4;

                                    if($offers_cat4->value_calculate==1 || $offers_cat4->value_calculate==2)
                                    {
                                        echo " OFF";
                                    }

                                    if($offers_cat4->value_calculate==3 || $offers_cat4->value_calculate==4)
                                    {
                                        echo " DISCOUNT";
                                    }

                                    if($offers_cat4->value_calculate==5 || $offers_cat->value_calculate==6)
                                    {
                                        echo " SAVING";
                                    }

                                ?>
                               

                                

                        </span></div>
                        <div class="col-expires">
                            
 <?php 

                                if($today < $ex_date)
                                {

                                $diff = round(abs(strtotime($today) - strtotime($ex_date))/86400);

                                    
                                //$days = date_diff($today, $ex_date);
                                //echo $days;
                                echo "*expires in".$diff."days";

                               

                                }

                                else
                                {
                                    echo "*already expires now!.";
                                }

                                ?>

                        </div>
                    </div>
                </a>
                

                </div>

<?php } ?>
            </div>
        </div>
</div> 
<!-- Travel End -->
<div class="clear"></div>
<!-- Shopping Start --> 
<div class="section-most-banked">
        <div class="row">
            <div class="col-md-12 nopadding">
                
 <?php foreach($CategoryTab5 as $cattab5){?>
                <h2><?php echo $cattab5->cat_name; ?></h2>
                <?php } ?>
                <a href="<?php echo site_url(); ?>/index.php/deals/?cat_id=<?php echo $cattab5->id; ?>" class="viewall">view all</a>


<?php foreach($offers_databycat5 as $offers_cat5) { 

                               

    ?>

                <div class="col-md-3 col-sm-3 product-view">
                

                
                <a href="<?php echo home_url()?>/index.php/deal-details/?offer=<?php echo $offers_cat5->id; ?>">
                    <img src="<?php echo $offers_cat5->offer_image_path; ?>" alt="img01" class="img-responsive" />
                    <div class="banked-product">
                        <div class="product-title"><?php echo $offers_cat5->offer_description; ?> </div>
                        <div class="product-savings">
                        <p><?php echo $offers_cat5->price_range_id; ?></p>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <span class="savings">
                            
<?php $savings5 = $offers_cat5->value_calculate%2==0 ? "$".$offers_cat5->discount : $offers_cat5->discount."%"; 

                                    echo $savings5;

                                    if($offers_cat5->value_calculate==1 || $offers_cat5->value_calculate==2)
                                    {
                                        echo " OFF";
                                    }

                                    if($offers_cat5->value_calculate==3 || $offers_cat5->value_calculate==4)
                                    {
                                        echo " DISCOUNT";
                                    }

                                    if($offers_cat5->value_calculate==5 || $offers_cat5->value_calculate==6)
                                    {
                                        echo " SAVING";
                                    }

                                ?>
                               

                                

                        </span></div>
                        <div class="col-expires">
                            
 <?php 


  $today5 = date('Y-m-d');
                                //echo $today;
                                $exp_date5 = $offers_cat5->end_date; 
                                $expiry5 = new DateTime($exp_date5);
                                $ex_date5 = $expiry5->format('Y-m-d');
                                //echo $ex_date;

                                if($today5 < $ex_date5)
                                {

                                $diff5 = round(abs(strtotime($today5) - strtotime($ex_date))/86400);

                                    
                                //$days = date_diff($today, $ex_date);
                                //echo $days;
                                echo "*expires in".$diff5."days";

                               

                                }

                                else
                                {
                                    echo "*already expires now!.";
                                }

                                ?>

                        </div>
                    </div>
                </a>
                

                </div>

<?php } ?>

            </div>
        </div>
</div> 
<!-- Shopping End --> 
<div class="clear"></div>
<!-- View all Start -->
<div class="section-most-banked">
        <div class="row">
            <div class="col-md-12 view-btn-container">
                <a href="<?php echo site_url(); ?>/index.php/deals/" class="view-btn">View All</a>
            </div>
        </div>
</div>
<!-- View all End --> 
       
</div>

<div class="clear"></div>
<!-- Partners Start -->
<div class="section-partners">
        <div class="row">
            <div class="col-md-12">
                <h2>Redeemer Partners</h2>

<?php 

$ploop = 1;
//$arr_length = count($partner_logo);
//echo $arr_length;


foreach($partner_logo as $plogos)
{
      
      if($ploop%7!=0) { ?>
    
        <div class="col-md-2 col-sm-2"><a href="#"><img src="<?php echo '<?php echo site_url(); ?>/admin/uploads/original/'.$plogos->logo_name; ?>" alt="img01" class="img-responsive" /></a></div>
                
 
       <?php } 

        else {

            echo '</div>
            <div class="clear">&nbsp</div>';

            }



        $ploop++;


   }

   




    ?>
            
            <div class="clear">&nbsp</div>
            <div class="col-md-12">
                <a href="#" class="view-btn">View All</a>
            </div>

        </div>
</div>
<!-- Partners End -->
<script type="text/javascript">
  $(document).ready(function(){
$(".product-view img").each(function(){
console.log($(this));
});
  });
</script>
<?php get_footer(); ?>