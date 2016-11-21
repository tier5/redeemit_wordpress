<?php get_header(); ?>
<div class="clear"></div> 
        <div class="container">
            <div class="row">
				<?php if(is_shop() ){?>
			   <div class="col-md-3 shop-left-box">
				   <?php dynamic_sidebar('shop_category_sidebar');?>
				   <?php dynamic_sidebar('shop_sidebar');?></div>
			   <div class="col-md-9 shop-right-box"><?php //woocommerce_content(); ?>
			    <div class="shop-banner-slider">
                <?php echo do_shortcode('[rev_slider homepage]');?>
            </div>
			   <div class="clear10"></div>
            <div class="shop-textbanner">
                <div class="col-md-3 nopadding">
                    <div class="textboxes" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/bg11.jpg');">
                        <div class="cms-image">
                             <img src="<?php echo get_template_directory_uri(); ?>/images/offer11.png" class="img-responsive">
                         </div>
                        <div class="tm_cms_banner_inner">
                            <div class="maintitle">Upto 5% Reward</div>
                            <div class="subtitle">on your shipping</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 nopadding">
                    <div class="textboxes" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/bg21.jpg');">
                        <div class="cms-image">
                             <img src="<?php echo get_template_directory_uri(); ?>/images/offer21.png" class="img-responsive">
                         </div>
                        <div class="tm_cms_banner_inner">
                            <div class="maintitle">Upto 5% Reward</div>
                            <div class="subtitle">on your shipping</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 nopadding">
                    <div class="textboxes" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/bg31.jpg');">
                        <div class="cms-image">
                             <img src="<?php echo get_template_directory_uri(); ?>/images/offer31.png" class="img-responsive">
                         </div>
                        <div class="tm_cms_banner_inner">
                            <div class="maintitle">Upto 5% Reward</div>
                            <div class="subtitle">on your shipping</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 nopadding">
                    <div class="textboxes" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/bg41.jpg');">
                        <div class="cms-image">
                             <img src="<?php echo get_template_directory_uri(); ?>/images/offer41.png" class="img-responsive">
                         </div>
                        <div class="tm_cms_banner_inner">
                            <div class="maintitle">Upto 5% Reward</div>
                            <div class="subtitle">on your shipping</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear10"></div>
			  
               
               <?php echo do_shortcode('[woocommerce_products_carousel_all_in_one all_items="10" show_only="featured" out_of_stock="false"  ordering="asc" template="compact.css" show_title="true" show_description="false" allow_shortcodes="false" show_price="true" show_category="" show_tags="false" show_add_to_cart_button="true" show_more_button="" show_more_items_button="" show_featured_image="true" image_source="thumbnail" image_height="100" image_width="100" items_to_show_mobiles="1" items_to_show_tablets="2" items_to_show="4" slide_by="1" stage_padding="0" margin="5" loop="true" stop_on_hover="true" auto_play="false" auto_play_timeout="1200" auto_play_speed="800" nav="true" nav_speed="800" dots="true" dots_speed="800" lazy_load="false" mouse_drag="true" touch_drag="true" easing="linear" auto_width="false" auto_height="true" custom_breakpoints=":"]');?>
               
                <div class="clear10"></div>
            <div class="shop-product-links">
                <div class="col-md-4 nopadding">
                    <div class="banner-hover">
                        <a href="#">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/sub-01.png" class="img-responsive">
                            <span class="hover_effect"> </span>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 nopadding">
                    <div class="banner-hover">
                        <a href="#">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/sub-02.png" class="img-responsive">
                            <span class="hover_effect"> </span>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 nopadding">
                    <div class="banner-hover">
                        <a href="#">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/sub-03.png" class="img-responsive">
                            <span class="hover_effect"> </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="clear10"></div>
               <?php echo do_shortcode('[woocommerce_products_carousel_all_in_one all_items="10" show_only="newest" out_of_stock="false"  ordering="asc" template="compact.css" show_title="true" show_description="false" allow_shortcodes="false" show_price="true" show_category="false" show_tags="false" show_add_to_cart_button="false" show_more_button="false" show_more_items_button="false" show_featured_image="true" image_source="thumbnail" image_height="100" image_width="100" items_to_show_mobiles="1" items_to_show_tablets="2" items_to_show="4" slide_by="1" stage_padding="0" margin="5" loop="true" stop_on_hover="true" auto_play="false" auto_play_timeout="1200" auto_play_speed="800" nav="true" nav_speed="800" dots="true" dots_speed="800" lazy_load="false" mouse_drag="true" touch_drag="true" easing="linear" auto_width="false" auto_height="true" custom_breakpoints=":"]');?>
               </div>
               <?php } 
               else if(is_product()){?>
               <div style="width:75%; float:left;"><?php woocommerce_content(); ?></div>
               <?php } else if(is_product_category()){?>
				   <div class="col-md-3 shop-left-box">
				   <?php dynamic_sidebar('shop_category_sidebar');?>
				   <?php dynamic_sidebar('shop_sidebar');?></div>
               <div style="width:75%; float:left;"><?php woocommerce_content(); ?></div>
				   <?php } ?>
               
