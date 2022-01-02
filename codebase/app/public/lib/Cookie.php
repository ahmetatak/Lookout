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
class Cookie  extends Controller
{
  protected $name;
  protected $value;
  protected $domain;
  protected $expire;
  protected $path;
  protected $secure;
  protected $httpOnly;
  const LIMIT_ACCESS = true; //If true, blocks JS cookie API access by default (can be overridden case by case)
  //In some cases you may desire to prefix your cookies
  public static function get($name = false, $decode = false)
  {
    if (!isset($_COOKIE[$name])) {
      return false;
    } else {
      if ($decode) {
        $en = new Encryption();
        return Protection::SqlInject($en->decrypt($_COOKIE[$name]));
      }
    }
    return Protection::SqlInject($_COOKIE[$name]);
  }
  //Pass the 4th optional param as false to allow JS access to the cookie
  public static function set($name = "", $value = "", $expire = "30", $secure = true, $http = true)
  {

    if (self::isSecure())
      $secure = true;
    else
      $secure = false;
    $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
    $expire = strtotime("+" . $expire . " days");

    return setcookie($name, $value, $expire, "/", $domain, $secure, $http);
  }
  public static function delete($key_name)
  {
    $expire = time() - 3600;
    $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
    setcookie($key_name, '', $expire, '/', $domain);
  }
  public static function flush()
  {
    $Cookies = array_keys($_COOKIE);
    foreach ($Cookies as $Cookie) {
      self::delete($Cookie);
    }
  }

  public static function isSecure()
  {
    if ((isset($_SERVER['HTTPS']) && (($_SERVER['HTTPS'] == 'on') || ($_SERVER['HTTPS'] == '1'))) || (isset($_SERVER['HTTPS']) && (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443))) {
      return true;
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
      return true;
    } else {
      return FALSE;
    }
  }

  public  static  function  isUser($type = "")
  {
    if (self::get("token")) {
      try {

        $en = new Encryption();
        $payload = Access::decode($en->decrypt(self::get("token")), ACCESS_SECRETE_KEY, ACCESS_SECRETE_KEY_ENCRYPTION);
        $load = new Load();
        $modelToken = $load->model("account/token");


        $access = $modelToken->getuser(array("user_id" => $payload->data->userId));
        if (!is_array($access)) {
          die(_('This user is not found in our database.'));
        } else {
          if (is_array($access) and !empty($access)) {
            foreach ($access as $key => $v) {
              if ($v["rank"] !== $payload->data->account) {
                die(_("you do not have permission to do that! please contat to admin"));
              }
              $s = $v["active"];
              if ($s == 0) {

                die(_("This user may be decactived. Please contact to admin."));
              } else if ($s == 2) {

                die(_("this account is not exist anymore! please contact to admin!"));
              }
            }
          }
        }
        if (isset($payload->fingerMark) and $payload->data->fingerMark !== $en->password(Protection::ip())) {
          die(_("finger mark is  not correct!"));
        }
        if (isset($payload->account) and $type == $payload->data->account)
          return true;
        else
          return false;
      } catch (Exception $e) {
        if (isset($e)) {
          if ($e->getMessage() == "Expired token") {
          } else {
            echo (_("Token key error"));
          }
        }
      }
    } else
      return false;
  }
}
