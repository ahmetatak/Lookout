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

class ControllerApiVehicleAll extends Controller
{
    private $userid;
    public function __construct($i = "")
    {
        parent::__construct();
        if (!isset($i) or !is_numeric($i)) {
            $this->page = 1;
        } else {
            $this->page = Protection::sefurl($i);
        }
        return $this->all();
    }


    public function all($i = "")
    {
        $this->api(TRUE, FALSE, TRUE);
        if (!isset($i) or !is_numeric($i))
            $this->page = 1;
        else
            $this->page = Protection::sefurl($i);
        $limit = 10;

        $this->userid = $this->payload->data->userId;
        // $this->Response->success("merhaba");
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
        if (TRUE) {
            $this->model["vehicle"] = $this->call->model("vehicle");
            $this->data["start"] = ($this->page - 1) * $limit;
            $this->data["vehicles"] = $this->model["vehicle"]->all(array("company" => $this->data["employee"][0]["company_id"]), $this->data["start"], $limit);
            $this->data["count"]  = $this->model["vehicle"]->count;
            $this->data["page"] = $this->page;
            $this->data["limit"] = $limit;
            $this->data["total"] = ceil($this->data["count"] / $limit);
            $this->data["list"] = array(
                "page" => $this->page,
                "count" => $this->data["count"],
                "total" => $this->data["total"],
                "vehicles" => $this->data["vehicles"]
            );
            $this->print->init(TRUE, "ListOfVehicle", _('list of vehicles'), $this->data["list"]);
        } else {

            $this->print->init(false, "PermissionDenied", _('you do not have permission to access!'));
        }
    }
}
