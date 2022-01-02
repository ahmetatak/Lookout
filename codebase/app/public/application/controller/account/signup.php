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
class ControllerAccountSignup extends Controller
{
  private $username;
  private $fullname;
  private $email;
  private $password;
  private $captcha;
  private $repassword;

  public    function __construct()
  {
    parent::__construct();
  }
  public function index($i = "")
  {

    if ($this->form->check("username", "POST") and $this->form->check("email", "POST") and $this->form->check("password", "POST") and $this->form->check("repassword", "POST")) {
      $this->form->post("captcha", _("captcha"))
        ->captcha();
      $this->form->post("fullname", _("Name and surname"))
        ->isEmpty()
        ->length(3, 20)
        ->isUserName();
      $this->form->post("username", _("Username"))
        ->isEmpty()
        ->length(3, 100);
      $this->form->post("email", _("Email"))
        ->isEmpty()

        ->length(6, 100)
        ->isMail();
      $this->form->post("password", _("Password"))
        ->isEmpty()
        ->length(6, 100);
      $this->form->post("repassword", _("Password (again)"))
        ->isEmpty()
        ->length(6, 100)
        ->issame(_("Password"), _("Password (again)"), $this->form->values['password'], $this->form->values['repassword']);

      $this->data["form"] =
        array(
          "fullname" => $this->form->values['fullname'],
          "username" => $this->form->values['username'],
          "email" =>  $this->form->values['email'],
          "password" => $this->form->values['password'],
        );

      if (!$this->form->submit() == TRUE) {

        $this->data["errorList"] = $this->form->errors;
      } else {
        if (MEMBER_CAN_SIGN_UP == FALSE) {
          $this->data["response"] = array(
            "title" => "Warning!",
            "statu" => "warning",
            "code" => "SignupNotActive",
            "message" => _("Signup area is closed! ")
          );
        } else {

          $this->username = $this->form->values['username'];
          $this->email = $this->form->values['email'];
          $this->password = $this->form->values['password'];
          $this->fullname = $this->form->values['fullname'];
          $this->model["login"] = $this->call->model("account/signup");
          $this->return = $this->model["login"]->checkUserName(array("user" => $this->username));
          $checkEmail = $this->model["login"]->checkEmail(array("email" => $this->email));
          if ($this->return == true) {
            $this->data["response"] = array(
              "title" => "Wrong info!",
              "statu" => "danger",
              "code" => "UserNotExist",
              "message" => _('username or email  is  exist!')
            );
          } else if ($checkEmail == true) {
            $this->data["response"] = array(
              "title" => "Wrong info!",
              "statu" => "danger",
              "code" => "UserNotExist",
              "message" => _('username or email  is  exist!')
            );
          } else {

            $this->model["login"]->setUsername($this->username);
            $this->model["login"]->setEmail($this->email);
            $this->model["login"]->setFullname($this->fullname);
            $this->model["login"]->setPassword(md5($this->password));
            $this->model["login"]->setRank("user");
            $this->model["login"]->setActive(0);
            $this->return = $this->model["login"]->insert();

            if ($this->return) {
              $this->data["response"] = array(
                "title" => "Successful!",
                "statu" => "success",
                "code" => "LoginSuccess",
                "message" => _("you have signed up successfully")
              );
            } else {
              $this->data["response"] = array(
                "title" => "Successful!",
                "statu" => "danger",
                "code" => "SignUpFail",
                "message" => _("sign up fail!")
              );
            }
          }
        }
      }
    } else {
    }
    if (MEMBER_CAN_SIGN_UP == FALSE) {
      $this->data["response"] = array(
        "title" => "Warning!",
        "statu" => "warning",
        "code" => "SignupNotActive",
        "message" => _("Signup area is closed! ")
      );
    }
    $this->call->view("account/signup", _("Sign Up"), $this->data, "account");
  }
}
