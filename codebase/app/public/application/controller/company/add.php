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
class ControllerCompanyAdd extends Controller
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
    private $payload = array();
    public    function __construct()
    {
        parent::__construct();
    }
    public function index($i = "")
    {
        $this->controller_validation(true, TRUE, true);
        if ($this->serviceName == "insertcompany" and $this->isAccount("admin")) {
            $this->form->param("company_name", $this->getParam("company_name"))
                ->isEmpty()
                ->length(4, 100);
            $this->form->param("password", $this->getParam("password"))
                ->isEmpty()
                ->length(6, 100);

            if (!$this->form->submit() == TRUE) {

                $this->data["error"] = $this->form->errors;
                $this->print->init(false, "ErrorList", $this->data["error"]);
            } else {

                $this->user_identitiy = $this->form->values['identity'];
                $this->user_pw = $this->form->values['password'];
                $this->model["login"] = $this->call->model("account/login");
            }
        }
    }
}
