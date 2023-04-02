<?php
require_once '../../../../wp-load.php';
require_once '../includes/functions.php';
if ( is_user_logged_in() )
{
	global $wpdb;
	global $sql;
	$result = $wpdb->get_results($sql);
	$output = fopen("php://output",'w') or die("Can't open php://output");
	header("Content-Type:application/csv");
	header("Content-Disposition:attachment;filename=tsjc-export.csv");
	fputcsv($output, array('datum','předmět','zpráva'));
	foreach($result as $key => $value) {
		fputcsv($output, array($value->sent_date,$value->subject,$value->message));
	}
	fclose($output) or die("Can't close php://output");
} else {
	echo "err";
}
