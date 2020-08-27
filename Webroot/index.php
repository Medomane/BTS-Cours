<?php
define('ROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_NAME"]));
define('WEBROOT', ROOT."Webroot/");
define('DIR_WEBROOT', explode(WEBROOT,dirname(__FILE__))[0]);
define('DIR_ROOT', rtrim(explode(WEBROOT,dirname(__FILE__))[0],"Webroot"));
define('UPLOADS_DIR', DIR_WEBROOT.'/uploads/');

require(DIR_ROOT . "Config/hook.php");
require(DIR_ROOT . "Core/Func.php");
require(DIR_ROOT . "Core/Session.php");
require(DIR_ROOT . "Core/AuthUser.php");
require(DIR_ROOT . "Config/conf.php");
require(DIR_ROOT . "Core/Model.php");
require(DIR_ROOT . "Core/Controller.php");
require(DIR_ROOT . "Core/Authentication.php");
require(DIR_ROOT . "Core/Notify.php");
require(DIR_ROOT . "Core/Form.php");

require(DIR_ROOT . 'router.php');
require(DIR_ROOT . 'request.php');
require(DIR_ROOT . 'dispatcher.php');

$dispatch = new Dispatcher();
$dispatch->dispatch();
?>