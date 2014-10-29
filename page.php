<div class='wrap'>
	<h2><i class="fa fa-thumbs-up"></i> Welcome to your website developed by Fred Bradley</h2>
	<p>As you probably know, this site is built on Wordpress and as such is very versatile in what it can do.</p>
	<p>Below I have listed a couple of bespoke functions that I have added that make your life a little easier to make your website your own.</p>
	<ol>
	<li>Should you find an error or 'bug' then please report it using the link in the top right of the admin screen</li>
	</ol>
	<hr>
	<h2>Ignore below here!</h2>
				<?php 
//	remove_role( 'sra_exec' );

global $current_user, $wpdb;
$role = $wpdb->prefix . 'capabilities';
$current_user->role = array_keys($current_user->$role);
$role = $current_user->role[0];
echo "<pre>";
	var_dump(get_option('site_global_options'));
	//var_dump(get_role( $role ));
	echo "</pre>";
	?>

	
<?php

 
	// HERE IS A TEST!
	$meta = array(
		'invoice_type' => 'ConferenceTicket',
		'invoice_station' => 4573,
		'invoice_fao' => "Donny Darko",
		'invoice_address' => "Stu's New Home",
		'invoice_postcode' => "WC2H 7LA",
	);
	
	$prices = array(
		array(
			'n' => 1,
			'd' => "Aiming for an Error! Priced Entry",
			'p' => 110
		)
	);

/*	echo "<pre>";
	$invoice = new SRA_Invoices();
	$create = $invoice->create_invoice($meta, $prices);
	if ( is_wp_error( $create ) ) {
		$error_string = $result->get_error_message();
		echo '<div id="message" class="error"><p>' . $error_string . '</p></div>';
	} else {
		echo $sendemail;
	}
	echo "</pre>";
	*/
?>	
</div>