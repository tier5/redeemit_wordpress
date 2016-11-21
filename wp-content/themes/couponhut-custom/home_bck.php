<?php
/*
Template Name: Home Page
*/

global $wpdb; 
$category_tab="SELECT * FROM reedemer_category WHERE status='1' AND parent_id='0' ORDER BY id DESC LIMIT 10";
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

$partner =  "SELECT ro.*, rp.created_by, ru.* FROM users AS ru, reedemer_partner_settings AS rp, reedemer_offer AS ro WHERE ru.id=rp.created_by AND ru.id=ro.created_by AND ru.type='2' ORDER BY RAND() ";

$partner_offers = $wpdb->get_results($partner);


//

// SHOWING PARTNER LOGO


$partner_logos ="SELECT * FROM reedemer_logo WHERE status='1' LIMIT 14";
$partner_logo =  $wpdb->get_results($partner_logos);

//


get_header(); ?>

<div class="clear20"></div>
<div class="container-fluid container-main">
    <div class="row">
        <div class="col-md-12 main-heading">
            <h1>Connect with a brand ... shop discount offers</h1>
        </div>
    </div>
</div>
<div class="clear20"></div>

<!-- Categorywise Begin -->

<div class="container">
   <div class="row category_box">
    <div class="col-md-12">
        <div class="col-md-3 col-sm-3 category-left-box">
            <h2>Categories</h2>
            <ul class="nav nav-tabs cat-nav">
              <li class="active cat_rows"  id="-1"">
				  <a href="#tab_a" data-toggle="tab">Miscellaneous
				 	 <em>
						 <?php
							$offer_count = $wpdb->get_results("select * from reedemer_offer where cat_id!=0 && status = 1");
							echo count($offer_count);
							  ?>
				 	 </em> 
				  </a> <span class="misc">&nbsp;</span>
              </li>
              <?php          
			foreach($categories as $category)
				{
					$offer_count = $wpdb->get_results("select * from reedemer_offer where cat_id='".$category->id."' && status = 1");

					echo '<li class="cat_rows" id="'.$category->id.'"><a href="#tab_'.$category->id.'" data-toggle="tab">'.$category->cat_name.'<em>'.count($offer_count).'</em></a><span class="food">&nbsp;</span></li>';


				} 

            ?>
            </ul>
            <a href="<?php echo home_url(); ?>/index.php/deals" class="viewall-cat">View All</a>
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
				<span class="searchbox">
					<input class="search-txt" id="deal_cat" type="text"/>
					
					<input type="hidden" id="deal_catid"/>
					<input type="hidden" id="deal_subcatid"/>


					<div id="suggesstion-box-cat"></div>
					
				</span>
			</div>
			<div class="col-md-4 col-sm-5">
				<input class="location"  id="deal_loc" type="text" placeholder="Location"/>
				
				<input type="hidden" id="deal_created"/>
                        	<button class="search-btn-new" name="search-btn-new" id="search_deal_btn" type="submit" value="Go"><i class="fa fa-search" aria-hidden="true"></i></button>
				<div id="suggesstion-box-loc"></div>
				
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
<!-- Categorywise End -->
<div class="clear"></div>  
</div>

 
<div class="map_test">

	
</div>
	<div class="clear"></div>

<!-- Categorywise End -->
<div class="clear"></div>      
<div class="map_ico">
<?php 
		$sql_locations = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE status = 1"); 
			
		foreach( $sql_locations as $rs_location ) {

			$lat= $rs_location->latitude; //latitude
			$lng= $rs_location->longitude; //longitude
			$address= getaddress($lat,$lng);

			$markers[] = array(
			"$address",
			$rs_location->latitude,
			$rs_location->longitude,
			"http://labs.google.com/ridefinder/images/mm_20_red.png",
			$rs_location->offer_description,
			"<img src='".$rs_location->offer_image_path."' width='100px' height='50px' >"
			);
		}
		//print_r($markers);
	?>
	<div id="map_wrapper">
    <div id="map_canvas" class="mapping"></div>
</div>


<style>

    #map_wrapper {
        height: 400px;
    }

    #map_canvas {
        width: 100%;
        height: 430px;
    }
