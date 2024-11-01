<?php

/**
 * Vote view
 * Displays settings for change current vote
 * 
 * @since 1.0.0
 */
class weightyvote_voteView {
    /**
     * Widget id
     * @var int 
     */
    private $id = 0;
    
    /**
     * Vote settings
     * @var array
     */
    private $vote = [];
    
    /**
     * Widget style
     * @var array
     */
    private $style = [];
    
    /**
     * Constructor
     * Get widget options by id and register recources for display view
     * 
     * @access public
     * @param int $id - widget id
     * @return void
     */
    public function weightyvote_voteView($id) {
        $this->title = __('Change vote', 'weightyvote');
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
     * Get widget style
     * 
     * @static
     * @access private
     * @param int $id - widget id
     * @return array $style - widget style
     */
    private static function getStyle($id) {
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
     * Register and download resources
     * 
     * @static
     * @access private
     * @return void
     */
    static private function registerResources() {
        wp_register_script('weightyvote_widget_bootstrap_dropdown', WEIGHTYVOTE_PLUGIN_URL . 'js/bootstrap-dropdown.js', ['jquery'], true);
        wp_register_script('weightyvote_widget_script_edit', WEIGHTYVOTE_PLUGIN_URL . 'js/edit.js', ['jquery'], true);
    }
    
    /**
     * Print resources
     * 
     * @access private
     * @return void
     */
    private function printResources() {
        wp_localize_script('weightyvote_widget_script_edit', 'service_domain', WEIGHTYVOTE_SERVICE_URL);
        wp_localize_script('weightyvote_widget_script_edit', 'current_vote_id', $this->vote['vote_id']);

        wp_enqueue_script('weightyvote_widget_bootstrap_dropdown');
        wp_enqueue_script('weightyvote_widget_script_edit');
    }
    
    /**
     * Displays current view
     * 
     * @access public
     * @return void
     */
    function display() {
        $this->printResources();
        require_once(WEIGHTYVOTE_SETTINGS_VOTE_TEMPLATE);
    }
}