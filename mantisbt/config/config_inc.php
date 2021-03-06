<?php
$g_hostname               = 'localhost';
$g_db_type                = 'mysqli';
$g_database_name          = 'bugtracker';
$g_db_username            = 'root';
$g_db_password            = 'Qligent_1!';
$g_default_timezone       = 'Europe/Moscow';

$g_crypto_master_salt     = 'SaHvr+uA7Sdx0YdPS9H2NZMvDzvu0OhVvy1rF2dKxy8=';

#$g_phpMailer_method = PHPMAILER_METHOD_MAIL; # or PHPMAILER_METHOD_SMTP, PHPMAILER_METHOD_SENDMAIL
#$g_smtp_host = 'localhost';			# used with PHPMAILER_METHOD_SMTP
#$g_smtp_username = '';					# used with PHPMAILER_METHOD_SMTP
#$g_smtp_password = '';					# used with PHPMAILER_METHOD_SMTP
#$g_webmaster_email = 'support123@qligent.com';
#$g_from_email = 'support@qligent.com;	# the "From: " field in emails
#$g_return_path_email = 'support123@qligent.com';	# the return address for bounced mail


$g_enable_email_notification = ON;
$g_phpMailer_method = 2;
$g_smtp_host = 'smtp.yandex.ru';
$g_smtp_username = 'support.qligent'; 
$g_smtp_password = 'Qwerty12345'; 
$g_smtp_connection_mode = 'ssl';
$g_smtp_port = '465';
// $g_administrator_email = 'support.qligent@yandex.ru';  
$g_webmaster_email = 'support.qligent@yandex.ru';  
$g_from_email = 'support.qligent@yandex.ru'; 
$g_return_path_email = 'support.qligent@yandex.ru'; 
$g_log_level = LOG_EMAIL | LOG_EMAIL_RECIPIENT | LOG_DATABASE;  
$g_from_name = 'Support'; 

$g_debug_email = 'avstaroverov@gmail.com';

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

/**
 * CSV Export
 * Set the csv separator
 * @global string $g_csv_separator
 */
$g_csv_separator = '|';

####################
# Mantis wiki
####################
/**
 * Wiki Integration Enabled?
 * @global integer $g_wiki_enable
 */
$g_wiki_enable = ON;

/**
 * Wiki Engine.
 * Supported engines: 'dokuwiki', 'mediawiki', 'twiki', 'wikka', 'xwiki'
 * @global string $g_wiki_engine
 */
$g_wiki_engine = 'dokuwiki';

/**
 * Wiki namespace to be used as root for all pages relating to this MantisBT
 * installation.
 * @global string $g_wiki_root_namespace
 */
$g_wiki_root_namespace = 'qligent';

/**
 * URL under which the wiki engine is hosted.
 * Must be on the same server as MantisBT, requires trailing '/'.
 * By default, this is derived from the global MantisBT path ($g_path),
 * replacing the URL's path component by the wiki engine string (i.e. if
 * $g_path = 'http://example.com/mantis/' and $g_wiki_engine = 'dokuwiki',
 * the wiki URL will be 'http://example.com/dokuwiki/')
 * @global string $g_wiki_engine_url
 */
$g_wiki_engine_url = 'http://192.168.192.171/mantisbt/dokuwiki/';

#########################
# MantisBT Enum Strings #
#########################

/**
 * bugnote ordering
 * change to ASC or DESC
 * @global string $g_bugnote_order
 */
$g_bugnote_order = 'DESC';

/**
 * access level needed to be able to be listed in the assign to field.
 * @global integer $g_handle_bug_threshold
 */
#$g_update_bug_assign_threshold = SUPPORT;

/**
 *
 * @global string $g_default_bugnote_order
 */
$g_default_bugnote_order = 'ASC';

/**
 * Position of the filter box, can be: POSITION_*
 * POSITION_TOP, POSITION_BOTTOM, or POSITION_NONE for none.
 * @global integer $g_filter_position
 */
$g_filter_position = FILTER_POSITION_TOP;

/**
 * Threshold needed to be able to create stored queries
 * @global integer $g_stored_query_create_threshold
 */
$g_stored_query_create_threshold = NOBODY;

/**
 * Access level required to attach tags to a bug
 * @global integer $g_tag_attach_threshold
 */
$g_tag_attach_threshold = NOBODY;

/**
 * threshold for viewing changelog
 * @global integer $g_view_changelog_threshold
 */
$g_view_changelog_threshold = NOBODY;

/**
 * threshold for viewing roadmap
 * @global integer $g_roadmap_view_threshold
 */
$g_roadmap_view_threshold = NOBODY;
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
$g_severity_enum_string_1 = '10:Enhancement, 30:Consultation, 50:Low, 60:High, 70:Urgent, 80:Immediate';
$g_severity_enum_string_2 = '50:Low, 60:Medium, 70:High, 80:Critical';

$g_severity_enum_string = $g_severity_enum_string_1;
/**
 * @global array $g_default_notify_flags
 */
$g_notify_flags['new']['threshold_min'] = SUPPORT;
$g_notify_flags['new']['threshold_max'] = SUPPORT;

/**
 * System logging
 * This controls the type of logging information recorded.
 * The available log channels are:
 *
 * LOG_NONE, LOG_EMAIL, LOG_EMAIL_RECIPIENT, LOG_EMAIL_VERBOSE, LOG_FILTERING,
 * LOG_AJAX, LOG_LDAP, LOG_DATABASE, LOG_WEBSERVICE, LOG_ALL
 *
 * and can be combined using
 * {@link http://php.net/language.operators.bitwise PHP bitwise operators}
 * Refer to {@link $g_log_destination} for details on where to save the logs.
 *
 * @global integer $g_log_level
 */
$g_log_level = LOG_ALL;

/**
 * @global bool $g_show_stat_by_priority
 */
$g_show_stat_by_priority = false;

/**
 * @global bool $g_show_stat_by_reporters
 */
$g_show_stat_by_reporters = false;

/**
 * @global bool $g_show_stat_by_reporters
 */
$g_show_stat_by_category = false;

/**
 * @global bool $g_show_stat_most_active
 */
$g_show_stat_most_active = false;

/**
 * add new settings to gloabl settings' list
 */
array_push($g_public_config_names, $g_show_stat_by_priority, $g_show_stat_by_reporters, $g_show_stat_most_active,
		   $g_show_stat_by_category);
