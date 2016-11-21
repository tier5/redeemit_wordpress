<?php
/* Template Name: SignUp
*/
if ( is_user_logged_in() ) {
$home = home_url();
header("Location: $home");
}

// $msg = "";
// if(isset($_POST['email'])&& !empty($_POST['email']))
// {
// $get_user = "SELECT *  from users  where email = '".$_POST['email']."'";
// $get_user1=$wpdb->get_results($get_user,ARRAY_A);

//   if(isset($get_user1) && !empty($get_user1))
//   {
//     $msg = "User with this email id already exist.";
//   }else
//   {


//      $first_name = $_POST['first_name'];
//      $last_name = $_POST['last_name'];
//      $email = $_POST['email'];
//      $password = $_POST['password'] ;
     // $password = bcrypt($_POST['password']);
     // $status = 1;
     // $approve = 1;
     // $source = 1;
     // $type = 3;

 //  $signup_data="INSERT INTO users (first_name,last_name,email,password,status,approve,source,type)values($first_name,$last_name,$email,$password,$status,$approve,$source,$type)";

 // echo $signup_data;




// ['email' => $email, 'password' => $password, 'status' => $status , 'approve' => $approve ,  'device_token' => $device_token , 'source' => $source , 'type' => 3]
  
  //}

//}

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
  .error1
  {
    border: 1px solid red ! important;
  }
  .red
  {
    color:red;
  }
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
                        <div class="logo"><a href="<?php echo site_url(); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" alt="redeemar" title="redeemar"></a></div>
                        <div class="top-right-menu">
                            <ul>
                               <?php wp_nav_menu(array('theme_location'=>'top-menu'));  ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
    </header>
<div class="clear"></div> 

<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 signup">
            <h2>Sign Up 
            <!-- <span>or <a href="<?php echo site_url(); ?>/index.php/signin/">Sign In</a></span> -->
            </h2>
            <div class="form-section">
                <div class="col-md-7 formsignup">
                    <form id="sign_in_form" method="post" action="#" name="sign_in_form">
                      <div class="form-group">
                      <div id="disp_message"><?php echo $msg; ?></div>
                        <label for="exampleInputName2">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name">
                        <div id="first_name_msg" class="red"></div>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName2">Last Name</label>
                        <input type="text" class="form-control" id="Last_name" name="Last_name" >
                        <div id="Last_name_msg" class="red"></div>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail2">Email</label>
                        <input type="email" class="form-control" id="email" name="email" >
                        <div id="email_msg" class="red"></div>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword3">Password</label>
                        <input type="password" class="form-control" id="password" name="password" >
                        <div id="password_msg" class="red"></div>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword3">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password">
                        <div id="confirm_password_msg" class="red"></div>
                      </div>
                      <!--<div class="checkbox policy-check">
                        <label>
                          <input type="checkbox" class="checkbox-custom" id="checkbox-2" checked> 
                          <label for="checkbox-2" class="checkbox-custom-label">Keep me signed in on this computer</label>
                        </label>
                        <p class="forgot-password"><a href="forgot-password.html">Forgot Password?</a></p>
                      </div>-->
                      <div class="checkbox policy-check">
                        <label>
                          <input type="checkbox" class="checkbox-custom" id="checkbox-3"> 
                          <label for="checkbox-3" class="checkbox-custom-label" id="checkbox_msg">I agree to the Terms of Use and Privacy Statement</label>
                        </label>
                        <div id="checkbox-3_msg" class="red"></div>
                      </div>
                      <button type="button" class="btn btn-default btn-block" id="sign_up_btn" >Sign up</button>
                    </form>
                </div>
                <div class="col-md-5 signup-btns">
					<?php //echo do_shortcode('[apsl-login-lite]');?>
                     <a href="#"><img src="<?php echo get_template_directory_uri(); ?>//images/fb-signup.jpg" class="img-responsive" /></a>
                     <a href="#"><img src="<?php echo get_template_directory_uri(); ?>//images/google-signup.jpg" class="img-responsive" /></a><div class="checkbox policy-check">
                        <!-- <label>
                          <input type="checkbox" class="checkbox-custom" id="checkbox-1">  
                          <label for="checkbox-1" class="checkbox-custom-label">Keep me signed in on this computer</label> 
                        </label>
                      </div>-->
                      <p>Already have a Redeemer Account? <a href="<?php echo site_url(); ?>/index.php/signin/">Sign In</a></p>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
