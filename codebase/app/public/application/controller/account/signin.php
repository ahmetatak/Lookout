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
class ControllerAccountSignin extends Controller
{
  private $user_id;
  private $user_identitiy;
  private $user_pw;
  private $user_type;
  private $tokenLength = 60;
  private $tokenKey;
  private $Auth;
  private $retun;
  private $ip;
  private $captcha;
  private $deactive;
  private $active;


  public    function __construct()
  {
    parent::__construct();
  }
  public function index($i = "")
  {

    if ($this->form->check("identity", "POST") and $this->form->check("password", "POST")) {

      $this->form->post("identity", "Identitiy")
        ->isEmpty()
        ->length(4, 100);
      $this->form->post("password", "Password")
        ->isEmpty()
        ->length(6, 100);
      if (SESSION_MEMBER_LOGIN_FAIL_CONTROL == TRUE and  Session::get(SESSION_MEMBER_LOGIN_FAIL_COUNT) > SESSION_MEMBER_LOGIN_FAIL_COUNT_LIMIT) {
        $this->form->post("captcha", _("captcha"))
          ->captcha();
      }


      if (!$this->form->submit() == TRUE) {

        $this->data["errorList"] = $this->form->errors;
      } else {
        if (SESSION_MEMBER_LOGIN_FAIL_CONTROL == TRUE and  Session::get(SESSION_MEMBER_LOGIN_FAIL_COUNT) > SESSION_MEMBER_LOGIN_FAIL_COUNT_LIMIT) {
          $this->captcha = $this->form->values['captcha'];
        }
        $this->user_identitiy = $this->form->values['identity'];
        $this->user_pw = $this->form->values['password'];
        $this->model["login"] = $this->call->model("account/signin");
        $this->data["user"] = $this->model["login"]->login(array("user" => $this->user_identitiy, "password" => md5($this->user_pw)));
        if ($this->data["user"] == FALSE) {
          if (SESSION_MEMBER_LOGIN_FAIL_CONTROL) {
            Session::set(SESSION_MEMBER_LOGIN_FAIL_COUNT, Session::get(SESSION_MEMBER_LOGIN_FAIL_COUNT) + 1);
          }

          $this->data["response"] = array(
            "title" => "Wrong info!",
            "statu" => "danger",
            "code" => "UserNotExist",
            "message" => _('username or password is  not correct!')
          );
        } else {
          if (isset($_POST['remember'])) { // checkbox seçilmişse "on" değeri gönderiliyor
            if (!Cookie::get("remember_me"))
              Cookie::set("remember_me", "true", 30);
          }
          $this->user_type = $this->data["user"][0]["rank"];
          $this->user_id = $this->data["user"][0]["account_id"];
          $this->active = $this->data["user"][0]["active"];
          if ($this->active == 0) {
            $this->data["response"] = array(
              "title" => "Wrong info!",
              "statu" => "danger",
              "code" => "UserNotActive",
              "message" => _('This user may be decactived. Please contact to admin.')
            );
          } else {
            $this->data["token"] =
              array(

                'full_name' => $this->data["user"][0]["fullname"],
                'username' => $this->data["user"][0]["username"],
                'email' => $this->data["user"][0]["email"],
                'account' => $this->user_type,
                'fingerMark' => $this->encryption->password(Protection::ip()),
                'userId' =>  $this->user_id,
              );

            $this->tokenKey = $this->generateToken($this->data["token"]);
            Session::set("token",  $this->tokenKey);

            $this->return = $this->model["login"]->log(array(
              "account_id" => Session::decodeToken()->data->userId,
              "log_table" => "account",
              "log_data_id" => Session::decodeToken()->data->userId,
              "log_action" => "signin",
              "log_datetime" => Time::get(),
              "log_ip" => Protection::ip(),
              "log_detail" => "",
            ));

            $this->data["response"] = array(
              "title" => "Successful!",
              "statu" => "success",
              "code" => "LoginSuccess",
              "message" => _("you have logged successfully")
            );
            $this->data["redirect"] = true;

            if (SESSION_MEMBER_LOGIN_FAIL_CONTROL == TRUE and Session::get(SESSION_MEMBER_LOGIN_FAIL_COUNT) > 0)
              Session::set(SESSION_MEMBER_LOGIN_FAIL_COUNT, FALSE);
          }
        }
      }
    }


    $this->call->view("account/signin", _("Sign in! "), $this->data, "account");
  }





  private function generateToken($data = array())
  {
    $token = false;
    $paylod = [
      'iat' => time(),
      'exp' => time() + (1440 * 60),
      'data' => $data
    ];

    try {
      $token = Access::encode($paylod, ACCESS_SECRETE_KEY);
    } catch (Exception $e) {
      $this->Response->error(ERROR_CODE_REQUEST_METHOD_NOT_VALID, _("failed to create token key"));
    }

    return $token;
  }
  public function token()
  {
    $this->controller_validation(TRUE, TRUE, TRUE);
  }
}
