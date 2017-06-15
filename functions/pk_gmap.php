<?php

if (!function_exists('pk_gmap')) {
	function pk_gmap($address) {
		if (!empty($address)) {
			$output = '<iframe style="width: 100%; min-height:300px"'
						. 'frameborder="0" scrolling="no" marginheight="0" marginwidth="0"'
						. 'src="https://maps.google.com/maps?q='
						. $address
						. ', &t=&z=15&ie=UTF8&iwloc=&output=embed"></iframe>';
			return $output;
		}
		else return;
	}
}