.map_ico {
    margin-bottom: 60px;
    max-height: 400px;
}


</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD84iwE1qE0EPyKXMS8zBj3J_4J1Q9fP3w"></script>
	
<!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"
  type="text/javascript"></script>-->	
<script>

    function initialize() {
        var map;
        var bounds = new google.maps.LatLngBounds();
        var mapOptions = {
            mapTypeId: "roadmap",
            center: new google.maps.LatLng(52.791331, -1.918728), // somewhere in the uk BEWARE center is required
            zoom: 20,
        };

        // Display a map on the page
        map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
        map.setTilt(45);

        // Multiple Markers
        var markers = <?php echo json_encode( $markers ); ?>;

	// Info Window Content
        var infoWindowContent = [
            ['<div class="info_content">' +
            '<h3>London Eye</h3>' +
            '<p>The London Eye is a giant Ferris wheel situated on the banks of the River Thames. The entire structure is 135 metres (443 ft) tall and the wheel has a diameter of 120 metres (394 ft).</p>' + '</div>'],
            ['<div class="info_content">' +
            '<h3>Palace of Westminster</h3>' +
            '<p>The Palace of Westminster is the meeting place of the House of Commons and the House of Lords, the two houses of the Parliament of the United Kingdom. Commonly known as the Houses of Parliament after its tenants.</p>' +
            '</div>']
        ];

        // Display multiple markers on a map
        var infoWindow = new google.maps.InfoWindow();
        var marker, i;

        // Loop through our array of markers & place each one on the map
        for (i = 0; i < markers.length; i++) {
            var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
            bounds.extend(position);
            marker = new google.maps.Marker({
                position: position,
                map: map,
                title: markers[i][0],
                icon: markers[i][3]    
            });

	    
	
            // Allow each marker to have an info window
            google.maps.event.addListener(marker, 'mouseover', (function (marker, i) {
                return function () {
		    var mar_img = markers[i][5];
		    var mar_name = markers[i][4];		
		    html = mar_img + '<br>' + mar_name;
	
                    infoWindow.setContent(html);
                    infoWindow.open(map, marker);
                }
            })(marker, i));

	    /*google.maps.event.addListener(marker, 'mouseout', (function (marker, i) {
                return function () {
                    //infoWindow.setContent(markers[i][0]);
                    infoWindow.close();
                }
            })(marker, i));*/

            // Automatically center the map fitting all markers on the screen
            map.fitBounds(bounds);
        }

        //Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
        var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function (event) {
            this.setZoom(3);
            google.maps.event.removeListener(boundsListener);
        });

    }
    google.maps.event.addDomListener(window, 'load', initialize);


</script>

</div>
<!--Most Popular Start-->
<div class="section-most">
        <div class="row">
            <div class="col-md-12 nopadding">
                <h2>Popular & seasonal</h2>
                <a href="#" class="viewall">view all</a>
                <div class="col-md-3 col-sm-3 product-view">
                <a href="#">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/search1.jpg" alt="img01" class="img-responsive" />
                    <div class="product">
                        <div class="product-title">Famiglia’s Famous dinner for 2 with welcome drinks Famiglia’s Famous dinner</div>
                        <div class="product-savings">
                            <span class="savings">53% off</span>
                            <span class="pricesection"><color>$750</color>
                                $349
                            </span>
                        </div>
                        <div class="col-expires"><i class="fa fa-map-marker" aria-hidden="true"></i>FBBC Hillcrest  (1.8 miles)
                        </div>
                    </div>
                </a>
                </div>
                <div class="col-md-3 col-sm-3 product-view">
                <a href="#">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/search9.jpg" alt="img01" class="img-responsive" />
                    <div class="product">
                        <div class="product-title">Famiglia’s Famous dinner for 2 with welcome drinks</div>
                        <div class="product-savings">
                            <span class="savings">53% off</span>
                            <span class="pricesection"><color>$750</color>
                                $349
                            </span>
                        </div>
                        <div class="col-expires"><i class="fa fa-map-marker" aria-hidden="true"></i>FBBC Hillcrest  (1.8 miles)
                        </div>
                    </div>
                </a>
                </div>
                <div class="col-md-3 col-sm-3 product-view">
                <a href="#">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/search2.jpg" alt="img01" class="img-responsive" />
                    <div class="product">
                        <div class="product-title">Famiglia’s Famous dinner for 2 with welcome drinks</div>
                        <div class="product-savings">
                            <span class="savings">53% off</span>
                            <span class="pricesection"><color>$750</color>
                                $349
                            </span>
                        </div>
                        <div class="col-expires"><i class="fa fa-map-marker" aria-hidden="true"></i>FBBC Hillcrest  (1.8 miles)
                        </div>
                    </div>
                </a>
                </div>
                <div class="col-md-3 col-sm-3 product-view">
                <a href="<?php echo home_url(); ?>/admin/public/index.php/partner">
                    <img src="<?php bloginfo('template_directory'); ?>/images/most-pop-third.jpg" alt="img01" class="img-responsive" />
					</a>	
                </div>
            </div>
        </div>
