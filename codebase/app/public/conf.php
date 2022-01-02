<?php
/* ..:: ENGLISH ::..
 *  © 2017 Aljazarisoft.com all rights reserved. Please Read "Licence Agreement & Terms And Conditions" carefully before using this software!
 *  You agree to the Licence Agreement,  Terms and Conditions by using this software
 *  Programmed by Ahmet ATAK <info@ahmetatak.net> | Github : https://github.com/ahmetatak | Linkedin : https://tr.linkedin.com/in/ahmetatak | StackOverFlow :https://stackoverflow.com/users/2152934/ahmet-atak
 *  ..:: Türkçe ::..
 *  © 2017 Aljazarisoft.com her hakkı saklıdır. Bu uygulamayı kullanmadan önce lütfen Lisans Sözleşmesi'ni ve Kullanım Koşulları dikkatle okuyun!
 *  Bu yazılımı kullanarak Lisans Sözleşmesi ve Kullanım Koşulları'nı kabul etmiş olursunuz.
 *  Ahmet ATAK tarafından programlandı <info@ahmetatak.net> | Github : https://github.com/ahmetatak | Linkedin : https://tr.linkedin.com/in/ahmetatak | StackOverFlow :https://stackoverflow.com/users/2152934/ahmet-atak
 */

session_start();

#site
error_reporting(E_ERROR | E_WARNING | E_PARSE);
header_remove('x-powered-by');

define('VERSION', '1.0.0');
(!defined("DS") ? define("DS",  DIRECTORY_SEPARATOR) : false);
(!defined("ROOT") ? define("ROOT",  dirname(__FILE__)) : false);
error_reporting(E_ALL & ~E_STRICT);
ini_set('display_errors', 'on');
ini_set('log_errors', 'on');
ini_set('error_log', ROOT . DS . 'tmp' . DS . 'logs' . DS . 'error.log');
error_reporting(E_ALL);
(!defined("TEMPLATE") ? define("TEMPLATE", "default") : false);
(!defined("URL") ? define("URL", "http://localhost:8080") : false);
define('SITE_TITLE', _('Lookout Vehicle Tracking Automation'));
define('DB_PREFIX', 'os_');

define('DB_HOST', 'db_server');
define('DB_DATABASE', 'lookout');
define('DB_USER', 'root');
define('DB_PW', 'jzdb');



#paths & folder names &
define('URL_UPLOAD_PRODUCT', 'upload/products/');
define('PATH_UPLOAD_PRODUCT', ROOT . DS . URL_UPLOAD_PRODUCT);
define('DIR_API', ROOT . DS . "application");
define('DIR_TEMPLATE', ROOT . DS . "template/");
define('DIR_LIB', ROOT . DS . "lib/");
define('FOLDER_ADMIN', "admin");
define('DIR', dirname($_SERVER['PHP_SELF']));

(!defined("PATH_VIEW") ? define("PATH_VIEW", ROOT . DS . "template/" . TEMPLATE) : false);
(!defined("PATH_MODEL") ? define("PATH_MODEL", DIR_API . DS . "model/") : false);

(!defined("PATH_CONTROLLER") ? define("PATH_CONTROLLER", DIR_API . DS . "controller") : false);

(!defined("CLASS_CONTROLLER") ? define("CLASS_CONTROLLER", "Controller") : false);
(!defined("CLASS_MODEL") ? define("CLASS_MODEL", "Model") : false);


define('SESSION_MEMBER_LOGIN_FAIL_CONTROL', TRUE);
define('SESSION_MEMBER_LOGIN_FAIL_COUNT', "member_login_limit");
define('SESSION_MEMBER_LOGIN_FAIL_COUNT_LIMIT', 3);
define('MEMBER_TIMEZONE', 'd.m.Y H:i:s');
define('MEMBER_SESSION_LOGIN', 'Member_login');
define('MEMBER_SESSION_EMAIL', 'Member_mail');
define('MEMBER_SESSION_NICK', 'Member_nick');
define('MEMBER_SESSION_NAME', 'Member_name');
define('MEMBER_SESSION_SNAME', 'Member_sname');
define('MEMBER_SESSION_RANK', 'Member_rank');
define('MEMBER_SESSION_ID', 'Member_id');
define('MEMBER_SESSION_IP', 'Member_ip');
define('MEMBER_SESSION_BROWSER', 'Member_browser');
define('MEMBER_SESSION_WRONG_LOG', 'Member_login_failed');
define('MEMBER_CAN_LOGIN', TRUE);
define('MEMBER_CAN_SIGN_UP', TRUE);

define('ACCESS_SECRETE_KEY', 'LOOKOUT_VEHICLE_TRACKING_SYSTEM');
define('ACCESS_SECRETE_API_URL', 'lookout.apps.aljazarisoft.com');
define('ACCESS_SECRETE_KEY_ENCRYPTION', array("HS256"));
define('ERROR_CODE_REQUEST_METHOD_NOT_VALID', 100);
define('ERROR_CODE_REQUEST_CONTENTTYPE_NOT_VALID', 101);
define('ERROR_CODE_REQUEST_NOT_VALID', 102);
define('ERROR_CODE_VALIDATE_PARAMETER_REQUIRED', 103);
define('ERROR_CODE_VALIDATE_PARAMETER_DATATYPE', 104);
define('ERROR_CODE_API_NAME_REQUIRED', 105);
define('ERROR_CODE_API_PARAM_REQUIRED', 106);
define('ERROR_CODE_API_DOST_NOT_EXIST', 107);
define('ERROR_CODE_INVALID_USER_PASS', 108);
define('ERROR_CODE_USER_NOT_ACTIVE', 109);
define('ERROR_CODE_NOT_WRITABLE', 110);
define('ERROR_CODE_USER_CAPTCHA', 111);

define('ERROR_CODE_USER_CAPTCHA_NO_IMAGE_NAME', 112);
define('ERROR_CODE_ATHORIZATION_HEADER_NOT_FOUND', 113);
define('ERROR_CODE_ACCESS_TOKEN_ERRORS', "ErrorTokenExpired");
define('ERROR_CODE_LOGIN_DISABLE', 115);

define('SERVER_REQUEST_METHOD', 'POST');
define('SERVER_CONTENT_TYPE', 'application/json');

define('SECURITY_CAPTCHA_TIME', 'CAPTCHA_TIME');
define('SECURITY_SESSION_CAPTCHA', 'CAPTCHA');
