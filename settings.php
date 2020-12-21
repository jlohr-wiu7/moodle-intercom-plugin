<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Plugin administration pages are defined here.
 *
 * @package     local_intercom
 * @category    admin
 * @copyright   2020 Westmoreland IU <jlohr@wiu7.org>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
   // TODO: Define the plugin settings page.
   // https://docs.moodle.org/dev/Admin_settings
}

if ($hassiteconfig) {
    // Create the new settings page.
    $settings = new admin_settingpage('local_intercom', get_string('pluginname', 'local_intercom'));

    // Create.
    $ADMIN->add('localplugins', $settings);

    // Add a checkbox setting to the settings for this page.
    $name = 'local_intercom/enabled';
    $title = get_string('enabled', 'local_intercom');
    $description = get_string('enabled_help', 'local_intercom');
    $default = '0';
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $settings->add($setting);

    // Add a string setting to the settings for this page.
    $name = 'local_intercom/app_id';
    $title = get_string('app_id', 'local_intercom');
    $description = get_string('app_id_help', 'local_intercom');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_NOTAGS);
    $settings->add($setting);
	
	// Add a string setting to the settings for this page.
    $name = 'local_intercom/id_verification_secret';
    $title = get_string('id_verification_secret', 'local_intercom');
    $description = get_string('id_verification_secret_help', 'local_intercom');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_NOTAGS);
    $settings->add($setting);
}