</div>
<div class="clear"></div>	
<!-- Most Popular End -->
	
<!-- Most Banked Start -->
<div class="section-most-banked">
        <div class="row">
            <div class="col-md-12 nopadding">
                <h2>Entertainment</h2>
                <a href="#" class="viewall">view all</a>
                <div class="col-md-3 col-sm-3 product-view">
                <a href="#">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/pic1.jpg" alt="img01" class="img-responsive" />
                    <div class="banked-product">
                        <div class="product-title">Famiglia’s Famous dinner for 2 with welcome drinks Famiglia’s Famous dinner for </div>
                        <div class="product-savings">
                            <span class="savings">53% off</span>
                            <span class="pricesection"><color>$750</color>
                                $349
                            </span>
                        </div>
                        <div class="col-expires"><i class="fa fa-map-marker" aria-hidden="true"></i>FBBC Hillcrest  (1.8 miles)
                        </div>
                    </div>
                </a>
                </div>
                <div class="col-md-3 col-sm-3 product-view">
                <a href="#">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/pic2.jpg" alt="img01" class="img-responsive" />
                    <div class="banked-product">
                        <div class="product-title">Famiglia’s Famous dinner for 2 with welcome drinks</div>
                        <div class="product-savings">
                            <span class="savings">53% off</span>
                            <span class="pricesection"><color>$750</color>
                                $349
                            </span>
                        </div>
                        <div class="col-expires"><i class="fa fa-map-marker" aria-hidden="true"></i>FBBC Hillcrest  (1.8 miles)
                        </div>
                    </div>
                </a>
                </div>
                <div class="col-md-3 col-sm-3 product-view">
                <a href="#">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/pic3.jpg" alt="img01" class="img-responsive" />
                    <div class="banked-product">
                        <div class="product-title">Famiglia’s Famous dinner for 2 with welcome drinks</div>
                        <div class="product-savings">
                            <span class="savings">53% off</span>
                            <span class="pricesection"><color>$750</color>
                                $349
                            </span>
                        </div>
                        <div class="col-expires"><i class="fa fa-map-marker" aria-hidden="true"></i>FBBC Hillcrest  (1.8 miles)
                        </div>
                    </div>
                </a>
                </div>
                <div class="col-md-3 col-sm-3 product-view">
                <a href="#">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/pic4.jpg" alt="img01" class="img-responsive" />
                    <div class="banked-product">
                        <div class="product-title">Famiglia’s Famous dinner for 2 with welcome drinks</div>
                        <div class="product-savings">
                            <span class="savings">53% off</span>
                            <span class="pricesection"><color>$750</color>
                                $349
                            </span>
                        </div>
                        <div class="col-expires"><i class="fa fa-map-marker" aria-hidden="true"></i>FBBC Hillcrest  (1.8 miles)
                        </div>
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
                 <?php foreach($CategoryTab2 as $cattab2){?>
                <h2><?php echo $cattab2->cat_name; ?></h2>
                <?php } ?>
                <a href="<?php echo home_url(); ?>/index.php/deals/?cat_id=<?php echo $cattab2->id; ?>" class="viewall">view all</a>


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
                        <div class="product-title">
				<?php if(strlen($offers_cat2->offer_description) > 35) { 
								echo substr($offers_cat2->offer_description,0,35)."....";
							} else { 
								echo $offers_cat2->offer_description;
							} ?>
			</div>
                        <div class="product-savings">
				<?php 		 		
								//echo "SELECT * FROM `reedemer_offer` WHERE id = $offers->id";
								$offer_prc = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE id = $offers_cat2->id && status = 1");
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

