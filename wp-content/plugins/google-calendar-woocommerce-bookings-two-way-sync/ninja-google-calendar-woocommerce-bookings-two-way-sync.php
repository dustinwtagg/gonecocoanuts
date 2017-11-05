<?php
/*
Plugin Name: Google Calendar Woocommerce Bookings Two Way Sync
Description: Get Bookings from Google Calender
Version: 2.0
Author: customwpninjas
*/

ob_start();
ini_set('display_errors',1);
defined( 'ABSPATH' ) OR exit;
if(session_id() == '') {
    session_start();
}
			
add_action( 'admin_menu', 'register_bookings_ninja' );

register_activation_hook( __FILE__, 'ninja_create_quick_add' );

function register_bookings_ninja(){
	add_menu_page('Settings', 'Ninja Bookings', 'manage_options', __FILE__, 'bookings_settings_page', "dashicons-external");
	
	add_submenu_page( __FILE__, 'Google To Woo', 'Google >> Woo', 'manage_options', 'dashicons-external', 'bookings_list_page' ); 
	add_submenu_page( __FILE__, 'Authorize', 'Authorize', 'manage_options', 'google-woo-page', 'google_woo_page' ); 
}

function bookings_settings_page(){
	
	echo '<h1>Google to Woo Bookings import settings</h1>';
	?>
	<style>
	.bookings_options_panel .short, .bookings_options_panel label{float: left; width: 25% !important;}
	p.form-field { clear: both;}
	</style>
	<div class="wrap">
	<?php 
	if($_POST['save']){
		if($_POST['client_id'] && $_POST['client_secret'] && $_POST['redirect_uri'] && $_POST['calendar_id'] ){
			update_option('client_id', $_POST['client_id']);
			update_option('client_secret', $_POST['client_secret']);
			update_option('redirect_uri', $_POST['redirect_uri']);
			update_option('calendar_id', $_POST['calendar_id']);
			echo '<div class="updated">Values saved</div>';
		}else{
			echo '<div class="updated">Please fill value in all fields.</div>';
		}
	}
	?>
		<div class="bookings_options_panel">
			<form action="" method="post">
				<p class="form-field">
					<label>Client ID</label><em>*</em>
					<input type="text" placeholder="" value="<?php echo get_option('client_id');?>" id="client_id" name="client_id" class="short" required> 
				</p>
				<p class="form-field">
					<label>Client Secret</label><em>*</em>
					<input type="text" placeholder="" value="<?php echo get_option('client_secret');?>" id="client_secret" name="client_secret" class="short" required> 
				</p>
				<p class="form-field">
					<label>Redirect URI</label><em>*</em>
					<input type="text" placeholder="" value="<?php echo get_option('redirect_uri');?>" id="redirect_uri" name="redirect_uri" class="short" required> 
				</p>
				<p class="form-field">
					<label>Primary calendar ID</label><em>*</em>
					<input type="text" placeholder="" value="<?php echo get_option('calendar_id');?>" id="calendar_id" name="calendar_id" class="short" required> 
				</p>
				<p class="form-field">
					<input type="submit" value="Update" accesskey="p" id="publish" class="button button-primary button-large" name="save">
				</p>
			</form>
		</div>
	</div>
<?php }

function get_ninja_google_services(){
	
	// radrevmarketing@gmail.com
	// $client_id = '577107204533-f83kq7gi5tqkhefbjht9nauqctrcnb0d.apps.googleusercontent.com';
	// $client_secret = 'dMK90ay4zjWNV3VsQnvSI3M4';
	
	// $client_id = '367871841331-jr25ao9msqp9gt8vq28266c64vmvtuh7.apps.googleusercontent.com';
	// $client_secret = 'uOPGo6Pqgw04uHhWCAk5i_Yg';
	$client_id = get_option('client_id');
	$client_secret = get_option('client_secret');
	$redirect_uri = get_option('redirect_uri');
	// $redirect_uri = 'http://www.customwpninjas.com/square/?wc-api=wc_bookings_google_calendar';
	
	require_once plugin_dir_path( __FILE__ )  . 'google-api-php-client/autoload.php'; // or wherever autoload.php is located

	$client = new Google_Client();
	$client->setClientId($client_id);
	$client->setClientSecret($client_secret);
	$client->setRedirectUri($redirect_uri);
	$client->setApprovalPrompt('force');
	$client->addScope('https://www.googleapis.com/auth/calendar');

	// echo time();echo '<br/>';
	$auth = json_decode($_SESSION['access_token']);
	$valid_time = time();
	$auth_time = $auth->created + $auth->expires_in;
	// echo $_SESSION['access_token'];die;
	/**/
	if( $auth_time <  $valid_time ){
	// if (isset($_REQUEST['logout'])) {
		unset($_SESSION['access_token']);
	}

	if (isset($_GET['code'])) {
		$client->authenticate($_GET['code']);
		$_SESSION['access_token'] = $client->getAccessToken();
	}

	/* if($client->isAccessTokenExpired() && $client->getAccessToken()) {

		$authUrl = $client->createAuthUrl();
		header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));

	} */

	if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
		$client->setAccessToken($_SESSION['access_token']);
	} else {
		$authUrl = $client->createAuthUrl();
	}
	if (isset($authUrl)):
		echo "<a class='login' target='_blank' href='".$authUrl."'>Connect Me!</a>";
    else :
		/**/

		$client->setApplicationName("WooCalendar");
		// $client->setDeveloperKey("AIzaSyBQJ2hQzpYn8UIL97VKkg3tBFTq9nFAQUE");
		$service = new Google_Service_Calendar($client);

		return $service;
	endif;
	

}

