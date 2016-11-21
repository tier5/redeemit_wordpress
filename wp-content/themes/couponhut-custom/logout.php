<?php 
/*Template Name:Logout Page
*/

wp_logout(); 
$home = home_url();
header("Location: $home");

?>