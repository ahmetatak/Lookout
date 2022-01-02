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

class ControllerAdminAccountAll extends Controller
{



    public function index($i = "")
    {
        if (!isset($i) or !is_numeric($i)) {
            $this->page = 1;
        } else {
            $this->page = Protection::sefurl($i);
        }
        $limit = 10;





        if (Session::checklogin("token") == TRUE) {

            // $this->Response->success("merhaba");

            if (Session::is("admin")) {
                $this->model = $this->call->model("account");


                $this->data["start"] = ($this->page - 1) * $limit;

                $this->data["accounts"] = $this->model->all($this->data["start"], $limit);

                $this->data["count"]  = $this->model->count;

                $this->data["page"] = $this->page;
                $this->data["limit"] = $limit;
                $this->data["total"] = ceil($this->data["count"] / $limit);
            } else {
                $this->data["response"] = array(
                    "title" => "Error!",
                    "statu" => "danger",
                    "code" => "UserNotExist",
                    "message" => _('you do not have permission to access!')
                );
            }
        }

        $this->call->view("account/all", _("All Accounts"), $this->data, "admin");
    }

    public function e($i = "")
    {
        echo 'function e ' . $i;
    }
}
