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

class ControllerAdminVehicleTrack extends Controller {

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

                $this->model = $this->call->model("location");
                $this->data["vehicle"] = $this->model->get(array("id" => Protection::SqlInject($this->id)));
                $this->data["location"] = $this->model->location(array("id" => Protection::SqlInject($this->id)),0,20);
                 
            } else {
                $this->data["response"] = array(
                    "title" => "Error!",
                    "statu" => "danger",
                    "code" => "UserNotExist",
                    "message" => _('you do not have permission to access!')
                );
            }
        }

        $this->call->view("vehicle/track", _("Tracking The Vehicle"), $this->data, "admin");
    }

    public function e($i = "") {
        echo 'function e ' . $i;
    }

}
