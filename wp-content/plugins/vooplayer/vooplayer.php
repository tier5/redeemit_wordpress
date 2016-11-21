<?php
/*
Plugin Name: VOOplayer - Ultimate Video Player for WordPress
Plugin URI: http://www.vooplayer.com
Description: The official #1 most powerful video player to customize, analyze and optimize FLV, MP4 and YouTube videos is now available on WordPress.
Author: IMW Enterprises Ltd.
Version: 3.0.3
*/
?>
<?php
class Vooplayer
{
	var $plugin_base;
	var $plugin_name;
	var $plugin_dir;
	var $plugin_url;
	var $namespace;
	var $min_words_per;
	var $max_words_per;
	//var $service_url = "http://183.177.126.17/vooplayer/";
	var $service_url = "https://www.vooplayer.com/";
	function __construct() {
		$this->plugin_base =  plugin_basename( __FILE__ );
		$this->plugin_name = trim( dirname( $this->plugin_base ), '/' );
		$this->plugin_dir = WP_PLUGIN_DIR . '/' . $this->plugin_name;
		$this->plugin_url = WP_PLUGIN_URL . '/' . $this->plugin_name;
		$this->namespace = "vooplayer";
		// Hooks
		add_action('admin_menu', array($this,'admin_menu'));
		add_shortcode("vooplayer",array($this,'show_player'));	
		add_shortcode("VOOPLAYER",array($this,'show_player'));	
		wp_enqueue_script('jquery');
		wp_enqueue_style($this->namespace."_css",$this->plugin_url."/style.css");
		add_action('init', array($this,'add_vooplayer_button'));
	}

	function admin_menu() 
	{
		if ( current_user_can( 'list_users' )){
			add_menu_page( __( 'vooPlayer', $this->namespace), __( 'vooPlayer', $this->namespace ), 8, $this->namespace, array($this,'my_vooplayer'),$this->plugin_url."/images/icon.jpg");
			add_submenu_page($this->namespace, __( 'Create Video', $this->namespace ), __( 'Video Dashboard', $this->namespace ),8, $this->namespace, array($this,'my_vooplayer'));
			//add_submenu_page($this->namespace, __( 'My Videos', $this->namespace ), __( 'My Videos', $this->namespace ),8, $this->namespace."_videos", array($this,'list_videos'));
			//add_submenu_page($this->namespace, __( 'Split Tests', $this->namespace ), __( 'Split Tests', $this->namespace ),8, $this->namespace."_split_tests", array($this,'split_tests'));
			add_submenu_page($this->namespace, __( 'Settings', $this->namespace ), __( 'Settings', $this->namespace ),8, $this->namespace."_settings", array($this,'settings')); 
			add_submenu_page($this->namespace, 'Help','Help',8, $this->namespace."_help", array($this,'help')); 
		}
		else
		{
		}
		
	}
	
	function help()
	{
		echo "<script language='javascript'>window.open('https://vooplayer.helpscoutdocs.com');</script>";
	}

	function settings()
	{
		include("settings.php");
	}

	function my_vooplayer()
	{
		if (get_option("voo_valid_id") == '')
		{
			echo "<script language='javascript'>location.href = '".admin_url('admin.php?page=vooplayer_settings')."';</script>";
			exit();
		}
		include("showvoo.php");
	}

	function list_videos()
	{
	}
	function split_tests()
	{
	}

	public $tabs = array(
		// The assoc key represents the ID
		// It is NOT allowed to contain spaces
		 'LOGIN' => array(
		 	 'title'   => 'Login'
		 	,'content' => 'This screen will validate your vooPlayer account login details and authenticate you to operate your vooPlayer account here. <br/>You have to validate your vooPlayer account login details only once.<br/>You can change associated vooPlayer account any time by login in from this screen.<br/><br/>Username - Your vooPlayer account Username.<br/>Password - Your vooPlayer account Password.'
		 ),
		 'FORGOT' => array(
		 	 'title'   => 'Lost Password?'
		 	,'content' => 'You will be redirected to vooPlayer web site to retrieve password.<br/><br/>Password will be e-mailed to you.'
		 ),
		 'Register' => array(
		 	 'title'   => 'New User'
		 	,'content' => 'You can create your vooPlayer Free account using this screen. You can operate your vooPlayer account directly on vooPlayer web site using these account details.<br/></br>Username - Your vooPlayer account Username.<br/>Password - Your vooPlayer account Password.<br/>Email Address - Email address associated with your vooPlayer account.All communication will be done on this email address.'
		 )
	);

