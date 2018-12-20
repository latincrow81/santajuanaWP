<?php
/**
* Config mailchimp
*/

if ( !function_exists('pi_add_mailchimp_menu') )
{
    add_action('admin_menu', 'pi_add_mailchimp_menu');

    function pi_add_mailchimp_menu()
    {
        add_theme_page('Mailchimp', 'Mailchimp', 'edit_theme_options', 'pi-config-mailchimp', 'pi_config_mailchimp');
        add_action('admin_enqueue_scripts', 'pi_include_mailchimp_js');
    }

    function pi_include_mailchimp_js($hook)
    {
        if ( $hook == "appearance_page_pi-config-mailchimp" )
        {
            wp_enqueue_script('pi_mailchimp_js', PI_WIDGET_URI . 'js/mailchimp.js', array('jquery'), '1.0', true);
        }
    }

    function pi_config_mailchimp()
    {
        $aLists    = get_option("pi_mailchimp_lists");

        if ( isset($_POST['pi_mailchimp']['list_id']) && !empty($_POST['pi_mailchimp']['list_id']) )
        {
            $mailchimpAPI = $_POST['pi_mailchimp']['api_key'];
            update_option('pi_mailchimp_listid', $_POST['pi_mailchimp']['list_id']);
            update_option('pi_mailchimp_api_key', $_POST['pi_mailchimp']['api_key']);
            unset($_POST['pi_mailchimp']['list_id']);
        }else{
           $mailchimpAPI = get_option('pi_mailchimp_api_key');
        }

        $selected     = get_option('pi_mailchimp_listid'); 
        ?>
        <form method="POST" action="">
            <table class="form-table">
                <tbody>
                <tr class="wrapper">
                    <th>
                        <?php _e('API key', 'wiloke'); ?> <br>
                        <span class="help"><a href="https://admin.mailchimp.com/account/api-key-popup" target="_blank"><?php  _e('How to get mailchimp', 'wiloke'); ?></a></span>
                    </th>
                    <td><input name="pi_mailchimp[api_key]" value="<?php echo esc_attr($mailchimpAPI); ?>" type="text"><button id="pi_get_list_id" class="button button-primary"><?php _e('Get Lists', 'wiloke'); ?></button></td>
                </tr>
                <tr class="pi_mailchimp_lists">
                    <th><?php _e('List ID', 'wiloke') ?></th>
                    <td>
                        <select name="pi_mailchimp[list_id]" id="pi_mailchimp_lists" class="pi_append_mailchimp_lists">
                            <?php if ( !empty($aLists) ) : ?>
                                <?php
                                foreach ( $aLists as $key => $listName ) :
                                    ?>
                                    <option value="<?php echo esc_attr($key); ?>" <?php selected($selected, $key) ?>><?php echo esc_html($listName); ?></option>
                                <?php
                                endforeach;
                                ?>
                            <?php else: ?>
                                <option value="0">---</option>
                            <?php endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td><input value="<?php _e('Save', 'wiloke'); ?>" type="submit" class="button button-primary"></td>
                </tr>
                <tr>
                    <th><?php _e('Note', 'wiloke'); ?></th>
                    <td><?php _e('Please click Save button to get the setting finished.', 'wiloke'); ?></td>
                </tr>
                </tbody>
            </table>
        </form>
        <script type="text/javascript">
            jQuery(function($){
                $("#pi_get_list_id").piGetListsOfMailchimp();
            })
        </script>
    <?php
    }
}

if ( !function_exists('pi_save_mailchimp_info') )
{

    /**
     * Parse and get the list of mailchimp
     */
    add_action('wp_ajax_pi_mailchimp_get_lists', 'pi_save_mailchimp_info');

    function pi_save_mailchimp_info()
    {
        if( isset($_POST['api_key']) && !empty($_POST['api_key']) )
        {
            $current = get_option('pi_mailchimp_api_key');

            require_once plugin_dir_path(__FILE__)."mailchimp/Mailchimp.php";

            $MailChimp = new MailChimp($_POST['api_key']);

            $data = $MailChimp->call('lists/list');

            $lists=array();

            if( is_array($data) && is_array($data['data']) )
            {
                foreach($data['data'] as $item)
                {
                    $lists[$item['id']]=$item['name'];
                }
            }

            if( count($lists) > 0 )
            {
                update_option("pi_mailchimp_lists",$lists);
                update_option("pi_mailchimp_api_key", $_POST['api_key']);
                echo json_encode(array("type"=>"success","data"=>json_encode($lists)));
            }else{
                echo json_encode(array("type"=>"error","msg"=>"Can not get list from your MailChimp"));
            }
           
        }else{
            echo json_encode(array("type"=>"error","msg"=>"Can not get list from your MailChimp"));
        }

        wp_die();
    }


    /**
     * handle on front-end
     */
    add_action( 'wp_ajax_pi_subscribe', 'mailchimp_subscribe');
    add_action( 'wp_ajax_nopriv_pi_subscribe','mailchimp_subscribe');
    function mailchimp_subscribe()
    {

        if(!isset($_POST['subscribeNonce']) || !check_ajax_referer( 'pi_subscribe_nonce', 'subscribeNonce' ) )
        {
            echo json_encode(array("type"=>"error","msg"=>"There're something wrongs!"));
            exit();
        }

        if(isset($_POST['email']))
        {
            if ( filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) )
            {
                $api = get_option("pi_mailchimp_api_key");

                if ( !$api || empty($api) )
                {
                    echo json_encode(array("type"=>"error","msg"=>"You haven't configured mailchimp yet!"));
                }else{
                    require_once plugin_dir_path(__FILE__)."mailchimp/Mailchimp.php";
                    $MailChimp = new MailChimp($api);
                    $result = $MailChimp->call('lists/subscribe', array(
                        'id'                => get_option("pi_mailchimp_listid"),
                        'email'             => array('email'=>$_POST['email']),
                        'double_optin'      => true,
                        'update_existing'   => true,
                        'replace_interests' => false,
                        'send_welcome'      => false,
                    ));
                    if(isset($result['status']) && $result['status']=='error')
                    {
                        echo json_encode(array("type"=>"error","msg"=>$result['error']));
                        exit;
                    }

                    echo json_encode(array("type"=>"success","msg"=>"Thank you for subscribing!"));
                }
            }else{
                echo json_encode(array("type"=>"error","msg"=>"Invalid email!"));
            }
        }else{
            echo json_encode(array("type"=>"error","msg"=>"Please enter your email!"));
        }
        exit;
    }

}