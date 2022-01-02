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

class ControllerAdminAccountUpdate extends Controller
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

                $this->model = $this->call->model("account");
                $this->data["account"] = $this->model->getAccount(array("userid" => Protection::SqlInject($this->id)));

                if ($this->form->check("username", "POST") and  $this->form->check("fullname", "POST") and $this->form->check("rank", "POST") and $this->form->check("active", "POST")) {

                    $this->form->post("username", _("Username"))

                        ->isEmpty()
                        ->length(1, 20)
                        ->isUserName();
                    $this->form->post("email", _("Email"))
                        ->isEmpty()
                        ->length(1, 250)
                        ->isMail();
                    $this->form->post("rank", _("Position"))
                        ->isEmpty()
                        ->length(1, 100);
                    $this->form->post("password", _("Password"))
                        ->isEmpty()
                        ->length(6, 100);
                    $this->form->post("fullname", _("Name and surname "))
                        ->isEmpty()
                        ->length(1, 100);
                    $this->form->post("active", _("Active"))
                        ->isInt()
                        ->length(0, 1);


                    if (!$this->form->submit() == TRUE) {

                        $this->data["errorList"] = $this->form->errors;
                    } else {

                        $this->return = $this->model->checkUserName(array("user" => $this->form->values['username']));
                        $checkEmail = $this->model->checkEmail(array("email" => $this->form->values['email']));

                        if ($this->return == true and $this->return[0]["account_id"] !== $this->data["account"][0]["account_id"]) {
                            $this->data["response"] = array(
                                "title" => "Wrong info!",
                                "statu" => "danger",
                                "code" => "UserNotExist",
                                "message" => _('that username address is already in use.')
                            );
                        } else if ($checkEmail == true and  $checkEmail[0]["account_id"] !== $this->data["account"][0]["account_id"]) {
                            $this->data["response"] = array(
                                "title" => "Wrong info!",
                                "statu" => "danger",
                                "code" => "UserNotExist",
                                "message" => _('that email address is already in use.' . $checkEmail[0]["account_id"])
                            );
                        } else {
                            $this->data["update"] = array(
                                "username" =>  $this->form->values['username'],
                                "fullname" =>  $this->form->values['fullname'],
                                "pw" =>  md5($this->form->values['password']),
                                "email" =>  $this->form->values['email'],
                                "rank" =>  $this->form->values['rank'],
                                "active" =>  $this->form->values['active']

                            );
                            $this->return = $this->model->update(Protection::SqlInject($this->id), $this->data["update"]);
                            if ($this->return) {

                                $this->data["response"] = array(
                                    "title" => "Success!",
                                    "statu" => "success",
                                    "code" => "UpdateSuccess",
                                    "message" => _('Account updated successfuly!')
                                );
                            } else {
                                $this->data["response"] = array(
                                    "title" => _("Error!"),
                                    "statu" => "danger",
                                    "code" => "ErrorUpdateAccount",
                                    "message" => _('Account could not be updated!')
                                );
                            }
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

        $this->call->view("account/update", _("Update The Account"), $this->data, "admin");
    }

    public function e($i = "")
    {
        echo 'function e ' . $i;
    }
}
