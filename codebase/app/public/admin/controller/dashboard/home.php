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

class ControllerAdminDashboardHome extends Controller
{
  public function __construct()
  {
    parent::__construct($i = "");
  }


  public function index($i = "")
  {

    if (Session::checklogin("token") == TRUE) {

      // $this->Response->success("merhaba");
      $this->model = $this->call->model("dashboard");
      if (Session::is("admin")) {
        $this->data["log"] = $this->model->getLog(0, 20);

        $this->data["devices"] = $this->model->getDevices();
        $this->data["deviceCount"] = $this->model->count;
        $this->data["company"] = $this->model->getCompanies();
        $this->data["companyCount"] = $this->model->count;
        $this->data["acconts"] = $this->model->getAccounts();
        $this->data["accountCount"] = $this->model->count;
        $this->data["vehicles"] = $this->model->getVehicles();
        $this->data["vehicleCount"] = $this->model->count;
      }
    }

    $this->call->view("index", _("Control Panel "), $this->data, "admin");
  }
}
