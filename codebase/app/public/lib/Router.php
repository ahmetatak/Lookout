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
class Router extends Response
{
  public $length;
  private $path;
  private $path2;
  private $controller;
  private $method;
  private $folder;
  private $api;
  private $admin;

  private $param;
  public function __construct($url = "")
  {
    parent::__construct($url);
    $this->start($url);
  }
  private function start($url = "")
  {
    #first of all parsel the url 
    $this->url = $this->parseUrl($url);
    $this->initController();
  }

  private function parseUrl($uri = "")
  {
    $this->url =  explode("/", filter_var(rtrim(Protection::SqlInject($uri), "/")));



    return $this->url;
  }
  private function initController()
  {


    $this->length = count($this->url);

    if ($this->length == 0 or empty($this->url[0])) {
      $this->folder = "";
      $this->url[0] = "home";
      $this->url[1] = "index";
    }



    $this->initPath();
  }

  private function initPath()
  {

    if (isset($this->url[0]) and isset($this->url[1]))
      $this->path = PATH_CONTROLLER . DS . $this->url[0] . "/" . $this->url[1] . ".php";
    if (isset($this->url[0]));
    $this->path2 = PATH_CONTROLLER . DS . $this->url[0] . ".php";


    if (file_exists($this->path)) {
      require_once $this->path;

      $this->controller = str_replace('/', '', CLASS_CONTROLLER . DS . $this->url[0] . $this->url[1]);
      if (isset($this->url[3]))
        $this->method = $this->url[3];
      else
        $this->method = "";
      unset($this->url[0]);
      unset($this->url[1]);
      if (isset($this->url[3]))
        unset($this->url[3]);
      $this->url = array_merge($this->url);
      $this->initMethod();
    } else {

      if (file_exists($this->path2)) {
        require_once $this->path2;

        $this->controller = str_replace('/', '', CLASS_CONTROLLER . DS . $this->url[0]);

        if (isset($this->url[0]))
          unset($this->url[0]);
        $this->url = array_merge($this->url);
        $this->initMethod();
      } else return $this->init(FALSE, "404", _("Controller is not exist"));
    }
  }

  private function initMethod($controller = "")
  {

    if (class_exists($this->controller)) {

      $controller = $this->controller;
      $this->controller = new  $this->controller;
      if (isset($this->url[0]))
        $this->method = $this->url[0];

      if (method_exists($controller,  $this->method)) {
        if (isset($this->url[0])) {

          unset($this->url[0]);
          $this->url = array_merge($this->url);
        }
        $reflection = new ReflectionMethod($controller, $this->method);
        if (!$reflection->isPublic())
          $this->init(false, "noPerm", _("You do not have permission to access"));

        $this->param = array_values($this->url);
        return call_user_func_array([$this->controller, $this->method], $this->param);
      } else {
        if (method_exists($this->controller, "index")) {
          $this->param = array_values($this->url);
          return call_user_func_array([$this->controller, "index"], $this->param);
        } else {
          $this->param = array_values($this->url);
          return call_user_func_array([$this->controller, '__construct'], $this->param);
        }
      }
    } else {
      $this->init(FALSE, "ClassNotExist", _("please be sure your class name is correct"));
    }
  }
}
