<?php 
/* Template Name: Deal Page
*/

// $search_all = "SELECT rc.*, ro.*, rp.* FROM reedemer_category AS rc, reedemer_offer AS ro, reedemer_partner_settings AS rp WHERE rc.id=ro.cat_id AND rc.status = 1 AND ro.status = 1  AND rc.parent_id = '0' AND ro.created_by = rp.created_by ORDER BY RAND()";
// $offers_alldata = $wpdb->get_results($search_all );
// print_r($offers_alldata);
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
    <style type="text/css">
      .next,.back{background: #252525; color: #fff; padding: 4px 8px; cursor: pointer;}
    </style>
     
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
    var all = $('#deals_show').val();;
    



     $.ajax({

                type:"post",
                url:"<?php echo site_url(); ?>/index.php/deal-search/",
                data:'deal_search='+all,
                success:function(data)
                {
                    $('#deal_search_results').html(data);

                    get_data();
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
                    get_data();
                }

            });

        });




     $('.all_catrows').click(function(){

            var allcat_id = this.id;


            //alert(cat_id);

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



/*

     $('.all_subcatrows').click(function(){

            var allsubcat_id = this.id;

            var array_rec = allsubcat_id.split(',');


           //console.log(array_rec[0]);
            //console.log(array_rec[1]);


            //alert(allsubcat_id);

            $.ajax({

                type:"post",
                url:"<?php echo site_url(); ?>/index.php/deal-search/",
                data:'side_categoryid='+array_rec[0]+'&side_subcatid='+array_rec[1],
                success:function(data)
                {
                     $('#deal_search_results').html(data);
                    
                }

            });

        });

*/


     //$( "#brandbyOffer option:selected" ).text();


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
  var per_page = 5;
  var current_page = 1;
  $(".product-view").each(function(){
    $(this).css({"display":"none"});
    source.push($(this));
  });
  console.log(source);
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

     

});

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


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/paging.js"></script> 
<script type="text/javascript">
            // $(document).ready(function() {
            //     $('#tableData').paging({limit:5});
            // });
        </script>

<!-- Pagination End -->

<div class="container">
    <div class="row">
        <div class="col-md-12 search-result">
            <h2>Here are your results </h2>
        

                <div class="col-md-3 col-sm-3 search-widget-area">
                        <?php get_sidebar(); ?>
                </div>

                    
                <div class="col-md-9 col-sm-9 search-result-view nopadding">
                    <div id="deal_search_results">
                    </div>
                </div>

        </div>


    </div>
</div>
<div class="clear"></div>
<?php get_footer(); ?>