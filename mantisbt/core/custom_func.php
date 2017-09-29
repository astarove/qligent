<?php

function simple_function(){
	echo "Here!";
}

function summary_life_time( $p_current_project ){
	$query = "select id, project_id, summary, status, severity, date_submitted, last_updated from {bug} where status=80";
        if( $p_current_project )
                $query .= " and project_id=".$p_current_project;

        $results = db_query_bound( $query );

	$enhanscement_data	= array( 'count' => 0, 'life_time' => 0 );
	$consultation_data	= array( 'count' => 0, 'life_time' => 0 );
	$low_data		= array( 'count' => 0, 'life_time' => 0 );
	$hight_data		= array( 'count' => 0, 'life_time' => 0 );
	$urgent_data		= array( 'count' => 0, 'life_time' => 0 );
	$immediate_data		= array( 'count' => 0, 'life_time' => 0 );

        while ($row = db_fetch_array($results)) {
                $bug_id = $row['id'];
                $bug_title = $row['summary'];
                $bug_project = $row['project_id'];
                $bug_status = $row['status'];
		$bug_severity = $row['severity'];
                $bug_date_created = $row['date_submitted'];
		$bug_date_updated = $row['last_updated'];
                $bug_interval = DateTime::createFromFormat('Y-m-d', date('Y-m-d', $bug_date_updated)) -> diff(DateTime::createFromFormat('Y-m-d', date('Y-m-d', $bug_date_created)));

		switch ( $bug_severity ){
                        case '10': $enhancement_data['count'] += 1;
                                   $enhancement_data['life_time'] += $bug_interval->format('%a');
                                   break;
                        case '30': $consultation_data['count'] += 1;
                                   $consultation_data['life_time'] += $bug_interval->format('%a');
                                   break;
			case '50': $low_data['count'] += 1;
				   $low_data['life_time'] += $bug_interval->format('%a');
				   break;
                        case '60': $hight_data['count'] += 1;
                                   $hight_data['life_time'] += $bug_interval->format('%a');
                                   break;
                        case '70': $urgent_data['count'] += 1;
                                   $urgent_data['life_time'] += $bug_interval->format('%a');
                                   break;
                        case '80': $immediate_data['count'] += 1;
                                   $immediate_data['life_time'] += $bug_interval->format('%a');
                                   break;
		}
	}

	echo "<p>";

        echo '<table class="table table-hover table-bordered table-condensed table-striped">';
        echo '<thead><tr><td>'. lang_get( 'by_severity' ) .'</td><td>Life time (average)</td></tr></thead><tbody>';

	echo "<tr><td>". string_display_line( get_enum_element( 'severity', '80' )) ."</td><td>";
	echo ($immediate_data['count']?$immediate_data['life_time']/$immediate_data['count']:0) ."</td></tr>";

        echo "<tr><td>". string_display_line( get_enum_element( 'severity', '70' )) ."</td><td>";
	echo ($urgent_data['count']?$urgent_data['life_time']/$urgent_data['count']:0) ."</td></tr>";

	echo "<tr><td>". string_display_line( get_enum_element( 'severity', '60' )) ."</td><td>";
	echo ($hight_data['count']?$hight_data['life_time']/$hight_data['count']:0) ."</td></tr>";

	echo "<tr><td>". string_display_line( get_enum_element( 'severity', '50' )) ."</td><td>";
	echo ($low_data['count']?$low_data['life_time']/$low_data['count']:0) ."</td></tr>";

        echo "<tr><td>". string_display_line( get_enum_element( 'severity', '30' )) ."</td><td>";
	echo ($consultation_data['count']?$consultation_data['life_time']/$consultation_data['count']:0) ."</td></tr>";

        echo "<tr><td>". string_display_line( get_enum_element( 'severity', '10' )) ."</td><td>";
	echo ($enhancement_data['count']?$enhancement_data['life_time']/$enhancement_data['count']:'0') ."</td></tr>";

	echo "</tbody></table>";
}

function summary_by_severity_form( $p_current_project ){
	echo '<p/>';

	echo '<table class="table table-hover table-bordered table-condensed table-striped">';
	echo '<tr><td>';
        echo '<form name="select_severity" id="summary_by_severity_form" action="summary_page.php" method="post">';
	echo '<select ';
	echo helper_get_tab_index();
	echo ' id="summary_by_severity" name="severity" class="input-sm">';
        print_enum_string_option_list( 'severity', gpc_get_string('severity', 80) );
	echo '</select>';
	echo '</form>';
	echo '</td></tr>';
	echo '<tr><td>';
	$affected_rows = summary_by_severity( $p_current_project, gpc_get_string('severity', 80) );
	echo '</td></tr>';
	echo '<tr><td><b>';
	echo 'Найдено записей: '. $affected_rows;
	echo '</b></td></tr>';
	echo '</table>';
}

function summary_by_severity( $p_current_project, $p_severity ){
	$query = "select id, project_id, summary, status, severity, date_submitted from {bug} where severity=". $p_severity ." and status<80";
	if( $p_current_project )
		$query .= " and project_id=".$p_current_project;
	$query .=" order by date_submitted DESC";

        $results = db_query_bound( $query );
        $resnum = db_num_rows($results);

	$current_date = new DateTime();

	echo '<table class="scrolling-table table table-hover table-bordered table-condensed table-striped">';

	echo "<thead><tr><th style='width: 70px; text-align:center'>".
	     lang_get( 'id' ) ."</th><th>".
	     lang_get( 'summary' ) ."</th><th style='width: 120px;'>".
	     lang_get( 'project' ) ."</th><th style='width: 120px;'>".
	     lang_get( 'status' ) ."</th><th style='width: 85px;'>".
	     lang_get( 'date_submitted' ) ."</th><th style='width: 70px;'>".
	     lang_get( 'opened_days' ) ."</th><th style='width: 10px;'></th></tr></thead><tbody>";

	while ($row = db_fetch_array($results)) {
		$bug_id = $row['id'];
		$bug_title = $row['summary'];
		$bug_project = $row['project_id'];
		$bug_status = $row['status'];
		$bug_date_created = $row['date_submitted'];
		$bug_interval = $current_date -> diff(DateTime::createFromFormat('Y-m-d', date('Y-m-d', $bug_date_created)));

		echo "<tr><td style='width: 70px; text-align:center;'>";
		echo print_bug_link($bug_id) ."</td><td>". $bug_title ."</td><td style='width: 120px;'>".
		     project_get_name($bug_project) ."</td><td style='width:120px; text-align:center;'>".
		     string_display_line( get_enum_element( 'status', $bug_status )) ."</td><td style='width: 85px; text-align:center;'>".
		     date('d-m-Y', $bug_date_created) ."</td><td style='width: 70px; text-align:center;'>".
		     $bug_interval->format('%a') ."</td></tr>";
	}
	echo '</tbody></table>';
	return ($resnum?$resnum:0);
}

?>
