<?php
/*
Template Name: Home Page
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



<div class="container">
   <div class="row category_box">
    <div class="col-md-12">
        <div class="col-md-3 col-sm-3 category-left-box">
            <h2>Categories</h2>
            <ul class="nav nav-tabs cat-nav home-left">
              
            </ul>
            <a href="<?php echo home_url(); ?>/index.php/deals" class="viewall-cat">View All</a>
        </div>  

        <!-- AJAX BEGIN -->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">
	
  $(document).ready(function()
    {
	var default_location = $("#deal_loc").val();
		$.ajax({

		type:"post",
		url:"<?php echo site_url(); ?>/index.php/home-left/",
		data:'default_location='+default_location,
		success:function(data)
		{
		$('.home-left').html(data);
		}

		});
    var default_location = $("#deal_loc").val();
    
        $.ajax({

                type:"post",
                url:"<?php echo site_url(); ?>/index.php/category-tab/",
                data:"cat_id=-1&default_location="+default_location,
                success:function(data)
                {
                    $('#info').html(data);
                }

            });
    
    
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
					$('.search-loading').hide();
                    $('#info').html(data);
                }

            });

        });
    
    

   });



</script>





        <!-- AJAX END -->



<!-- ***************************SEARCH PANEL JQUERY *********************** -->



<?php if(is_front_page()) { ?>
      <script type="text/javascript">
      $(document).ready(function(){
        });
      </script> 
<?PHP } ?>


<script type="text/javascript">

// AJAX call for autocomplete for DEALS CATEGORIES AND SUBCATEGORIES 
$(document).ready(function(){
	
	
		$('#deal_cat').blur(function(){
		$("#suggesstion-box-cat").css("display","none");
		});

		$('#suggesstion-box-cat').on('mousedown', function(event) {
		event.preventDefault();
		}).on('click', '.cat-list>li', function() {
		$('#deal_cat').val(this.textContent).blur();
		});
	
		
	
	
		$(document).on("keyup","#deal_cat",function(e){
			var code = e.which;
			
			if(code == 13){
			   	$("#search_deal_btn").trigger("click");
				
			}else if((code == 38) || (code == 40))
			{
				return false;
			}else
			{
				$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>/index.php/autosearch/",
			data:'keyword='+$(this).val(),
			beforeSend: function(){
			$("#suggesstion-box-cat").css("background","#FFF url(<?php echo site_url(); ?>/wp-content/uploads/2016/06/21.gif) no-repeat 165px");
			},
			success: function(data){
			if(data === 'null'){$('#deal_key').val('');return false;}else{
			var obj =$.parseJSON(data);
			//alert(newobj.subcat_id);
			//console.log(obj);
			$('#deal_catid').val(obj.subcat_id);
			$('#deal_subcatid').val(obj.cat_id);
			$('#deal_sub_sub_parent').val(obj.sub_sub_parent_id);
			$("#suggesstion-box-cat").show();
			$("#suggesstion-box-cat").html(obj.list_data);
			$("#deal_cat").css("background","#FFF");

			var key = obj.search_key;

			var valThis = key.toLowerCase();
			if($('.cat-list > li').length == 0){
			$("#suggesstion-box-cat").hide();
			$('#deal_key').val(obj.search_key);
			$('#deal_tag').val('');
			$('#deal_brand').val('');
			$('#deal_created_by').val('');
			}
			else if (obj.search_key =='')
			{
				$('#deal_key').val('');
			}
			else
			{
				$('#deal_key').val(obj.search_key);
				$('#deal_tag').val('');
				$('#deal_brand').val('');
				$('#deal_created_by').val('');
			}	
				
			$('.cat-list > li').each(function(){
			var text = $(this).text().toLowerCase();
			if(text == valThis){
			 if($(this).data("type") == 'category'){
			$('#deal_key').val('');	 
			$('#deal_tag').val('');
			$('#deal_brand').val('');
			$('#deal_created_by').val('');
			$('#deal_cat').val(text);
			
			}else if($(this).data("type") == 'tag'){
			$('#deal_key').val('');
			$('#deal_cat').val(text);
			$('#deal_brand').val('');
			$('#deal_created_by').val('');
			$('#deal_tag').val(text);
			}else if($(this).data("type") == 'brand'){
				$('#deal_key').val('');
				$('#deal_tag').val('');
				$('#deal_brand').val(text);
				$('#deal_created_by').val($(this).data('created_by'));
				$('#deal_cat').val(text);
			}
			//$('#deal_sub_sub_parent').val(text);
			$(this).css('background-color','#73bf21');
			$(this).removeClass('background');
			}else{
			$(this).css('background-color','white');
			$(this).removeClass('background');
			}
			  
		});
				
				
		// This is for change color when mouse in and out in autosuggestion box
		$('.cat-list>li').on("mouseover",function(){
			$(this).css('background-color','#73bf21');
		});
				
		$('.cat-list>li').on("mouseout",function(){
			$(this).css('background-color','#fff');
		});
				
				
		}	
				
			// for selecting list using up & down arrow	
				
			var li = $('.cat-list > li');	
			var liSelected;
			$(document).on('keydown','#deal_cat', function(e){
				
				var selected;
			    if(e.which === 40){
					
			        if(liSelected){
			            liSelected.removeClass('background');
			            next = liSelected.next();
			            if(next.length > 0){
			                liSelected = next.addClass('background').css('background-color','');
			                selected = next.text();

			            }else{
			                liSelected = li.eq(0).addClass('background').css('background-color','');
			                selected = li.eq(0).text();
			            }
			        }else{
			            liSelected = li.eq(0).addClass('background').css('background-color','');
			                selected = li.eq(0).text();
			        }
					if($('.background').data('type') == 'category'){
					var cat_id = $('.background').data('cat_id');
					var sub_catid = $('.background').data('sub_catid');
					var sub_sub_parent= $('.background').data('sub_sub_parent');
					$('#deal_key').val('');
					$('#deal_brand').val('');
					$('#deal_created_by').val('');
					$('#deal_tag').val('');
					$('#deal_catid').val(cat_id);
			    	$('#deal_subcatid').val(sub_catid);
			    	$('#deal_sub_sub_parent').val(sub_sub_parent);
					}
					else if($('.background').data('type') == 'tag'){
			    	$('#deal_key').val('');
			    	$('#deal_brand').val('');
					$('#deal_created_by').val('');
			    	$('#deal_catid').val('');
			    	$('#deal_subcatid').val('');
			    	$('#deal_sub_sub_parent').val('');
			    	$('#deal_tag').val($('.background').text());
					}
					else if($('.background').data('type') == 'brand'){
						var created_by = $('.background').data('created_by');
						$('#deal_key').val('');
						$('#deal_catid').val('');
						$('#deal_subcatid').val('');
						$('#deal_sub_sub_parent').val('');
						$('#deal_tag').val('');
						$('#deal_brand').val($('.background').text());
						$('#deal_created_by').val(created_by);
					}
					
			    }else if(e.which === 38){
			        if(liSelected){
			            liSelected.removeClass('background');
			            next = liSelected.prev();
			            if(next.length > 0){
			                liSelected = next.addClass('background').css('background-color','');
			                selected = next.text();

			            }else{

			                liSelected = li.last().addClass('background').css('background-color','');
			                selected = li.last().text()
			            }
			        }else{

			            liSelected = li.last().addClass('background').css('background-color','');
			            selected = li.last().text()
			        }
					
					if($('.background').data('type') == 'category'){
					var cat_id = $('.background').data('cat_id');
					var sub_catid = $('.background').data('sub_catid');
					var sub_sub_parent= $('.background').data('sub_sub_parent');
					$('#deal_key').val('');
					$('#deal_brand').val('');
					$('#deal_created_by').val('');
					$('#deal_tag').val('');
					$('#deal_catid').val(cat_id);
			    	$('#deal_subcatid').val(sub_catid);
			    	$('#deal_sub_sub_parent').val(sub_sub_parent);
					}
					else if($('.background').data('type') == 'tag'){
			    	$('#deal_key').val('');
			    	$('#deal_brand').val('');
					$('#deal_created_by').val('');
			    	$('#deal_catid').val('');
			    	$('#deal_subcatid').val('');
			    	$('#deal_sub_sub_parent').val('');
			    	$('#deal_tag').val($('.background').text());
					}
					else if($('.background').data('type') == 'brand'){
						var created_by = $('.background').data('created_by');
						$('#deal_key').val('');
						$('#deal_catid').val('');
						$('#deal_subcatid').val('');
						$('#deal_sub_sub_parent').val('');
						$('#deal_tag').val('');
						$('#deal_brand').val($('.background').text());
						$('#deal_created_by').val(created_by);
					}
					
				 }else if(li.is( ".background" ) && e.which === 13){
					if($('.background').data('type') == 'category'){
					$('#deal_key').val('');
					$('#deal_brand').val('');
					$('#deal_created_by').val('');
					$('#deal_tag').val('');
					$('#deal_cat').val($('.background').text());
					}else if($('.background').data('type') == 'tag'){
					$('#deal_key').val('');
					$('#deal_brand').val('');
					$('#deal_created_by').val('');
					$('#deal_cat').val($('.background').text());
					$('#deal_tag').val($('.background').text());
					}
					else if($('.background').data('type') == 'brand'){
					$('#deal_key').val('');	
					$('#deal_tag').val('');	
					$('#deal_brand').val($('.background').text());
					$('#deal_cat').val($('.background').text());	
					}
					 li.removeClass('background');
					 
				}
			});	
				
				
				
			}
	});
			
			}
			
		});
});
//To select category name

	function selectCategory(val, cid, subid, sub_sub_id) {
	 // alert('feee');
	$('.cat-list>li').removeClass('background');
	$('#deal_key').val('');
	$("#deal_brand").val('');
	$('#deal_created_by').val('');	
	$("#deal_tag").val('');
	$("#deal_cat").val(val);
	$("#deal_catid").val(cid);
	$("#deal_subcatid").val(subid);
	$("#deal_sub_sub_parent").val(sub_sub_id);
	$("#search_deal_btn").trigger("click");
	}
	function selecttag(tag){
		$('#deal_key').val('');
		$("#deal_brand").val('');
		$('#deal_created_by').val('');	
		$("#deal_cat").val(tag);
		$("#deal_tag").val(tag);
		$("#search_deal_btn").trigger("click");
		}
	function selectbrand(id,name){
	$("#deal_tag").val('');
	$('#deal_key').val('');	
	$("#deal_cat").val(name);
	$("#deal_brand").val(name);
	$('#deal_created_by').val(id);
	$("#search_deal_btn").trigger("click");
	}
// END *******************************************




// AJAX call for autocomplete for DEALS LOCATION 
$(document).ready(function(){
   
	
	$('#deal_loc').blur(function(){
		$("#suggesstion-box-loc").css("display","none");
    });
	
	$('#suggesstion-box-loc').on('mousedown', function(event) {
    event.preventDefault();
    }).on('click', '.loc-list>li', function() {
    $('#deal_loc').val(this.textContent).blur();
    });

	
	
     $("#deal_loc").keyup(function(e){
     	var search_field_val = $('#deal_cat').val();
			if(search_field_val == '' || search_field_val == null){
			$('#deal_catid').val('');
			$('#deal_subcatid').val('');
			$('#deal_sub_sub_parent').val('');
			$('#deal_tag').val('');
			}
		var code = e.which;
		if(code == 13){
			   $("#search_deal_btn").trigger("click");
			}else if((code == 38) || (code == 40))
			{
				return false;
			}else
			{
        $.ajax({
        type: "POST",
        url: "<?php echo site_url(); ?>/index.php/autosearch-2/",
        data:'keyword2='+$(this).val(),
        beforeSend: function(){
            $("#suggesstion-box-loc").css("background","#FFF no-repeat 165px","border-radius: 5px","display: block","position: absolute","width: 100%"," z-index: 999999");
        },
        success: function(data){
			console.log(data);
			if(data === 'null'){return false;}else{
			var obj =$.parseJSON(data);
			
            $("#suggesstion-box-loc").show();
            $("#suggesstion-box-loc").html(obj.loc_data);
            $("#deal_loc").css("background","#FFF");
			
			
			var key = obj.search_key;

			var valThis = key.toLowerCase();
			if($('.loc-list > li').length == 0){
			$("#suggesstion-box-loc").hide();
			}
			var listForRemove = [];
			var liText = '';

			$('.loc-list > li').each(function(){
			var text = $(this).text().toLowerCase();
			if(text == valThis){
			$('#deal_loc').val(text);
			$(this).css('background-color','#73bf21');
			$(this).removeClass('background');
			}else{
			$(this).css('background-color','white');
			$(this).removeClass('background');
			}
				
				if (liText.indexOf('|'+ text + '|') == -1)
					liText += '|'+ text + '|';
				else
					listForRemove.push($(this));	
				
			});
				
				$(listForRemove).each(function () { $(this).remove(); });
			// This is for change color on mouse in and out of autosuggestion box	
				
				$('.loc-list>li').on("mouseover",function(){
					$(this).css('background-color','#73bf21');
				});
				
				$('.loc-list>li').on("mouseout",function(){
					$(this).css('background-color','#fff');
				});
				
			}
			$('#deal_created_loc').val(key);
			$('#deal_created_fill').val(key);
			
			
			
			
			
			// for selecting list using up & down arrow	
				
			var li = $('.loc-list > li');	
			var liSelected;
			$(document).on('keydown','#deal_loc', function(e){
				
				var selected;
			    if(e.which === 40){
					
			        if(liSelected){
			            liSelected.removeClass('background');
			            next = liSelected.next();
			            if(next.length > 0){
			                liSelected = next.addClass('background').css('background-color','');
			                selected = next.text();

			            }else{
			                liSelected = li.eq(0).addClass('background').css('background-color','');
			                selected = li.eq(0).text();
			            }
			        }else{
			            liSelected = li.eq(0).addClass('background').css('background-color','');
			                selected = li.eq(0).text();
			        }
					
					$('#deal_created_loc').val($('.background').text());
					$('#deal_created_fill').val($('.background').text());
					//$('#deal_tag').val($('.background').text());
					
			    }else if(e.which === 38){
			        if(liSelected){
			            liSelected.removeClass('background');
			            next = liSelected.prev();
			            if(next.length > 0){
			                liSelected = next.addClass('background').css('background-color','');
			                selected = next.text();

			            }else{

			                liSelected = li.last().addClass('background').css('background-color','');
			                selected = li.last().text()
			            }
			        }else{

			            liSelected = li.last().addClass('background').css('background-color','');
			            selected = li.last().text()
			        }
					$('#deal_created_loc').val($('.background').text());
					//$('#deal_tag').val($('.background').text());
					$('#deal_created_fill').val($('.background').text());
					 }else if(li.is( ".background" ) && e.which === 13){
					$('#deal_loc').val($('.background').text());
					//$('#deal_tag').val($('.background').text());
					$('#deal_created_loc').val($('.background').text());
					$('#deal_created_fill').val($('.background').text());
					li.removeClass('background');
				}
			});
			
			
			
			
			
			
        }
			
		 });
			}
    });
});
//To select deal location
function selectZipcode(val2, createdby) {
$('.loc-list>li').removeClass('background');
$("#deal_loc").val(val2);
$("#deal_created_loc").val(val2);
$("#deal_created_fill").val(val2);
$("#deal_created").val(createdby);
$("#search_deal_btn").trigger("click");
}

// END *******************************************


// SEARCH DEALS AJAX METHOD *****************************
$(document).ready(function(){
    var dcat = $('#deal_cat').val();
    var dloc = $('#deal_loc').val();

	function get_location_result()
      {
      
      var location = $( "#deal_created_fill" ).val();
        //alert(cat_id);
          $.ajax({
              type: "POST",
              url: "<?php echo site_url() ?>/index.php/home-search",
              data: {"location":location},        
              beforeSend: function(){
                  
              },
              success: function(data){
				  
                  var obj = $.parseJSON(data);
                  $('#loc_data').empty();
				  $('#loc_data').html(obj.res_data);
              }

          });

      } 
	
	get_location_result();
	
	
//////////////////////////////////for deal searchbutton ///////////////////////////////////////
     $('#search_deal_btn').on('click', function(){
		 $('.search-loading').show();
		 $("#suggesstion-box-cat").css("display","none");
		$("#suggesstion-box-loc").css("display","none");
		var default_location = $("#deal_loc").val();
		 
		if($("#deal_cat").val() == '' || $("#deal_cat").val() == null){
			$("#deal_catid").val("");
			$("#deal_subcatid").val("");
			$("#deal_sub_sub_parent").val("");
			$("#deal_tag").val("");
			$("#deal_key").val("");
			$("#deal_brand").val("");
			$("#deal_created_by").val("");
		} 
		 
		 
		 
		$.ajax({

		type:"post",
		url:"<?php echo site_url(); ?>/index.php/home-left/",
		data:'default_location='+default_location,
		success:function(data)
		{
		$('.home-left').html(data);
		}

		});
     get_location_result();
     var expireAt = new Date;

    expireAt.setMonth(expireAt.getMonth() + 3);
    var deal_created_loc = $("#deal_loc").val();
    document.cookie = "location_input=" + deal_created_loc + ";expires=" + expireAt.toGMTString()
        var deal_catname= $('#deal_cat').val();
        var dcatid = $('#deal_catid').val();
        var dsubcatid = $('#deal_subcatid').val();
        var sub_sub_parent = $('#deal_sub_sub_parent').val();
        var dcreated = $('#deal_created').val();
    	var location = $('#deal_loc').val();
    	var dealtag = $('#deal_tag').val();
    	var dealkey = $('#deal_key').val();
    	var dealbrand = $('#deal_brand').val();
		var dealcreated_by = $('#deal_created_by').val();
    	$("#suggesstion-box-cat").hide();
    	if( dealtag != '')
				{
					//alert('h2');
					home_deal_data={"uer_location":location,"dealtag":dealtag};
				}
		else if(dealbrand != '' && dealcreated_by != '')
				{
					home_deal_data={"uer_location":location,"dealbrand":dealbrand,"deal_created_by":dealcreated_by};
				}
		else if( dealkey != '')
				{
					//alert('h1');
				home_deal_data={"uer_location":location,"dealkey":dealkey};
				}
		else
				{	//alert('h3');
					home_deal_data={"deal_catname":deal_catname,"deal_categoryid":dcatid,"deal_subcatid":dsubcatid,"dealcreatedby":dcreated,"uer_location":location,"sub_sub_parent_id":sub_sub_parent};
				}
        $.ajax({

                type:"post",
                url:"<?php echo site_url(); ?>/index.php/category-tab/",
                data:home_deal_data,
                success:function(data)
                {
          //console.log(data);
					$('.search-loading').hide();
                     $('#info').html(data);
                    $('#deal_catid').val(dcatid);
                    $('#deal_subcatid').val(dsubcatid);
                    $('#deal_created').val(dcreated);
                }

            });

        });
});
</script>

<!-- Deal SEARCH METHOD END -->






    <div class="tab-content col-md-9 col-sm-9 nopadding section-most">


    <!-- Header Search Box Start -->
    <div class="header-search col-md-12 col-sm-12">
      <div class="col-md-8 col-sm-7">

        <span class="searchbox">
          <input class="search-txt" id="deal_cat" type="text"/>

          <input type="hidden" id="deal_catid"/>
          <input type="hidden" id="deal_subcatid"/>
          <input type="hidden" id="deal_sub_sub_parent"/>
		  <input type="hidden" id="deal_tag"/>
		  <input type="hidden" id="deal_key"/>
			<input type="hidden" id="deal_brand" value="">
			<input type="hidden" id="deal_created_by" value="">
          <div id="suggesstion-box-cat"></div>

        </span>
      </div>
      <div class="col-md-4 col-sm-5">
        <!--<input class="location" id="deal_loc" type="text" placeholder="Enter Your Location" value="New Jersey, NJ"/>
          <input type="hidden" id="deal_created_loc"/>

        <input type="hidden" id="deal_created"/>-->
        
        <?php 
          if($_COOKIE['location_input'] != '') {
            $default_loc = $_COOKIE['location_input'];
          }else {
            $default_loc = 'Yonkers';
          }

        ?>
        
        <input class="location" id="deal_loc" type="text" placeholder="Enter Your Location" value="<?php echo $default_loc;?>" name="deal_loc" onload="putCookie()"/>
        <?PHP //echo $default_loc;?>
        <input type="hidden" id="deal_created_loc" />
        <input type="hidden" id="deal_created"/>
        <input type="hidden" id="deal_created_fill" value="<?php echo $default_loc; ?>"/>
        
        <button class="search-btn-new" name="search-btn-new" id="search_deal_btn" type="submit" value="Go"><i class="fa fa-search" aria-hidden="true"></i></button>
        <div id="suggesstion-box-loc"></div>

      </div>
    </div>
    <!-- Header Search Box End -->
    
            <div class="clear"></div> 



        
        <!-- Category Ajax Call Begin -->
        
            <div id="info"> <span class="search-loading"><img src="<?php echo get_template_directory_uri();?>/images/ajax.gif" height="50" width="50" id="home-loader"/></span></div>

        <!-- Category Ajax Call End -->

         <div id="deal_search_results"> </div>

    </div><!-- tab content -->
</div>

</div>
  


<!-- Categorywise End -->
<div class="clear10"></div>      

<div class="map-slider">
    <div class="row">
      <div class="col-md-12 nopaddding">  
          <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <ul class="view-link">
            <li class="mapview_btn activebtn"><a href="#" >Map view</a></li>
            <li class="adview_btn"><a href="#">Ad View</a></li>
          </ul>
     <div class="map_view_tab">   
      <div class="mapmap">
        <div id="map_wrapper">              
          <div id="map_canvas" class="mapping"></div>             
        </div>
      </div>
  
        <style>

        .mapmap #map_wrapper {
          height: 500px;
        }

        .mapmap .mapping {
          width: 100%;
          height: 500px;
        }
        .mapmap .map_ico {
          margin-bottom: 60px;
          max-height: 550px;
        }


        </style>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCb0kirLjsnOe4aUnYsZFVV1ziOulmt-3s"></script>



        <!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"
        type="text/javascript"></script>--> 
        <script>



        function initialize(markers) {


          var map;
          var bounds = new google.maps.LatLngBounds();
          var mapOptions = {
            scrollwheel: false,
            mapTypeId: "roadmap",
            center: new google.maps.LatLng(52.791331, -1.918728), // somewhere in the uk BEWARE center is required
            zoom: 20,
          };

          // Display a map on the page
          map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
          map.setTilt(45);

          // Multiple Markers

          //var markers = <?php //echo json_encode( $markers ); ?>;



        // Info Window Content
          var infoWindowContent = [
            ['<div class="info_content">' +
            '<h3>London Eye</h3>' +
            '<p>The London Eye is a giant Ferris wheel situated on the banks of the River Thames. The entire structure is 155 metres (443 ft) tall and the wheel has a diameter of 120 metres (394 ft).</p>' + '</div>'],
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
            
            var iconss = {
              url: markers[i][2], // url
              scaledSize: new google.maps.Size(50, 50), // scaled size
            };
            
            var position = new google.maps.LatLng(markers[i][0], markers[i][1]);
            //bounds.extend(position);
            marker = new google.maps.Marker({
              position: position,
              map: map,
              icon : iconss
            });

            // Automatically center the map fitting all markers on the screen
			var map_position = new google.maps.LatLng('40.730610', '-73.935242');  
			bounds.extend(map_position);  
            map.fitBounds(bounds);
          }

          //Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
          var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function (event) {

            this.setZoom(8);
            google.maps.event.removeListener(boundsListener);
          });

        }
          </script>   

          <ul class="map-view-buttons" id="cat_data" curr_cat_id="-"> 
              <?php   
              $memebr = $wpdb->get_results("SELECT * FROM users WHERE membership_level = 5");
                $k = 1 ;
                foreach($memebr as $memebr_name){
                  echo '<li data-target="#myCarousel" data-slide-to="'.$k.'"><a href="#" class="als-item" cat_id="'.$memebr_name->id.'">'.$memebr_name->company_name.'</a></li>';
                  $k++;
                }

              ?>  
        </ul>
  
</div>  
     <div class="ad_view_tab" style="display:none;">
      <div class="carousel-inner">
          
            <div class="item active">
               <div id="tabs">
                  
                  
                  <div class="block">
                   <img src="<?php echo get_template_directory_uri(); ?>/images/banner.jpg" alt="img" class="img-responsive">
                       <div class="carousel-caption">
                        <h3>FAMIGLIA <span>Pizzeria</span></h3>
                        
                        <p>Famiglia’s <br>
                        Famous Pizza for 2</p>
                        <div class="dollar">
                            <p>$$$</p>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                        </div>
                        <h3>10% SAVINGS</h3>
                        <p><a href="#">Bank It</a></p>
                      </div>
                  </div>
                </div>
            </div><!-- End Item -->
     
             <div class="item">
                <div id="tabs">
                  
                  
                  <div class="block">
                   <img src="<?php echo get_template_directory_uri(); ?>/images/banner.jpg" alt="img" class="img-responsive">
                       <div class="carousel-caption">
                        <h3>FAMIGLIA <span>Pizzeria</span></h3>
                        
                        <p>Famiglia’s <br>
                        Famous Pizza for 2</p>
                        <div class="dollar">
                            <p>$$$</p>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                        </div>
                        <h3>10% SAVINGS</h3>
                        <p><a href="#">Bank It</a></p>
                      </div>
                  </div>
                </div>
             </div><!-- End Item -->
            
            <div class="item">
              <div id="tabs">
                  
                  
                  <div class="block">
                   <img src="<?php echo get_template_directory_uri(); ?>/images/banner.jpg" alt="img" class="img-responsive">
                       <div class="carousel-caption">
                        <h3>FAMIGLIA <span>Pizzeria</span></h3>
                        
                        <p>Famiglia’s <br>
                        Famous Pizza for 2</p>
                        <div class="dollar">
                            <p>$$$</p>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                        </div>
                        <h3>10% SAVINGS</h3>
                        <p><a href="#">Bank It</a></p>
                      </div>
                  </div>
                </div>
            </div><!-- End Item -->
            
            <div class="item">
              <div id="tabs">
                  
                  
                  <div class="block">
                   <img src="<?php echo get_template_directory_uri(); ?>/images/banner.jpg" alt="img" class="img-responsive">
                       <div class="carousel-caption">
                        <h3>FAMIGLIA <span>Pizzeria</span></h3>
                        
                        <p>Famiglia’s <br>
                        Famous Pizza for 2</p>
                        <div class="dollar">
                            <p>$$$</p>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                        </div>
                        <h3>10% SAVINGS</h3>
                        <p><a href="#">Bank It</a></p>
                      </div>
                  </div>
                </div>
            </div>

            <div class="item">
              <div id="tabs">
                  
                  
                  <div class="block">
                   <img src="<?php echo get_template_directory_uri(); ?>/images/banner.jpg" alt="img" class="img-responsive">
                       <div class="carousel-caption">
                        <h3>FAMIGLIA <span>Pizzeria</span></h3>
                        
                        <p>Famiglia’s <br>
                        Famous Pizza for 2</p>
                        <div class="dollar">
                            <p>$$$</p>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                        </div>
                        <h3>10% SAVINGS</h3>
                        <p><a href="#">Bank It</a></p>
                      </div>
                  </div>
                </div>
            </div>
            <div class="item">
              <div id="tabs">
                  
                  
                  <div class="block">
                   <img src="<?php echo get_template_directory_uri(); ?>/images/banner.jpg" alt="img" class="img-responsive">
                       <div class="carousel-caption">
                        <h3>FAMIGLIA <span>Pizzeria</span></h3>
                        
                        <p>Famiglia’s <br>
                        Famous Pizza for 2</p>
                        <div class="dollar">
                            <p>$$$</p>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                        </div>
                        <h3>10% SAVINGS</h3>
                        <p><a href="#">Bank It</a></p>
                      </div>
                  </div>
                </div>
            </div>
            <div class="item">
              <div id="tabs">
                  
                  
                  <div class="block">
                   <img src="<?php echo get_template_directory_uri(); ?>/images/banner.jpg" alt="img" class="img-responsive">
                       <div class="carousel-caption">
                        <h3>FAMIGLIA <span>Pizzeria</span></h3>
                        
                        <p>Famiglia’s <br>
                        Famous Pizza for 2</p>
                        <div class="dollar">
                            <p>$$$</p>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                        </div>
                        <h3>10% SAVINGS</h3>
                        <p><a href="#">Bank It</a></p>
                      </div>
                  </div>
                </div>
            </div>
            <div class="item">
              <div id="tabs">                  
                  
                  <div class="block">
                   <img src="<?php echo get_template_directory_uri(); ?>/images/banner.jpg" alt="img" class="img-responsive">
                       <div class="carousel-caption">
                        <h3>FAMIGLIA <span>Pizzeria</span></h3>
                        
                        <p>Famiglia’s <br>
                        Famous Pizza for 2</p>
                        <div class="dollar">
                            <p>$$$</p>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                        </div>
                        <h3>10% SAVINGS</h3>
                        <p><a href="#">Bank It</a></p>
                      </div>
                  </div>
                </div>
            </div>

            <!-- End Item -->
                    
          </div><!-- End Carousel Inner -->


            <ul class="nav nav-justified carousel-nav">
              <div class="carouselslide carouselslide1">  
                  <li data-target="#myCarousel" data-slide-to="0" class="active"><a href="#">Famiglia</a></li>
                  <li data-target="#myCarousel" data-slide-to="1"><a href="#">
                    Maria’s <br> pizza & Restaurant
                  </a></li>
                  <li data-target="#myCarousel" data-slide-to="2"><a href="#">Harisson Pizza</a></li>
                  <li data-target="#myCarousel" data-slide-to="3"><a href="#">Lazy Boy <br> Saloon & Ale House</a></li>
              </div>
              <div class="carouselslide carouselslide2">
                  <li data-target="#myCarousel" data-slide-to="4"><a href="#">Lazy Boy <br>Lorem ipsum</a></li>
                  <li data-target="#myCarousel" data-slide-to="5"><a href="#">Lazy Boy <br> Dummy text</a></li>
                  <li data-target="#myCarousel" data-slide-to="6"><a href="#">Lazy Boy <br>Demo</a></li>
                  <li data-target="#myCarousel" data-slide-to="7"><a href="#">Lazy Boy <br>Demo2</a></li>
              </div>
                <a href="#" class="carouselarrow carouselarrow-left"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                <a href="#" class="carouselarrow carouselarrow-right"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            </ul>
     </div>  
      </div>
    </div>
</div>
</div>  
<div class="clear"></div>
	
<div id="loc_data">
	
</div>

<!-- View all End -->

<!-- blogs Start -->
<div class="section-most-banked blogs">
    <div class="row">
        <div class="col-md-12">
            <h2>Our Latest Blogs</h2>
            <p>Donec sollicitudin molestie malesuada. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Proin eget tortor risus. Quisque velit nisi, pretium ut lacinia in, elementum id enim.</p>
            
            <div class="carousel-reviews">
            <?php if ( have_posts() ) : ?>
                <div class="container-fluid">
                    <div class="row">
                        <div id="carousel-reviews" class="carousel slide" data-ride="carousel">
                            
                            <div class="carousel-inner">
                <div class="item active">
                    <?php  while( have_posts() ) : the_post();?>
                                      <?php $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()));?>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="block-text">
                                            <h4><?php echo get_the_date('j M, Y'); ?></h4>
                                            <img src="<?php echo($featured_image[0]!="")?$featured_image[0]:''; ?>" class="img-responsive"/>
                                            <h3><?php echo get_the_title();?></h3>
                                            <p><?php echo (strlen(get_the_content())>150)?substr(get_the_content(),0,150).'...':get_the_content();?></p> 
                                            <a href="<?php echo get_permalink();?>">See More</a>
                                        </div>
                                    </div>
                  <?php $count++;if($count%4 == 0):?></div><div class="item"><?php endif;?>
                  <?php endwhile;?>
                </div>
                  
                
                            </div>
              
                        </div>
                    </div>
                </div>
            <?php if($blog_count > 4):?>
              <a class="left carousel-control" href="#carousel-reviews" role="button" data-slide="prev">
                  <i class="fa fa-angle-left" aria-hidden="true"></i>
              </a>
              <a class="right carousel-control" href="#carousel-reviews" role="button" data-slide="next">
                  <i class="fa fa-angle-right" aria-hidden="true"></i>
              </a>
            <?php endif;?>
            <?php endif;?>
            </div>
        </div>
    </div>
</div>
<!-- blogs End -->  
</div>

<script>

$(document).ready(function() {
  
$('.als-item').click(function(e){
  e.preventDefault();
  $('#cat_data').attr("curr_cat_id",$(this).attr("cat_id"));
  get_result();
}); 

  
  
 function get_result()
      {
      
      var user_id = $('#cat_data').attr("curr_cat_id");
        //alert(cat_id);
          $.ajax({
              type: "POST",
              url: "<?php echo site_url() ?>/index.php/home-map/",
              data: {"user_id":user_id},        
              beforeSend: function(){
                  
              },
              success: function(data){
                 //console.log(data);       
                  var obj = $.parseJSON(data);
                  //$('.map-slider').empty();
                  if(obj.status == "true")
                  {        
                                
            var obj_markers = obj.marker;
            
            var markers = [];
                       $.each(obj_markers, function(i, obj) {
                       markers.push([obj.lat, obj.lng, obj.icon]);
                       });
            
            //console.log(markers);
            
           
        google.maps.event.addDomListener(window, 'load', initialize(markers));
            
          
                  }else if(obj.status == "false")
                  {
           $('.map-slider').html(obj.res_data); 
          }
                 
              }

          });

      } 
  
  
  function get_result1()
      {
      
      
        //alert(cat_id);
          $.ajax({
              type: "POST",
              url: "<?php echo site_url() ?>/index.php/home-map/",
              data: {"user_id":"-"},        
              beforeSend: function(){
                  
              },
              success: function(data){
                        
                  var obj = $.parseJSON(data);
                  //$('.map-slider').empty();
                  if(obj.status == "true")
                  {        
                                
            var obj_markers = obj.marker;
            
            var markers = [];
                       $.each(obj_markers, function(i, obj) {
                       markers.push([obj.lat, obj.lng, obj.icon]);
                       });
            
            //console.log(markers);
            
           
        google.maps.event.addDomListener(window, 'load', initialize(markers));
            
          
                  }else if(obj.status == "false")
                  {
           $('.map-slider').html(obj.res_data); 
          }
                 
              }

          });

      } 
  
  get_result();
  
  $(".mapview_btn").click(function(e){
    $(".ad_view_tab").hide();
    $(".map_view_tab").show();
    $('.adview_btn').removeClass('activebtn');
      $('.mapview_btn').addClass('activebtn');
        $(".block").hide();   
        e.preventDefault();
    get_result1();
  });

  $(".adview_btn").click(function(e){
    $(".map_view_tab").hide();
    $(".ad_view_tab").show();
    $('.mapview_btn').removeClass('activebtn');
      $('.adview_btn').addClass('activebtn');
        $(".block").show();
        e.preventDefault();
  });

});
	
	


</script>


<?php get_footer(); ?>
