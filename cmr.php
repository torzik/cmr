<?php

/*
 Plugin Name: CMR - Car  Maintenance Reminder
 Plugin URI: https://github.com/torzik/cmr
 Version: 1.0.0
 Author: Konstantin 
*/

add_action('admin_menu', 'cmr_to_admin_panel');

function cmr_to_admin_panel()
{
	add_menu_page( 'Car Maintenance Reminder', 'Car Maintenance Reminder', 'manage_options', 'cmr', 'cmr_init', 'dashicons-dashboard', 5 );
	add_submenu_page('cmr', 'Add New User', 'Add New User', 'manage_options', 'cmr/add', 'cmr_add' );
}
 function cmr_init()
{
	 global $wpdb;
	 $tableName = $wpdb->prefix . 'cmr_user';
	 // var_dump($tableName);
	$select = "select * from " . $tableName;
	$users = $wpdb->get_results($select, OBJECT);
	
	?>

	<div class="wrap">
	 	<h2>Car Maintenance Reminder Users</h2>
		<table class="cmr-users wp-list-table widefat fixed striped users">
			<thead>
				<tr>
					<th id="car-number">Car Number</th>
					<th id="customer-name">Customer Name</th>
					<th id="maintanence-time">Maintanence Date</th>
					<th id="maintanence-time">Maintanence Reminder Date</th>
					<th id="is-registered">Registered On Site</th>
					<th id="customer-email">Customer Email</th>
				</tr>
			</thead>
			<tbody>
					<?php foreach ($users as $user) :?>
					<tr>
							<td> <?php echo $user->car_number; ?></td>
							<td><?php echo $user->customer_name; ?></td>
							<td><?php echo $user->maintenance_time; ?></td>
							<td><?php echo $user->reminder_maintenance_time; ?></td>
							<td><?php echo $user->isregistered_on_site; ?></td>
							<td><?php echo $user->customer_email; ?></td>
					<?php endforeach; ?>
					</tr>
			</tbody>
		</table>
	</div>
<?php
}
function cmr_add()
{?>
	<div>
		<h2>Add User to Car Maintenance Reminder</h2>
        <form method="post" action="options.php">
            <?php wp_nonce_field('update-options') ?>
            <p><strong>Twitter ID:</strong><br />
                <input type="text" name="twitterid" size="45" value="<?php echo get_option('twitterid'); ?>" />
            </p>
            <p><input type="submit" name="Submit" value="Store Options" /></p>
            <input type="hidden" name="action" value="update" />
            <input type="hidden" name="page_options" value="twitterid" />
        </form>
	</div>
  <?php
}


register_activation_hook( __FILE__, 'cmr_activate_create_db' );
function cmr_activate_create_db()
{
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = $wpdb->prefix . 'cmr_user';
		$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		maintenance_time datetime DEFAULT '0000-00-00' NOT NULL,
		reminder_maintenance_time datetime DEFAULT '0000-00-00' NOT NULL,
		car_number mediumint(7) NOT NULL,
		customer_name VARCHAR(255) NOT NULL,
		customer_email VARCHAR(255) NOT NULL,
		isregistered_on_site BOOLEAN NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}

?>
