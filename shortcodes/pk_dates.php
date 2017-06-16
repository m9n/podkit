<?php

function pk_dates_shortcode( $atts, $content = null ) {
	if (!is_pods_active()) return 'Shortcode error: the Pods plugin needs to be installed and active to use this shortcode.';
	$a = shortcode_atts( array(
		'opt'    => '',
        'format' => 'j M Y',
        'id'     => get_the_ID()
    ), $atts );
    $output = $end_day = '';

    if (empty($a['opt'])) return 'Shortcode error: pk_dates shortcode needs an <code>opt</code> parameter. Eg. <code>opt="[pod],[start field],[end field]"</code>. End field is optional.';

    $id  = $a['id'];
    
    // prepare pods options
 	$opt = explode(',', $a['opt']);
 	if ( empty($opt[0]) || empty($opt[1])) return 'Shortcode error: you might have made a mistake with your <code>opt</code> synatax.  It should look like this example: <code>opt="[pod],[start field],[end field]"</code>. End field is optional.';
 	$opt = array_filter(array_map('trim', $opt));
 	$pod = $opt[0];
 	$start_field = $opt[1];
 	if (!empty($opt[2])) {
 		$end_field = $opt[2];
 	}

 	// prepare date formats
 	$month_codes = array('F','m','M','n');
    $day_codes   = array('d','D','j');
    $year_codes  = array('Y','y');
 	$formats = explode(' ', $a['format']);
 	$formats = array_filter(array_map('trim', $formats));
 	if ( in_array($formats[0], $day_codes) && in_array($formats[1], $month_codes) && in_array($formats[2], $year_codes) ) {
 		$order = 'DMY';
	 	$format_date = $formats[0];
	 	$format_month = $formats[1];
 		$format_year = $formats[2];
 	}
 	elseif ( in_array($formats[0], $month_codes) && in_array($formats[1], $day_codes) && in_array($formats[2], $year_codes) )  {
 		$order = 'MDY';
	 	$format_month = $formats[0];
 		$format_date = $formats[1];
 		$format_year = $formats[2];
 	}
 	else {
 		$order = 'DMY';
 		$format_date = 'j';
 		$format_month = 'M';
 		$format_year = 'Y';
 	}


 	$get_start = pods_field($pod, $id, $start_field);
 	$starts = strtotime($get_start[0]);

 	$get_end = pods_field($pod, $id, $end_field);
 	$ends = (empty($get_end) || $get_end[0] == '0000-00-00') ? '' : strtotime($get_end[0]);

 	$start_date = date($format_date, $starts);
 	$start_month = date($format_month, $starts);
 	$start_year = date($format_year, $starts);

 	if (!empty($ends)) {
	 	$end_date = date($format_date, $ends);
	 	$end_month = date($format_month, $ends);
	 	$end_year = date($format_year, $ends);
	 	$end_day = ( empty($format_day) ) ? '' : date($format_day, $ends);
 	}
 	$this_year = date($format_year);

 	if ( empty($ends) || $starts == $ends ) {
 		$output = '';
 	}
 	if ( !empty($ends) ) {
 		if ($start_date == $end_date && $start_month == $end_month && $start_year == $end_year) {
 			if ( $start_year == $this_year && $end_year == $this_year)
 				$start_year = $end_year = '';
 			$format = ($order=='DMY') ?

	 			'<div class"date">%1$s %2$s %3$s</div>' :
	 			'<div class"date">%2$s %1$s %3$s</div>' ;
	 		$output = sprintf($format, $start_date, $start_month, $start_year);
 		}
 		elseif ($start_month == $end_month && $start_year == $end_year) {
 			if ( $start_year == $this_year && $end_year == $this_year)
 				$start_year = $end_year = '';
 			$format = ($order=='DMY') ?
	 			'<div class"date">%1$s&ndash;%2$s %3$s %4$s</div>' :
	 			'<div class"date">%3$s %1$s&ndash;%2$s %4$s</div>' ;
	 		$output = sprintf($format, $start_date, $end_date, $start_month, $start_year);
 		}
 		elseif ($start_year == $end_year) {
 			if ( $start_year == $this_year && $end_year == $this_year)
 				$start_year = $end_year = '';
 			$format = ($order=='DMY') ?
	 			'<div class"date">%1$s %2$s&ndash;%3$s %4$s %5$s</div>' :
	 			'<div class"date">%2$s %1$s&ndash;%4$s %3$s %5$s</div>' ;
	 		$output = sprintf($format, $start_date, $start_month, $end_date, $end_month, $start_year);
 		}
 		else {
 			if ( $start_year == $this_year && $end_year == $this_year)
 				$start_year = $end_year = '';
 			$format = ($order=='DMY') ?
	 			'<div class"date">%1$s %2$s %3$s&ndash;%4$s %5$s %6$s</div>' :
	 			'<div class"date">%2$s %1$s %3$s&ndash;%5$s %4$s %6$s</div>' ;
	 		$output = sprintf($format, $start_date, $start_month, $start_year, $end_date, $end_month, $end_year);
 		}
 	} else {
 		$start_year = ($start_year == $this_year) ? '' : $start_year;
 		$format = ($order=='DMY') ?
 			'<div class"date">%1$s %2$s %3$s</div>' :
 			'<div class"date">%2$s %1$s %3$s</div>' ;
 		$output = sprintf($format, $start_date, $start_month, $start_year);
 	}

 	return $output;
}
add_shortcode( 'pk_dates', 'pk_dates_shortcode' );