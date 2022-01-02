<?php
/* 
 *  ..:: ENGLISH ::..
 *  © 2017 Aljazarisoft.com all rights reserved. Please Read "Licence Agreement & Terms And Conditions" carefully before using this software!
 *  You agree to the Licence Agreement and Terms and Conditions by using this software
 *  Programmed by Ahmet ATAK <info@ahmetatak.net> 
 *  Powered by Aljazarisoft.com | Software & Design <info@aljazarisoft.com>
 *  ..:: Türkçe ::..
 *  © 2017 Aljazarisoft.com her hakkı saklıdır. Bu uygulamayı kullanmadan önce lütfen Lisans Sözleşmesi'ni ve koşulları dikkatle okuyun!
 *  Bu yazılımı kullanarak Lisans Sözleşmesi'ni ve koşulları kabul etmiş olursunuz.
 *  Ahmet ATAK tarafından programlandı <info@ahmetatak.net> 
 *  Aljazarisoft.com [El-Cezerî yazılım] tarafından desteklenmektedir! | Yazılım & Tasarım <info@aljazarisoft.com>
 */


#site
define("URL", 'https://' . $_SERVER['SERVER_NAME']);
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__DIR__));


define('PATH_VIEW', ROOT . DS . "api/view/");
define('PATH_MODEL', ROOT . DS . "api/model/");
define('PATH_CONTROLLER', ROOT . DS . "api/controller");
define("CLASS_CONTROLLER", "ControllerApi");
define("CLASS_MODEL", "ModelApi");
define('PATH_SITE_CONFIG', "../concon.php");
define('PATH_START_UP', "../system/startsup.php");
require_once("../concon.php");
