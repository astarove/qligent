<?php

function simple_function(){
	echo "Here!";
}

function summary_sla_by_severity( $f_project_id, $t_days_from = '', $t_days_to = '' ) {

// $s_status_enum_string = '10:новая,20:запрос информации,30:рассматривается,40:подтверждена,50:назначена,80:решена,90:закрыта';
// '10:Enhancement, 30:Consultation, 50:Low, 60:High, 70:Urgent, 80:Immediate';

	$p_enum_name = "severity";
	$p_val = 0;
	$t_config_var_name = $p_enum_name."_enum_string";

        $t_config_var_value = config_get( $t_config_var_name );

	$t_val = (int)$p_val;

        $t_enum_values = MantisEnum::getValues( $t_config_var_value );

        $today = getdate();

        $t_from_date = strtotime($t_days_from?$t_days_from : $today['mon'].'/'.$today['mday'].'/'.$today['year']);
        $t_to_date = strtotime($t_days_to?$t_days_to : $today['mon'].'/'.$today['mday'].'/'.$today['year']);


	echo "<table  class='table table-hover table-bordered table-condensed table-striped'><thead><tr>";
	echo "<th style='width: 120px;'>" . lang_get('by_severity') ."</th>";
        echo "<th style='width: 120px;'>" . 'Новый' . "</th>";
        echo "<th style='width: 120px;'>" . 'В работе' . "</th>";
        echo "<th style='width: 120px;'>" . 'Решено' . "</th>";
	echo "<th style='width: 120px;'>" . 'Передано на L3' . "</th>";
	echo "<th style='width: 120px;'>" . 'Превышение по SLA, заявок' . "</th>";
	echo "</thead></tr>";

	unset($t_enum_values[0]);
        foreach ( array_reverse($t_enum_values) as $t_key ) {
                $t_elem2 = get_enum_element( $p_enum_name, $t_key );

		echo "<tr><td>". get_enum_element( $p_enum_name, $t_key ) ."</td>";
		$query = "SELECT id FROM mantis_bug_table WHERE severity=". $t_key ." ".
			 " AND (status=10 OR status=20) AND date_submitted BETWEEN ". $t_from_date ." AND ". strtotime("+1 day", $t_to_date). ";";

		$results = db_query_bound( $query );
		echo "<td>". db_num_rows($results) ."</td>";

                $query = "SELECT id FROM mantis_bug_table WHERE severity=". $t_key ." ".
                         " AND (status=30 OR status=40 OR status=50) AND date_submitted BETWEEN ". $t_from_date ." AND ". strtotime("+1 day", $t_to_date). ";";

                $results = db_query_bound( $query );
                echo "<td>". db_num_rows($results) ."</td>";

                $query = "SELECT id FROM mantis_bug_table WHERE severity=". $t_key ." ".
                         " AND (status=80 OR status=90) AND date_submitted BETWEEN ". $t_from_date ." AND ". strtotime("+1 day", $t_to_date). ";";

                $results = db_query_bound( $query );
                echo "<td>". db_num_rows($results) ."</td>";

		$query = "SELECT custom.value FROM mantis_bug_table AS bug JOIN mantis_custom_field_string_table AS custom ON bug.id=custom.bug_id ".
			 "WHERE custom.field_id=".custom_field_get_id_from_name( 'RedMineID' )." AND custom.value<>'' ".
			 "AND bug.severity=". $t_key ." AND bug.date_submitted BETWEEN ". $t_from_date ." AND ". strtotime("+1 day", $t_to_date). ";";
		$results = db_query_bound( $query );
		echo "<td>";
		echo db_num_rows($results)."</td>";

		$query = "SELECT id FROM mantis_bug_table WHERE severity=". $t_key ." AND date_submitted BETWEEN ". $t_from_date ." AND ". strtotime("+1 day", $t_to_date). ";";
		$results = db_query_bound( $query );
		$total = db_num_rows( $results );
		$sla_errs = 0;

		echo "<td>";
		while ( $row = db_fetch_array($results) ){
			$query1 = "SELECT history.date_modified ".
	                          "FROM mantis_bug_table AS bug JOIN mantis_bug_history_table AS history ON bug.id=history.bug_id ".
        	                  "WHERE bug.id=". $row['id'] . " AND bug.severity=". $t_key ." AND bug.status>=80 AND history.old_value<=20 AND new_value>20 ".
                	          "AND bug.date_submitted BETWEEN ". $t_from_date ." AND ". strtotime("+1 day", $t_to_date). ";";
			$query2 = "SELECT history.date_modified ".
                                  "FROM mantis_bug_table AS bug JOIN mantis_bug_history_table AS history ON bug.id=history.bug_id ".
                                  "WHERE bug.id=". $row['id'] . " AND bug.severity=". $t_key ." AND bug.status>=80 AND history.old_value<80 AND new_value>=80 ".
                                  "AND bug.date_submitted BETWEEN ". $t_from_date ." AND ". strtotime("+1 day", $t_to_date). ";";

			$results1 = db_query_bound( $query1 );
			$results2 = db_query_bound( $query2 );

			$row1 = db_fetch_array($results1);
			$row2 = db_fetch_array($results2);

			if ( isset($row1['date_modified']) && isset($row2['date_modified']) ) {
//				echo $row1['date_modified']." ".$row2['date_modified']." ";
                                $interval = round(($row2['date_modified'] - $row1['date_modified'])/(3600*3*8),2); // 60 sec * 60 min * whours * wdays
				$sla_bound_var_name = 'sla_'.strtolower( MantisEnum::getLabel( $t_config_var_value, $t_key ) );
				if( custom_field_get_id_from_name( $sla_bound_var_name ) ) {
					if( (int)custom_field_get_definition( custom_field_get_id_from_name( $sla_bound_var_name ) )['default_value'] < $interval) {
//			                        echo $interval; // work hours
						$sla_errs ++;
					}
				}
			}
		}

		if ( $sla_errs>0 ) {
			$percent = round($sla_errs*100/$total,2);
			echo "$sla_errs (". $percent ."%)";
		}

		echo "</td></tr>";
        };
	echo "</table>";
}

