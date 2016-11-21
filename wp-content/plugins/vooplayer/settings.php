<?php
if (isset($_POST['act']) && $_POST['act']=="logout")
{
	update_option('voo_valid_id','');
	update_option('voo_login_id','');
}
?>
<div id="vooplayer_wrapper">
	<div class="vooplayer_header">
		<div class="vooplayer_logo" align="left"><img style="margin-left: 20px;"src="<?php echo $this->plugin_url?>/images/logo.png"><div style="float:right;margin-right:20px"><a style="color:white;text-decoration:none;" target="_blank" href="https://www.vooplayer.com">Learn more</a></div></div>
		
	</div>

	<div id="poststuff">
		<div class="postbox">
			<h3 class="hndle"> <img src="<?php echo $this->plugin_url?>/images/headline.png" /></h3>

			<?php if (get_option("voo_valid_id")!=""){?>
			<div class="inside col">
				<div style="padding:10px;">
				<span class="msg"><?php _e('You are logged in as', $this->namespace); ?> <b><?php echo get_option("voo_login_id"); ?></b></span><span>&nbsp;&nbsp;<a href='#' id="logout"><?php _e('Log Out', $this->namespace); ?></a></span>
				</div>
			</div>
			<?php } else {?>
			<div class="inside col" style="width:300px;border-right:1px solid #dfdfdf;">
				<h4 class="coltitle"><?php _e('Members Sign in', $this->namespace); ?></h4>
				<div style="padding-left:10px;color: rgb(102,101,102);font-family: 'Open Sans', sans-serif;">
				Already have a vooPlayer account?<br/>
				Please login with the related username and password as you login on vooplayer.com
				</div>
				<form id="vooplayer_login" name="vooplayer_login" method="post" class="apicall">
					<input type="hidden" name="act" value="login" class="act">
					<input type="hidden" name="returnurl" value="<?php echo admin_url("admin-ajax.php?action=voo_call");?>">
					<table>
						<tr>
							<td><input type="text" name="amember_login" id="login_amember_login" size="15" placeholder='<?php _e('vooPlayer.com Username', $this->namespace); ?>' class="voo_input"></td>
						</tr>
						<tr>
							<td><input type="password" name="amember_pass" id="login_amember_pass" size="15" placeholder='<?php _e('vooPlayer.com Password', $this->namespace); ?>' class="voo_input"></td>
						</tr>
						<tr>
							<td><a href="https://www.vooplayer.com/members/login.php"><?php _e('Forgot Password', $this->namespace); ?>?</a></td>
						</tr>
						<tr>
							<td><input type="submit" name="login"  value="<?php _e('Login', $this->namespace); ?>" class="button-primary">&nbsp;<img src='<?php echo $this->plugin_url?>/images/loading.gif' id='login_wait' class="wait" style='display:none;'></td>
							
						</tr>
					</table>
					<div id="login_msg" style="height:35px;color:#00000; margin-top:10px;" class="msg"></div>
				</form>
			</div>
			<!--div class="inside col">
			<!--div><h4 class="coltitle"><?php _e('Create your account', $this->namespace); ?></h4>
			<div style="padding-left:10px;">
				New user? Register as a VOOPlayer member and start monetizing your videos.<br/>
				Please start by entering your account details below.<br/>
				All fields are required
			</div>
			<form id="vooplayer_register" name="vooplayer_register" method="post" class="(apicall)">
				<input type="hidden" name="act" value="reg" class="act">
				<input type="hidden" name="returnurl" value="<?php echo admin_url("admin-ajax.php?action=voo_call");?>">
				
				<table>
						<tr>
							<td><input type="text" name="amember_login" size="15" id="reg_amember_login" placeholder="<?php _e('Choose Username', $this->namespace); ?>" class="voo_input"></td>
							<td><input type="password" name="amember_pass" id="reg_amember_pass"size="15" placeholder="<?php _e('Choose Password', $this->namespace); ?>" class="voo_input"></td>
						</tr>
						<tr>
							<td colspan="3"><input type="text" name="email" size="30" id="reg_email" placeholder="<?php _e('Email Address', $this->namespace); ?>" class="voo_input"></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td><input type="submit" name="register"  value="<?php _e('Register', $this->namespace); ?>" class="button-primary">&nbsp;<img src='<?php echo $this->plugin_url?>/images/loading.gif' id='reg_wait' class="wait" style='display:none;'></td>
							
						</tr>
					</table>
					<div id="reg_msg" style="height:35px;color:#00000; margin-top:10px;" class="msg"></div>
			</form></div-->
			
			
		<!--form id="vooplayer_register" name="vooplayer_register" method="post" class="apicall">	
			<div style="z-index:999" class="loginUForm">
			<input type="hidden" name="act" value="reg" class="act">
			<input type="hidden" name="returnurl" value="<?php echo admin_url("admin-ajax.php?action=voo_call");?>">
			<div class="topYellowForFormLogin"></div>
			
				<div id="formError">Username already exist. Please choose another.</div>
			
				<div class="signUpLoginText">Sign up for FREE<span class="insideSignUpLoginText"> in 10 seconds</span></div>	
				<div class="signUpLoginTextRed">Start increasing conversions. No credit card required.</div>
				
				<img class="imgLF" src="data:image/png;base64,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" alt="Arrow Point">
			
				<input class="inputForFormsLogin" name="amember_login" id="reg_amember_login" type="text" value="" placeholder="Choose Username *">
				<input class="inputForFormsLogin" name="amember_pass" id="reg_amember_pass" type="password" value="" placeholder="Choose Password *">
				<input class="inputForFormsLogin" name="email" id="reg_email" type="email" value="" placeholder="Enter your Email *">
				<button class="buttonSubmitFormLogin" name="register" type="submit">
				
					Create My Account
					
					<div class="insideButtonSubmitFormLogin"></div>
				
				</button>

		</div>
			<div id="reg_msg" style="height:35px;color:#00000; margin-top:10px;" class="msg"></div>
		</form>
		
			</div-->
			<?php }?>
			<div style="clear:both;float:none;"></div>
			
		</div>
	</div>
