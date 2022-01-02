<?php
/* 
 *  ..:: ENGLISH ::..
 *  © 2018 Aljazarisoft.com all rights reserved. Please Read "Licence Agreement & Terms And Conditions" carefully before using this software!
 *  You agree to the Licence Agreement & Terms and Conditions by using this software
 *  Programmed by Ahmet ATAK <info@ahmetatak.net>, <ahmet_atak@msn.com> 
 *  Powered by Aljazarisoft.com | Software & Design <info@aljazarisoft.com>
 *  ..:: Türkçe ::..
 *  © 2017 Aljazarisoft.com her hakkı saklıdır. Bu uygulamayı kullanmadan önce lütfen Lisans Sözleşmesi'ni ve koşulları dikkatle okuyun!
 *  Bu yazılımı kullanarak Lisans Sözleşmesi'ni ve koşulları kabul etmiş olursunuz.
 *  Ahmet ATAK tarafından programlandı <info@ahmetatak.net>, <ahmet_atak@msn.com> 
 *  Aljazarisoft.com [El-Cezerî yazılım] tarafından desteklenmektedir! | Yazılım & Tasarım <info@aljazarisoft.com>
 */

//$key = implode('-', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
//die($key);
// Version



// Configuration

if (file_exists("conf.php") and is_file('conf.php')) {
        require_once('conf.php');
} else
        die(json_encode(array("statu" => "fail", "reason" => _("the configration file is not exist"))));

// Install
if (!defined('DIR_API')) {
        if (file_exists(ROOT . DS . "install/index.php")) {
                header('Location: install/index.php');
                die();
        } else {
                die(json_encode(array("statu" => "fail", "reason" => _("installation is not correct or folder is not exist!"))));
        }
}

// Ready for the magic!
if (file_exists(ROOT . DS . "system/startup.php")) {
        require_once(ROOT . DS . 'system/startup.php');
        start('');
} else {
        die(json_encode(array("statu" => "fail", "reason" => _("startup file cannot be loaded!"))));
}