function bookings_list_page(){
	
	echo '<h1>Import Google Calendar Bookings Page</h1>';
	if(get_option('client_id') && get_option('client_secret') && get_option('redirect_uri') && get_option('calendar_id') ){
		if($_POST['import']){
			$service = get_ninja_google_services();
		}
	}else{
		$service = '';
		echo 'Please update your required values <a href="admin.php?page='.plugin_basename( __FILE__ ).'">here</a> to start import bookings.';
	}
	if($service){
		$calendar_id = get_option('calendar_id');
		$events = $service->events->listEvents($calendar_id);
		// echo 'here';die;
		// var_dump($events->getItems());
			// pre($events);
		$quick_add_id = ninja_create_quick_add();

		$updated_events = 0;
		while(true) {
		  foreach ($events->getItems() as $event) {
			$event_id = $event->getId();
			$event_title = $event->getSummary();
			// echo '<br/>';
			$start = $event->getStart()->getDateTime();
			// echo '<br/>';
			$end = $event->getEnd()->getDateTime();
			$woo_start = getFormattedTime($start);
			$unix_start_time = strtotime(str_replace('@','',$woo_start));
			$woo_end = getFormattedTime($end);
			$unix_end_time = strtotime(str_replace('@','',$woo_end));
			// echo '<br/>';
			// pre($event);
			$check_hash = substr($event_title, 0, 1);
			
			if($check_hash == '#'){
				$bookin_id = substr($event_title, 1, strpos($event_title, ' ',1));
				// echo '<br/>';
				$booking = ninja_check_booking($bookin_id);
				
				// pre($booking);
				if(!$booking){
					// echo 'product<br/>';
					$product = ninja_check_product($bookin_id);
					// pre($product);
					if($product){
						$new_booking_data = array(
												'start_date' => $unix_start_time,
												'end_date' => $unix_end_time
											);
						// echo $product[0]->ID;
						$new_booking = create_ninja_wc_booking( $product[0]->ID, $new_booking_data, $status = 'confirmed', $exact = false );
						if($new_booking->id){
							// echo 'New Booking ID ' . $new_booking->id;
							
							$order_id = ninja_create_booking_order($product[0]->ID);
							// echo 'Order ID ' . $order_id . '<br/>';
							if($order_id){
								// Update post 37
								$my_post = array(
									'ID'           => $new_booking->id,
									'post_parent' => $order_id
								);

								// Update the post into the database
								wp_update_post( $my_post );
								// pre($new_booking);
								
								$title = '#'.$new_booking->id . ' - ' . $product[0]->post_title;
								$i = update_google_event($event_id, $title);
								if($i == true){
									$updated_events++;
								}
								
							}
						}
					}
				}
			}
		  }
		  $pageToken = $events->getNextPageToken();
		  if ($pageToken) {
			$optParams = array('pageToken' => $pageToken);
			$events = $service->events->listEvents('primary', $optParams);
		  } else {
			break;
		  }
		}
	}?>
	
	<?php if($updated_events){
		echo '#'.$updated_events.' events has been updated.';
	}?>
	<div class="wrap">
		<div class="bookings_options_panel">
			<form action="" method="post">
				<p class="form-field">
					<input type="submit" value="Import" accesskey="p" id="publish" class="button button-primary button-large" name="import">
				</p>
			</form>
		</div>
	</div>
	<?php 
}

