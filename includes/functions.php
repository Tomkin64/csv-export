<?php
/*
 * Funkce pro TSJC
 */

//config
$table_name = $wpdb->prefix . 'email_log';
$sql = 'SELECT sent_date,subject,message FROM ' . $table_name . ' WHERE `subject` LIKE \'%%[wpdev.eternityhosting.eu]%%\' LIMIT 50';

//nacist tridy
//require_once plugin_dir_path(__FILE__) . 'tsjc-classes.php';

//prida polozku admin menu
add_action( 'admin_menu', 'csv_export_admin_link' );

function csv_export_admin_link()
{
	add_menu_page(
		'CSV Export',
		'CSV Export',
		'manage_options',
		'csv-export-admin-page',
		'csv_export_adminpage_init'
	);
}


function show_db_result()
{
	global $wpdb;
	global $sql;
	$result = $wpdb->get_results($sql);
	echo '<table border="1">
<thead>
  <tr>
    <th>Datum</th>
    <th>Předmět</th>
    <th>Zpráva</th>
</thead>
<tbody>';

	foreach ($result as $key => $value)
	{
		echo '  <tr>';
		echo '    <td>' . $value->sent_date . '</td>';
		echo '    <td>' . $value->subject . '</td>';
		echo '    <td>' . $value->message . '</td>';
		echo '  </tr>';
	}
	unset($key);
	echo '</tbody>
</table>';
	

}

function create_form($filepath)
{
	echo '<form action="'. $filepath .'" method="post" id="form_post" target="_blank">';
	echo '<p class="submit"><input type="submit" class="button-primary" value="Export do CSV"></p>';
	echo '</form>';

}

function export_db_to_csv()
{
	global $wpdb;
	global $sql;
	//$table_name = $wpdb->prefix . 'email_log';
	//$sql = 'SELECT sent_date,to_email,subject,message FROM ' . $table_name . ' WHERE `subject` LIKE \'%% - Bio%%\' LIMIT 50';
	$result = $wpdb->get_results($sql);
	$output = fopen("php://output",'w') or die("Can't open php://output");
	header("Content-Type:application/csv"); 
	header("Content-Disposition:attachment;filename=tsjc-export.csv"); 
	fputcsv($output, array('datum','email','předmět','zpráva'));
	foreach($result as $key => $value) {
		fputcsv($output, array($value->sent_date,$value->to_email,$value->subject,$value->message));
	}
	fclose($output) or die("Can't close php://output");
}

function csv_export_adminpage_init()
{
	require_once plugin_dir_path(__FILE__) . '../admin/admin-page.php';
}