FBBC Hillcrest (<?php 
								$ip  = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
								$url = "http://freegeoip.net/json/$ip";
								$ch  = curl_init();

								curl_setopt($ch, CURLOPT_URL, $url);
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
								curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
								$data = curl_exec($ch);
								curl_close($ch);

								if ($data) {
									$location = json_decode($data);

									$lat = $location->latitude;
									$lon = $location->longitude;

								}	
								echo floor(distance($lat, $lon, $offer_lat, $offer_lon, "M"))." Miles"; ?>) 
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
                <img src="<?php echo get_template_directory_uri(); ?>/images/banner_mid.jpg" alt="img01" class="img-responsive bannermiddle" />
                <a href="<?php echo home_url(); ?>/index.php/signup/" class="signup-btn">Sign up</a>
            </div>
        </div>
</div>
<!-- Banner End -->	
<div class="clear"></div>	
<!-- Saloons & Spa Start --> 
<div class="section-most-banked">
        <div class="row">
            <div class="col-md-12 nopadding">
                <h2>Everything outdoor</h2>
                <a href="#" class="viewall">view all</a>
                <div class="col-md-3 col-sm-3 product-view">
                <a href="#">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/pic9.jpg" alt="img01" class="img-responsive" />
                    <div class="banked-product">
                        <div class="product-title">Famiglia’s Famous dinner for 2 with welcome drinks</div>
                        <div class="product-savings">
                            <span class="savings">53% off</span>
                            <span class="pricesection"><color>$750</color>
                                $349
                            </span>
                        </div>
                        <div class="col-expires"><i class="fa fa-map-marker" aria-hidden="true"></i>FBBC Hillcrest  (1.8 miles)
                        </div>
                    </div>
                </a>
                </div>
                <div class="col-md-3 col-sm-3 product-view">
                <a href="#">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/pic10.jpg" alt="img01" class="img-responsive" />
                    <div class="banked-product">
                        <div class="product-title">Famiglia’s Famous dinner for 2 with welcome drinks</div>
                        <div class="product-savings">
                            <span class="savings">53% off</span>
                            <span class="pricesection"><color>$750</color>
                                $349
                            </span>
                        </div>
                        <div class="col-expires"><i class="fa fa-map-marker" aria-hidden="true"></i>FBBC Hillcrest  (1.8 miles)
                        </div>
                    </div>
                </a>
                </div>
                <div class="col-md-3 col-sm-3 product-view">
                <a href="#">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/pic11.jpg" alt="img01" class="img-responsive" />
                    <div class="banked-product">
                        <div class="product-title">Famiglia’s Famous dinner for 2 with welcome drinks</div>
                        <div class="product-savings">
                            <span class="savings">53% off</span>
                            <span class="pricesection"><color>$750</color>
                                $349
                            </span>
                        </div>
                        <div class="col-expires"><i class="fa fa-map-marker" aria-hidden="true"></i>FBBC Hillcrest  (1.8 miles)
                        </div>
                    </div>
                </a>
                </div>
                <div class="col-md-3 col-sm-3 product-view">
                <a href="#">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/pic12.jpg" alt="img01" class="img-responsive" />
                    <div class="banked-product">
                        <div class="product-title">Famiglia’s Famous dinner for 2 with welcome drinks</div>
                        <div class="product-savings">
                            <span class="savings">53% off</span>
                            <span class="pricesection"><color>$750</color>
                                $349
                            </span>
                        </div>
                        <div class="col-expires"><i class="fa fa-map-marker" aria-hidden="true"></i>FBBC Hillcrest  (1.8 miles)
                        </div>
                    </div>
                </a>
                </div>
            </div>
        </div>
