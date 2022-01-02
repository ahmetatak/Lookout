<?php

/*
 *  ..:: ENGLISH ::..
 *  © 2017 Aljazarisoft.com all rights reserved. Please Read "Licence Agreement & Terms And Conditions" carefully before using this software!
 *  You agree to the Licence Agreement & Terms and Conditions by using this software
 *  Programmed by Ahmet ATAK <info@ahmetatak.net>, <ahmet_atak@msn.com> 
 *  Powered by Aljazarisoft.com | Software & Design <info@aljazarisoft.com>
 *  ..:: Türkçe ::..
 *  © 2017 Aljazarisoft.com her hakkı saklıdır. Bu uygulamayı kullanmadan önce lütfen Lisans Sözleşmesi'ni ve koşulları dikkatle okuyun!
 *  Bu yazılımı kullanarak Lisans Sözleşmesi'ni ve koşulları kabul etmiş olursunuz.
 *  Ahmet ATAK tarafından programlandı <info@ahmetatak.net>, <ahmet_atak@msn.com> 
 *  Aljazarisoft.com [El-Cezerî yazılım] tarafından desteklenmektedir! | Yazılım & Tasarım <info@aljazarisoft.com>
 */

class ControllerAdminVehicleUpdate extends Controller {

    private $id;

    public function index($i = "") {
        if (!isset($i) or ! is_numeric($i))
            $this->id = 1;
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

                $this->model = $this->call->model("vehicle");
                $this->data["vehicle"] = $this->model->get(array("id" => Protection::SqlInject($this->id)));
                $this->data["employee"] = $this->model->getEmployee(array("position" => "driver"));
                $this->data["com"] = $this->model->getCompanies();
                if ($this->form->check("company", "POST") and $this->form->check("plate", "POST") and $this->form->check("driver", "POST") and $this->form->check("serial", "POST")) {

                    $this->form->post("company", _("Company name"))
                            ->isEmpty()
                            ->length(1, 100);
                    $this->form->post("driver", _("Driver"))
                            ->isEmpty()
                            ->length(1, 100);
                    $this->form->post("serial", _("Serial"))
                            ->isEmpty()
                            ->length(1, 200);


                    $this->form->post("plate", _("Plate"))
                            ->isEmpty()
                            ->length(1, 200);
                    $this->form->post("vehicle", _("Type of vehicle"))
                            ->isEmpty()
                            ->length(1, 200);

                    $this->form->post("statu", _("statu"))
                            ->length(0, 1);

                    if (!$this->form->submit() == TRUE) {

                        $this->data["errorList"] = $this->form->errors;
                    } else {
                        $this->data["update"] = array(
                            "company_id" => $this->form->values['company'],
                            "employee_id" => $this->form->values['driver'],
                            "vehicle_serial_number" => $this->form->values['serial'],
                            "vehicle_plate_number" => $this->form->values['plate'],
                            "vehicle_type" => $this->form->values['vehicle'],
                            "vehicle_statu" => $this->form->values['statu'],
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
                    "title" => "Error!",
                    "statu" => "danger",
                    "code" => "UserNotExist",
                    "message" => _('you do not have permission to access!')
                );
            }
        }

        $this->call->view("vehicle/update", _("Control Panel "), $this->data, "admin");
    }

    public function e($i = "") {
        echo 'function e ' . $i;
    }

}
