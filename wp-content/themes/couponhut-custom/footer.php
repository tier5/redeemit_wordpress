<div class="clear"></div>
<!-- Footer Start --> 
<footer class="footer">
	<div class="footer-top">
		<div class="container">
			<div class="col-md-3 col-sm-3">
				<div class="row">
					<div class="col-md-3 col-sm-4">
						<img src="<?php echo get_template_directory_uri(); ?>/images/5.png" class="img-responsive">
					</div>
					<div class="col-md-9 col-sm-8">
						<div class="row">
							<p>customer care</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-3">
				<div class="row">
					<div class="col-md-3 col-sm-4">
						<img src="<?php echo get_template_directory_uri(); ?>/images/6.png" class="img-responsive">
					</div>
					<div class="col-md-9 col-sm-8">
						<span>service call</span>
						<p class="callat">1-888-979-2656</p>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-3">
				<div class="row">
					<div class="col-md-3 col-sm-1">
					</div>
					<div class="col-md-9 col-sm-11">
						<span>Address</span>
						<p class="addr"><img src="<?php echo get_template_directory_uri(); ?>/images/7.png" class="img-responsive"> Karte zeigen ›</p>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-3">
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<img src="<?php echo get_template_directory_uri(); ?>/images/app-store.png" class="img-responsive">
					</div>
					<div class="col-md-6 col-sm-6">
						<img src="<?php echo get_template_directory_uri(); ?>/images/google-play.png" class="img-responsive">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="footer-middle">
				<div class="col-md-3 text-center social-section col-sm-3">
					<?php dynamic_sidebar( 'footer-section01' ); ?>
					<!--<img src="<?php //echo //get_template_directory_uri(); ?>/images/logo.png" class="img-responsive">
					<p>507-Union Trade Center,Udhana Darvaja Surat</p>
					<p>Call us: 0123-456-789
					<p>support@loremipcom</p>
					<ul>
						<li><a href="#"><img src="<?php //echo get_template_directory_uri(); ?>/images/8.png" class="img-responsive"></a></li>
						<li><a href="#"><img src="<?php //echo get_template_directory_uri(); ?>/images/9.png" class="img-responsive"></a></a></li>
						<li><a href="#"><img src="<?php //echo get_template_directory_uri(); ?>/images/10.png" class="img-responsive"></a></a></li>
						<li><a href="#"><img src="<?php //echo get_template_directory_uri(); ?>/images/11.png" class="img-responsive"></a></a></li>
						<li><a href="#"><img src="<?php //echo get_template_directory_uri(); ?>/images/12.png" class="img-responsive"></a></a></li>
					</ul>-->
				</div>
				<div class="col-md-3 col-sm-3">
					<div class="footer-menu">
						<?php dynamic_sidebar( 'footer-section02' ); ?>
						<!--<h3>my account</h3>
						<ul>
							<li><a href="#">Ask in forum</a></li>
							<li><a href="#">Help Desk</a></li>
							<li><a href="#">Payment Method</a></li>
							<li><a href="#">Promotions</a></li>
							<li><a href="#">Terms & Condition</a></li>
							<li><a href="#">Payment Method</a></li>
						</ul>-->
					</div>
				</div>
				<div class="col-md-3 col-sm-3">
					<div class="footer-menu">
						<?php dynamic_sidebar( 'footer-section03' ); ?>
						<!--<h3>shop</h3>
						<ul>
							<li><a href="#">Accessories</a></li>
							<li><a href="#">Dining</a></li>
							<li><a href="#">Salon/SPA</a></li>
							<li><a href="#">Services</a></li>
							<li><a href="#">Health</a></li>
							<li><a href="#">Fitness</a></li>
						</ul>-->
					</div>
				</div>
				<div class="col-md-3 col-sm-3">
					<div class="footer-menu">
						<?php dynamic_sidebar( 'footer-section04' ); ?>
						<!--<h3>More</h3>
						<ul>
							<li><a href="#">About redeemar</a></li>
							<li><a href="#">Why Choose Us</a></li>
							<li><a href="#">AD Choise</a></li>
							<li><a href="#">Track My Offer</a></li>
							<li><a href="#">Contact Us</a></li>
						</ul>-->
					</div>
				</div>
			</div>
		<!--new footer end-->

<!-- Footer End --> 

