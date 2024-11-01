<?php
/**
 * weightyvote class.
 * Plugin part.
 * 
 * @since 1.0.0
 */
class weightyvote{
    private static $initiated = false;
    
    /**
     * Initialization
     * 
     * @static
     * @access public
     * @return void
     */
    public static function init() {
        if (!self::$initiated) {
            load_plugin_textdomain('weightyvote', false, '/' . plugin_basename(plugin_dir_path(__FILE__)) . '/languages/');
            self::init_hooks();
        }
    }

    /**
     * Validation function
     * 
     * @param mixed $input
     * @access public
     * @return mixed $value - returns false if validation has fail, else returns $input.
     */
    public function validate($input) {
        return $input;
    }
    
    /**
     * Initializes WordPress hooks
     * 
     * @static
     * @access private
     * @return void
     */
    private static function init_hooks() {
        self::$initiated = true;
        
        add_action('wp_footer', ['weightyvote_widget', 'load_script']);
        $vote_id = get_option('vote_id');
        if ($vote_id > 0) {
            add_action('wp_footer', ['weightyvote_widget', 'print_form_js']);    // display widget
        }
    }
    
    /**
     * Attached to activate_{plugin_basename(__FILES__)} by register_activation_hook()
     * 
     * @static
     * @access public
     * @return void
     */
    public static function plugin_activation() {
        if (version_compare($GLOBALS['wp_version'], WEIGHTYVOTE_MINIMUM_WP_VERSION, '<')) {
            $message = '<strong>'.sprintf(esc_html__('vote_widget %s requires WordPress %s or higher.', 'weightyvote'), 
                    WEIGHTYVOTE_VERSION, WEIGHTYVOTE_MINIMUM_WP_VERSION).'</strong>';
            echo $message;
        }
    }
    
    /**
     * Removes all options and actions
     * 
     * @static
     * @access public
     * @return void
     */
    public static function plugin_deactivation() {
        remove_action('wp_footer', ['weightyvote', 'load_script']);
        remove_action('wp_footer', ['weightyvote', 'print_form_js']);
    }
}