	public function add_tabs($contextual_help, $screen_id, $screen)
	{
		if (strpos($screen_id, "vooplayer")!==false)
		{
			foreach ( $this->tabs as $id => $data )
			{
				get_current_screen()->add_help_tab( array(
					 'id'       => $id
					,'title'    => __( $data['title'], $this->namespace )
					// Use the content only if you want to add something
					// static on every help tab. Example: Another title inside the tab
					,'content'  => '<p><u>This plugin is only a interface to operate your vooPlayer account in Wordpress Admin.</u></p>'
					,'callback' => array( $this, 'prepare' )
				) );
			}
		}
	}

	public function prepare( $screen, $tab )
	{
	    	printf( 
			 '<p>%s</p>'
			,__( 
	    			 $tab['callback'][0]->tabs[ $tab['id'] ]['content']
				,'dmb_textdomain' 
			 )
		);
	}

	public function api_callback()
	{
		$valid = 0;
		if ($_REQUEST["mid"] >0)
		{
			update_option('voo_valid_id',$_REQUEST["mid"]);
			update_option('voo_login_id',$_REQUEST["name"]);
			$valid = 1;
		}
		else if ($_REQUEST["mid"] < 0)
		{
			$valid = $_REQUEST["mid"];
		}
		echo "<script language='javascript'>window.parent.api_callback('".$_REQUEST["act"]."','".$valid."');</script>";		
		exit();
	}
	
	function show_player( $atts)
	{
		if (!isset($atts['width']) || $atts['width'] < 1)
			$atts['width'] = 543;
		if (!isset($atts['height']) || $atts['height'] < 1)
			$atts['height'] = 408;
		return "<script src='".$this->service_url."videoplayer/video.js'></script><iframe id='vooplayerframe' name='vooplayerframe' src='".$this->service_url."v3/watch/watch.php?v=".$atts['vooid']."' frameborder='0' scrolling='no' width='".$atts['width']."' height='".$atts['height']."'></iframe>";
	}

	/*Editor Button*/
	function add_vooplayer_button() {
		// Don't bother doing this stuff if the current user lacks permissions
	    if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;
		// Add only in Rich Editor mode
		if ( get_user_option('rich_editing') == 'true') {
			add_filter("mce_external_plugins", array($this,"add_vooplayer_tinymce_plugin"));
			add_filter('mce_buttons', array($this, 'register_vooplayer_button'));
		}
	}
	 
	function register_vooplayer_button($buttons) {
	   array_push($buttons, "|", "vooplayer");
	   return $buttons;
	}
	 
	// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
	function add_vooplayer_tinymce_plugin($plugin_array) {
		global $pluginName, $persiteurl;
		$plugin_array['vooplayer'] = $this->plugin_url."/js/editor_plugin.js";
		return $plugin_array;
	}

	function videolist()
	{
		include('videolist.php');
		exit();
	}

/*Activation notice*/

	function activation_notice(){
		if(function_exists('admin_url')){
			echo '<div class="update-nag">'.__( 'Please', $this->namespace ).' <a href="' . admin_url( 'options-general.php?page='.$this->plugin_name ) . '">'.__( 'Click here', $this->namespace ).'</a> '.__( 'to Login or register to vooPlayer.', $this->namespace ).'.</div>';
		}
	}		

}

$Vooplayer = new Vooplayer();
add_filter('contextual_help', array($Vooplayer,'add_tabs'), 10, 3);
add_action('wp_ajax_voo_call', array($Vooplayer,'api_callback'));
add_action('wp_ajax_nopriv_voo_call', array($Vooplayer,'api_callback'));
add_action('wp_ajax_voo_videolist', array($Vooplayer,'videolist'));
if(get_option("voo_valid_id")==""){
	add_action( 'admin_notices', array($Vooplayer,'activation_notice'));
}
?>