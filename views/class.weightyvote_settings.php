<?php

/**
 * Settings view
 * 
 * @since 1.0.0
 */
class weightyvote_settingsView {
    
    /**
     * Settings action
     * @var string 
     */
    private $action;
    
    /**
     * Widget id
     * @var int
     */
    private $id;
    
    /**
     * Constructor
     * Get params and register resources
     * 
     * @access public
     * @param type $action - settings action
     * @param type $id - widget id
     */
    public function weightyvote_settingsView($action, $id) {
        $this->title = __('Settings', 'weightyvote');
        $this->action = $action;
        $this->id = $id;
        
        self::registerResources();
    }
    
    /**
     * Register and download resources
     * 
     * @static
     * @access private
     * @return void
     */
    private static function registerResources() {
        wp_register_style('weightyvote_widget_bcss', WEIGHTYVOTE_PLUGIN_URL . 'css/bootstrap.min.css', [], '');
    }
    
    /**
     * Print resources to the page
     * 
     * @static
     * @access private
     * @return void
     */
    private static function printResources() {
        wp_enqueue_style('weightyvote_widget_bcss');
    }
    
    /**
     * Doing redirect to settings menu
     * 
     * @static
     * @access private
     * @return void
     */
    private static function redirect() {
        echo '<script>window.location="'.weightyvote_get_settings_url().'";</script>';
    }
    
    /**
     * Remove widget by id
     * 
     * @static
     * @access private
     * @param int $id - widget id
     * @return void
     */
    private static function removeWidget($id) {
        if (!$id) {
            self::redirect();
            return;
        }
        echo "<h1>" . __('removing...', 'weightyvote') . '</h1>';
        
        $options = get_option('widget_weightyvote_widget');
        unset($options[$id]);

        update_option('widget_weightyvote_widget', $options);
        
        self::redirect();
    }

    /**
     * Publish or unpublish widget by id
     * 
     * @static
     * @access private
     * @param int $id - widget id
     * @param bool $publish - if set to true then widget set to published, else sets to unpublished
     * @return void
     */
    private static function publishVote($id, $publish=true) {
        if (!$id) {
            self::redirect();
            return;
        }
        echo $publish ? '<h1>' . __('publish...', 'weightyvote').'</h1>' : '<h1>' . __('unpublish...', 'weightyvote').'</h1>';
        
        $options = get_option('widget_weightyvote_widget');
        if (isset($options[$id])) {
            $options[$id]['published'] = $publish;
        }
        update_option('widget_weightyvote_widget', $options);

        self::redirect();
    }
    
