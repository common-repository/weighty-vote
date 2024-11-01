<?php
/**
 * Select view
 * View for select action and appended widget
 * 
 * @since 1.0.0
 */
class weightyvote_selectView {
    /**
     * Appended widgets
     * @var array
     */
    private static $votes = [];
    
    /**
     * Constructor
     * Register resources and get appended votes
     * 
     * @access public
     * @return void
     */
    public function weightyvote_selectView() {
        $this->title = __('Appended votes', 'weightyvote');
        self::registerResources();
        self::$votes = self::getVotes();
    }
    
    /**
     * Register resources
     * 
     * @static
     * @access private
     * @return void
     */
    private static function registerResources() {
        wp_register_script('weightyvote_widget_script_select_url', WEIGHTYVOTE_PLUGIN_URL . 'js/votes.js', ['jquery'], false);
    }
    
    /**
     * Print resources to the page
     * 
     * @static
     * @access private
     * @return void
     */
    private static function printResources() {
        wp_localize_script('weightyvote_widget_script_select_url', 'service_domain', WEIGHTYVOTE_SERVICE_URL);
        wp_enqueue_script('weightyvote_widget_script_select_url');
    }
    
    /**
     * Get appended widgets and his options
     * 
     * @static
     * @access private
     * @return array $votes - widgets options by ids
     */
    private static function getVotes() {
        $options = get_option('widget_weightyvote_widget');
        
        if (count($options) <= 1) {
            return [];
        }
        
        $votes = [];
        foreach ($options as $key => $value) {
            if ($key === "_multiwidget"){
                continue;
            }
        
            $vote = [];
            if (is_array($value)) {
                foreach ($value as $k => $v) {
                    $vote[$k] = $v;
                }
            }
            $votes[$key] = $vote;
        }
        
        return $votes;
    }
    
    /**
     * Displays a select view
     * 
     * @access public
     * @return void
     */
    public function display() {
        self::printResources();
        require_once(WEIGHTYVOTE_SETTINGS_SELECT_TEMPLATE);
    }
}