</div> 
<!-- Saloons & Spa End -->	
<div class="clear"></div>
<!-- Health & Fitness Start --> 
<div class="section-most-banked">
        <div class="row">
            <div class="col-md-12 nopadding">
                <h2>Health & Fitness</h2>
                <a href="#" class="viewall">view all</a>
                <div class="col-md-3 col-sm-3 product-view">
                <a href="#">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/pic13.jpg" alt="img01" class="img-responsive" />
                    <div class="banked-product">
                        <div class="product-title">Famiglia’s Famous dinner for 2 with welcome drinks</div>
                        <div class="product-savings">
                            <span class="savings">53% off</span>
                            <span class="pricesection"><color>$750</color>
                                $349
                            </span>
                        </div>
                        <div class="col-expires"><i class="fa fa-map-marker" aria-hidden="true"></i>FBBC Hillcrest  (1.8 miles)
                        </div>
                    </div>
                </a>
                </div>
                <div class="col-md-3 col-sm-3 product-view">
                <a href="#">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/pic14.jpg" alt="img01" class="img-responsive" />
                    <div class="banked-product">
                        <div class="product-title">Famiglia’s Famous dinner for 2 with welcome drinks</div>
                        <div class="product-savings">
                            <span class="savings">53% off</span>
                            <span class="pricesection"><color>$750</color>
                                $349
                            </span>
                        </div>
                        <div class="col-expires"><i class="fa fa-map-marker" aria-hidden="true"></i>FBBC Hillcrest  (1.8 miles)
                        </div>
                    </div>
                </a>
                </div>
                <div class="col-md-3 col-sm-3 product-view">
                <a href="#">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/pic15.jpg" alt="img01" class="img-responsive" />
                    <div class="banked-product">
                        <div class="product-title">Famiglia’s Famous dinner for 2 with welcome drinks</div>
                        <div class="product-savings">
                            <span class="savings">53% off</span>
                            <span class="pricesection"><color>$750</color>
                                $349
                            </span>
                        </div>
                        <div class="col-expires"><i class="fa fa-map-marker" aria-hidden="true"></i>FBBC Hillcrest  (1.8 miles)
                        </div>
                    </div>
                </a>
                </div>
                <div class="col-md-3 col-sm-3 product-view">
                <a href="#">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/pic16.jpg" alt="img01" class="img-responsive" />
                    <div class="banked-product">
                        <div class="product-title">Famiglia’s Famous dinner for 2 with welcome drinks</div>
                        <div class="product-savings">
                            <span class="savings">53% off</span>
                            <span class="pricesection"><color>$750</color>
                                $349
                            </span>
                        </div>
                        <div class="col-expires"><i class="fa fa-map-marker" aria-hidden="true"></i>FBBC Hillcrest  (1.8 miles)
                        </div>
                    </div>
                </a>
                </div>
            </div>
        </div>
</div> 
<!-- Health & Fitness End --> 
<div class="clear"></div>
<!-- Banner Start -->
<div class="section-most-banked">
        <div class="row">
            <div class="col-md-12 contentvdo">
                <div class="vdo">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/contentvdo.jpg" class="img-responsive bannermiddle">
                    <a href="#" class="vdo-start">
                        <i class="fa fa-caret-right vdo-starticon" aria-hidden="true"></i>
                        <i class="fa fa-pause vdo-paused" aria-hidden="true"></i>
                    </a>
                    <iframe class="video" width="560" height="313" src="https://www.youtube.com/embed/aEbfQMut-50?enablejsapi=1&amp;version=3&amp;playerapiid=ytplayer&amp;rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" marginwidth="0" marginheight="0" hspace="0" vspace="0" scrolling="no"allowfullscreen allowscriptaccess="always"></iframe>
                </div>
            </div>
        </div>
