<?php
$g_hostname               = 'localhost';
$g_db_type                = 'mysqli';
$g_database_name          = 'bugtracker';
$g_db_username            = 'root';
$g_db_password            = 'Qligent_1!';
$g_default_timezone       = 'Europe/Moscow';
$g_crypto_master_salt     = 'F7cXw5q60zWig1XTPAenhyjr4jeukSbPbW/RRnSTNWQ=';
// e-Mail settings
//$g_path = 'http://82.208.111.89:1337/mantis/';
$g_enable_email_notification = ON;
$g_phpMailer_method = 2;
$g_smtp_host = 'smtp.yandex.ru';
$g_smtp_username = 'help@icom-nn.ru';
$g_smtp_password = 'h234js)(D';
$g_smtp_connection_mode = 'ssl';
$g_smtp_port = '465';
$g_administrator_email = 'help@icom-nn.ru';
$g_webmaster_email = 'help@icom-nn.ru';
$g_from_email = 'help@icom-nn.ru';
$g_return_path_email = 'help@icom-nn.ru';
##########################
# Mantis global settings #
##########################
/**
 * Default Bug View Status (VS_PUBLIC or VS_PRIVATE)
 * @global integer $g_default_bug_view_status
 */
$g_default_bug_view_status = VS_PRIVATE;
/**
 * Allow a bug to have no category
 * @global integer $g_allow_no_category
 */
$g_allow_no_category = ON;
/*
 * @global array $g_bug_report_page_fields
 */
$g_bug_report_page_fields = array(
	'additional_info',
	'attachments',
	'category_id',
	'due_date',
	'handler',
	'priority',
	'product_build',
	'product_version',
	'severity',
	'target_version'
);

/*
 * @global array $g_bug_view_page_fields
 */
$g_bug_view_page_fields = array (
	'additional_info',
	'attachments',
	'date_submitted',
	'description',
	'due_date',
	'fixed_in_version',
	'handler',
	'id',
	'last_updated',
	'product_build',
	'product_version',
	'project',
	'priority',
	'reporter',
	'resolution',
	'severity',
	'status',
	'summary',
	'target_version',
	'view_state',
);

/*
 * @global array $g_bug_update_page_fields
 */
$g_bug_update_page_fields = array (
	'additional_info',
	'attachments',
	'date_submitted',
	'description',
	'due_date',
	'fixed_in_version',
	'handler',
	'id',
	'last_updated',
	'product_build',
	'product_version',
	'project',
	'priority',
	'reporter',
	'resolution',
	'severity',
	'status',
	'summary',
	'target_version',
	'view_state',
);

/*
 * @gloabl array $g_group_names
 */
 $g_group_names = array (
	'support',
);

#########################
# MantisBT Enum Strings #
#########################

/**
 * Position of the filter box, can be: POSITION_*
 * POSITION_TOP, POSITION_BOTTOM, or POSITION_NONE for none.
 * @global integer $g_filter_position
 */
$g_filter_position = FILTER_POSITION_NONE;

/**
 * Access level required to attach tags to a bug
 * @global integer $g_tag_attach_threshold
 */
$g_tag_attach_threshold = NOBODY;

/**
 * Move bug threshold
 * @global integer $g_move_bug_threshold
 */
$g_move_bug_threshold = NOBODY;

/**
 * access level needed to set a bug sticky
 * @global integer $g_set_bug_sticky_threshold
 */
$g_set_bug_sticky_threshold = NOBODY;

/**
 * Default Bugnote View Status (VS_PUBLIC or VS_PRIVATE)
 * @global integer $g_default_bugnote_view_status
 */
$g_default_bugnote_view_status = VS_PRIVATE;

/**
 * Threshold needed to set the view status while reporting a bug or a bug note.
 * @global integer $g_set_view_status_threshold
 */
$g_set_view_status_threshold = DEVELOPER;

/**
 * Threshold needed to update the view status while updating a bug or a bug note.
 * This threshold should be greater or equal to $g_set_view_status_threshold.
 * @global integer $g_change_view_status_threshold
 */
$g_change_view_status_threshold = ADMINISTRATOR;

/**
 * status from $g_status_index-1 to 79 are used for the onboard customization
 * (if enabled) directly use MantisBT to edit them.
 * @global string $g_access_levels_enum_string
 */
$g_access_levels_enum_string = '10:viewer,25:reporter,40:updater,55:developer,60: support,70:manager,90:administrator';

/**
 * @global string $g_resolution_enum_string
 */
$g_resolution_enum_string = '10:open,20:fixed,80:suspended,90:wont fix';

/**
 * @global string $g_severity_enum_string
 */
$g_severity_enum_string = '10:Enhancement, 50:Low, 60:High, 70:Urgent, 80:Immediate';

/**
 * @global array $g_default_notify_flags
 */
$g_notify_flags['new']['threshold_min'] = SUPPORT;
$g_notify_flags['new']['threshold_max'] = SUPPORT;
