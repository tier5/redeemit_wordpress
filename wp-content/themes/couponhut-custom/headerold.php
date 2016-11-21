<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	  <?php //wp_head(); ?>
    <title><?php if (is_home () ) { bloginfo('name'); } elseif ( is_category() ) { single_cat_title(); echo ' - ' ; bloginfo('name'); }
		elseif (is_single() ) { single_post_title(); }
		elseif (is_page() ) { bloginfo('name'); echo ': '; single_post_title(); }
		else { wp_title('',true); } ?></title>
	<link href="<?php echo get_template_directory_uri();?>/style.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css" rel="stylesheet">
	<!--<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">-->
	 <?php if(!is_home() && !is_front_page()) { ?>	
	<link href="<?php echo get_template_directory_uri(); ?>/custom.css" rel="stylesheet">
	<?php } ?>
	
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery-ui.css">
	  
	  
    <style type=text/css>
		/*.background {background: #73bf21;}*/
	  </style>
	  
	  <style>
		.search-loading{position:absolute; top:0; left:0; right:0; display:block; text-align:center;}
		.search-loading img{max-width:100%; width:auto; height:auto;}
     </style>
	  
	 
     
<!-- Latest compiled JavaScript -->
<?php wp_head(); ?>

  </head>
  <body>
	  <!--New header-->
	  <header>
		  
    <div class="container">
        <div class="row">
        	<div class="top-bar text-right">
        		<div class="col-md-12">
					<?php
					if ( is_user_logged_in() ) {
					$user_data = get_user_by("id",get_current_user_id());
					$get_user_dtl = "SELECT * from users where email ='".$user_data->user_login."'";
					$get_user_dtl1=$wpdb->get_results($get_user_dtl,ARRAY_A);
					if( !empty($get_user_dtl1[0]['first_name']))
					{
					$usr = $get_user_dtl1[0]['first_name'];
					}
					else
					{
					$usr = $user_data->user_login;
					}
					?>
        			<nav>
        				<ul>
        					<li><a href="<?php echo home_url(); ?>/admin/public/partner">Partners</a></li>
        					<li><a href="<?php echo home_url(); ?>/index.php/shop">Store</a></li>
        				</ul>
        				<ul>
        					<li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/cart.png" class="img-responsive"><span class="cart-item">0</span>Cart</a></li>
        					<li><a href="#">Help</a></li>
        					<li class="username-link">
	        					<a href="#">
	        						Welcome, <?php echo $usr; ?> <i class="fa fa-caret-up uparw" aria-hidden="true"></i><i class="fa fa-caret-down downarw" aria-hidden="true"></i>
	        					</a>
	        					<ul>
		        					<li><a href="<?php echo home_url(); ?>/index.php/my-deals/#tabs-1" id="tab_one_btn">My deals</a></li>
									<li><a href="<?php echo home_url(); ?>/index.php/my-deals/#tabs-2" id="tab_two_btn" >My profile</a></li>
									<li><a href="<?php echo home_url(); ?>/index.php/logout/">sign out</a></li>
		        				</ul>
        					</li>
        				</ul>
					</nav>
					<?php }else{?>
						<nav>
        				<ul>
        					<li><a href="<?php echo home_url(); ?>/admin/public/partner">Partners</a></li>
        					<li><a href="<?php echo home_url(); ?>/index.php/shop">Store</a></li>
        				</ul>
        				<ul>
        					<li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/cart.png" class="img-responsive"><span class="cart-item">0</span>Cart</a></li>
        					<li><a href="#">Help</a></li>
        					<li><a href="<?php echo home_url(); ?>/index.php/signin">Sign In</a></li>
        					<li><a href="<?php echo home_url(); ?>/index.php/signup">Sign Up</a></li>
        				</ul>
					</nav>
						
						<?php } ?>
        		</div>
        	</div>
        </div>
        <div class="row">
        	<div class="middle-bar">
        		<div class="col-md-3 col-sm-3">
        			<div class="logo"><a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="redeemar" title="redeemar" width="190px" height="54px"></a></div>
        		</div>
        		<div class="col-md-9 col-sm-9">
        			<form class="form-inline">
					  <div class="form-group">
					    <input type="text" class="form-control search" placeholder="Search">
					    <img src="<?php echo get_template_directory_uri(); ?>/images/3.png" class="img-responsive">
					  </div>
					  <div class="form-group">
					    <input type="text" class="form-control">
					    <img src="<?php echo get_template_directory_uri(); ?>/images/2.png" class="img-responsive">
					  </div>
					  <div class="form-group">
					  	<input type="submit" value="">
					  </div>
					</form>
        		</div>
        	</div>
        </div>
    </div>
    <div class="main-menu">
	    <div class="container">
		    <div class="row">
		    	<nav class="navbar navbar-default">
				  <div class="container-fluid">
				    <!-- Brand and toggle get grouped for better mobile display -->
				    <div class="navbar-header">
				      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				      </button>
				    </div>

				    <!-- Collect the nav links, forms, and other content for toggling -->
				    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				      <ul class="nav navbar-nav">
				        <li><a href="#">summer special</a></li>
				        <li><a href="#">outdoor dining</a></li>
				        <li><a href="#">fashion</a></li>
				        <li><a href="#">outdoor events</a></li>
				        <li><a href="#">Local gateways</a></li>
				        <li><a href="#">sports</a></li>
				      </ul>
				    </div><!-- /.navbar-collapse -->
				  </div><!-- /.container-fluid -->
				</nav>
		    </div>
	    </div>
    </div>