    /**
     * Save widget changes in settings
     * 
     * @static
     * @access private
     * @param int $id - widget id
     * @return void
     */
    private static function saveSettings($id) {
        if (!$id) {
            self::redirect();
            return;
        }
        
        echo '<h1>' . __('saving...', 'weightyvote') . '</h1>';
        
        $options = get_option('widget_weightyvote_widget');

        if (isset($options[$id])) {
            $title = $options[$id]['title'];
        }

        $options[$id] = [];
        $options[$id]['title'] = $title;
        $options[$id]['vote_id'] = filter_input(INPUT_POST,  'vote_id', FILTER_SANITIZE_NUMBER_INT);
        $options[$id]['showTitle'] = filter_input(INPUT_POST,  'vote_id', FILTER_SANITIZE_NUMBER_INT);
        $options[$id]['published'] = filter_input(INPUT_POST,  'published', FILTER_SANITIZE_NUMBER_INT);
        $options[$id]['borderWg'] = filter_input(INPUT_POST,  'borderWg', FILTER_SANITIZE_STRING);
        $options[$id]['borderSizeWg'] = filter_input(INPUT_POST,  'borderSizeWg', FILTER_SANITIZE_NUMBER_INT);
        $options[$id]['shadowSize'] = filter_input(INPUT_POST,  'shadowSize', FILTER_SANITIZE_NUMBER_INT);
        $options[$id]['shadowOpacity'] = filter_input(INPUT_POST,  'shadowOpacity', FILTER_SANITIZE_STRING);
        $options[$id]['bgHeader'] = filter_input(INPUT_POST,  'bgHeader', FILTER_SANITIZE_STRING);
        $options[$id]['colorHeader'] = filter_input(INPUT_POST,  'colorHeader', FILTER_SANITIZE_STRING);
        $options[$id]['borderHeader'] = filter_input(INPUT_POST,  'borderHeader', FILTER_SANITIZE_STRING);
        $options[$id]['borderSizeHeader'] = filter_input(INPUT_POST,  'borderSizeHeader', FILTER_SANITIZE_NUMBER_INT);
        $options[$id]['bgBody'] = filter_input(INPUT_POST,  'bgBody', FILTER_SANITIZE_STRING);
        $options[$id]['colorWg'] = filter_input(INPUT_POST,  'colorWg', FILTER_SANITIZE_STRING);
        $options[$id]['bgAnswerCount'] = filter_input(INPUT_POST,  'bgAnswerCount', FILTER_SANITIZE_STRING);
        $options[$id]['colorAnswerCount'] = filter_input(INPUT_POST,  'colorAnswerCount', FILTER_SANITIZE_STRING);
        $options[$id]['bgButton'] = filter_input(INPUT_POST,  'bgButton', FILTER_SANITIZE_STRING);
        $options[$id]['colorButton'] = filter_input(INPUT_POST,  'colorButton', FILTER_SANITIZE_STRING);
        $options[$id]['borderFooter'] = filter_input(INPUT_POST,  'borderFooter', FILTER_SANITIZE_STRING);
        $options[$id]['borderSizeFooter'] = filter_input(INPUT_POST,  'borderSizeFooter', FILTER_SANITIZE_STRING);
        $options[$id]['bgFooter'] = filter_input(INPUT_POST,  'bgFooter', FILTER_SANITIZE_STRING);
        $options[$id]['colorFooter'] = filter_input(INPUT_POST,  'colorFooter', FILTER_SANITIZE_STRING);
        $options[$id]['bgCounter'] = filter_input(INPUT_POST,  'bgCounter', FILTER_SANITIZE_STRING);
        $options[$id]['colorCounter'] = filter_input(INPUT_POST,  'colorCounter', FILTER_SANITIZE_STRING);
        $options[$id]['colorLink'] = filter_input(INPUT_POST,  'colorLink', FILTER_SANITIZE_STRING);

        update_option('widget_weightyvote_widget', $options);
        
        self::redirect();
    }

    /**
     * Save changes in vote settings
     * 
     * @static
     * @access private
     * @param int $id
     * @return void
     */
    private static function saveVote($id) {
        if (!$id) {
            self::redirect();
            return;
        }
        
        '<h1>' . __('saving...', 'weightyvote') . '</h1>';
        
        $options = get_option('widget_weightyvote_widget');
        if (isset($options[$id])) {
            $options[$id]['vote_id'] = filter_input(INPUT_POST, 'vote_id', FILTER_SANITIZE_NUMBER_INT);
        }
        update_option('widget_weightyvote_widget', $options);
        
        self::redirect();
    }

    /**
     * Displays the settings view
     * 
     * @access public
     * @return void
     */
    public function display() {
        self::printResources();
        
        switch ($this->action) {
            case 'edit':
                require_once(WEIGHTYVOTE_SETTINGS_CHANGE_PAGE);
                
                $view = new weightyvote_changeView($this->id);
                $view->display();

                break;
            case 'change':
                require_once(WEIGHTYVOTE_SETTINGS_VOTE_PAGE);

                $view = new weightyvote_voteView($this->id);
                $view->display();

                break;
            case 'delete':
                self::removeWidget($this->id);
                break;
            case 'save':
                self::saveSettings($this->id);
                break;
            case 'savevote':
                self::saveVote($this->id);
                break;
            case 'publish':
                self::publishVote($this->id, true);
                break;
            case 'unpublish':
                self::publishVote($this->id, false);
                break;
            default:
                require_once(WEIGHTYVOTE_SETTINGS_SELECT_PAGE);

                $view = new weightyvote_selectView();
                $view->display();
        }
    }
}