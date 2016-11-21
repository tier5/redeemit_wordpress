<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/*add_action( 'wp_enqueue_scripts', 'ssd_theme_enqueue_styles' );
function ssd_theme_enqueue_styles() {

	wp_enqueue_style( 'child-styles', get_stylesheet_directory_uri() . '/style.css', array('ssd_owl-carousel-css', 'ssd_font-awesome-css', 'ssd_icomoon-css', 'ssd_videojs-css', 'ssd_bigvideo-css', 'ssd_master-css', 'ssd_fw-theme-ie'), '1.0');

} */



add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
    add_theme_support( 'post-thumbnails' );
}


function register_custom_menus()
    {

        register_nav_menus(array(

            'top-menu' => __('Top Menu'),
            'top-menu-logedin' => __('Top Menu Loged In'),
            'main-primary-menu' => __('Main Primary Menu')

            ));
    
    }


add_action('init', 'register_custom_menus');



function reedemar_footer_section_widget_init()
	{

		register_sidebar( array(

        'name'          => __( 'Footer Section01', 'reedemar' ),

        'id'            => 'footer-section01',

        'description'   => __( 'Appears in the footer section of the site.', 'reedemar' ),

        'before_widget' => '<aside id="%1$s" class="widget %2$s">',

        'after_widget'  => '</aside>',

        'before_title'  => '<h3 class="widget-title">',

        'after_title'   => '</h3>',

    ) );


		register_sidebar( array(

        'name'          => __( 'Footer Section02', 'reedemar' ),

        'id'            => 'footer-section02',

        'description'   => __( 'Appears in the footer section of the site.', 'reedemar' ),

        'before_widget' => '<aside id="%1$s" class="widget %2$s">',

        'after_widget'  => '</aside>',

        'before_title'  => '<h3 class="widget-title">',

        'after_title'   => '</h3>',

    ) );




		register_sidebar( array(

        'name'          => __( 'Footer Section03', 'reedemar' ),

        'id'            => 'footer-section03',

        'description'   => __( 'Appears in the footer section of the site.', 'reedemar' ),

        'before_widget' => '<aside id="%1$s" class="widget %2$s">',

        'after_widget'  => '</aside>',

        'before_title'  => '<h3 class="widget-title">',

        'after_title'   => '</h3>',

    ) );



		register_sidebar( array(

        'name'          => __( 'Footer Section04', 'reedemar' ),

        'id'            => 'footer-section04',

        'description'   => __( 'Appears in the footer section of the site.', 'reedemar' ),

        'before_widget' => '<aside id="%1$s" class="widget %2$s">',

        'after_widget'  => '</aside>',

        'before_title'  => '<h3 class="widget-title">',

        'after_title'   => '</h3>',

    ) );
	register_sidebar( array(

        'name'          => __( 'Shop_sidebar', 'reedemar' ),

        'id'            => 'shop_sidebar',

        'description'   => __( 'Appears in the shop page section of the site.', 'reedemar' ),

        'before_widget' => '<div id="%1$s" class="widget %2$s product-list-box">',

        'after_widget'  => '</div><div class="clear10"></div>',

        'before_title'  => '<h2 class="widget-title">',

        'after_title'   => '</h2>',

    ) );
register_sidebar( array(

        'name'          => __( 'Shop_category_sidebar', 'reedemar' ),

        'id'            => 'shop_category_sidebar',

        'description'   => __( 'Appears in the shop page section of the site.', 'reedemar' ),

        'before_widget' => '<div id="%1$s" class="widget %2$s category-list-box">',

        'after_widget'  => '</div><div class="clear10"></div>',

        'before_title'  => '<h2 class="widget-title">',

        'after_title'   => '<i class="fa fa-chevron-circle-down catlistopen" aria-hidden="true"></i><i class="fa fa-chevron-circle-up catlistclose" aria-hidden="true"></i></h2>',

    ) );

	}	

	add_action( 'widgets_init', 'reedemar_footer_section_widget_init' );
	

add_action('init', 'myStartSession', 1);
add_action('wp_logout', 'myEndSession');
add_action('wp_login', 'myEndSession');

function myStartSession() {
    if(!session_id()) {
        session_start();
    }
}

function myEndSession() {
    session_destroy ();
}

function distance($lat1, $lon1, $lat2, $lon2, $unit) {

  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit == "K") {
	return ($miles * 1.609344);
  } else if ($unit == "N") {
	  return ($miles * 0.8684);
	} else {
		return $miles;
	  }
}


function getaddress($lat,$lng)
{
	$url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lng).'&sensor=false';
	$json = @file_get_contents($url);
	$data=json_decode($json);
	$status = $data->status;
	if($status=="OK")
	return $data->results[0]->formatted_address;
	else
	return false;
}

function limit_text($text, $limit) {
  if (str_word_count($text, 0) > $limit) {
	  $words = str_word_count($text, 2);
	  $pos = array_keys($words);
	  $text = substr($text, 0, $pos[$limit]);
  }
  return $text;
}


function create_posttype() {

	register_post_type( 'Home Videos',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Home Videos' ),
				'singular_name' => __( 'Video' )
			),
			'public' => true,
			'has_archive' => true,
			'supports' => array( 'title', 'editor', 'thumbnail', ),
			'taxonomies' => array('category',),
			'rewrite' => array('slug' => 'videos'),
		)
	);
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );

add_image_size('video_img',259,180,true);
add_image_size('main_video_img',418,293,true);


function getLatLong($address){
    if(!empty($address)){
        //Formatted address
        $formattedAddr = str_replace(' ','+',$address);
        //Send request and receive json data by address
        $geocodeFromAddr = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddr.'&sensor=false&key=AIzaSyDDkJZ7Uc_3T_ScES8_FL2p4cwOCaBVb20'); 
        $output = json_decode($geocodeFromAddr);
        //Get latitude and longitute from json data
        $data['latitude']  = $output->results[0]->geometry->location->lat; 
        $data['longitude'] = $output->results[0]->geometry->location->lng;
        //Return latitude and longitude of the given address
        if(!empty($data)){
            return $data;
        }else{
            return false;
        }
    }else{
        return false;   
    }
}

/*function getLnt($zip){
$url = "http://maps.googleapis.com/maps/api/geocode/json?address=
".urlencode($zip)."&sensor=false";
$result_string = file_get_contents($url);
$result = json_decode($result_string, true);
$result1[]=$result['results'][0];
$result2[]=$result1[0]['geometry'];
$result3[]=$result2[0]['location'];
return $result3[0];
}*/

