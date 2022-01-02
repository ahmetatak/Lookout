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

class ControllerAdminEmployeeProfile extends Controller
{
  private $id;



  public function index($i = "")
  {
    if (!isset($i) or !is_numeric($i))
      return $this->print->init(false, "WrondIdentity", _("identity must be intager!"));
    else
      $this->id = Protection::sefurl($i);
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

        $this->model = $this->call->model("employee");
        $this->data["employee"] = $this->model->get(array("id" => Protection::SqlInject($this->id)));

        $this->data["com"] = $this->model->getCompanies();

        $this->data["accounts"] = $this->model->getAccounts();
        if ($this->form->check("user", "POST") and $this->form->check("company", "POST") and $this->form->check("position", "POST") and $this->form->check("statu", "POST")) {

          $this->form->post("company", _("Company name"))
            ->isEmpty()
            ->length(1, 100);
          $this->form->post("user", _("Username"))
            ->isEmpty()
            ->length(1, 100);
          $this->form->post("position", _("Position"))
            ->isEmpty()
            ->length(1, 100);


          $this->form->post("statu", _("Statu"))

            ->length(0, 1);

          if (!$this->form->submit() == TRUE) {

            $this->data["errorList"] = $this->form->errors;
          } else {
            $this->data["update"] = array(
              "company_id" =>  $this->form->values['company'],
              "account_id" =>  $this->form->values['user'],
              "employee_position" =>  $this->form->values['position'],
              "employee_statu" =>  $this->form->values['statu']


            );
            $this->return = $this->model->update(Protection::SqlInject($this->id), $this->data["update"]);
            if ($this->return) {

              $this->data["response"] = array(
                "title" => "Success!",
                "statu" => "success",
                "code" => "UpdateSuccess",
                "message" => _('Employee updated successfuly!')
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

    $this->call->view("employee/update", _("Update Employee"), $this->data, "admin");
  }

  public function e($i = "")
  {
    echo $i;
  }
}