function ninja_create_booking_order( $pid ){
	$order_date = new DateTime();
	// build order data
	$order_data = array(
		'post_name'     => 'order-' . date_format($order_date, 'M-d-Y-hi-a'), //'order-jun-19-2014-0648-pm'
		'post_type'     => 'shop_order',
		'post_title'    => 'Order &ndash; ' . date_format($order_date, 'F d, Y @ h:i A'), //'June 19, 2014 @ 07:19 PM'
		'post_status'   => 'wc-processing',
		'ping_status'   => 'closed',
		'post_excerpt'  => 'Ninja Booking',
		'post_author'   => 1,
		'post_password' => uniqid( 'order_' ),   // Protects the post just in case
		'post_date'     => date_format($order_date, 'Y-m-d H:i:s e'), //'order-jun-19-2014-0648-pm'
		'comment_status' => 'open'
	);

	// create order
	$order_id = wp_insert_post( $order_data, true );
	
	if ( !is_wp_error( $order_id ) ) {

		// add a bunch of meta data
		/* add_post_meta($order_id, 'transaction_id', $order->transaction_id, true); 
		add_post_meta($order_id, '_payment_method_title', 'Import', true);
		add_post_meta($order_id, '_order_total', $order->gross, true);
		add_post_meta($order_id, '_customer_user', $account->user_id, true);
		add_post_meta($order_id, '_completed_date', date_format( $order_date, 'Y-m-d H:i:s e'), true);
		add_post_meta($order_id, '_order_currency', $order->currency, true);
		add_post_meta($order_id, '_paid_date', date_format( $order_date, 'Y-m-d H:i:s e'), true); */

		// billing info
		/* add_post_meta($order_id, '_billing_address_1', $order->address_line_1, true);
		add_post_meta($order_id, '_billing_address_2', $order->address_line_2, true);
		add_post_meta($order_id, '_billing_city', $order->city, true);
		add_post_meta($order_id, '_billing_state', $order->state, true);
		add_post_meta($order_id, '_billing_postcode', $order->zip, true);
		add_post_meta($order_id, '_billing_country', $order->country, true);
		add_post_meta($order_id, '_billing_email', $order->from_email, true);
		add_post_meta($order_id, '_billing_first_name', $order->first_name, true);
		add_post_meta($order_id, '_billing_last_name', $order->last_name, true);
		add_post_meta($order_id, '_billing_phone', $order->phone, true); */

		// get product by item_id
		$product = get_ninja_product( $pid );

		if( $product ) {

			// add item
			$item_id = wc_add_order_item( $order_id, array(
				'order_item_name'       => $product->get_title(),
				'order_item_type'       => 'line_item'
			) );

			if ( $item_id ) {

				// add item meta data
				wc_add_order_item_meta( $item_id, '_qty', 1 ); 
				wc_add_order_item_meta( $item_id, '_tax_class', $product->get_tax_class() );
				wc_add_order_item_meta( $item_id, '_product_id', $product->ID );
				wc_add_order_item_meta( $item_id, '_variation_id', '' );
				wc_add_order_item_meta( $item_id, '_line_subtotal', wc_format_decimal( $order->gross ) );
				wc_add_order_item_meta( $item_id, '_line_total', wc_format_decimal( $order->gross ) );
				wc_add_order_item_meta( $item_id, '_line_tax', wc_format_decimal( 0 ) );
				wc_add_order_item_meta( $item_id, '_line_subtotal_tax', wc_format_decimal( 0 ) );

			}

			// set order status as completed
			wp_set_object_terms( $order_id, 'completed', 'shop_order_status' );
			
			return $order_id;

		}
	}else{
		return false;
	}
}

function get_ninja_product( $product_id ) {

    if ( $product_id ) return new WC_Product( $product_id );

    return null;
}
function ninja_check_booking($bid){
	
	global $wpdb;
	$results = $wpdb->get_results( "SELECT * FROM `wp_posts` where post_type = 'wc_booking' and ID = $bid", OBJECT );
	
	if(!empty($results)){
		return $results;
	}else{
		return false;
	}
}

function ninja_check_product($bid){
	
	global $wpdb;
	$query = "SELECT * FROM `wp_posts` where post_type = 'product' and post_status = 'publish' and ID = $bid";
	$results = $wpdb->get_results( $query , OBJECT );
	if(!empty($results)){
		return $results;
	}else{
		return false;
	}
}

