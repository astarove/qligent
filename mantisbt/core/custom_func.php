<?php

function simple_function(){
	echo "Here!";
}

function summary_by_severity( $p_current_project ){
	$query = "select id, project_id, summary, status, severity, date_submitted from {bug} where severity=80 and status<80";
	if( $p_current_project )
		$query .= " and project_id=".$p_current_project;
	$query .=" order by date_submitted DESC";

        $results = db_query_bound( $query );
        $resnum = db_num_rows($results);

	$current_date = new DateTime();
	echo '<p/>';

	echo '<table class="scrolling-table table table-hover table-bordered table-condensed table-striped">';

	echo '<thead><tr><th>'.
	     lang_get( 'id' ) .'</th><th>'.
	     lang_get( 'summary' ) .'</th><th>'.
	     lang_get( 'project' ) .'</th><th>'.
	     lang_get( 'status' ) .'</th><th>'.
	     lang_get( 'date_submitted' ) .'</th><th>'.
	     lang_get( 'opened_days' ) .'</th></tr></thead><tbody>';

	while ($row = db_fetch_array($results)) {
		$bug_id = $row['id'];
		$bug_title = $row['summary'];
		$bug_project = $row['project_id'];
		$bug_status = $row['status'];
		$bug_date_created = $row['date_submitted'];
		$bug_interval = $current_date -> diff(DateTime::createFromFormat('Y-m-d', date('Y-m-d', $bug_date_created)));

		echo '<tr><td>';
		echo print_bug_link($bug_id) .'</td><td>'. $bug_title .'</td><td>'.
		     project_get_name($bug_project) .'</td><td>'.
		     string_display_line( get_enum_element( 'status', $bug_status )) .'</td><td>'.
		     date('d-m-Y', $bug_date_created) .'</td><td>'.
		     $bug_interval->format('%a') .'</td></tr>';
	}
	echo '</tbody></table>';
}

?>
