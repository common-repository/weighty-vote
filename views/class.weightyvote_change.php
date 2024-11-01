<?php

/**
 * Change view
 * View for display form for change widget settings
 * 
 * @since 1.0.0
 */
class weightyvote_changeView {
    /**
     * Widget id
     * @access private
     * @var int
     */
    private $id = 0;
    
    /**
     * Widget settings
     * @access private
     * @var array
     */
    private $vote = [];
    
    /**
     * Widget style options
     * @access private
     * @var array
     */
    private $style = [];
    
    
    /**
     * Constructor
     * 
     * @access public
     * @param type $id - widget id
     * @return void
     */
    public function weightyvote_changeView($id) {
        if (!$id){
            $this->id = null;
            return;
        }
        $this->id = $id;

        $options = get_option('widget_weightyvote_widget');

        $this->vote = [];
        if (isset($options[$this->id])) {
            foreach ($options[$this->id] as $k => $v) {
                $this->vote[$k] = $v;
            }
        }

        $this->style = self::getStyle($this->id);

        self::registerResources();
    }
    
    /**
     * Get widget style options by widget id
     * 
     * @static
     * @access private
     * @param int $id - widget id
     * @return array $style - widget syle options
     */
    private static function getStyle($id) {
        if (!$id){
            return [];
        }
        $style_opt = ["borderWg", "borderSizeWg", "shadowSize", "shadowOpacity", "bgHeader", "colorHeader", "borderHeader", "borderSizeHeader", "bgBody", "colorWg", "bgAnswerCount", "colorAnswerCount", "bgButton", "colorButton", "borderFooter", "borderSizeFooter", "bgFooter", "colorFooter", "bgCounter", "colorCounter", "colorLink"];
        $style = [];

        $options = get_option('widget_weightyvote_widget');

        if (!isset($options[$id])) {
            return [];
        }

        foreach ($style_opt as $value) {
            $style[$value] = $options[$id][$value];
        }

        return $style;
    }
    
    /**
     * Register resources
     * 
     * @static
     * @access private
     * @return void
     */
    static private function registerResources() {
        wp_register_style('weightyvote_widget_style_spectrum_url', WEIGHTYVOTE_PLUGIN_URL . 'css/spectrum.css', [], true);
        wp_register_script('weightyvote_widget_bootstrap_dropdown', WEIGHTYVOTE_PLUGIN_URL . 'js/bootstrap-dropdown.js', ['jquery'], true);
        wp_register_script('weightyvote_widget_spectrum_url', WEIGHTYVOTE_PLUGIN_URL . 'js/spectrum.js', ['jquery'], true);
        wp_register_script('weightyvote_widget_jquerycookie_url', WEIGHTYVOTE_PLUGIN_URL . 'js/jquery.cookie.js', ['jquery'], true);
        wp_register_script('weightyvote_widget_script_url', WEIGHTYVOTE_PLUGIN_URL, ['jquery', 'weightyvote_widget_ifvisible_url'], true);
        wp_register_script('weightyvote_widget_script_settings_url', WEIGHTYVOTE_PLUGIN_URL . 'js/settings.js', ['jquery'], false);
        wp_register_script('weightyvote_widget_customizationscript_url', WEIGHTYVOTE_CUSTOMIZE_SCRIPT_URL, ['jquery', 'weightyvote_widget_script_settings_url'], true);
    }
    
    /**
     * Print resources to the page
     * 
     * @access private
     * @return void
     */
    private function printResources() {
        wp_localize_script('weightyvote_widget_script_settings_url', 'service_domain', WEIGHTYVOTE_SERVICE_URL);
        wp_localize_script('weightyvote_widget_script_settings_url', 'url', WEIGHTYVOTE_SERVICE_URL);
        wp_localize_script('weightyvote_widget_script_settings_url', 'params', '[]');
        wp_localize_script('weightyvote_widget_script_settings_url', 'widget_style', $this->style);
        wp_localize_script('weightyvote_widget_script_settings_url', 'current_vote_id', $this->vote['vote_id']);
        wp_localize_script('weightyvote_widget_script_settings_url', 'widget', 'null');

        wp_enqueue_style('weightyvote_widget_style_spectrum_url');
        wp_enqueue_script('jquery');
        wp_enqueue_script('weightyvote_widget_bootstrap_dropdown');
        wp_enqueue_script('weightyvote_widget_spectrum_url');
        wp_enqueue_script('weightyvote_widget_ifvisible_url');
        wp_enqueue_script('weightyvote_widget_jquerycookie_url');
        wp_enqueue_script('weightyvote_widget_script_url');
        wp_enqueue_script('weightyvote_widget_script_settings_url');
        wp_enqueue_script('weightyvote_widget_customizationscript_url');
    }
    
    /**
     * Displays a change view
     * 
     * @access public
     * @return void
     */
    function display() {
        $this->printResources();
        require_once(WEIGHTYVOTE_SETTINGS_CHANGE_TEMPLATE);
    }
}