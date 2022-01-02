<?php

/*
 *  ..:: ENGLISH ::..
 *  © 2017-2019 Aljazarisoft.com all rights reserved. Please Read "Licence Agreement & Terms And Conditions" carefully before using this software!
 *  You agree to the Licence Agreement & Terms and Conditions by using this software
 *  Programmed by Ahmet ATAK <info@ahmetatak.net>, <ahmet_atak@msn.com> 
 *  Powered by Aljazarisoft.com | Software & Design <info@aljazarisoft.com>
 *  ..:: Türkçe ::..
 *  © 2017 Aljazarisoft.com her hakkı saklıdır. Bu uygulamayı kullanmadan önce lütfen Lisans Sözleşmesi'ni ve koşulları dikkatle okuyun!
 *  Bu yazılımı kullanarak Lisans Sözleşmesi'ni ve koşulları kabul etmiş olursunuz.
 *  Ahmet ATAK tarafından programlandı <info@ahmetatak.net>, <ahmet_atak@msn.com> 
 *  Aljazarisoft.com [El-Cezerî yazılım] tarafından desteklenmektedir! | Yazılım & Tasarım <info@aljazarisoft.com>
 */

class ControllerApiVehicleFind extends Controller {

    private $vehicle_id;
    private $user_id;
    private $rank;

    public function index($i = "") {
        $this->api(TRUE, FALSE, TRUE);
        if (!isset($i) or ! is_numeric($i))
            $this->page = 1;
        else
            $this->page = Protection::sefurl($i);
        $limit = 10;
        $this->form->param("vehicle_id", $this->getParam("vehicle_id"))
                ->isEmpty()
                ->isInt()
                ->length(1, 11);


        if (!$this->form->submit() == TRUE) {

            $this->data["error"] = $this->form->errors;
            $this->print->init(false, "ErrorList", $this->data["error"]);
        } else {
            $this->user_id = Protection::SqlInject($this->payload->data->userId);
            $this->rank = Protection::SqlInject($this->payload->data->account);
            $this->vehicle_id = Protection::SqlInject($this->form->values['vehicle_id']);
            $this->model["vehicle"] = $this->call->model("vehicle/find");
            $this->data["vehicle"] = $this->model["vehicle"]->getVehicle(array("vehicle" => $this->vehicle_id));
           
            if($this->model["vehicle"]->count > 0) {
                if (!$this->rank == "admin") {
                     $this->return = $this->model["vehicle"]->isEmployeeExist(array("company" => $this->data["vehicle"][0]["company_id"], "account" => $this->user_id));
                if (!$this->return)
                    $this->print->init(false, "UserNotEmployee", "This account is not exist in employee table");
                } 
                $this->data["location"] = $this->model["vehicle"]->location(array("id" => Protection::SqlInject($this->vehicle_id)),0,20);
                if($this->model["vehicle"]->count > 0) {
                  $this->print->init(TRUE, "LocationOfTheVehicle", _('location of the vehicle'),  $this->data["location"]);  
                }else $this->print->init(false, "LocationIsNotExist", _("the vehicle does not have any location record "));
                
            }else
                $this->print->init(false, "VehicleNotExist", _('vehicle is not exist!'));


            if ($this->model["vehicle"]->count > 0) {
               
                $this->print->init(TRUE, "ListOfVehicle", _('list of vehicles'), $this->data["list"]);
            }else {
                $this->print->init(false, "UserNotEmployee", "This account is not exist in employee table");

                $this->print->init(false, "PermissionDenied", _('you do not have permission to access!'));
            }
        }
    }

}
