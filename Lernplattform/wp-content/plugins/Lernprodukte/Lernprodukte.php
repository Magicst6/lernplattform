


<?php

/*
Plugin Name:  Lernprodukte
Version: 1.0
Description: Manage pupils Uploads.
Author: Stefan Heim
Author URI: 
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: Lernprodukte
*/

	
	
	
	$isheader=0;
	

	add_shortcode( 'TextUser', 'TextUser' );
add_shortcode( 'meineLP', 'meineLP' );
add_shortcode( 'UploadUser', 'UploadUser' );
add_shortcode( 'TabLehrer', 'TabLehrer' );
add_shortcode( 'TabLehrerPlain', 'TabLehrerPlain' );
add_shortcode( 'UploadLehrer', 'UploadLehrer' );


function LP_init(){


   

	
 function meineLP() {

		  ob_start();
	 if (!$isheader) include( 'header.php' );
    include( 'LPInhaltUserPlain.php' );
    return ob_get_clean();
		 $isheader=1;
	 
 }
	

 
	function UploadUser() {
	
		 ob_start();
		if (!$isheader) include( 'header.php' );
    include( 'LPInhaltUserDatei.php' );
    return ob_get_clean();
		$isheader=1;
		
	}
	
	function TextUser() {
	
		 ob_start();
		if (!$isheader) include( 'header.php' );
    include( 'LPInhaltUserText.php' );
    return ob_get_clean();
		$isheader=1;
		
	}
	
		function TabLehrer() {
	
		 ob_start();
			if (!$isheader) include( 'header.php' );
			
    include( 'LPInhalt.php' );
    return ob_get_clean();
		$isheader=1;
	}
		function TabLehrerPlain() {
	
		 ob_start();
			if (!$isheader) include( 'header.php' );
			
    include( 'LPInhaltPlain.php' );
    return ob_get_clean();
		$isheader=1;
	}
	 
	function UploadLehrer() {
	
		 ob_start();
			if (!$isheader) include( 'header.php' );
			
    include( 'UploadLehrer.php' );
    return ob_get_clean();
		$isheader=1;
	}
		
	
}
add_action('init', 'LP_init');

?>


