<?php
// This file is part of the Intercom local plugin for Moodle
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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Library of interface functions and constants for module intercom
 *
 * All the core Moodle functions, needed to allow the module to work
 * integrated in Moodle should be placed here.
 *
 * @package     local_intercom
 * @copyright   2020 Westmoreland IU <jlohr@wiu7.org>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_intercom;

defined('MOODLE_INTERNAL') || die();

/**
 * Class helper
 *
 * @package     local_intercom
 * @copyright   2020 Westmoreland IU <jlohr@wiu7.org>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class helper {
	
	/**
	* Generate the Intercom Javascript to embed.
	*
	* @param null|stdClass $context Context instance
	* @param null|stdClass $course Related course instance
	* @return null|string A string containing the Intercom embed code, otherwise, null.
	*/
	public function embed_intercom($context, $course) {
		global $USER;
		global $CFG;
		global $SITE;

		// Trap any catchable error.
		try {
			// Grab settings for the plugin from the database
			$app_id = get_config('local_intercom', 'app_id');
			$id_verification_secret = get_config('local_intercom', 'id_verification_secret');
			
			// Generate user hash using ID Verification Secret from settings
			$user_hash = hash_hmac(
				'sha256', // hash function
				$SITE->shortname."-".$USER->id, // user's id
				$id_verification_secret // secret key
			);

			// Get active course info
			if(!empty($course)){
				$course_title = empty($course->fullname) ? $course->name : $course->fullname;
				$course_title = format_string($course_title, true, array('context' => \context_system::instance()));
				$course_desc = "";
				if (!empty($course->summary)) {
					$course_desc = format_text($course->summary, FORMAT_HTML,
					array('context' => \context_system::instance(), 'newlines' => false));
					$course_desc = html_to_text($course_desc, -1, false);
				}
			}

			// Build the JS code to embed
			$embed_code = '
				<script>
					window.intercomSettings = {
						app_id: "'.$app_id.'",
						company: {
							id: "'.$SITE->shortname.'",
							name: "'.$SITE->fullname.'",
							website: "'.$CFG->wwwroot.'"
						},
						moodle_version: "Moodle '.$CFG->release.'",
						user_id: "'.$SITE->shortname.'-'.$USER->id.'",
						username: "'.$USER->username.'",
						name: "'.$USER->firstname.' '.$USER->lastname.'",
						email: "'.$USER->email.'",
						user_hash: "'.$user_hash.'",
						created_at: '.$USER->firstaccess.',';
			if(!empty($course)){
					$embed_code .= '
						active_course_title: "'.$course_title.'",
						active_course_shortname: "'.$course->shortname.'",
						active_course_description: "'.$course_desc.'",
						active_course_id: '.$course->id.',
					};
				</script>';
			}else{
					$embed_code .= '
					};
				</script>';
			}

			$embed_code .= "
				<script>
					// We pre-filled your app ID in the widget URL: 'https://widget.intercom.io/widget/".$app_id."'
					(function(){var w=window;var ic=w.Intercom;if(typeof ic==='function'){ic('reattach_activator');ic('update',w.intercomSettings);}else{var d=document;var i=function(){i.c(arguments);};i.q=[];i.c=function(args){i.q.push(args);};w.Intercom=i;var l=function(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/".$app_id."';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);};if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
				</script>";

			return $embed_code;
		} catch (Exception $e) {
			// Do nothing here.
			return null;
		}
		return null;
	}
}