</div>
<!-- Banner End -->	
<div class="clear"></div>
<!-- Travel Start --> 
<div class="section-most-banked">
        <div class="row">
            <div class="col-md-12 nopadding">
                <h2>Travel</h2>
                <a href="#" class="viewall">view all</a>
                <div class="col-md-3 col-sm-3 product-view">
                <a href="#">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/pic17.jpg" alt="img01" class="img-responsive" />
                    <div class="banked-product">
                        <div class="product-title">Famiglia’s Famous dinner for 2 with welcome drinks</div>
                        <div class="product-savings">
                            <span class="savings">53% off</span>
                            <span class="pricesection"><color>$750</color>
                                $349
                            </span>
                        </div>
                        <div class="col-expires"><i class="fa fa-map-marker" aria-hidden="true"></i>FBBC Hillcrest  (1.8 miles)
                        </div>
                    </div>
                </a>
                </div>
                <div class="col-md-3 col-sm-3 product-view">
                <a href="#">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/pic18.jpg" alt="img01" class="img-responsive" />
                    <div class="banked-product">
                        <div class="product-title">Famiglia’s Famous dinner for 2 with welcome drinks</div>
                        <div class="product-savings">
                            <span class="savings">53% off</span>
                            <span class="pricesection"><color>$750</color>
                                $349
                            </span>
                        </div>
                        <div class="col-expires"><i class="fa fa-map-marker" aria-hidden="true"></i>FBBC Hillcrest  (1.8 miles)
                        </div>
                    </div>
                </a>
                </div>
                <div class="col-md-3 col-sm-3 product-view">
                <a href="#">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/pic19.jpg" alt="img01" class="img-responsive" />
                    <div class="banked-product">
                        <div class="product-title">Famiglia’s Famous dinner for 2 with welcome drinks</div>
                        <div class="product-savings">
                            <span class="savings">53% off</span>
                            <span class="pricesection"><color>$750</color>
                                $349
                            </span>
                        </div>
                        <div class="col-expires"><i class="fa fa-map-marker" aria-hidden="true"></i>FBBC Hillcrest  (1.8 miles)
                        </div>
                    </div>
                </a>
                </div>
                <div class="col-md-3 col-sm-3 product-view">
                <a href="#">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/pic20.jpg" alt="img01" class="img-responsive" />
                    <div class="banked-product">
                        <div class="product-title">Famiglia’s Famous dinner for 2 with welcome drinks</div>
                        <div class="product-savings">
                            <span class="savings">53% off</span>
                            <span class="pricesection"><color>$750</color>
                                $349
                            </span>
                        </div>
                        <div class="col-expires"><i class="fa fa-map-marker" aria-hidden="true"></i>FBBC Hillcrest  (1.8 miles)
                        </div>
                    </div>
                </a>
                </div>
            </div>
        </div>
</div> 	
<div class="clear"></div>
<!--Shopping Start-->	
<div class="section-most-banked">
        <div class="row">
            <div class="col-md-12 nopadding">
                <?php foreach($CategoryTab3 as $cattab3){?>
                <h2><?php echo $cattab3->cat_name; ?></h2>
                <?php } ?>
                <a href="<?php echo home_url(); ?>/index.php/deals/?cat_id=<?php echo $cattab3->id; ?>" class="viewall">view all</a>


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
                        <div class="product-title">
				<?php if(strlen($offers_cat3->offer_description) > 35) { 
								echo substr($offers_cat3->offer_description,0,35)."....";
							} else { 
								echo $offers_cat3->offer_description;
							} ?> 
			</div>
                        <div class="product-savings">
				<?php 		 		
								//echo "SELECT * FROM `reedemer_offer` WHERE id = $offers->id";
								$offer_prc = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE id = $offers_cat3->id && status = 1");
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
FBBC Hillcrest (<?php 
								$ip  = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
								$url = "http://freegeoip.net/json/$ip";
								$ch  = curl_init();

								curl_setopt($ch, CURLOPT_URL, $url);
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
								curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
								$data = curl_exec($ch);
								curl_close($ch);

								if ($data) {
									$location = json_decode($data);

									$lat = $location->latitude;
									$lon = $location->longitude;

								}	
								echo floor(distance($lat, $lon, $offer_lat, $offer_lon, "M"))." Miles"; ?>) 
                        </div>
                    </div>
                </a>
                

                </div>

<?php } ?>
            </div>
        </div>
