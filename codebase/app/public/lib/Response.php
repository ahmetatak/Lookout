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

class Response
{
  private $array;
  private $reason;
  private $message;
  private $data;

  public function __construct($statu = "", $code = 0, $message = "", $data = array())
  {
  }
  public function init($statu = "", $code = 0, $message = "", $data = array())
  {
    header('Content-Type: application/json;charset=utf-8');
    return $this->display($statu, $code, $message, $data);
  }
  public function info($code = "", $reason = null, $json = true)
  {
    $this->reason = $reason;
    $this->array =
      array(
        "statu" => "info",
        "error_code" => $code,
        "detail" => $this->reason,



      );

    if ($json)

      return exit(json_encode($this->array));
  }
  public function error($code = "", $reason = null, $json = true)
  {
    $this->reason = $reason;
    $this->array =
      array(
        "statu" => "error",
        "error_code" => $code,
        "detail" => $this->reason,



      );

    if ($json)
      header("Content-type: application/json; charset=utf-8");
    return exit(json_encode($this->array));
  }
  public function success($data = array(), $json = true)
  {
    $d = "data";
    $this->data = $data;
    if (!is_array($this->data))
      $d = "message";
    else $d = "data";
    $this->array =
      array(
        "statu" => "success",
        $d => $this->data,



      );
    if ($json)
      header("Content-type: application/json; charset=utf-8");
    return exit(json_encode($this->array));
  }

  public   function display($statu = true, $code = 0, $message = "", $data = array())
  {
    $this->data = $data;
    $this->message = $message;
    if ($statu == TRUE) {

      if (is_array($this->data) && !empty($this->data)) {
        $this->array =
          array(
            "statu" => "success",
            "code" => $code,
            "message" => $this->message,
            "data" => $this->data


          );
      } else {
        $this->array =
          array(
            "statu" => "success",
            "code" => $code,
            "message" => $this->message,



          );
      }
    } elseif (!$statu) {
      if (is_array($this->data) && !empty($this->data)) {
        $this->array =
          array(
            "statu" => "error",
            "error_code" => $code,
            "detail" => $this->message,
            "data" => $this->data


          );
      } else {
        $this->array =
          array(
            "statu" => "error",
            "error_code" => $code,
            "detail" => $this->message,



          );
      }
    };


    return exit(json_encode($this->array, JSON_UNESCAPED_UNICODE));
  }
}