<?php wp_footer(); ?>
</body>		
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-ui.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
	

    
<script type="text/javascript"> 
$(document).ready(function(){
	
		$(".click").click(function(){  
            $(".main_nav").slideToggle(700);
        });
	
		$("#deal_loc").focus(function() {
				document.getElementById("deal_created_loc").value = $("#deal_loc").val();
				document.getElementById("deal_loc").value = "";
			}).blur(function() {
				$("#deal_loc").val($("#deal_created_loc").val());
		});

        

        $(".cat-nav li").addClass("catlist-closed");

        $(".cat-nav li").click(function(){
            $( this ).addClass( "catlist-opened" );
            $( this ).removeClass( "catlist-closed" );

        });


/*=====Stop carousel autoslide=======*/
        $('.carousel').each(function(){
            $(this).carousel({
                interval: false
            });
        });
/*==============================*/

/*============= Video Start =============*/
	
			
	
		
	
		$(".slidevdo .middle-vdo .vdo").click(function(ev){
			
            $(this).find("img").hide();
            $(this).find(".vdo-start").hide();
			var vdo_src = $("this").find("input").val();
		
		    //$(this).find(".video")[0].src += "&autoplay=1";
			player.playVideo();
            ev.preventDefault();
        });

        $(".slidevdo .side-vdo .vdo").click(function(ev){
			
			
				$(".vdo-start").attr("data-mode","");
		    
				var parentSlide = $(this).parent().parent().parent();
				var pausebtn = $(this).find($(".fa.vdo-paused"));
				var vdo_src = $(this).find("input").val();
				var img_src = $(this).find("img").attr("src");
			
				var video_ID = YouTubeGetID(vdo_src);
			
			
				var middle_video_src = $(".slidevdo .middle-vdo .vdo").find("input").val();
				var middle_img_src = $(".slidevdo .middle-vdo .vdo").find("img").attr("src");
			
			
			
			
			
				$(this).find("input").val(middle_video_src);
				$(".slidevdo .middle-vdo .vdo").find("input").val(vdo_src);
				
				$(this).find("img").attr("src",middle_img_src);
				$(".slidevdo .middle-vdo .vdo").find("img").attr("src",img_src);
			
			
			
				$(parentSlide).find($(".middle-vdo .vdo img")).hide();
                $(parentSlide).find($(".middle-vdo .vdo .vdo-start")).hide();
				var video_data = player.getVideoData();
				if(video_data['video_id'] !== video_ID){
					player.loadVideoById(video_ID);
				}
					player.playVideo();
			
			
			
				var target_video = $(parentSlide).find( $(".vdo") ).not( $(this) );
                $(target_video).find($(".fa.vdo-starticon")).show();
                $(target_video).find($(".fa.vdo-paused")).hide();
                $(target_video).find($("img")).css("opacity","1");

               //$(parentSlide).find($(".middle-vdo .vdo .video"))[0].src += "&autoplay=1";
            
            ev.preventDefault();
        });
	
	
	
		


        $(".slidearrow").click(function(e){
            $(".slidevdo").toggle(500);
            
            $(".vdo").find("iframe")[0].contentWindow.postMessage('{"event":"command","func":"' + 'pauseVideo' + '","args":""}', '*');
            $(".vdo").find("iframe")[1].contentWindow.postMessage('{"event":"command","func":"' + 'pauseVideo' + '","args":""}', '*');
            e.preventDefault();
        });

        $(".contentvdo-section").click(function(ev){

            $(this).find("img").hide();
            $(this).find(".vdo-start").hide();

            $(this).find(".video")[0].src += "&autoplay=1";
            ev.preventDefault();
        });

        $(".slide1 .vdo").click(function(){
            $(".slide1 .skipvdo").show();
        });

        $(".slide2 .vdo").click(function(){
            $(".slide2 .skipvdo").show();
        });
/*============== Video End ===============*/


 /*=== Tranparent bg Start ===*/
$(".main_nav ul li").mouseover(function(){
if($(".submenu-category").is(':visible')) {
var fullheight = $(document).height();
$(".transparent-layer").css("height",fullheight);
$(".transparent-layer").show();
}

});

$(".main_nav ul li").mouseout(function(){
$(".transparent-layer").hide();
});
/*=== Tranparent bg end ===*/

});
	
	
function YouTubeGetID(url){
		  var ID = '';
		  if(url !== 'undefined'){
		  url = url.replace(/(>|<)/gi,'').split(/(vi\/|v=|\/v\/|youtu\.be\/|\/embed\/)/);
		  }
		  if(url[2] !== undefined) {
			ID = url[2].split(/[^0-9a-z_\-]/i);
			ID = ID[0];
		  }
		  else {
			ID = url;
		  }
			return ID;
}	
</script> 

<script>
/*=============== Carousel Section  ================*/
$(document).ready(function(){
    $(".carousel ul.view-link li.mapview").click(function(e){
        $(this).addClass("activebtn");
        $(".carousel ul.view-link li.adview").removeClass("activebtn");
        $(".mapimage").show();
        $(".block").hide();
        e.preventDefault();
    });

    $(".carousel ul.view-link li.adview").click(function(e){
        $(this).addClass("activebtn");
        $(".carousel ul.view-link li.mapview").removeClass("activebtn");
        $(".mapimage").hide();
        $(".block").show();
        e.preventDefault();
    });

    $("a.carouselarrow-right").click(function(e){

        $('.carouselslide1').hide('slide', {direction: 'left'}, 1400);
        $('.carouselslide2').stop().show('slide', {direction: 'right'}, 1400);

        $(this).css("color","#f1f1f1");
        $("a.carouselarrow-left").css("color","#B7B7B7");

        $(".carouselslide2 li:first-child").click();

        e.preventDefault();
    });

    $("a.carouselarrow-left").click(function(e){

        $('.carouselslide2').hide('slide', {direction: 'right'}, 1400);
        $('.carouselslide1').stop().show('slide', {direction: 'left'}, 1400);

        $(this).css("color","#f1f1f1");
        $("a.carouselarrow-right").css("color","#B7B7B7");

        $(".carouselslide1 li:first-child").click();

        e.preventDefault();
    });

});
/*================== Carousel Section  ==================*/
</script>
	
<script type="text/javascript">
$(document).ready(function(){
    $("a#ui-lightbox-button-close").insertBefore("#ui-lightbox-content-container");
    $("a#ui-lightbox-button-close span.ui-icon-closethick").text("X");
});
</script>	
	
<script>
	
$("#search_deal_btn").click(function(){	
	
	var expireAt = new Date;
	expireAt.setMonth(expireAt.getMonth() + 3);
	var deal_created_loc = $("#deal_loc").val();
	document.cookie = "location_input=" + deal_created_loc + ";expires=" + expireAt.toGMTString()

	var dcatid = $('#deal_catid').val();
	var dsubcatid = $('#deal_subcatid').val();
	var dcreated = $('#deal_created').val();
	var location = $('#deal_loc').val();
});
	
</script>