</div>	
<div class="clear"></div>
<script   src="https://code.jquery.com/jquery-1.12.4.min.js"   crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function(){


 $("#sign_up_btn").click(function(){

  var err = 0;
  var j = 0;
  var k = 0;
$('#disp_message').empty();
$msg="";
if(  $("#first_name").val() == "" ||  $("#first_name").val() == null )
  { 
    $("#first_name").addClass('error1'); 
    err++;
    $("#first_name_msg").text("This Field is Required");
 }else if(/[^a-zA-Z\-\/]/.test( $("#first_name").val() )){
	  $("#first_name").addClass('error1'); 
    err++;
    $("#first_name_msg").text("Please enter valid first name");
 
   }else{
	    $("#first_name").removeClass('error1'); 
       $("#first_name_msg").text("");
   }

 if(  $("#Last_name").val() == "" ||  $("#Last_name").val() == null  )
  { 
    $("#Last_name").addClass('error1'); 
    $("#Last_name_msg").text("This Field is Required");
    err++;
 }else if(/[^a-zA-Z\-\/]/.test( $("#Last_name").val() )){
	  $("#Last_name").addClass('error1'); 
    $("#Last_name_msg").text("Please enter valid last name");
    err++;
 
   }else{
	    $("#Last_name").removeClass('error1'); 
  $("#Last_name_msg").text("");
   }
   
 if(  $("#email").val() == "" ||  $("#email").val() == null)
  { 
    $("#email").addClass('error1'); 
    $("#email_msg").text("This Field is Required");
    
    err++;
 }else if(!isValidEmailAddress( $("#email").val())){
		   $("#email").addClass('error1'); 
    $("#email_msg").text("Please enter valid email address");
    
    err++;
  
   }else{
		$("#email").removeClass('error1'); 
  $("#email_msg").text("");				 
						 
	}
   
 if(  $("#password").val() == "" ||  $("#password").val() == null )
  { 
    $("#password").addClass('error1');
    $("#password_msg").text("This Field is Required");
    err++;
 }else{
  $("#password").removeClass('error1'); 
  $("#password_msg").text("");
    j = 1;
   }

   if(  $("#confirm_password").val() == "" ||  $("#confirm_password").val() == null )
  { 
    $("#confirm_password").addClass('error1');
    $("#confirm_password_msg").text("This Field is Required");
    err++;
 }else{
  $("#confirm_password").removeClass('error1'); 
  $("#confirm_password_msg").text("");
   k = 1;
   }

 if(  k == 1 && j == 1){
if( $("#confirm_password").val() != $("#password").val()  )
  { 
 err++;
 $("#password_msg").text("password and confirm password not same"); 
  $("#password").addClass('error1'); 
  $("#confirm_password").addClass('error1'); 
  }
  else
  {
 $("#password").removeClass('error1'); 
 $("#confirm_password").removeClass('error1'); 
 $("#password_msg").text(""); 

  }
 }

 if($("#checkbox-3:checked").length  == 0)
 {
  $("#checkbox_msg").css({'color':'red'}); 
  $("#checkbox-3_msg").text("Please checked the checkbox");
 err++;
}  else
{
  $("#checkbox-3").css({'color':'black'});
  $("#checkbox-3_msg").text("");
}
   if( err == 0){  
//$('#sign_in_form').submit();
var first_name = $("#first_name").val();
var lastname = $("#Last_name").val();
var email = $("#email").val();
var password = $("#password").val();

        $.ajax({
        type: "POST",
        url: '<?php echo site_url(); ?>/index.php/user-register/',
		data: {"webservice_name":"userregister","first_name":first_name,"lastname":lastname,"email":email,"password":password,"device_token":"","source":"web"},
        //data:"{'webservice_name':'bankoffer','user_id':1,'offer_id':6}",
      
        success: function(resp){ 
          if(resp == "R01001")
          {
            alert("You Successfully Signed UP");
            location.assign("<?php echo home_url(); ?>");
          }
          if(resp == "R01002")
          {
            
            $("#email_msg").text("This email already Registered");
          }
        }
        });
      }
    
    });
  
  function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
};

 });
</script>
<?php get_footer(); ?>
