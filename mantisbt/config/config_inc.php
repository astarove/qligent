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
	'reproducibility',
	'severity',
	'steps_to_reproduce',
	'tags',
	'target_version',
	'view_state',
);

#########################
# MantisBT Enum Strings #
#########################
/**
 *
 * @global string $g_severity_enum_string
 */
$g_severity_enum_string = '10:Immediate, 30:Urgent, 50:Hight, 70:Low, 100:Enhancement';

