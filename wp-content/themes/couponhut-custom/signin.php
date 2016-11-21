<?php
/* Template Name:SignIn Page Template
*/
if ( is_user_logged_in() ) {
$home = home_url();
header("Location: $home");
}
?>
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
<script   src="https://code.jquery.com/jquery-1.12.4.min.js"   crossorigin="anonymous"></script>
     
<!-- Latest compiled JavaScript -->
<?php wp_head(); ?>
<style type="text/css">
  .error1
  {
    border: 1px solid red ! important;
  }
</style>
  </head>
    <body <?php body_class(); ?> >
      <div id="snd_data"></div>
    <?php 
    if(isset($_POST['user_id']) && !empty($_POST['user_id']))
    {

      if(isset($_POST['referrer']) && !empty($_POST['referrer']))
      {
        $redirect_url = $_POST['referrer'];
      }

      if ( username_exists( $_POST['email'] ) )
      {
        
        ?>
<script>


 $(document).ready(function(){
$('#snd_data').append('<form name="loginform" id="loginform" action="<?php echo home_url(); ?>/wp-login.php" method="post" style="position: static; left: 0px; display:none;"> <p> <label for="user_login">Username<br> <input type="text" name="log" id="user_login" aria-describedby="login_error" class="input" value="<?php echo $_POST["email"]; ?>" size="20"></label> </p> <p> <label for="user_pass">Password<br> <input type="password" name="pwd" id="user_pass" aria-describedby="login_error" class="input" value="<?php echo $_POST["passwrd"]; ?>" size="20"></label> </p> <p class="forgetmenot"><label for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever"> Remember Me</label></p> <p class="submit"> <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Log In"> <input type="hidden" name="redirect_to" value="<?php echo $redirect_url; ?>" > <input type="hidden" name="testcookie" value="1"> </p> </form>');
$('#loginform').submit();
 });
  
</script>
<?php
      }
      else
      {
               $userdata = array(
              'user_login'  =>  $_POST['email'] ,
              'user_pass'   =>  $_POST['passwrd'],
              'user_email' => $_POST['email'],
              'role'=>'Subscriber'  // When creating an user, `user_pass` is expected.
              );

        $user_id = wp_insert_user( $userdata ) ;

      //On success
      if ( ! is_wp_error( $user_id ) ) {
         ?>

<script>
$(document).ready(function(){
$('#snd_data').append('<form name="loginform" id="loginform" action="<?php echo home_url(); ?>/wp-login.php" method="post" style="position: static; left: 0px; display:none;"> <p> <label for="user_login">Username<br> <input type="text" name="log" id="user_login" aria-describedby="login_error" class="input" value="<?php echo $_POST["email"]; ?>" size="20"></label> </p> <p> <label for="user_pass">Password<br> <input type="password" name="pwd" id="user_pass" aria-describedby="login_error" class="input" value="<?php echo $_POST["passwrd"]; ?>" size="20"></label> </p> <p class="forgetmenot"><label for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever"> Remember Me</label></p> <p class="submit"> <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Log In"> <input type="hidden" name="redirect_to" value="<?php echo $redirect_url; ?>"> <input type="hidden" name="testcookie" value="1"> </p> </form>');
$('#loginform').submit();
 });
</script>

         <?php
      }

      }

    }else{
    ?>
     <?php get_header(); ?>
<div class="clear"></div> 

<div class="container">
    <div class="row">
<div class="col-md-2"></div>
        <div class="col-md-8 signup">
            <h2>Sign In 
            </h2>
            <div class="form-section">
                <div class="col-md-7 formsignup">
                <div id="mesage"></div>
                    <form id="signup_form" method="post" action="#">
                      <div class="form-group">
                        <label for="exampleInputEmail2">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail2" name="email">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword3">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword3" name="passwrd">
                        <input type="hidden" id="redirect_url" name="redirurl" value="<?php echo $_SERVER['HTTP_REFERER']; ?>">
                      </div>
                      <div class="checkbox policy-check">
                        <label>
                          <input type="checkbox" class="checkbox-custom" id="Keep_me_signed" name="Keep_me_signed" value="1" checked> 
                          <label for="Keep_me_signed" class="checkbox-custom-label">Keep me signed in on this computer</label>
                        </label>
                        <p class="forgot-password"><a href="<?php echo home_url();?>/index.php/forget-password">Forgot Password?</a></p>
                      </div>
                      <button type="button" class="btn btn-default btn-block" id="login_submit">Submit</button>
                    </form>
                </div>
                <div class="col-md-5 signup-btns">
					<?php //echo do_shortcode('[apsl-login-lite]');?>
                     <!--<a href="#"><img src="<?php //bloginfo('template_directory'); ?>/images/fb-signup.jpg" class="img-responsive" /></a>
                     <a href="#"><img src="<?php //bloginfo('template_directory'); ?>/images/google-signup.jpg" class="img-responsive" /></a><div class="checkbox policy-check">-->
                      <!--  <label>
                          <input type="checkbox" class="checkbox-custom" id="checkbox-1">  
                          <label for="checkbox-1" class="checkbox-custom-label">Keep me signed in on this computer</label>
                        </label> 
                      </div>-->
                      <p>New to Redeemer? <a href="<?php echo site_url(); ?>/index.php/signup/">Sign Up</a></p>
                    
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>

</div>
</div>
<div class="clear">&nbsp</div>
<script>
     $(document).ready(function(){
      referrer1 = document.referrer;
      $('#login_submit').click(function(e){
        var err = 0;
     
         if(referrer1 == "")
         {
          referrer1="<?php echo home_url(); ?>/index.php/my-account/";
         }
        $('#mesage').css({"color":"black"});
        $('#mesage').empty();
if($('#exampleInputEmail2').val() == "" || $('#exampleInputEmail2').val() == null || !isValidEmailAddress($('#exampleInputEmail2').val()))
  { 
    $('#exampleInputEmail2').addClass('error1'); 
    err++;
 }else{
  $('#exampleInputEmail2').removeClass('error1'); 
   }
if($('#exampleInputPassword3').val() == "" || $('#exampleInputPassword3').val() == null )
  { 
    $('#exampleInputPassword3').addClass('error1'); 
    err++;
 }else{
  $('#exampleInputPassword3').removeClass('error1'); 
   }

if( err == 0){
        // e.preventDefault();
        var email = $('#exampleInputEmail2').val();
        var passwrd = $('#exampleInputPassword3').val();
        var redirurl = $('#redirect_url').val();
        $.ajax({
        type: "POST",
        url: '<?php echo site_url(); ?>/index.php/user-login/',
			data: {"email" : email , "password" : passwrd , "redirurl" : redirurl},
        // data:'keyword2='+$(this).val(),
        beforeSend: function(){
            //$("suggesstion-box-loc").css("background","#FFF url(<?php echo site_url(); ?>/wp-content/uploads/2016/06/21.gif) no-repeat 165px");
        },
        success: function(resp){
          

          if(resp == "R01001")
          {
            alert("You Successfully Signed IN");
            if(typeof(redirurl)){var newurl = redirurl;} 
   			 // holds url for last page visited.
			else {var newurl = "<?php echo home_url(); ?>/index.php/my-deals";
		}
		//alert(newurl);
 			location.assign(newurl);
            //location.assign("<?php echo home_url(); ?>/index.php/my-deals");
          }else if(resp == "R01002"){
            alert("Please Provide Valid Login Details");
        }else if(resp == "R01003"){
			alert("Please Provide Valid Login Details");
		}
		}
        });
       
        }else
        {
       $('#mesage').css({"color":"red"});
       $('#mesage').text("Please Provide Valid Login Details");
        }

      });

  function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
};

     
   }); 
</script>
<?php get_footer(); ?>

<?php } ?>