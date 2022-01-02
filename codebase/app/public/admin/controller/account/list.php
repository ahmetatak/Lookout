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

class ControllerAdminEmployeeList extends Controller {
private $username;
    public function index($i = "") {
      
            $this->username = Protection::sefurl($i);
        





        if (Session::checklogin("token") == TRUE) {

// $this->Response->success("merhaba");

            if (Session::is("admin")) {

                if (isset($this->username) and !empty($this->username)) {
 
 
                        $this->model = $this->call->model("account");
 
            
                        $this->data["accounts"] = $this->model->searchAccount(array("username"=>$this->username));
               
                     
                    }
                }else{
                   $this->data["response"] = array(
                    "title" => "Error!",
                    "statu" => "danger",
                    "code" => "UserNotExist",
                    "message" => _('username not posted!')
                );   
                }
            } else {
                $this->data["response"] = array(
                    "title" => "Error!",
                    "statu" => "danger",
                    "code" => "UserNotExist",
                    "message" => _('you do not have permission to access!')
                );
            }
      

        $this->call->view("employee/list", _("All Employees"), $this->data, "empty");
    }

    public function e($i = "") {
        echo 'function e ' . $i;
    }

}