function ninja_create_quick_add() {

    global $wpdb;
	
	$results = $wpdb->get_results( "SELECT * FROM `wp_posts` p, `wp_terms` t, `wp_term_relationships` tr where t.name='booking' and p.post_type = 'product' and p.post_status = 'publish' and tr.term_taxonomy_id = t.term_id and p.ID = tr.object_id and p.post_title = 'Quick Add' limit 1", OBJECT );
	if(!empty($results)){
		foreach($results as $product){
			$product_id = $product->ID;
		}
		// pre($results);
		return $product_id;
	}else{
		$post = array(
			 'post_title'   => "Quick Add",
			 'post_content' => "Quick Add Google Calendar Booking Product",
			 'post_status'  => "publish",
			 'post_excerpt' => "Quick Add",
			 'post_name'    => "quick-add", //name/slug
			 'post_type'    => "product"
		);
		$new_post_id = wp_insert_post( $post, $wp_error );
		wp_set_object_terms ($new_post_id,'booking','product_type');
		return $new_post_id;
	}
}

function create_ninja_wc_booking( $product_id, $new_booking_data = array(), $status = 'confirmed', $exact = false ) {
	// Merge booking data
	$defaults = array(
		'product_id'  => $product_id, // Booking ID
		'start_date'  => '',
		'end_date'    => '',
		'resource_id' => '',
	);

	$new_booking_data = wp_parse_args( $new_booking_data, $defaults );
	$product          = get_product( $product_id );
	// pre($product);
	$start_date       = $new_booking_data['start_date'];
	$end_date         = $new_booking_data['end_date'];
	$max_date         = $product->get_max_date();

	// If not set, use next available
	if ( ! $start_date ) {
		$min_date   = $product->get_min_date();
		$start_date = strtotime( "+{$min_date['value']} {$min_date['unit']}", current_time( 'timestamp' ) );
	}

	// If not set, use next available + block duration
	if ( ! $end_date ) {
		$end_date = strtotime( "+{$product->wc_booking_duration} {$product->wc_booking_duration_unit}", $start_date );
	}

	$searching = true;
	$date_diff = $end_date - $start_date;

	/* while( $searching ) {

		$available_bookings = $product->get_available_bookings( $start_date, $end_date, $new_booking_data['resource_id'], $data['_qty'] );

		if ( $available_bookings && ! is_wp_error( $available_bookings ) ) {

			if ( ! $new_booking_data['resource_id'] && is_array( $available_bookings ) ) {
				$new_booking_data['resource_id'] = current( array_keys( $available_bookings ) );
			}

			$searching = false;

		} else {
			if ( $exact )
				return false;

			$start_date += $date_diff;
			$end_date   += $date_diff;

			if ( $end_date > strtotime( "+{$max_date['value']} {$max_date['unit']}" ) )
				return false;
		}
	} */

	// Set dates
	$new_booking_data['start_date'] = $start_date;
	$new_booking_data['end_date']   = $end_date;

	// Create it
	$new_booking = get_wc_booking( $new_booking_data );
	$new_booking ->create( $status );

	return $new_booking;
}

function getFormattedTime($time){
	
	$new_date = substr($time, 0, strpos($time, 'T',1));
	$new_hour = substr($time, strpos($time, 'T',1) + 1, 8);
	$new_time = $new_date . ' ' . $new_hour;
	
	$new_format = date("M d, Y @ h:i A", strtotime($new_time));
	return $new_format;
}
function google_woo_page(){
	
	echo '<h1>Google Calendar To Woo Bookings Page</h1>';
	// echo '<br/>';
	// echo get_option('wc_bookings_google_calendar_settings');
	
	$service = get_ninja_google_services();
	if ($service){
	
		echo 'You are authorized.';
	}
}

function update_google_event($event_id, $title){
	
	$service = get_ninja_google_services();
	$calendar_id = get_option('calendar_id');
	
	if($service){
		$currEvent    = $service->events->get($calendar_id, $event_id);
		
		$currEvent->setSummary($title);
		
		$start = new Google_Service_Calendar_EventDateTime();
		$start->setDateTime($currEvent->getStart()->getDateTime());
		$currEvent->setStart($start);
		
		$end = new Google_Service_Calendar_EventDateTime();
		$end->setDateTime($currEvent->getEnd()->getDateTime());
		$currEvent->setEnd($end); 
			
		try{
			$service->events->update($calendar_id, $currEvent->getId(), $currEvent);
			return true;
		}catch(Exception $e){
			// echo 'Events of only primary or shared caledar can be updated';
		}
		return false;
		// echo '<br/>Booking updated on google calendar. <br/>';
		// pre($currEvent);
	}
}

if (!function_exists('pre')) {
	function pre($arr = array()){
		echo '<pre>';
		print_r($arr);
		echo '</pre>';
	}
}