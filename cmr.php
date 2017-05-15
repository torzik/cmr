<?php


/*
 Plugin Name: CMR - Car  Maintenance Reminder
 Plugin URI: https://github.com/torzik/cmr
 Version: 1.0.0
 Author: Konstantin 
*/

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

add_action('admin_menu', 'cmr_to_admin_panel');

function cmr_to_admin_panel()
{
	add_menu_page( 'Car  Maintenance Reminder', 'Car Maintenance Reminder', 'manage_options', 'cmr', 'cmr_init' );
}
 function cmr_init()
{
	echo '<h1> hello dsfd </h1>';
}


register_activation_hook( __FILE__, 'cmr_activate_create_db' );
function cmr_activate_create_db()
{
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = $wpdb->prefix . 'cmr_user';
		$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		maintenance_time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		reminder_maintenance_time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		car_number mediumint(7) NOT NULL,
		customer_email VARCHAR(255) NOT NULL,
		isregistered_on_site BOOLEAN NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}

?>