</header>
<!--end new header-->
<!---->

<!--<?php //if(!is_home() && !is_front_page()) { ?>	
<div class="header-search">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-sm-8">
				<input class="search-txt" id="deal_cat" type="text" placeholder="How can we help you" value=""  />
				<input type="hidden" id="deal_catid" value="<?php echo(isset($_GET['deal_catid']) && $_GET['deal_catid']!='')?$_GET['deal_catid']:'';?>"/>
				<input type="hidden" id="deal_subcatid" value="<?php echo(isset($_GET['deal_subcatid']) && $_GET['deal_subcatid']!='')?$_GET['deal_subcatid']:'';?>"/>
				 <input type="hidden" id="deal_sub_sub_parent" value="<?php echo(isset($_GET['deal_subsub_parent']) && $_GET['deal_subsub_parent']!='')?$_GET['deal_subsub_parent']:'';?>"/>
				 <input type="hidden" id="deal_tag" value="<?php echo(isset($_GET['deal_tag']) && $_GET['deal_tag']!='')?$_GET['deal_tag']:'';?>"/>
				 <input type="hidden" id="deal_key" value="<?php echo(isset($_GET['dealkey']) && $_GET['dealkey']!='')?$_GET['dealkey']:'';?>"/>
					<input type="hidden" id="deal_brand" value="<?php echo(isset($_GET['deal_brandname']) && $_GET['deal_brandname']!='')?$_GET['deal_brandname']:'';?>">
					<input type="hidden" id="deal_created_by" value="<?php echo(isset($_GET['deal_created_by']) && $_GET['deal_created_by']!='')?$_GET['deal_created_by']:'';?>">
				<div id="suggesstion-box-cat"></div>
			</div>
			<div class="col-md-4 col-sm-4">
				<!--<input class="location" id="deal_loc" type="text" placeholder="Enter Your Location"/>
				<input type="hidden" id="deal_created_loc"/>
				<input type="hidden" id="deal_created"/>
				<input type="hidden" id="deal_created_fill"/>-->
				
				<?php 
					if($_COOKIE['location_input'] != '') {
						$default_loc = $_COOKIE['location_input'];
					}else {
						$default_loc = 'Yonkers';
					}

				?>
				
				
				
				<!--<input class="location" id="deal_loc" type="text" placeholder="Enter Your Location" value="<?php echo $default_loc;?>" name="deal_loc" onload="putCookie()"/>
				<?PHP //echo $default_loc;?>
				<input type="hidden" id="deal_created_loc" />
				<input type="hidden" id="deal_created"/>
				<input type="hidden" id="deal_created_fill" value="<?php echo $default_loc;?>"/>

				
				<?php if(is_page('deals') || is_page('summer-special')) { ?>

				<button class="search-btn-new" name="search_deal_btn" id="search_deal_btn" type="submit" value="Go"><i class="fa fa-search" aria-hidden="true"></i></button>
				
				<?php } else { ?>
					<button class="search-btn-new" name="search_deal_btn" id="search_deal_btn_other" type="submit" value="Go"><i class="fa fa-search" aria-hidden="true"></i></button>
					
				<?php }	?>
				<div id="suggesstion-box-loc"></div>

			</div>
		</div>    
	</div>
