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

class ControllerAdminEmployeeDelete extends Controller {

    private $id;

    public function index($i = "") {

        if (!isset($i) or ! is_numeric($i))
            return $this->print->init(false, "WrondIdentity", _("identity must be intager!"));
        else
            $this->id = Protection::sefurl($i);


        if (Session::checklogin("token") == TRUE) {

// $this->Response->success("merhaba");

            if (Session::is("admin")) {
                $this->model = $this->call->model("employee");

                $this->return = $this->model->delete($this->id);
                if ($this->return) {
                    $this->data["response"] = array(
                        "title" => "Success!",
                        "statu" => "success",
                        "code" => "EmployeeDeleted",
                        "message" => _('Employee deleted successfuly!')
                    );
                    header("Location:" . URL . DS . FOLDER_ADMIN . "/employee/all");
                } else {
                    $this->data["response"] = array(
                        "title" => "Error!",
                        "statu" => "danger",
                        "code" => "EmployeeNotDeleted",
                        "message" => _('Employee could not be deleted!')
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
        }

        $this->call->view("employee/all", _("Delete Employee "), $this->data, "admin");
    }

    public function e($i = "") {
        echo 'function e ' . $i;
    }

}
