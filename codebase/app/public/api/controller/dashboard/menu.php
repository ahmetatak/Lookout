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

class ControllerApiDashboardMenu extends Controller
{
    private $userid;

    public function __construct()
    {
        parent::__construct($i = "");
    }


    public function index($i = "")
    {
        $this->api(TRUE, false, TRUE);
        if (isset($this->payload->data->userId)) {
            $this->userid = $this->payload->data->userId;
            $this->model["employee"] = $this->call->model("dashboard");
            $this->data["employee"] = $this->model["employee"]->getEmployee(array("account" => $this->userid, "statu" => 1));

            if ($this->data["employee"] == FALSE)
                $this->print->init(false, "UserNotEmployee", "This account is not exist in employee table");
            if ($this->data["employee"][0]["employee_position"] == "ceo")
                $this->data["menu"] = array(
                    "menu" => array("device", "employees", "vehicles", "account")
                );
            else if ($this->data["employee"][0]["employee_position"] == "worker")
                $this->data["menu"] = array(
                    "menu" => array("device", "employees", "vehicles", "account")
                );
            $this->print->init(true, "UserMenu", "user menu", $this->data["menu"]);
        }
    }
}
