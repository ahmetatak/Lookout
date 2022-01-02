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

class Session
{
    public static function init()
    {
        if (!isset($_SESSION) or session_id() === "") {
            ini_set('session.cookie_httponly', 1);
            session_start();
        }
    }



    public static function set($key, $val, $remember = false)
    {

        $_SESSION[$key] = $val;
    }



    public static function get($key)
    {


        if (isset($_SESSION[$key])) {

            return $_SESSION[$key];
        } else {

            return false;
        }
    }
    public static function checklogin($session = false)
    {
        if (self::get($session) == TRUE) {

            $payload = self::decodeToken();
            if (isset($payload) && !empty($payload)) {
                if ($payload->data->account == true)
                    return true;
                else return false;
            } else {
                return false;
            }
        } else {
            self::destroy();
            header("Location:" . URL . "/account/signin");
            die();
        }
    }


    public static function destroy($session = false)
    {
        session_destroy();
    }


    public static function redirect($url = URL, $time = 0, $msj = '')
    {
        $return = ' <META HTTP-EQUIV="REFRESH" CONTENT="' . $time . ';URL=' . $url . '/">';
        echo  $return;
    }
    public static function id()
    {
        return session_id();
    }
    public static function permission($per = "")
    {

        if (isset($per) and self::get(MEMBER_SESSION_LOGIN) == TRUE) {

            if (!self::get(MEMBER_SESSION_IP) == Protection::useip() or self::get(MEMBER_SESSION_BROWSER) !== $_SERVER['HTTP_USER_AGENT']) {
                echo '<script type="text/javascript">alert("' . _("Stolen cookies detected!") . '")</script>';
                echo ' <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=' . URL . '/">';
                self::destroy();
                die();
            } else {
                if (self::get(MEMBER_SESSION_RANK) == MEMBER_RANK_ADMIN)
                    return true;
                else {
                    if (self::get($per) == true)
                        return TRUE;
                    else {
                        echo '<script type="text/javascript">alert("' . _("You do not have permission to continue") . '"); history.back();</script>';
                        echo ' <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=' . URL . '/">';
                        die();
                    }
                }
            }
        } else {
            echo '<script type="text/javascript">alert("' . _("You do not have permission to continue") . '"); history.back();</script>';
            die();
        }

        if (self::get($per) == true)

            return true;
        else {
            echo '<script type="text/javascript">alert("' . _("You do not have permission to continue") . '")</script>';
        }
    }
    public static function is($is = "")
    {
        $payload = self::decodeToken();

        if (isset($payload) && !empty($payload)) {
            if ($is == $payload->data->account)
                return true;
            else return false;
        } else {
            return false;
        }
    }

    public  static  function  decodeToken()
    {
        if (self::get("token")) {
            $payload = array();
            try {
                $payload = Access::decode(self::get("token"), ACCESS_SECRETE_KEY, ACCESS_SECRETE_KEY_ENCRYPTION);
            } catch (Exception $e) {
                if ($e->getMessage() == "Expired token")
                    Access::refresh(self::get("token"));
                return self::decodeToken();
                echo ($e->getMessage());
            }

            return $payload;
        } else
            return false;
    }
}
