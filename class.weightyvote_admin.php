<?php

/**
 * weightyvote_admin class.
 * Plugin admin part.
 * 
 * @since 1.0.0
 */
class weightyvote_admin {
    /**
     * Widget has publicated
     * @var bool
     */
    private static $initiated = false;
    
    /**
     * Add admin widget hooks
     * 
     * @access public
     * @return void
     */
    public function init() {
        if (!self::$initiated) {
            add_action('admin_menu', ['weightyvote_admin', 'create_menu']);
            add_action('admin_init', ['weightyvote_admin', 'register_settings']);
        }
    }

    /**
     * Append widget settings
     * 
     * @static
     * @access public
     * @return void
     */
    public static function register_settings() {
        register_setting('weightyvote_settings', 'title', 'sanitize_text_field');
        register_setting('weightyvote_settings', 'showTitle', 'intval');
        register_setting('weightyvote_settings', 'published', 'intval');
        register_setting('weightyvote_settings', 'vote_id', 'intval');
        register_setting('weightyvote_settings', 'borderWg', 'sanitize_text_field');
        register_setting('weightyvote_settings', 'borderSizeWg', 'sanitize_text_field');
        register_setting('weightyvote_settings', 'shadowSize', 'sanitize_text_field');
        register_setting('weightyvote_settings', 'shadowOpacity', 'sanitize_text_field');
        register_setting('weightyvote_settings', 'bgHeader', 'sanitize_text_field');
        register_setting('weightyvote_settings', 'colorHeader', 'sanitize_text_field');
        register_setting('weightyvote_settings', 'borderHeader', 'sanitize_text_field');
        register_setting('weightyvote_settings', 'borderSizeHeader', 'sanitize_text_field');
        register_setting('weightyvote_settings', 'bgBody', 'sanitize_text_field');
        register_setting('weightyvote_settings', 'colorWg', 'sanitize_text_field');
        register_setting('weightyvote_settings', 'bgAnswerCount', 'sanitize_text_field');
        register_setting('weightyvote_settings', 'colorAnswerCount', 'sanitize_text_field');
        register_setting('weightyvote_settings', 'bgButton', 'sanitize_text_field');
        register_setting('weightyvote_settings', 'colorButton', 'sanitize_text_field');
        register_setting('weightyvote_settings', 'borderFooter', 'sanitize_text_field');
        register_setting('weightyvote_settings', 'borderSizeFooter', 'sanitize_text_field');
        register_setting('weightyvote_settings', 'bgFooter', 'sanitize_text_field');
        register_setting('weightyvote_settings', 'colorFooter', 'sanitize_text_field');
        register_setting('weightyvote_settings', 'bgCounter', 'sanitize_text_field');
        register_setting('weightyvote_settings', 'colorCounter', 'sanitize_text_field');
        register_setting('weightyvote_settings', 'colorLink', 'sanitize_text_field');
    }
    
    /**
     * Create settings page
     * 
     * @access public
     * @return void
     */
    public function create_menu() {
        add_filter('plugin_action_links_' . plugin_basename(plugin_dir_path(__FILE__) . 'vote_widget.php'), ['weightyvote_admin', 'weightyvote_settings_link']);

	//register settings
        add_options_page('vote widget', 'Weighty Vote', 'manage_options', 'weightyvote_settings', ['weightyvote_admin', 'show_settings_page']);
    }
    
    /**
     * Append settings link for menu
     * 
     * @static
     * @access public
     * @return array $links - Array of menu links
     */
    public static function weightyvote_settings_link($links) {
        $settings_link = '<a href="' . esc_url(weightyvote_get_settings_url()) . '">' . __('Settings', 'weightyvote') . '</a>';
        array_unshift($links, $settings_link);
        
        return $links;
    }

    /**
     * Print settings page
     * 
     * @access public
     * @return void
     */
    public function show_settings_page() {
        require_once WEIGHTYVOTE_SETTINGS_PAGE;
        
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        
        $view = new weightyvote_settingsView($action, $id);
        $view->display();
    }
}