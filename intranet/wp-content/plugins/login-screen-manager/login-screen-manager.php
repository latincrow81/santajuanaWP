<?php
/*
Plugin Name: Login Screen Manager
Plugin URI: http://www.SuperbCodes.com/
Description: Using Login Screen Manager in your Wordpress site you can easily customize your login screen.You can add your own logo to the login screen,change styles and colors of the different elements of the login screen.You can add your custom css code.It has colorpicker so you don't need to worry about the color codes.It also has shortcode feature.If you type %BLOG_URL% or %BLOG_NAME% in setting inputs it will replace those with your site url and site title.
Tags: login screen,login logo,wp-login.php,admin,Nazmul Hossain Nihal,logos,login screen manager,SuperbCodes
Version: 3.5
Author:	Nazmul Hossain Nihal
Author URI: http://www.SuperbCodes.com/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/load_plugin_textdomain('cwlsm', false, basename( dirname( __FILE__ ) ) . '/languages' );
/******************************* global variables******************************/

$cwlsm_options = get_option('cwlsm_settings');
/******************************* includes******************************/
require_once('inc/admin.php'); //Admin Panel
require_once('inc/display.php'); //Display
?>