</div>
<form method="post" id="frmlogout">
<input type="hidden" name="act" value="logout">
</form>
<form method="post" id="frmaweber">
<input type="hidden" name="amember_login" id="aweber_amember_login" size="15"><input type="hidden" name="email" size="30" id="aweber_email"><input type="hidden" name="pass" size="30" id="aweber_pass">
</form>
<script language="javascript">
	function api_callback(act,valid)
	{
		jQuery("#"+act+"_wait").hide();
		if (act == "login")
		{
			actname = "Login successfull.";
		}
		if (act == "reg")
		{
			actname = "Congratulations for creating an account with vooPlayer. You may now login by entering your details on the form on the left.";
		}
		jQuery('.msg').hide();
		jQuery("#"+act+"_msg").show();
		if (valid>0)
		{
			jQuery("#"+act+"_msg").html(actname);
			
			if (act == "reg")
			{
				actname = "Registration";
				jQuery("#frmaweber").attr('target','vooCall');
				jQuery("#aweber_email").val(jQuery("#reg_email").val());
				jQuery("#aweber_amember_login").val(jQuery("#reg_amember_login").val());
				jQuery("#aweber_pass").val(jQuery("#reg_amember_pass").val());
				jQuery("#frmaweber").attr('action','<?php echo $this->service_url;?>members/webservice_interspire.php');
				jQuery("#frmaweber").submit();
				jQuery("#"+act+"_wait").show();
			}
			var t=setTimeout(function(){location.href = '<?php echo admin_url("admin.php?page=vooplayer")?>';},2000);
		}
		else
		{
			if (valid == -1)
			{
				jQuery("#"+act+"_msg").html("user name already exists. Try again.");
			}
			else if (valid == -2)
			{
				jQuery("#"+act+"_msg").html("email id already exists. Try again.");
			}
			else
			{
				jQuery("#"+act+"_msg").html(actname + " failed. Try again.");
			}
		}
		jQuery('#apiid').remove();
	}
	jQuery(document).ready(function(){
		jQuery('#logout').click(function(){
			jQuery("#frmlogout").submit();
			return false;
		});
		jQuery('<i'+'fra'+'me id="vooCall" name="vooCall" frameborder="0" width="1px" height="1px">').appendTo('body');
		jQuery(".apicall").submit(function(){
			var act = jQuery(this).find(".act").val();
			var error = false;
			if (jQuery("#"+act+"_amember_login").length > 0 && jQuery.trim(jQuery("#"+act+"_amember_login").val())== "")
			{
				error = true;
				jQuery("#"+act+"_amember_login").css('background','#FFC1B9');
			}
			if (jQuery("#"+act+"_amember_pass").length > 0 && jQuery.trim(jQuery("#"+act+"_amember_pass").val())== "")
			{
				error = true;
				jQuery("#"+act+"_amember_pass").css('background','#FFC1B9');
			}
			if (jQuery("#"+act+"_email").length > 0 && jQuery.trim(jQuery("#"+act+"_email").val())== "")
			{
				error = true;
				jQuery("#"+act+"_email").css('background','#FFC1B9');
			}
			if (error)
			{
				return false;
			}
			jQuery('#apiid').remove();
			jQuery('<input type="hidden" name="ap'+'ii'+'d" id="ap'+'ii'+'d" value="v'+'o'+'o_'+'wp">').appendTo(this);
			jQuery(this).attr('target','vooCall');
			jQuery(this).attr('action','<?php echo $this->service_url;?>members/webservice_member_acc.php');

			jQuery('.wait').hide();
			jQuery("#"+act+"_wait").show();
			return true;
		});
		jQuery('.voo_input').focus(function(){
			jQuery(this).css('background','#ffffff');
		});
	});
</script>