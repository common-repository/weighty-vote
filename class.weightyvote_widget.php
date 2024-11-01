<?php

/**
 * Weightyvote_widget_widget class.
 * Widget on the page.
 * 
 * @since 1.0.0
 */
class weightyvote_widget extends WP_Widget
{
    /**
     * Widget has publicated
     * @var bool
     */
    private static $has_publicated = false;
    
    /**
     * Constructor
     * 
     * @access public
     */
    function weightyvote_widget() {
        load_plugin_textdomain('weightyvote', false, '/' . plugin_basename(plugin_dir_path(__FILE__)) . '/languages/');
        
        parent::WP_Widget(false,
                        'Weighty Vote',
                        [
                            'classname' => 'weightyvote_widget',
                            'description' => __('Weighty Vote widget. Append vote to your web page.', 'weightyvote')
                        ]);
        if (!self::$has_publicated) {
            self::load_script();
            self::$has_publicated = true;
        }
    }
    
    /**
     * Register and public resources
     * 
     * @access public
     * @return void
     */
    public function load_script() {
        wp_register_script('weightyvote_widget_ifvisible', WEIGHTYVOTE_IFVISIBLE_URL, ['jquery'], true);
        wp_register_script('weightyvote_widget_script', WEIGHTYVOTE_SCRIPT_URL, ['jquery', 'weightyvote_widget_ifvisible'], true);
        wp_register_script('weightyvote_widget_script_init', plugin_dir_url(__FILE__) . 'js/init_widget.js', ['jquery', 'weightyvote_widget_script'], false);
        
        wp_enqueue_script('weightyvote_widget_script');
        wp_enqueue_script('weightyvote_widget_script_init');
    }
    
    /**
     * Save widget changes
     * 
     * @access public
     * @param object $new_instance - new instance with changes
     * @param object $old_instance - without changes
     * @return object $instance - new instance
     */
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['showTitle'] = $new_instance['showTitle'];
        return $instance;
    }
    
    /**
     * Print admin widget options form
     * 
     * @access public
     * @param type $instance - instance of widget
     * @return void
     */
    public function form($instance) {
        $default_widget_args = [
                    'vote_id' => '',
                    'title' => 'Vote',
                    'showTitle' => 1,
                ];
        $instance_arg = wp_parse_args((array)$instance, $default_widget_args); 
?>
<div class='weightyvote_settings'><p><label><?php 
        echo __('Title', 'weightyvote'); ?></label><input type="text" <?php
        echo $this->get_field_id('title'); ?> name="<?php
        echo $this->get_field_name('title'); ?>" value="<?php
        echo $instance_arg['title'];
?>" class='widefat'/></p><p><input class="checkbox" type="checkbox" <?php
        checked($instance['showTitle' ], 'on'); ?> id="<?php
        echo $this->get_field_id('showTitle'); ?>" name="<?php
        echo $this->get_field_name('showTitle'); ?>" /> <label for="<?php
        echo $this->get_field_id('showTitle'); ?>"><?php 
        echo __('Show title', 'weightyvote');?></label></p><a href="<?php
        echo weightyvote_get_settings_url(['action'=>'edit', 'id'=> substr($this->id, strlen('weightyvote_widget_'))]);
?>"><button type="button" class="button"><?php 
        echo __('Change widget', 'weightyvote');?></button></a></div>
<?php
    }
    
    /**
     * Print widget block
     * 
     * @access public
     * @param type $instance - instance of widget
     * @return void
     */
    public function print_form_js($instance) {
        $style_opt = ["borderWg", "borderSizeWg", "shadowSize", "shadowOpacity",
            "bgHeader", "colorHeader", "borderHeader", "borderSizeHeader", 
            "bgBody", "colorWg", "bgAnswerCount", "colorAnswerCount", "bgButton", 
            "colorButton", "borderFooter", "borderSizeFooter", "bgFooter", 
            "colorFooter", "bgCounter", "colorCounter", "colorLink"];
        $style = [];

        if ($instance) {
            foreach ($style_opt as $value) {
                $style[$value] = $instance[$value];
            }
        }
        
        $vote_id = $instance['vote_id'];
        
        echo '<div class="vote-widget-place"><input type="hidden" name="vote_id" value="'
            . $vote_id . '"/><input type="hidden" name="style" value=\''
            . json_encode($style) . '\'/></div>';
    }
    
    /**
     * Display the widget
     * 
     * @access public
     * @param type $args - widget arguments
     * @param type $instance - instance of widget
     * @return void
     */
    public function widget($args, $instance) {
        $published = $instance['published'];
        
        extract($args);

        $this->load_script($instance);
        echo $before_widget;
        
        if ($published) {
            if (!empty($instance['title']) && $instance['showTitle']) {
                echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
            }
            $this->print_form_js($instance);
        }
        
        echo $after_widget;
    }
    
    /**
     * Widget registration
     * 
     * @static
     * @access public
     * @return object
     */
    public static function weightyvote_widget_reg() {
        return register_widget("weightyvote_widget");
    }
}