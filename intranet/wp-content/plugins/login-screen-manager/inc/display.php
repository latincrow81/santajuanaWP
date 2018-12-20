<?php 
	function cwlsm_change() {
		
	global $cwlsm_options;
	
	$shortcodes = array("%BLOG_NAME%","%BLOG_URL%");
	$longcodes = array(get_bloginfo("name"),get_bloginfo("wpurl"));
	
	$cwlsm_options["logo_url"] = str_replace($shortcodes,$longcodes,$cwlsm_options["logo_url"]);
	$cwlsm_options["fav_icon_url"] = str_replace($shortcodes,$longcodes,$cwlsm_options["fav_icon_url"]);
	$cwlsm_options["hover_title"] = str_replace($shortcodes,$longcodes,$cwlsm_options["hover_title"]);
	$cwlsm_options["url"] = str_replace($shortcodes,$longcodes,$cwlsm_options["url"]);
	$cwlsm_options["css"] = str_replace($shortcodes,$longcodes,$cwlsm_options["css"]);
	
	
	
	ob_start(); ?>
	<!-- Login Screen Manager Start -->
	
	<!-- Login Screen Manage : Version 3.5 -->
	
	<?php if(!empty($cwlsm_options["logo_url"])): ?>
	
	<style type="text/css">
	/* Login Screen Manager : Css : Change Logo */
	.login h1 a { background-image:url('<?php echo $cwlsm_options["logo_url"];  ?>')!important; }
	<?php list($cwwidth, $cwheight, $cwtype, $cwattr) = getimagesize($cwlsm_options["logo_url"]); ?>
	.login h1 a{ height:<?php echo $cwheight; ?>px!important; width:<?php echo $cwwidth; ?>px!important;}
	.login h1 a{ background-size:100% 100%!important;}
	.login h1{margin:0px!important;}
	</style>
	
	<?php endif;?>
	<?php if(!empty($cwlsm_options["body_bg_color"])): ?>
	
	<style type="text/css">
	/* Login Screen Manager : Css : Change Body Background Color*/
	body.login { background-color:<?php echo$cwlsm_options["body_bg_color"];  ?>; }
	</style>
	
	<?php endif;?>
	<?php if(!empty($cwlsm_options["login_form_bg_color"])): ?>
	
	<style type="text/css">
	/* Login Screen Manager : Css : Change Login Form Background Color*/
	#loginform,#registerform { background-color:<?php echo$cwlsm_options["login_form_bg_color"];  ?>; }
	</style>
	
	<?php endif;?>
	<?php if(!empty($cwlsm_options["label_color"])): ?>
	
	<style type="text/css">
	/* Login Screen Manager : Css : Change Label Color*/
	#loginform label,#registerform label,#reg_passmail{ color:<?php echo$cwlsm_options["label_color"];  ?>; }
	</style>
	
	<?php endif;?>
	<?php if(!empty($cwlsm_options["text_input_color"])): ?>
	
	<style type="text/css">
	/* Login Screen Manager : Css : Change Input Text Color*/
	#loginform input[type="text"],#loginform input[type="password"],#registerform input[type="text"],#registerform input[type="password"]{ color:<?php echo$cwlsm_options["text_input_color"];  ?>; }
	</style>
	
	<?php endif;?>
	<?php if(!empty($cwlsm_options["input_bg_color"])): ?>
	
	<style type="text/css">
	/* Login Screen Manager : Css : Change Input Background Color*/
	#loginform input[type="text"],#loginform input[type="password"],#registerform input[type="text"],#registerform input[type="password"]{ background-color:<?php echo$cwlsm_options["input_bg_color"];  ?>; }
	</style>
	
	<?php endif;?>
	<?php if(!empty($cwlsm_options["css"])): ?>
	
	<style type="text/css">
	/* Login Screen Manager : Custom Css Start*/
		
		<?php echo $cwlsm_options["css"]; ?>
		
	/* Login Screen Manager : Custom Css End*/
	</style>
	
	<?php endif;?>
	<?php if(!empty($cwlsm_options["fav_icon_url"])): ?>
	
	<!-- Login Favicon Start -->
	
	<link rel="icon" href="<?php echo $cwlsm_options["fav_icon_url"];  ?>" type="image/x-icon" />
	
	<!-- Login Favicon End -->
	
	<?php endif;?>
	<!-- Login Screen Manager End -->
	<?php
		echo ob_get_clean();
	}
	add_action('login_head', 'cwlsm_change');
	 
	function cwlsm_change_title(){
		global $cwlsm_options;
		return  $cwlsm_options["hover_title"];
	}
	
	if(!empty($cwlsm_options["hover_title"])){
		add_action('login_headertitle', 'cwlsm_change_title');
	}
	
	$shortcodes = array("%BLOG_NAME%","%BLOG_URL%");
	$longcodes = array(get_bloginfo("name"),get_bloginfo("wpurl"));
	
	$cwlsm_url = str_replace($shortcodes,$longcodes,$cwlsm_options["url"]);
	 
	function cwlsm_change_url(){
		global $cwlsm_url;
		return  $cwlsm_url;
	}
	
	if(!empty($cwlsm_options["url"])){
		add_action('login_headerurl', 'cwlsm_change_url');
	}
?>