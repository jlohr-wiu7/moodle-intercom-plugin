<?php
// …
 
namespace local_intercom\privacy;
 
class provider implements
    // This plugin does not store any personal user data.
    \core_privacy\local\metadata\null_provider {
 
    /**
     * Get the language string identifier with the component's language
     * file to explain why this plugin stores no data.
     *
     * @return  string
     */
    public static function get_reason() : string {
        return 'privacy:metadata';
    }
	
	public static function get_metadata(collection $collection) : collection {
		$collection->add_external_location_link('intercom_client', [
				'userid' => 'privacy:metadata:intercom_client:userid',
				'fullname' => 'privacy:metadata:intercom_client:fullname',
			], 'privacy:metadata:intercom_client');

		return $collection;
	}
}