<div class="clear"></div>
            </div>
        </div>
        
  
<!-- Product Grid End -->
<div class="clear"></div>
<!-- Footer Start -->  
<footer class="footer">
      <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="col-md-3 col-sm-3">
                </div>
                <div class="col-md-3 col-sm-3">
                    <img src="<?php bloginfo('template_directory'); ?>/images/app-store.png" alt="img01" class="img-responsive" />
                </div>
                <div class="col-md-3 col-sm-3">
                    <img src="<?php bloginfo('template_directory'); ?>/images/google-play.png" alt="img01" class="img-responsive" />
                </div>
                <div class="col-md-3 col-sm-3">
                    <img src="<?php bloginfo('template_directory'); ?>/images/rar.png" alt="img01" class="img-responsive img-rar" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-3 col-sm-3 foot-section">
                     <?php dynamic_sidebar( 'footer-section01' ); ?>
                </div>
                <div class="col-md-3 col-sm-3 foot-section">
                     <?php dynamic_sidebar( 'footer-section02' ); ?>
                </div>
                <div class="col-md-3 col-sm-3 foot-section">
                    <?php dynamic_sidebar( 'footer-section03' ); ?>
                </div>
                <div class="col-md-3 col-sm-3 foot-section">
                    <?php dynamic_sidebar( 'footer-section04' ); ?>
                </div>
            </div>
            <div class="clear"></div>
            <div class="col-md-12">
                <p class="copyright">© 2016 redeemar, Inc.. All rights reserved.</p>
            <div>
        </div>
      </div>
</footer>
<!-- Footer End --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-ui.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
<script type="text/javascript"> 
    jQuery(document).ready(function(){
        jQuery(".click").click(function(){
            jQuery(".main_nav").slideToggle(700);
        });

/*=== Tranparent bg Start ===*/
$(".main_nav ul li").hover(function(){

    if($(".submenu-category").is(':visible')) {
        var fullheight = $(document).height();
        $(".transparent-layer").css("height",fullheight);
        $(".transparent-layer").show();
    }
    else{
        $(".transparent-layer").hide();
    }
});
/*=== Tranparent bg end ===*/

$(".category-list-box h2").click(function(){
    $(this).toggleClass("open");
    if($(this).hasClass("open")){
        $(".fa.catlistopen").hide();
        $(".fa.catlistclose").css("display","inline-block");
    }
    else{
        $(".fa.catlistclose").hide();
        $(".fa.catlistopen").css("display","inline-block");
    }
    $("ul.category-list-section").slideToggle("slow");
});
    
});
</script> 

<?php wp_footer(); ?>
</body>

    <script src="<?php bloginfo('template_directory'); ?>/js/bootstrap.min.js"></script>
</html>
