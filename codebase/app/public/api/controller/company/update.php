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

class ControllerAdminCompanyUpdate extends Controller
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

        $this->model = $this->call->model("company");
        $this->data["company"] = $this->model->get(array("id" => Protection::SqlInject($this->id)));
        //  $this->data["employee"]= $this->model->getEmployee(array("position"=>"CEO"));


        if ($this->form->check("name", "POST")   and $this->form->check("phone", "POST") and $this->form->check("statu", "POST")) {

          $this->form->post("name", _("Company name"))
            ->isEmpty()
            ->length(1, 100);

          $this->form->post("website", _("Website "))
            ->isEmpty()
            ->length(1, 200);

          $this->form->post("email", _("Email"))
            ->isEmpty()

            ->length(6, 100)
            ->isMail();
          $this->form->post("phone", _("Phone"))
            ->isEmpty()
            ->length(1, 200);
          $this->form->post("gsm", _("GSM"))
            ->isEmpty()
            ->length(1, 200);
          $this->form->post("fax", _("Fax"))
            ->isEmpty()
            ->length(1, 200);
          $this->form->post("statu", _("statu"))

            ->length(0, 1);
          $this->form->post("address", _("Address"))
            ->isEmpty()
            ->length(1, 200);
          if (!$this->form->submit() == TRUE) {

            $this->data["errorList"] = $this->form->errors;
          } else {
            $this->data["update"] = array(
              "company_name" =>  $this->form->values['name'],

              "company_mail" =>  $this->form->values['email'],
              "company_website" =>  $this->form->values['website'],
              "company_phone" =>  $this->form->values['phone'],
              "company_gsm" =>  $this->form->values['gsm'],
              "company_fax" =>  $this->form->values['fax'],
              "company_address" =>  $this->form->values['address'],
              "company_statu" =>  $this->form->values['statu'],


            );
            $this->return = $this->model->update(Protection::SqlInject($this->id), $this->data["update"]);
            if ($this->return) {

              $this->data["response"] = array(
                "title" => "Success!",
                "statu" => "success",
                "code" => "UpdateSuccess",
                "message" => _('company updated successfuly!')
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

    $this->call->view("company/update", _("Control Panel "), $this->data, "admin");
  }

  public function e($i = "")
  {
    echo 'function e ' . $i;
  }
}
