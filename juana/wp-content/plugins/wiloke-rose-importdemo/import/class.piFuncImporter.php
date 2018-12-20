<?php
if ( class_exists( 'WP_Import' ))
{
    class piFuncImporter extends WP_Import
    {
        public $theme_options_name;
        public $default_configs;
        public $aErrors = array();
        public function __construct($aConfigs)
        {
            parent::__construct();
            $this->default_configs = $aConfigs;
        }

        public function set_widgets()  
        {
            if(isset($this->default_configs['widgets']) && is_array($this->default_configs['widgets']) && count($this->default_configs['widgets'])>0)
            {
                update_option('sidebars_widgets', '');
                foreach( $this->default_configs['widgets'] as $sidebar => $widgets )
                {
                    if( is_array($widgets) && count($widgets)>0 )
                    {
                        foreach( $widgets as $widget => $options )
                        {
                            $this->add_widget_sidebar($sidebar,$widget,$options[0],$options[1]);
                        }
                    }
                }
            }
        }

        public function checkMenuExists()
        {
            //get all registered menu locations
            $locations = get_theme_mod('nav_menu_locations');

            $theme_locations = get_nav_menu_locations();

            $menuExist = false;
           
            $menuID = $this->default_configs['menus']['menu_id'];

            if ( $theme_locations && !empty($theme_locations) )
            {
                if ( array_key_exists($menuID, $theme_locations) )
                {
                    $menuExist = true;
                }
            }

            if ($menuExist) :
                /* If menu already exist, reset menu */
                $term_id = $theme_locations[$menuID];
                $getMenuItems = wp_get_nav_menu_items($term_id);   

                if ( $getMenuItems && !empty($getMenuItems) )
                {
                    foreach ($getMenuItems as $controlMenuId) 
                    {
                        wp_delete_post($controlMenuId->ID);
                    }
                }
            endif;   
        }


        public function set_menus($field)
        {
            $menuID = $field->aConfigs['menus']['menu_id']; 
            $created_menus = wp_get_nav_menus();
            $founded = false;
            $aMenuLocation = array();

            if( !empty($created_menus) && is_array($field->aConfigs['menus']) )
            {

                foreach($created_menus as $menu) 
                {
                    if(is_object($menu))
                    {
                        if($menu->name == $field->aConfigs['menus']['menu_name'])
                        {
                            //if we have found a menu with the correct menu name apply the id to the menu location
                            $locations[$menuID] = $menu->term_id;
                            echo "<p class=\"success alert-box updated\">Set default menu successfully!</p>";
                            set_theme_mod( 'nav_menu_locations', $locations);
                            $founded = true;
                        }
                    }
                }
            }
            if(!$founded)
            {
                echo "<p class=\"error  alert-box\">Can not set default menu!</p>";
            }    
        }

        
        public function pi_normalize_newline_deep( $arr, $to = "\n" ) {
            if ( is_array( $arr ) ) {
                $result = array();

                foreach ( $arr as $key => $text )
                    $result[$key] = $this->pi_normalize_newline_deep( $text, $to );

                return $result;
            }

            return $this->pi_normalize_newline( $arr, $to );
        }

        public function pi_normalize_newline( $text, $to = "\n" ) {
            if ( ! is_string( $text ) )
                return $text;

            $nls = array( "\r\n", "\r", "\n" );

            if ( ! in_array( $to, $nls ) )
                return $text;

            return str_replace( $nls, $to, $text );
        }

        public function add_widget_sidebar($sidebarSlug, $widgetSlug, $countMod, $widgetSettings = array())
        {
            $sidebarOptions = get_option('sidebars_widgets');
            if(!isset($sidebarOptions[$sidebarSlug])){
                $sidebarOptions[$sidebarSlug] = array('_multiwidget' => 1);
            }
            $newWidget = get_option('widget_'.$widgetSlug);
            if(!is_array($newWidget))$newWidget = array();
            $count = count($newWidget)+1+$countMod;
            $sidebarOptions[$sidebarSlug][] = $widgetSlug.'-'.$count;

            $newWidget[$count] = $widgetSettings;

            update_option('sidebars_widgets', $sidebarOptions);
            update_option('widget_'.$widgetSlug, $newWidget);
        }

        public function remove_all_posts() 
        {   
            $posts = get_posts( array("post_type"=>"post", "posts_per_page"=>-1) );

            foreach ( $posts as $post ) : setup_postdata($post);
                wp_delete_post($post->ID, true);
            endforeach;wp_reset_postdata();

            $pages = get_posts( array("post_type"=>"page", "posts_per_page"=>-1) );

            foreach ( $pages as $page ) : setup_postdata($page);
                wp_delete_post($page->ID, true);
            endforeach;wp_reset_postdata();

            $portfolios = get_posts( array("post_type"=>"tip", "posts_per_page"=>-1) );

            foreach ( $portfolios as $portfolio ) : setup_postdata($portfolio);
                wp_delete_post($portfolio->ID, true);
            endforeach;wp_reset_postdata();
        }

        public function update_theme_options($field)
        {
            $aFiles = array("pi_options"=>"themeoptions.php");

            foreach ( $aFiles as $key => $file )
            {
                $directFile  = PI_PF_DIR . 'import/'. $file;

                if ( !file_exists($directFile) )
                {
                    $aErrors[] = "<p class='error alert-box updated'>File do not exist!</p>";
                }else{
                    $getContent = file_get_contents($directFile);
                    if ( !empty($getContent) )
                    {
                        $content = base64_decode($getContent);
                        $content = unserialize($content);
                        delete_option($key);
                        if ( !$content  )
                        {
                            $content = array();
                        }
                        update_option($field->aConfigs['themeoptions'], $content);
                    }else{
                        $aErrors[] = '<p class="error alert-box updated">Empty the  data</p>';
                    }
                }
            }

            if ( !empty($aErrors) )
            {
                foreach ($aErrors as $error)
                {
                    echo $error . "\n";
                }
            } 
        }

        public function update_static_page($field)
        {

            if ( isset($field->aConfigs['homepage']) && !empty($field->aConfigs['homepage'])  )
            {
                $piQuery = new WP_Query(
                    array(
                        'post_type'         => 'page',
                        'posts_per_page'    => 40,
                        'post_status'       => 'publish'
                    )
                );

                if ( isset($field->aConfigs['blogpage']) && !empty($field->aConfigs['blogpage']) )
                {
                    $total = 2;
                }else{
                    $total = 1;
                }

                if ( $piQuery->have_posts() )
                {
                    global $post;
                    $i = 0;
                    while( $piQuery->have_posts() )
                    {
                        $piQuery->the_post();
                       
                        if ( $total == 2 )
                        {
                            if ( $post->post_name == $field->aConfigs['blogpage'] )
                            {
                                $aOptions['page_for_posts'] = $post->ID;
                                $i = $i+1;
                            }
                        }

                        if ( $post->post_name == $field->aConfigs['homepage'] )
                        {
                            $aOptions['page_on_front'] = $post->ID;
                            $i = $i+1;
                        }

                        if ( $i == $total )
                        {
                            update_option('show_on_front', 'page');
                            update_option('page_on_front', $aOptions['page_on_front']);
                            update_option('page_for_posts', $aOptions['page_for_posts']);
                        }
                    }
                }
                wp_reset_postdata();
            }
        }
    }
}