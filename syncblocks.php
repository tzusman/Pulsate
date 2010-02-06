<?

	include( 'login.php' );

	sync_blocks();

	$m = 'The website has been updated';
	$h = sprintf( 'Location: http://%s/pulse/?m=%s', $domain, urlencode($m) );
	header( $h );

?>
