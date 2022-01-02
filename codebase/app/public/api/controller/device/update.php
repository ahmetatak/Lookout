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

class ControllerAdminDeviceUpdate extends Controller
{
  private $id;



  public function index($i = "")
  {
    if (!isset($i) or !is_numeric($i)) {
      return $this->print->init(false, "WrondIdentity", _("identity must be intager!"));
    } else {
      $this->id = Protection::sefurl($i);
    }
    //             $limit = 20;
    //    
    //if(isset($d))
    //$page=Suzgec::suz($d);   
    //if(!isset($page) or !is_numeric($page)){
    //$page=1; 
    //} 
    //$baslangic = ($page-1)*$limit;
    //$count  = $this->model->toplam($baslangic,$limit);
    // 
    //$data["duyurular"]=$this->model->duyurular($baslangic,$limit);
    //$data["sayfa"]=$page;
    //$data["toplam"]=$count;
    //$data["limit"]=$limit;
    //$data["toplamsayfa"] = ceil($count / $limit);


    if (Session::checklogin("token") == TRUE) {
      // $this->Response->success("merhaba");

      if (Session::is("admin")) {

        $this->model = $this->call->model("device");
        $this->data["device"] = $this->model->get(array("id" => Protection::SqlInject($this->id)));
        $this->data["vehicles"] = $this->model->getVehicles(array("position" => "CEO"));
        if ($this->form->check("serial", "POST") and $this->form->check("owner", "POST") and $this->form->check("os", "POST") and $this->form->check("statu", "POST")) {

          $this->form->post("key", _("Device Access key"))
            ->isEmpty()
            ->length(1, 100);
          $this->form->post("serial", _("Serial number"))
            ->isEmpty()
            ->length(1, 100);
          $this->form->post("os", _("Device OS Version"))
            ->isEmpty()
            ->length(1, 200);


          $this->form->post("owner", _(" Vehicle Plate Number"))
            ->isEmpty()
            ->length(1, 11);

          $this->form->post("statu", _("Statu"))

            ->length(0, 1);
          if (!$this->form->submit() == TRUE) {

            $this->data["errorList"] = $this->form->errors;
          } else {
            $this->data["update"] = array(
              "device_access_key" =>  $this->form->values['key'],
              "device_serial_number" =>  $this->form->values['serial'],
              "vehicle_id" =>  $this->form->values['owner'],
              "device_statu" =>  $this->form->values['statu'],

              "device_version" =>  $this->form->values['os'],


            );


            $this->return = $this->model->update(Protection::SqlInject($this->id), $this->data["update"]);
            if ($this->return) {

              $this->data["response"] = array(
                "title" => "Success!",
                "statu" => "success",
                "code" => "UpdateSuccess",
                "message" => _('device information updated successfuly!')
              );
            }
          }
        }
      } else {
        $this->data["response"] = array(
          "title" => "Wrong info!",
          "statu" => "danger",
          "code" => "UserNotExist",
          "message" => _('you do not have permission to access!')
        );
      }
    }

    $this->call->view("device/update", _("Update The Device"), $this->data, "admin");
  }

  public function e($i = "")
  {
    echo 'function e ' . $i;
  }
}
