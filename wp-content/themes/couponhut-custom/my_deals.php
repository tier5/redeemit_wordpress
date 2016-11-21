<?php 
/*Template Name:My Deals Page
*/

if ( !is_user_logged_in() ) {
	$home = home_url();
	header("Location: $home");
}

//ajax post data for updation
if(isset($_POST['first_name']) && !empty($_POST['first_name']))
{

global $wpdb;
	
$user = get_user_by("id",get_current_user_id());
if(!empty($_POST['new_password'])){
	
if (!wp_check_password($_POST['current_password'], $user->data->user_pass, $user->ID)) {
	echo 'P001';exit;
	
}else{
	
	$user_id = wp_update_user(array('ID' => $user->ID, 'user_pass' => $_POST['new_password']));
	$pass = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
	if(!empty($_POST['first_name'])){
	update_user_meta($user->ID,"first_name",$_POST['first_name']);
	}
	if(!empty($_POST['last_name'])){
	update_user_meta($user->ID,"last_name",$_POST['last_name']);
	}
	if(!empty($_POST['phone_no'])){
	update_user_meta($user->ID,"phone_no",$_POST['phone_no']);
	}
	$update_set1 = "UPDATE users SET first_name = '".$_POST['first_name']."', last_name = '".$_POST['last_name']."',password = '".$pass."' ,mobile = '".$_POST['phone_no']."' where email = '".$_POST['email']."'";
	$update_dta1 = $wpdb->query($update_set1);
	echo 'P002';exit;
	
	}
}else{
	
	if(!empty($_POST['first_name'])){
	update_user_meta($user->ID,"first_name",$_POST['first_name']);
	}
	if(!empty($_POST['last_name'])){
	update_user_meta($user->ID,"last_name",$_POST['last_name']);
	}
	if(!empty($_POST['phone_no'])){
	update_user_meta($user->ID,"phone_no",$_POST['phone_no']);
	}
	$update_set = "UPDATE users SET first_name = '".$_POST['first_name']."', last_name = '".$_POST['last_name']."', mobile = '".$_POST['phone_no']."' where email = '".$_POST['email']."'";
	$update_dta = $wpdb->query($update_set);

	echo 'P003';exit;
}

}else
{
 $user_data = get_user_by("id",get_current_user_id());
 $get_user_offers = "SELECT ofr.offer_id, ofr.validate_after from reedemer_user_bank_offer as ofr, users as usr where usr.email ='".$user_data->user_login."' && ofr.user_id = usr.id && ofr.status='1'";

 $offer_details_res=$wpdb->get_results($get_user_offers,ARRAY_A);

 $get_user = "SELECT *  from users  where email = '".$user_data->user_login."'";
 $get_user1=$wpdb->get_results($get_user,ARRAY_A);

 //print_r($get_user1);

 $bank_ofr="";
 if(isset($offer_details_res) && !empty($offer_details_res))
 {
 $t = 0;
 foreach ($offer_details_res as  $vl) {
 	# code...


$offer_details="SELECT usr.id, usr.company_name, usr.location, usr.first_name, usr.last_name, usr.address, usr.zipcode, usr.lat, usr.lng, usr.email, usr.mobile, usr.web_address, usr.password, usr.cat_id, usr.subcat_id, usr.owner, usr.create_offer_permission, usr.status,usr.approve,usr.type,usr.remember_token,usr.device_token,usr.source,usr.created_at,usr.updated_at, ofr.id,ofr.campaign_id,ofr.cat_id,ofr.subcat_id,ofr.offer_description,ofr.max_redeemar,ofr.redeem_offer,ofr.price,ofr.pay,ofr.start_date,ofr.end_date,ofr.what_you_get,ofr.more_information,ofr.pay_value,ofr.retails_value,ofr.include_product_value,ofr.discount,ofr.value_calculate,ofr.validate_after,ofr.validate_within,ofr.zipcode,ofr.latitude,ofr.longitude,ofr.status,ofr.created_by,ofr.offer_image,ofr.offer_image_path,ofr.created_at,ofr.updated_at, ps.setting_val,ps.price_range_id,ps.created_by,ps.created_at,ps.updated_at FROM reedemer_offer AS ofr, users as usr, reedemer_partner_settings as ps WHERE ofr.id = ".$vl['offer_id']." &&  ofr.created_by = usr.id && ofr.created_by = ps.created_by";
$offer_details_res=$wpdb->get_results($offer_details,ARRAY_A);
$bank_ofr[$t]= $offer_details_res;
 	$t++;
 	}
 //print_r($bank_ofr);
}

function get_expdate($date_data){
$now = time(); // or your date as well
$your_date = strtotime($date_data);
$datediff = $your_date - $now;
return floor($datediff/(60*60*24));
}
?>


  <body>
	 <?php get_header(); ?> 
     <?php //get_header( 'reedmer' ); ?>
<div class="clear"></div> 

<div class="container product-grid">
    <div class="row">
        <div class="col-md-12 mydeals">
            <div id="tabs">
              <ul>
                <li><a href="#tabs-1">My Deals</a></li>
                <li><a href="#tabs-2">My Profile</a></li>
                <!--<li><a href="#tabs-3">updrade</a></li>-->
              </ul>
              <div id="tabs-1">
 <?php if(isset($bank_ofr) && !empty($bank_ofr)){
                    $k = 1;
                    $kk=1;
                    $current_time=date('Y-m-d H:i:s');
            foreach ($bank_ofr as $grid_value1) 
            {
            	 $grid_value = $grid_value1[0];
               //print_r($grid_value1[0]);
			     ?>
              <div class="col-md-4 col-sm-4 product-view">
                    <!--<a href="<?php echo home_url(); ?>/index.php/deal-details/?offer=<?php echo $grid_value['id']; ?>">-->
                    <?php 
                      $reedem_user_id=$get_user1[0]['id'];
                      $reedem_offer_id=$grid_value['id'];
                      //$reedem_offer_validate_after=$vl['validate_after'];
                      $new_offer_qry="SELECT * from reedemer_user_bank_offer where user_id='$reedem_user_id' && offer_id='$reedem_offer_id'";
                        $get_user_banked_details=$wpdb->get_results($new_offer_qry,ARRAY_A);
                         foreach ($get_user_banked_details as $get_user_banked_details1)
                      {
                         $reedem_offer_validate_after=$get_user_banked_details1['validate_after'];
                         $diff = strtotime($reedem_offer_validate_after) - strtotime($current_time);   
                      }
                      
                    ?>
                    <input type="hidden" id="reedem_user_id" value="<?php echo $reedem_user_id;?>">
                    <input type="hidden" id="reedem_offer_id" value="<?php echo $reedem_offer_id; ?>"> 
                     
                    <input type="hidden" id="offer_valication_time" value="<?php echo $diff; ?>">
                   
                        <span class="redeemed-layer" id="parent_reedem">
                        <!--<strong id="before_reedem" style="margin-bottom:5px;padding-left:119px;position:relative;"></strong>-->
                       <?php if ($diff<='0')
                       {
                      ?>
                        <strong id="redem_it" 
                        user_id="<?php echo $get_user1[0]['id'];?>" offer_id="<?php echo $grid_value['id'];?>" style="cursor: pointer;">Redeem</strong>
                       <?php 
                        }
                       else
                        {
                          echo "<strong style='font-size: 20px; text-align: center;left:18%;'>You can reedem it after <br>".$reedem_offer_validate_after."</strong>";
                        }
                        ?>
                        </span>
                        <script>
                        //var kval = 1;
                        //alert (kval);
                        //var xxx='reedem_user_id'+kval;
                        //var reedem_user_id=document.getElementById('reedem_user_id').value;
                       // var reedem_offer_id=document.getElementById('reedem_offer_id').value;
                        //var offer_valication_time=document.getElementById('offer_valication_time').value; 
                        //var offer_valication_time= 5;
                        //var element_id = "parent_reedem" ;
                        //var link_text = "<strong id=redem_it user_id="+reedem_user_id+" offer_id="+reedem_offer_id+">Redeem</strong>"; //link location 
                        //setTimeout(function(){
                        //document.getElementById(element_id).innerHTML = link_text}, offer_valication_time*1000)
                       
                        </script>
                        
				  
      				  			<?php $img_explod = explode('/',$grid_value['offer_image_path']);
            								if($img_explod[0] == 'http:'){
            									$img_offers = $grid_value['offer_image_path'];									
            								}else{
            									$img_offers = home_url().'/'.$grid_value['offer_image_path'];
            								}
							         ?>	
                        <img src="<?php echo $img_offers; ?>" alt="img01" class="img-responsive">
                        <div class="product">
                            <div class="product-title"><?php echo $grid_value['offer_description']; ?></div>
                            <div class="product-savings">
									
									<?php 		 		
				 						
		 								//echo "SELECT * FROM `reedemer_offer` WHERE id = $offers->id && status = 1";
										$reed_id = $grid_value['id'];
				 						$offer_prc = $wpdb->get_results("SELECT * FROM `reedemer_offer` WHERE id = $reed_id && status = 1");
				 					
		 							foreach($offer_prc as $off_prc){
										
									$offer_lat = $off_prc->latitude;	
		 							$offer_lon = $off_prc->longitude;
									$cmp_id = $off_prc->created_by;		
										
									if($off_prc->discount > 0) {
									   
									?>
									<span class="savings">
										<?php 										
										
										$prc_val = ($off_prc->pay_value/$off_prc->retails_value); 
										$percent_friendly = number_format( $prc_val * 100, 2 ) . '%';
										$tot_per = 100 - $percent_friendly;
										$offer_lat = $off_prc->latitude;
										$offer_lon = $off_prc->longitude;
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
								<?php 
				 				//echo "SELECT `location` FROM `users` WHERE id = $cmp_id";
								//$cmp_nam = $wpdb->get_results("SELECT `location` FROM `users` WHERE id = $default_loc");				
								//foreach($cmp_nam as $cmp_nms) {					
									echo $grid_value['location']."(";				
								//}			
				 	
				 				if($location_user != '' || $default_loc != ''){
									
									if($location_user != '') {
										
										$loc_id = $location_user;
										
									}else if($default_loc != '') {
										
										$loc_id = $default_loc; 
										
									}
									//echo "SELECT usr.location,usr.lat,usr.lng FROM users AS usr INNER JOIN reedemer_offer AS ro ON ro.created_by = usr.id WHERE usr.location = '$loc_id' && ro.id = $offers->id";
									
									$loc_defs = $wpdb->get_results("SELECT usr.location,usr.lat,usr.lng FROM users AS usr INNER JOIN reedemer_offer AS ro ON ro.created_by = usr.id WHERE usr.location = '$loc_id' && ro.id = $offers->id");
									foreach($loc_defs as $loc_def){
										$lat = $loc_def->lat;
										$lon = $loc_def->lng;
									}
									
								}else {
									
									$lat = "40.9312099";
									$lon = "-73.89874689999999";
								}
								echo floor(distance($lat, $lon, $offer_lat, $offer_lon, "M"))." Miles"; ?>)


                                </div>
                        </div>
                    <!--</a>-->
                </div>
                <?php 
               
                if($k%3 == 0)
                    {
                        echo   '<div class="clear"></div>' ;
                    }

                    $k++;
                     $kk++;

        }
                    
                    
                }else
                {
                	Echo "<h2> No offer available to reedem !</h2>";
                }
                ?>
              </div>
              <div id="tabs-2">
                <div class="form-section">
                    <div class="col-md-5">
                        <form id="update_profile" action="#" method="post">
                          <div class="form-group">
                            <label for="exampleInputName2">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $get_user1[0]["first_name"]; ?>" >
                                   <div id="first_name_msg" class="red"></div>
                          </div> 
                          <div class="form-group">
                            <label for="exampleInputName2">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $get_user1[0]["last_name"]; ?>" >
                            <div id="Last_name_msg" class="red"></div>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail2">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $get_user1[0]["email"]; ?>" readonly="readonly">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword3">Mobile Number</label>
                            <input type="text" class="form-control" id="phone_no" name="phone_no" value="<?php echo $get_user1[0]["mobile"]; ?>" >
                            <div id="phone_no_msg" class="red"></div>
                          </div>
                          <div class="clear"></div>
                          <h3>Change the password</h3>
                           <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password">
                           <div id="current_password_msg" class="red"></div>
                           </div>
                           <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password">
                           <div id="new_password_msg" class="red"></div>
                           </div>
                           <div class="form-group">
                            <label for="confirm_new_password">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_new_password" name="confirm_new_password">
                           <div id="confirm_new_password_msg" class="red"></div>
                           </div>
                          
                          <button type="button" class="btn btn-default btn-block" id="update_btn">Save</button>
                        </form>
						
						<div class="success-msg" style="display:none;"></div>
                    </div>
                </div>
              </div>
               <!--<div id="tabs-3">
               <ul>
                 <li><a href="#" id="premium_upgrade">upgrade to Premium</a></li>
                 <li><a href="#" id="Gold_upgrade">upgrade to Gold</a></li>
                 </ul>
               </div>-->
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
<!-- Footer Start -->  
<?php get_footer(); ?>
<!-- Footer End --> 

</body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/js/jquery-ui.js"></script>

    
    <script type="text/javascript"> 

    jQuery(document).ready(function(){
      /*jQuery('#redem_it').click(function(){

        var user_id = $(this).attr("user_id");
        var offer_id = $(this).attr("offer_id");

        $.ajax({
        type: "POST",
        url: "<?php echo site_url() ?>/index.php/redeem-it/",
        //url: '<?php echo site_url(); ?>/admin/public/index.php/bridge/bankoffer?data={"webservice_name":"bankoffer","user_id":'+user_id+',"offer_id":'+offer_id+'}',
         data:{"user_id":user_id,"offer_id":offer_id},
        //data:"{'webservice_name':'bankoffer','user_id':1,'offer_id':6}",

        success: function(data){
           var obj = $.parseJSON(data)
           console.log(obj);
      

          if(obj.status_result == "R01001")
          {
            
            alert("You Have Successfully Redeem This Offer");
            //$(this).parent().closest('div').hide(); 
            location.reload();
          }
          if(obj.status_result == "R01002")
          {
           
            $(offer_message).attr("offer_message","banked");
            alert("You Have Already Banked This Offer");
          }
        }

        });





      });*/
		
		jQuery('#redem_it').click(function(){

        var user_id = $(this).attr("user_id");
        var offer_id = $(this).attr("offer_id");

       $.ajax({
        type: "POST",
        url: "<?php echo site_url() ?>/index.php/pay-it/",
        //url: '<?php echo site_url(); ?>/index.php/bridge/passoffer?data={"webservice_name":"bankoffer","user_id":'+user_id+',"offer_id":'+offer_id+'}',
        data:{"user_id":user_id,"offer_id":offer_id},

        success: function(data){

          var obj = $.parseJSON(data)
          //console.log(obj);

          if(obj.status_result == "R01001")
          {
            window.location.href = obj.payment_url;
            
          }
         if(obj.status_result == "R01002")
          {
             window.location.href = obj.login_url;
          }
        }
        });





      });




    /*jQuery(".click").click(function(){
    jQuery(".main_nav").slideToggle(700);
    });*/
    
    });

    function jqUpdateSize(){
    var width = jQuery('.banner_vdobox').width();
    var sqwidth = width * 33.85 / 100;
    jQuery('.banner_vdobox').css('height', sqwidth);
    };
    jQuery(document).ready(jqUpdateSize);    // When the page first loads
    jQuery(window).resize(jqUpdateSize);     // When the browser changes size

    </script> 

    <script>
      $(function() {
        $( "#tabs" ).tabs();
      });

      $(document).ready(function(){
      
  $('#update_btn').click(function(){
	  
              var err = 0;

 if(  $("#first_name").val() == "" ||  $("#first_name").val() == null )
  { 
    $("#first_name").addClass('error1'); 
    err++;
    $("#first_name_msg").text("This Field is Required");
 }else{
  $("#first_name").removeClass('error1'); 
  $("#first_name_msg").text("");
   }

 if(  $("#last_name").val() == "" ||  $("#last_name").val() == null  )
  { 
    $("#last_name").addClass('error1'); 
    $("#Last_name_msg").text("This Field is Required");
    err++;
 }else{
  $("#last_name").removeClass('error1'); 
  $("#Last_name_msg").text("");
   }

/*if(  $("#phone_no").val() == "" ||  $("#phone_no").val() == null  )
  { 
	  
    $("#phone_no").addClass('error1'); 
    $("#phone_no_msg").text("This Field is Required");
    err++;
 }else{
  $("#phone_no").removeClass('error1'); 
  $("#phone_no_msg").text("");
   }*/
	  
var __phone = $("#phone_no").val();	 
if(isNaN(__phone) )
  { 
    $("#phone_no").addClass('error1'); 
    $("#phone_no_msg").text("Phone no is numeric");
    err++;
 }else{
  $("#phone_no").removeClass('error1'); 
  $("#phone_no_msg").text("");
   }
	  
/*if(__phone.length < 10 || __phone.length > 10)
  { 
    $("#phone_no").addClass('error1'); 
    $("#phone_no_msg").text("Phone no must be 10 digit");
    err++;
 }else{
  $("#phone_no").removeClass('error1'); 
  $("#phone_no_msg").text("");
   }*/

	  
if( $("#current_password").val() != "" || $("#new_password").val() != "" || $("#confirm_new_password").val() != "")
  {
    
    if(  $("#current_password").val() == "" ||  $("#current_password").val() == null  )
  { 
    $("#current_password").addClass('error1'); 
    $("#current_password_msg").text("This Field is Required");
    err++;
 }else{
  $("#current_password").removeClass('error1'); 
  $("#current_password_msg").text("");
   }
	  

	  if(  $("#new_password").val() == "" ||  $("#new_password").val() == null  )
  { 
    $("#new_password").addClass('error1'); 
    $("#new_password_msg").text("This Field is Required");
    err++;
 }else{
  $("#new_password").removeClass('error1'); 
  $("#new_password_msg").text("");
   }
	  
	  if(  $("#confirm_new_password").val() == "" ||  $("#confirm_new_password").val() == null  )
  {
	  
    $("#confirm_new_password").addClass('error1'); 
    $("#confirm_new_password_msg").text("This Field is Required");
    err++;
 }else if($("#new_password").val() != $("#confirm_new_password").val()){
	 $("#confirm_new_password").addClass('error1'); 
    $("#confirm_new_password_msg").text("Password and confirm password must be same");
	 err++;
 }else{
  $("#confirm_new_password").removeClass('error1'); 
  $("#confirm_new_password_msg").text("");
   }
	  
}
	  
if( err == 0)
  {
var first_name = $("#first_name").val();
$.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/index.php/my-deals',
        data:$('#update_profile').serialize(),
      
        success: function(data){
         $(".success-msg").text("").css("display","none");
           if(data == 'P001'){
			   $("#current_password").addClass('error1'); 
               $("#current_password_msg").text("Password does not exists");
		   }else if(data == 'P002' || data == 'P003'){
			   $("#current_password").val('');
			   $("#new_password").val('');
			   $("#confirm_new_password").val('');
			   $(".success-msg").text("Updated successfully").css("display","block");
			   
		   }else{
			   $(".success-msg").text("Error").css("display","block");
		   }
      

        }
        });

  }
 


        });

    function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
};
$('#tab_one_btn').click(function(){
$('#tabs-1').show(1000);
$('#tabs-2').hide(1000);
});
$('#tab_two_btn').click(function(){
$('#tabs-2').show(1000);
$('#tabs-1').hide(1000);
});
      });

    </script>


    <script src="<?php bloginfo('template_directory'); ?>/js/bootstrap.min.js"></script>
</html>

<?php } ?>