function graph_redmine( $t_days_from = '', $t_days_to = '' ){

	$today = getdate();

        $t_from_date = strtotime($t_days_from?$t_days_from : $today['mon'].'/'.$today['mday'].'/'.$today['year']);
        $t_to_date = strtotime($t_days_to?$t_days_to : $today['mon'].'/'.$today['mday'].'/'.$today['year']);

	$query = "SELECT bug.id, custom.field_id ".
		 "FROM mantis_bug_table AS bug JOIN mantis_custom_field_string_table AS custom ".
		 "WHERE bug.id=custom.bug_id ".
		 "AND custom.field_id=".custom_field_get_id_from_name( 'RedMineID' )." AND custom.value<>'' AND bug.date_submitted BETWEEN ". $t_from_date ." AND ". strtotime("+1 day", $t_to_date). ";";

	$results = db_query_bound( $query );
	$res_ids = db_num_rows($results);

	$query ="SELECT id FROM mantis_bug_table AS bug WHERE bug.date_submitted BETWEEN ". $t_from_date ." AND ". strtotime("+1 day", $t_to_date). ";";
	$results = db_query_bound( $query );
	$res_total = db_num_rows($results);

	echo "<img src='cgi-bin/graph_redmine.php?total=". $res_total ."&redmine_id=". $res_ids ."' alt='' />";
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
        echo '<thead><tr><th>'. lang_get( 'by_severity' ) .'</th><th>'. lang_get( 'life_time' ). '</th></tr></thead><tbody>';

	echo "<tr><td>". string_display_line( get_enum_element( 'severity', '80' )) ."</td><td>";
	echo round( ($immediate_data['count']?$immediate_data['life_time']/$immediate_data['count']:0), 1) ."</td></tr>";

        echo "<tr><td>". string_display_line( get_enum_element( 'severity', '70' )) ."</td><td>";
	echo round( ($urgent_data['count']?$urgent_data['life_time']/$urgent_data['count']:0), 1) ."</td></tr>";

	echo "<tr><td>". string_display_line( get_enum_element( 'severity', '60' )) ."</td><td>";
	echo round( ($hight_data['count']?$hight_data['life_time']/$hight_data['count']:0), 1) ."</td></tr>";

	echo "<tr><td>". string_display_line( get_enum_element( 'severity', '50' )) ."</td><td>";
	echo round( ($low_data['count']?$low_data['life_time']/$low_data['count']:0), 1) ."</td></tr>";

        echo "<tr><td>". string_display_line( get_enum_element( 'severity', '30' )) ."</td><td>";
	echo round( ($consultation_data['count']?$consultation_data['life_time']/$consultation_data['count']:0), 1) ."</td></tr>";

        echo "<tr><td>". string_display_line( get_enum_element( 'severity', '10' )) ."</td><td>";
	echo round( ($enhancement_data['count']?$enhancement_data['life_time']/$enhancement_data['count']:'0'), 1) ."</td></tr>";

	echo "</tbody></table>";
}

function summary_by_severity_form( $p_current_project ){
	echo '<p/>';

	echo '<table class="table table-hover table-bordered table-condensed table-striped">';
	echo '<thead><tr><th>';
        echo '<form name="select_severity" id="summary_by_severity_form" action="summary_page.php" method="post">';
	echo lang_get( 'by_severity' ).':&#160<select ';
	echo helper_get_tab_index();
	echo ' id="summary_by_severity" name="severity" class="input-sm">';
        print_enum_string_option_list( 'severity', gpc_get_string('severity', 80) );
	echo '</select>';
	echo '</form>';
	echo '</th></tr></thead>';
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