</div>  	

<div class="clear"></div> 

   
  
  <!-- passing php data to ajax -->

  <input type="hidden" id="deal_cat" value="<?php echo $_REQUEST['deal_category']; ?>">

  <input type="hidden" id="deal_loc" value="<?php echo $_REQUEST['deal_location']; ?>">



<!-- ALL CATEGORIES OR HOME PAGE CATEGORIES -->

      <?php

            if($_GET['cat_id']!="")
            { ?>

              <input type="hidden" id="deals_show" value="<?php echo $_GET['cat_id']; ?>">

            <?php } 

            else
            {
              echo '<input type="hidden" id="deals_show" value="-1"/>';
            }

      ?>	


<!-- ALL CATEGORIES OR HOME PAGE CATEGORIES END -->



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php if(is_page('deal-details')) { ?>
<script type="text/javascript">
$(document).ready(function(){  
   $(document).on('keypress','#deal_cat',function(e) {
           if(e.which == 13) {
            $("#search_deal_btn_other").trigger("click");
            }
          });
	
	$(document).on('keypress','#deal_loc',function(e) {
           if(e.which == 13) {
            $("#search_deal_btn_other").trigger("click");
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
$("#search_deal_btn_other").trigger("click");
}	
</script>
<?php } else{?>
<script type="text/javascript">
 //To select deal location
function selectZipcode(val2, createdby) {
$('.loc-list>li').removeClass('background');
$("#deal_loc").val(val2);
$("#deal_created_loc").val(val2);
$("#deal_created_fill").val(val2);
$("#deal_created").val(createdby);
$("#search_deal_btn").trigger("click");
}
  
</script>
<?php } ?>

<script type="text/javascript">	


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
					$('#deal_created_fill').val($('.background').text());
					 }else if(li.is( ".background" ) && e.which === 13){
					$('#deal_loc').val($('.background').text());
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



// END *******************************************


// SEARCH DEALS AJAX METHOD *****************************
$(document).ready(function(){});
   
</script> 

<script type="text/javascript">
    $(document).ready(function(){
		
		$("#search_deal_btn_other").click(function(){	
      
			
			var expireAt = new Date;
			expireAt.setMonth(expireAt.getMonth() + 3);
			var deal_created_loc = $("#deal_loc").val();
			document.cookie = "location_input=" + deal_created_loc + ";expires=" + expireAt.toGMTString();

			var dcatid = $('#deal_catid').val();
			var dsubcatid = $('#deal_subcatid').val();
			var dcreated = $('#deal_created').val();
			var location = $('#deal_loc').val();
			var cat_name = $('#deal_cat').val();
			var dealtag = $('#deal_tag').val();
			var subsubparent = $('#deal_sub_sub_parent').val();
			var brandname = $('#deal_brand').val();
			var createdby = $('#deal_created_by').val();
			var dealkey = $('#deal_key').val();
			$("#suggesstion-box-cat").hide();
			$("#suggesstion-box-loc").hide();
			//selectCategoryFromdealDetails(cat_name, dcatid, dsubcatid);
      		//if((dcatid !=='' || dcatid !== null) && (dsubcatid !=='' || dsubcatid !== null) && (location !== '' || location !== null)){
		  		//console.log(1);
				window.location.href = "<?php echo site_url(); ?>/index.php/deals/?deal_catid="+dcatid+"&deal_subcatid="+dsubcatid+"&deal_subsub_parent="+subsubparent+"&deal_loc="+location+"&cat_name="+cat_name+"&deal_tag="+dealtag+"&deal_brandname="+brandname+"&deal_created_by="+createdby+"&dealkey="+dealkey;
			//}
			
			
      });

    });
</script>


<script type="text/javascript">




     $('#brandbyOffer').change(function() {
    
             var BrandOffer = $("#brandbyOffer option:selected").val();

             //alert (BrandOffer);


            $.ajax({

                type:"post",
                url:"<?php echo site_url(); ?>/index.php/deal-search/",
                data:"BrandId="+BrandOffer,
                success:function(data)
                {
                     $('#deal_search_results').html(data);
                    
                }

            });
    
    });



function get_data()
{
  var source = [];
  var per_page = 9;
  var current_page = 1;
  $(".product-view").each(function(){
    $(this).css({"display":"none"});
    source.push($(this));
  });
  // console.log(source);
  if(source.length > 0){
  for(i = 0 ; i < per_page; i++)
  {
    source[i].css({"display":"block"});
  }
  no_of_page = Math.ceil(source.length/per_page);
  if(no_of_page > 1 ){
   $("#deal_search_results").append("<div id='pegi_div'><div  no_of_page='"+no_of_page+"' no_of_res='"+per_page+"' current_page='"+current_page+"' class='pegenation_c col-md-2' id='forword_pegi' type='forword' onclick='get_page(this);' ><span class='next'>next</div></div>");
  //console.log(no_of_page);
    }
}
  
}


function get_page(obj){

    //console.log(obj);


    $('.pegenation_c').hide();
    var no_of_res = $(obj).attr("no_of_res");
    var no_of_page = $(obj).attr("no_of_page");
    var current_page = $(obj).attr("current_page");
    var pegi_type = $(obj).attr("type");
    $("#pegi_div").empty();
    source = [];
    
   if( pegi_type == "forword")
   {
      current_page++;
   }
   if( pegi_type == "backward")
   {
      current_page--;
   }
   $(obj).attr("current_page",current_page);
   start_point = (no_of_res * current_page)-no_of_res;
  
   end_point = parseInt(start_point) + parseInt(no_of_res);
   console.log(start_point);
   console.log(end_point);

    $(".product-view").each(function(){
    $(this).css({"display":"none"});
    source.push($(this));
    });

     if(end_point >= source.length )
    {
       end_point =  source.length;
    }

    for(i = start_point; i < end_point ;i++)
    {
        source[i].css({"display":"block"});
    }
    if(current_page == 1 ){
    $("#pegi_div").append("<div  no_of_page='"+no_of_page+"' no_of_res='"+no_of_res+"' current_page='"+current_page+"' class='pegenation_c col-md-2' id='forword_pegi' type='forword' onclick='get_page(this);' ><span class='next'>next</span></div>");

    }
    if( current_page > 1 && current_page < no_of_page)
    {
        $("#pegi_div").append("<div  no_of_page='"+no_of_page+"' no_of_res='"+no_of_res+"' current_page='"+current_page+"' class='pegenation_c col-md-2' id='forword_pegi' type='forword' onclick='get_page(this);' ><span class='next'>next</span></div>");
        $("#pegi_div").append("<div  no_of_page='"+no_of_page+"' no_of_res='"+no_of_res+"' current_page='"+current_page+"' class='pegenation_c col-md-2' id='forword_pegi' type='backward' onclick='get_page(this);' ><span class='back'>back</span></div>");

    }
    if(current_page == no_of_page )
    {
        $("#pegi_div").append("<div  no_of_page='"+no_of_page+"' no_of_res='"+no_of_res+"' current_page='"+current_page+"' class='pegenation_c col-md-2' id='forword_pegi' type='backward' onclick='get_page(this);' ><span class='back'>back</span></div>");
    }

    //console.log(source);

}
</script>

<!-- Deal SEARCH METHOD END -->


<!-- Pagination Begin -->








<!-- Pagination End -->	

	



	
	
	