</div> 	
<!--Shopping End-->
<div class="clear"></div>
<!-- View all Start -->
<div class="section-most-banked">
        <div class="row">
            <div class="col-md-12 view-btn-container">
                <a href="#" class="view-btn">View All</a>
            </div>
        </div>
</div>
<!-- View all End -->
<div class="clear"></div>
<!-- blogs Start -->
<div class="section-most-banked blogs">
    <div class="row">
        <div class="col-md-12">
            <h2>Our Latest Blogs</h2>
            <p>Donec sollicitudin molestie malesuada. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Proin eget tortor risus. Quisque velit nisi, pretium ut lacinia in, elementum id enim.</p>
            
            <div class="carousel-reviews">
                <div class="container">
                    <div class="row">
                        <div id="carousel-reviews" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="item active">
                                    <div class="col-md-3 col-sm-6">
                                        <div class="block-text">
                                            <h4>21 sept, 2015</h4>
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/testi_pic1.jpg" class="img-responsive"/>
                                            <h3>App launching</h3>
                                            <p>Never before has there been a good film portrayal of ancient Greece's favourite myth. So why would Hollywood start now? </p> 
                                            <a href="#">See More</a>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 hidden-xs">
                                        <div class="block-text">
                                            <h4>21 sept, 2015</h4>
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/testi_pic2.jpg" class="img-responsive"/>
                                            <h3>comfort of the home</h3>
                                            <p>Never before has there been a good film portrayal of ancient Greece's favourite myth. So why would Hollywood start now? </p> 
                                            <a href="#">See More</a>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 hidden-sm hidden-xs">
                                        <div class="block-text">
                                            <h4>21 sept, 2015</h4>
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/testi_pic3.jpg" class="img-responsive"/>
                                            <h3>comfort of the home</h3>
                                            <p>Never before has there been a good film portrayal of ancient Greece's favourite myth. So why would Hollywood start now? </p> 
                                            <a href="#">See More</a>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 hidden-sm hidden-xs">
                                        <div class="block-text">
                                            <h4>21 sept, 2015</h4>
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/testi_pic4.jpg" class="img-responsive"/>
                                            <h3>comfort of the home</h3>
                                            <p>Never before has there been a good film portrayal of ancient Greece's favourite myth. So why would Hollywood start now? </p> 
                                            <a href="#">See More</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="col-md-3 col-sm-6">
                                        <div class="block-text">
                                            <h4>21 sept, 2015</h4>
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/testi_pic2.jpg" class="img-responsive"/>
                                            <h3>comfort of the home</h3>
                                            <p>Never before has there been a good film portrayal of ancient Greece's favourite myth. So why would Hollywood start now? </p> 
                                            <a href="#">See More</a>
                                        </div>
                                    </div>   
                                    <div class="col-md-3 col-sm-6 hidden-xs">
                                        <div class="block-text">
                                            <h4>21 sept, 2015</h4>
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/testi_pic4.jpg" class="img-responsive"/>
                                            <h3>comfort of the home</h3>
                                            <p>Never before has there been a good film portrayal of ancient Greece's favourite myth. So why would Hollywood start now? </p> 
                                            <a href="#">See More</a>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 hidden-sm hidden-xs">
                                        <div class="block-text">
                                            <h4>21 sept, 2015</h4>
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/testi_pic1.jpg" class="img-responsive"/>
                                            <h3>comfort of the home</h3>
                                            <p>Never before has there been a good film portrayal of ancient Greece's favourite myth. So why would Hollywood start now? </p> 
                                            <a href="#">See More</a>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 hidden-sm hidden-xs">
                                        <div class="block-text">
                                            <h4>21 sept, 2015</h4>
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/testi_pic3.jpg" class="img-responsive"/>
                                            <h3>comfort of the home</h3>
                                            <p>Never before has there been a good film portrayal of ancient Greece's favourite myth. So why would Hollywood start now? </p> 
                                            <a href="#">See More</a>
                                        </div>
                                    </div>
                                </div>                   
                            </div>
                        </div>
                    </div>
                </div>
            <a class="left carousel-control" href="#carousel-reviews" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-reviews" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
            </div>
        </div>
    </div>
</div>
<!-- blogs End --> 	
</div>

<?php get_footer(); ?>
