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
class ControllerApiAccountSignup extends Controller
{
   private $username;
   private $phone;
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

      $this->api(TRUE, TRUE, FALSE);
      if ($this->serviceName == "signup") {

         $this->form->param("username", $this->getParam("username"))
            ->isEmpty()
            ->length(3, 20)
            ->isUserName();
         $this->form->param("email", $this->getParam("email"))
            ->isEmpty()

            ->length(6, 100)
            ->isMail();
         $this->form->param("phone", $this->getParam("phone"))
            ->isEmpty()
            ->length(1, 100);

         $this->form->param("password", $this->getParam("password"))
            ->isEmpty()
            ->length(6, 100);





         if (!$this->form->submit() == TRUE) {

            $this->data["errorList"] = $this->form->errors;
            $this->print->init(false, "ErrorList", _("there are some errors"), $this->data["errorList"]);
         } else {
            $this->data["form"] =
               array(
                  "phone" => $this->form->values['phone'],
                  "username" => $this->form->values['username'],
                  "email" =>  $this->form->values['email'],
                  "password" => $this->form->values['password'],
               );
            if (MEMBER_CAN_SIGN_UP == FALSE) {

               $this->print->init(false, "SignupNotActive", _("Signup section is not active now"));
            } else {

               $this->username = Protection::SqlInject($this->form->values['username']);
               $this->email = Protection::SqlInject($this->form->values['email']);
               $this->password = Protection::SqlInject($this->form->values['password']);
               $this->phone = Protection::SqlInject($this->form->values['phone']);
               $this->model["signup"] = $this->call->model("account/signup");
               $this->return = $this->model["signup"]->checkUserName(array("user" => $this->username));
               $checkEmail = $this->model["signup"]->checkEmail(array("email" => $this->email));
               if ($this->return == true) {

                  $this->print->init(false, "UserIsExist", _('username   is  exist!'));
               } else if ($checkEmail == true) {

                  $this->print->init(false, "UserIsExist", _('username or email  is  exist!'));
               } else {

                  $this->model["signup"]->setUsername($this->username);
                  $this->model["signup"]->setEmail($this->email);
                  $this->model["signup"]->setPhone($this->phone);
                  $this->model["signup"]->setPassword(md5($this->password));
                  $this->model["signup"]->setRank("user");
                  $this->model["signup"]->setActive(0);
                  $this->return = $this->model["signup"]->insert();

                  if ($this->return) {

                     $this->print->init(true, "SignUpSuccessful", _('you have signed up successfully'));
                  } else {

                     $this->print->init(true, "SignUpFail", _("sign up fail!"));
                  }
               }
            }
         }
      } else {
         $this->print->init(false, "ErrorAction", _('Action name is not correct'));
      }
      if (MEMBER_CAN_SIGN_UP == FALSE) {

         $this->print->init(true, "SignupNotActive", _("Signup area is closed!"));
      }
   }
}
