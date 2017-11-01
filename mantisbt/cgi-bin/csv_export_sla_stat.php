<?php
# MantisBT - A PHP based bugtracking system

# MantisBT is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 2 of the License, or
# (at your option) any later version.
#
# MantisBT is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with MantisBT.  If not, see <http://www.gnu.org/licenses/>.

/**
 * This file implements CSV export functionality within MantisBT
 * @package MantisBT
 * @copyright Copyright 2000 - 2002  Kenzaburo Ito - kenito@300baud.org
 * @copyright Copyright 2002  MantisBT Team - mantisbt-dev@lists.sourceforge.net
 * @link http://www.mantisbt.org
 *
 * @uses core.php
 * @uses authentication_api.php
 * @uses columns_api.php
 * @uses constant_inc.php
 * @uses csv_api.php
 * @uses file_api.php
 * @uses filter_api.php
 * @uses helper_api.php
 * @uses print_api.php
 */

# Prevent output of HTML in the content if errors occur
 define( 'DISABLE_INLINE_ERROR_REPORTING', true );

include( '../core.php' );
require_api( 'authentication_api.php' );
require_api( 'columns_api.php' );
require_api( 'constant_inc.php' );
require_api( 'csv_api.php' );
require_api( 'file_api.php' );
require_api( 'filter_api.php' );
require_api( 'helper_api.php' );
require_api( 'print_api.php' );
require_api( 'custom_func.php' );


auth_ensure_user_authenticated();

helper_begin_long_process();

$t_nl = csv_get_newline();
$t_sep = csv_get_separator();

session_start(['read_and_close'=>1]);

csv_start( csv_get_default_filename() );

$t_table = summary_sla_by_severity( $f_project_id, $_SESSION['sla_from'], $_SESSION['sla_to'] );
$t_table = preg_replace("/(<\/td><td id='sla'>)|(<\/th>)/", $t_sep, $t_table);
$t_table = preg_replace("/(<\/td><\/tr>)|(<\/thead><\/tr>)/", $t_nl, $t_table);
$t_table = preg_replace("/\&\#160;/", ' ', $t_table);
$t_table = strip_tags($t_table);

echo $t_table;

?>
