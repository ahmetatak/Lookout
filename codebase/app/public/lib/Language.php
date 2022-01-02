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

class Language
{
    public function __construct()
    {
        $this->lang();
    }
    public function lang()
    {
        ##################################

        define('SESSION_LOCALE_KEY', 'ix_locale');
        define('DEFAULT_LOCALE', 'en_US');
        define('LOCALE_REQUEST_PARAM', 'languages');

        if (array_key_exists(LOCALE_REQUEST_PARAM, $_REQUEST)) {
            $current_locale = $_REQUEST[LOCALE_REQUEST_PARAM];
            $_SESSION[SESSION_LOCALE_KEY] = $current_locale;
        } else {
            $current_locale = DEFAULT_LOCALE;
        }
        putenv("LC_ALL=$current_locale");
        setlocale(LC_ALL, $current_locale);

        $path_to_check = ROOT . DS . PATH_LANGUAGE . "$current_locale/LC_MESSAGES/";

        foreach (glob($path_to_check . "*.mo") as $file) {
            $file = basename($file, ".mo");

            bindtextdomain($file, ROOT . DS . PATH_LANGUAGE);
            bind_textdomain_codeset($file, 'UTF-8');
            textdomain($file);
        }
        ##################################
    }
    public static function errormessage($id = FALSE, $value1 = FALSE, $value2 = FALSE, $value3 = FALSE, $value4 = FALSE)
    {
        $error[1] = _('We are very sorry! "SIGNUP" is closed now. Please try again later. ');
        $error[2] = _('<strong>' . $value1 . '</strong> must be only intager !');
        $error[3] = _('Please type for  the <strong>' . $value1 . '</strong>  field  must be min ' . $value2 . ' and max ' . $value3 . '');
        $error[4] = _('Please enter a valid email address ');
        $error[5] = _('<strong>' . $value1 . '</strong>  cannot be null! ');
        $error[6] = _('  You entered wrong code in the <strong>' . $value1 . '</strong> field. Please be sure you did not entered wrong code ');
        $error[7] = _('<strong>' . $value1 . '</strong> and <strong>' . $value2 . '</strong> is not same! Please be sure you entered same value for the both  fields');
        $error[8] = _('You can type <strong>alphabet (eng)</strong>, <strong>numbers</strong> and only special character <strong>_</strong> for  the <strong>' . $value1 . '</strong> field ');
        $error[9] = '';
        if (isset($error[$id]))
            return $error[$id];
        else return false;
    }
    public static function infomessage($id = FALSE, $value1 = FALSE, $value2 = FALSE)
    {
        $error[1] = _('Sign up now !');
        $error[2] = '';
        $error[3] = '';
        $error[4] = '';
        $error[5] = '';
        $error[6] = '';
        $error[7] = '';
        $error[8] = '';
        $error[9] = '';
        if (isset($error[$id]))
            return $error[$id];
        else return false;
    }
}
