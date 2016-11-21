<?php 
/* Template Name: Redeemar Category Page
*/

$search_all = "SELECT rc.*, ro.*, rp.* FROM reedemer_category AS rc, reedemer_offer AS ro, reedemer_partner_settings AS rp WHERE rc.id=ro.cat_id AND rc.status='1' AND ro.status='1' AND rc.parent_id='0' AND ro.created_by=rp.created_by";
$offers_alldata = $wpdb->get_results($search_all );
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php if (is_home () ) { bloginfo('name'); } elseif ( is_category() ) { single_cat_title(); echo ' - ' ; bloginfo('name'); }
elseif (is_single() ) { single_post_title(); }
elseif (is_page() ) { bloginfo('name'); echo ': '; single_post_title(); }
else { wp_title('',true); } ?></title>

    <!-- Bootstrap -->
    <link href="<?php bloginfo('template_directory'); ?>/css/bootstrap.min.css" rel="stylesheet">
     <link href="<?php bloginfo('template_directory'); ?>/style.css" rel="stylesheet">

     <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/fonts/font-awesome/css/font-awesome.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
     
<!-- Latest compiled JavaScript -->
<?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <header>
        <div class="header-top">
             <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="logo"><a href="<?php echo site_url(); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/logo-new.png" alt="redeemar" title="redeemar"></a></div>
                        <div class="top-right-menu">
                            <ul>
                               <?php wp_nav_menu(array('theme_location'=>'top-menu'));  ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-search">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <input class="search-txt" id="deal_cat" type="text" placeholder="How can we help you"/>
                        <input type="hidden" id="deal_catid"/>
                        <input type="hidden" id="deal_subcatid"/>
                        
                        
                        <div id="suggesstion-box-cat"></div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <input class="location" id="deal_loc" type="text" placeholder="Location"/>
                        <input type="hidden" id="deal_created"/>
                        
                        <div id="suggesstion-box-loc"></div>
                        <button class="search-btn-new" name="search_deal_btn" id="search_deal_btn" type="submit" value="Go"><i class="fa fa-search" aria-hidden="true"></i></button>

                    </div>
                </div>    
            </div>
        </div>
        <div class="main-nav">
            <div class="container-fluid">
                <div class="row">
                    <div class="header_lt">
                       <div class="click">Menu</div>
                    </div>                
                    <div class="main_nav_deals main_nav">
                    <ul>
                        <?php wp_nav_menu(array('theme_location'=>'main-primary-menu'));  ?>
                    </ul>                                                
                    </div>
                </div>
            </div>
        </div>
    </header>
<div class="clear"></div> 

   
  
  <!-- passing php data to ajax -->

  <input type="hidden" id="deal_cat" value="<?php echo $_REQUEST['deal_category']; ?>">

    <input type="hidden" id="deal_loc" value="<?php echo $_REQUEST['deal_location']; ?>">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

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
    var all = -1;
    



     $.ajax({

                type:"post",
                url:"<?php echo site_url(); ?>/index.php/deal-search/",
                data:'deal_search='+all,
                success:function(data)
                {
                    $('#deal_search_results').html(data);
                }

            });

    


     $('#search_deal_btn').click(function(){

        var dcatid = $('#deal_catid').val();
        var dsubcatid = $('#deal_subcatid').val();
        var dcreated = $('#deal_created').val();

        //alert (dcreated);

        $.ajax({

                type:"post",
                url:"<?php echo site_url(); ?>/index.php/deal-search/",
                data:'deal_categoryid='+dcatid+'&deal_subcatid='+dsubcatid+'&dealcreatedby='+dcreated,
                success:function(data)
                {
                    $('#deal_search_results').html(data);
                    $('#deal_catid').val('');
                    $('#deal_subcatid').val('');
                    $('#deal_created').val('');
                }

            });

        });




     $('.all_catrows').click(function(){

            var allcat_id = this.id;


            $.ajax({

                type:"post",
                url:"<?php echo site_url(); ?>/index.php/deal-search/",
                data:"category_id="+allcat_id,
                success:function(data)
                {
                     $('#deal_search_results').html(data);
                    
                }

            });

        });






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


     

});
</script>

<!-- Deal SEARCH METHOD END -->

<div class="container">
    <div class="row">
        <div class="col-md-12 search-result">
            <h2>Here are your results </h2>
        

                <div class="col-md-3 col-sm-3 search-widget-area">
                        <?php get_sidebar(); ?>
                </div>

                    
                <div class="col-md-9 col-sm-9 search-result-view nopadding">
                    <div id="deal_search_results"> </div>
                </div>

        </div>


    </div>
</div>
<div class="clear"></div>
<?php get_footer(); ?>
