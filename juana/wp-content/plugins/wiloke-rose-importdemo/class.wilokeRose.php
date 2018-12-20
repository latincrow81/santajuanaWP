<?php
/*
Plugin Name: Wiloke - Rose Importer
Author: wiloke
Plugin URI: http://themeforest.net/user/wiloke
Author URI: http://themeforest.net/user/wiloke
Version: 1.0
Description: Import Your Website Look like Demo
*/


if ( !class_exists('wilokeRoseImporter') )
{

	define('PI_PF_DIR', plugin_dir_path(__FILE__));
	define('PI_PF_URI', plugin_dir_url(__FILE__));

	class wilokeRoseImporter
	{
	    public $piaDefaultConfigs = array();
	    public $importMenuSlug = "wiloke-rose-import-demo";
	    public $aConfigs = array(
	    	'menus' => array(
	    		'menu_id' 	=> 'main-menu',
	    		'menu_name' => 'Rose Menu'
	    	),
	    	'theme_name' 	=> 'Rose',
	    	'themeoptions' 	=> 'rose_option',
	    	'homepage'		=> 'portfolio-1',
	    	'blogpage'		=> 'blog'	
	    );

	    public function __construct()
	    {
	        add_action('admin_menu', array($this, 'pi_add_submenu'));
	        add_action('admin_enqueue_scripts', array($this, 'pi_enqueue_scripts'));
	        add_action('wp_ajax_wiloke-import', array($this, 'pi_parse_before_import')); 
	    }

	    
	    public function pi_enqueue_scripts()
	    {
	        $screen = get_current_screen();

	        if ( isset($screen->id) && preg_match("/$this->importMenuSlug/", $screen->id) )
	        {  
	            wp_register_style('pi-bootstrap-customized', PI_PF_URI . 'import/source/css/bootstrap.css', array(), '1.0');
	            wp_enqueue_style('pi-bootstrap-customized');

	            wp_enqueue_style('pi-rose-importer', PI_PF_URI . 'import/source/css/style.css', array(), '1.0');

	            wp_register_script('pi-import', PI_PF_URI . 'import/source/js/pi.import-demo.js', array(), '1.0', true);
	            wp_enqueue_script('pi-import');
	        }
	    }

	    public function pi_add_submenu()
	    {
	        add_menu_page('Rose Importer', 'Rose Importer', 'edit_theme_options', $this->importMenuSlug, array($this, 'pi_setting_demo'), 'dashicons-download');  
	    }

	    public function pi_setting_demo()
	    {
	        include ( PI_PF_DIR . 'import/tpl.demo-builder.php' );
	    }

	    public function pi_parse_before_import()
	    {
	        if ( check_ajax_referer('wo-nonce', '_wp_nonce') && isset($_REQUEST['_wp_http_referer']) &&  preg_match("/page={$this->importMenuSlug}/i",$_REQUEST['_wp_http_referer']) )
	        {
	           
	            if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);
	                require_once ABSPATH . 'wp-admin/includes/import.php';
	            $importer_error = false;
	            if ( !class_exists( 'WP_Importer' ) ) {
	                $class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
	                if ( file_exists( $class_wp_importer ) ){
	                    require_once($class_wp_importer);
	                }
	                else{
	                    $importer_error = true;
	                }
	            }

	            if ( !class_exists( 'WP_Import' ) ) {
	                $class_wp_import = PI_PF_DIR . 'import/class.wp-importer.php';
	                if ( file_exists( $class_wp_import ) )
	                    require_once($class_wp_import);
	                else
	                    $importerError = true;
	            } 

	            if($importer_error){
	                echo "<div class=\"alert-box alert-error updated rs-update-error-wrap\"><strong>Error!</strong> The Auto importing script could not be loaded. please use the wordpress importer and import the XML file that is located in your themes folder manually. :(</div>";
	                exit();
	            }else{
	                if ( class_exists( 'WP_Import' ))
	                {
	                    include_once( PI_PF_DIR . 'import/class.piFuncImporter.php');
	                }
	                if(!is_file( PI_PF_DIR . 'import/demo_data.xml')){
	                    echo "<div class=\"alert-box alert-error updated rs-update-notice-wrap\"><strong>Error!</strong> The XML file containing the dummy content is not available or could not be read .. You might want to try to set the file permission to chmod 755.<br/>If this doesn't work please use the wordpress importer and import the XML file (should be located in your download .zip: Sample Content folder) manually :(</div>";
	                    exit();
	                }
	                else{  
	                    $wp_import = new piFuncImporter($this->aConfigs);
	                    
	                    $wp_import->checkMenuExists();
	                    $wp_import->fetch_attachments = true;
	                    $wp_import->import( PI_PF_DIR . 'import/demo_data.xml' );
	                    $wp_import->set_menus($this);
	                    $wp_import->update_theme_options($this);
						$wp_import->update_static_page($this);
	                }

	                echo "<div class=\"alert-box updated rs-update-notice-wrap\"><strong>Success!</strong> Import Demo Ok :))</div>";
	            }
	        }else{
	            echo '<div class="alert-box updated error">Opp! Import Error:(</div>';
	        }

	        die();
	    }
	}

	new wilokeRoseImporter;

}