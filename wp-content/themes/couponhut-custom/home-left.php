<?php
/* Template Name: Home left
*/

global $wpdb;

$category_tab="SELECT * FROM reedemer_category WHERE status = 1 AND parent_id = 0 && visibility =1 ORDER BY cat_name ASC LIMIT 9 ";
$categories = $wpdb->get_results($category_tab);


$deal_catid =  $_POST['deal_categoryid'];
$deal_subcatid =  $_POST['deal_subcatid'];
$deal_createdby =  $_POST['dealcreatedby'];

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


foreach($categories as $category)
	{
		$usr_loc = $_POST['default_location'];
	  $offer_count = $wpdb->get_results("SELECT ro.* , usr.location, cat.status, cat.visibility, SQRT(POW(69.1 * (ro.latitude - $lat_dis), 2) + POW(69.1 * ($lon_dis - ro.longitude) * COS(latitude / 57.3), 2)) AS distance FROM reedemer_offer AS ro INNER JOIN users AS usr ON ro.created_by = usr.id INNER JOIN reedemer_category as cat ON ro.cat_id = cat.id WHERE ro.cat_id = ".$category->id." && ro.status =1 && ro.published = 'true' && ro.end_date >= CURDATE() && cat.status = 1 && cat.visibility = 1 HAVING distance < $min_distance");
	
	  echo '<li class="cat_rows" id="'.$category->id.'"><a href="#tab_'.$category->id.'" data-toggle="tab">'.$category->cat_name.'<em>'.count($offer_count).'</em></a><span class="food">&nbsp;</span></li>';
	}
?>
<!--<ul class="nav nav-tabs cat-nav home-left">
	<li class="cat_rows" id="44"><a href="#tab_44" data-toggle="tab">Food<em>29</em></a><span class="food">&nbsp;</span></li>
	<li class="cat_rows" id="56"><a href="#tab_56" data-toggle="tab">Bar &amp; Tavern<em>0</em></a><span class="food">&nbsp;</span></li>
	<li class="cat_rows" id="88"><a href="#tab_88" data-toggle="tab">Shopping<em>0</em></a><span class="food">&nbsp;</span></li>
	<li class="cat_rows" id="64"><a href="#tab_64" data-toggle="tab">Sporting Goods<em>0</em></a><span class="food">&nbsp;</span></li>
	<li class="cat_rows" id="225"><a href="#tab_225" data-toggle="tab">Test Cat<em>0</em></a><span class="food">&nbsp;</span></li>
	<li class="cat_rows" id="166"><a href="#tab_166" data-toggle="tab">Pharmacy<em>0</em></a><span class="food">&nbsp;</span></li>
	<li class="cat_rows" id="88"><a href="#tab_88" data-toggle="tab">Shopping<em>0</em></a><span class="food">&nbsp;</span></li>
	<li class="cat_rows" id="84"><a href="#tab_84" data-toggle="tab">Technology<em>0</em></a><span class="food">&nbsp;</span></li>
	<li class="cat_rows" id="72"><a href="#tab_72" data-toggle="tab">Travel<em>0</em></a><span class="food">&nbsp;</span></li>
	
	<li class="cat_rows" id="56"><a href="#tab_56" data-toggle="tab">Bar &amp; Tavern<em>0</em></a><span class="food">&nbsp;</span></li>
	<li class="cat_rows" id="44"><a href="#tab_44" data-toggle="tab">Food<em>29</em></a><span class="food">&nbsp;</span></li>
	<li class="cat_rows" id="34"><a href="#tab_34" data-toggle="tab">Beauty<em>4</em></a><span class="food">&nbsp;</span></li>
</ul>-->
<script>
	$('.cat_rows').click(function(){
		$('.search-loading').show();
            var cat_id = this.id;
      		var default_location = $("#deal_loc").val();

            //alert(cat_id);

            $.ajax({

                type:"post",
                url:"<?php echo site_url(); ?>/index.php/category-tab/",
                data:"cat_id="+cat_id+'&default_location='+default_location,
                success:function(data)
                {
					$('.search-loading').show();
                    $('#info').html(data);
                }

            });		  
		  	

        });
	
</script>
