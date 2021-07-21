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
 * Plugin strings are defined here.
 *
 * @package     local_intercom
 * @category    string
 * @copyright   2020 Westmoreland IU <jlohr@wiu7.org>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Intercom';
$string['enabled'] = 'Enabled';
$string['enabled_help'] = 'Enable Intercom integration.';
$string['privacy:metadata'] = 'The Intercom local plugin displays does not effect or store any data itself.';
$string['app_id'] = 'Intercom App ID';
$string['app_id_help'] = 'Copy the App ID from Settings - Installation in Intercom.';
$string['id_verification_secret'] = 'Identity Verification Secret';
$string['id_verification_secret_help'] = 'Copy this from Settings - Security - Identify verification for web in Intercom if you wish to enable this option.';
$string['ignored_script_names'] = 'Ignored Scripts';
$string['ignored_script_names_help'] = 'Do not load Intercom messenger from the following files (comma-separated).';
$string['privacy:metadata:intercom_client'] = 'In order to integrate with a remote Intercom service, user data needs to be exchanged with that service.';
$string['privacy:metadata:intercom_client:userid'] = 'The userid is sent from Moodle to allow you to access your data on the remote system.';
$string['privacy:metadata:intercom_client:fullname'] = 'Your full name is sent to the remote system to allow a better user experience.';