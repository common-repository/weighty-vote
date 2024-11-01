<?php
/*
Plugin Name: Weighty Vote
Plugin URI: http://wordpress.org/plugins/weightyvote/
Description: Append vote to your site.
Text Domain: weightyvote
Domain Path: /languages
Author: Weighty Vote
Author URI: http://wvote.ru/
Version: 1.0
License: GPLv3 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

define('WEIGHTYVOTE_SERVICE_URL', 'http://wvote.ru');
define('WEIGHTYVOTE_SCRIPT_URL', WEIGHTYVOTE_SERVICE_URL . '/js/vote.min.js');
define('WEIGHTYVOTE_CUSTOMIZE_SCRIPT_URL', WEIGHTYVOTE_SERVICE_URL . '/js/widget_customization.js');
define('WEIGHTYVOTE_VERSION', '1.0.0');
define('WEIGHTYVOTE_MINIMUM_WP_VERSION', '3.4');
define('WEIGHTYVOTE_PLUGIN_URL', plugin_dir_url(__FILE__));
define('WEIGHTYVOTE_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WEIGHTYVOTE_IFVISIBLE_URL', WEIGHTYVOTE_PLUGIN_URL . 'js/ifvisible.min.js');

// settings paths
define('WEIGHTYVOTE_SETTINGS_PAGE', WEIGHTYVOTE_PLUGIN_DIR . 'views/class.weightyvote_settings.php');
define('WEIGHTYVOTE_SETTINGS_VOTE_PAGE', WEIGHTYVOTE_PLUGIN_DIR . 'views/class.weightyvote_vote.php');
define('WEIGHTYVOTE_SETTINGS_SELECT_PAGE', WEIGHTYVOTE_PLUGIN_DIR . 'views/class.weightyvote_select.php');
define('WEIGHTYVOTE_SETTINGS_CHANGE_PAGE', WEIGHTYVOTE_PLUGIN_DIR . 'views/class.weightyvote_change.php');
define('WEIGHTYVOTE_SETTINGS_VOTE_TEMPLATE', WEIGHTYVOTE_PLUGIN_DIR . 'views/templates/vote.php');
define('WEIGHTYVOTE_SETTINGS_SELECT_TEMPLATE', WEIGHTYVOTE_PLUGIN_DIR . 'views/templates/select.php');
define('WEIGHTYVOTE_SETTINGS_CHANGE_TEMPLATE', WEIGHTYVOTE_PLUGIN_DIR . 'views/templates/change.php');

/**
 * Url getter for settings with arguments.
 * 
 * @static
 * @access public
 * @param array $arg - url arguments
 * @return string $url - url string
 */
function weightyvote_get_settings_url($arg = []) {
   $args = array_merge(['page' => 'weightyvote_settings'], $arg);
   $url = add_query_arg($args, admin_url('options-general.php'));

   return $url;
}

require_once(WEIGHTYVOTE_PLUGIN_DIR . 'class.weightyvote.php');
require_once(WEIGHTYVOTE_PLUGIN_DIR . 'class.weightyvote_widget.php');

register_activation_hook(__FILE__, ['weightyvote', 'plugin_activation']);
register_deactivation_hook(__FILE__, ['weightyvote', 'plugin_deactivation']);

add_action('init', ['weightyvote', 'init']);
add_action('widgets_init', ['weightyvote_widget', 'weightyvote_widget_reg']);

if (is_admin()) {
    require_once(WEIGHTYVOTE_PLUGIN_DIR . 'class.weightyvote_admin.php');
    add_action('init', ['weightyvote_admin', 'init']);
}