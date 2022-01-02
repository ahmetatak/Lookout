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

class ControllerAdminEmployeeAccount extends Controller
{
    private $id;
    private  $method;
    private $username;
    private $email;

    public function index($i = "")
    {
        $this->method = Protection::SqlInject($i);
        if (method_exists($this->method, 'foo')) {
            return $this->method();
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




    }

    public function add()
    {
        if (Session::checklogin("token") == TRUE) {
            // $this->Response->success("merhaba");
            if (Session::is("admin")) {

                $this->model = $this->call->model("account");



                if ($this->form->check("username", "POST") and $this->form->check("fullname", "POST") and $this->form->check("email", "POST") and $this->form->check("password", "POST")) {
                    $this->form->post("username", _("Username"))
                        ->isEmpty()
                        ->length(1, 20)
                        ->isUserName();
                    $this->form->post("fullname", _("Name & Surname"))
                        ->isEmpty()
                        ->length(1, 100);
                    $this->form->post("email", _("Email"))
                        ->isEmpty()
                        ->length(1, 100)
                        ->isMail();
                    $this->form->post("password", _("Password"))
                        ->isEmpty()
                        ->length(6, 100);
                    $this->form->post("rank", _("Position"))
                        ->length(1, 100);
                    $this->form->post("statu", _("Active"))
                        ->isInt()
                        ->length(0, 1);
                    if (!$this->form->submit() == TRUE) {

                        $this->data["errorList"] = $this->form->errors;
                    } else {

                        $this->return = $this->model->checkUserName(array("user" => $this->form->values['username']));
                        $checkEmail = $this->model->checkEmail(array("email" => $this->form->values['email']));
                        if ($this->return == true) {
                            $this->data["response"] = array(
                                "title" => "Wrong info!",
                                "statu" => "danger",
                                "code" => "UserNotExist",
                                "message" => _('username or email  is  exist!')
                            );
                        } else if ($checkEmail == true) {
                            $this->data["response"] = array(
                                "title" => "Wrong info!",
                                "statu" => "danger",
                                "code" => "UserNotExist",
                                "message" => _('username or email  is  exist!')
                            );
                        } else {
                            $this->data["add"] = array(
                                "username" =>  $this->form->values['username'],
                                "email" =>  $this->form->values['email'],
                                "femail" =>  $this->form->values['email'],
                                "pw" => md5($this->form->values['password']),
                                "fullname" =>  $this->form->values['fullname'],
                                "active" =>  $this->form->values['statu'],
                                "rank" =>  $this->form->values['rank']
                            );
                            $this->return = $this->model->insert($this->data["add"]);
                            if ($this->return) {

                                $this->data["response"] = array(
                                    "title" => "Success!",
                                    "statu" => "success",
                                    "code" => "AccounInsertSuccess",
                                    "message" => _('Account added sccessfully!')
                                );
                            } else {

                                $this->data["response"] = array(
                                    "title" => "Error!",
                                    "statu" => "danger",
                                    "code" => "AccountAddFail",
                                    "message" => _('Soryy! account could not add to the database')
                                );
                            }
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

        $this->call->view("employee/accountadd", _("Add Account"), $this->data, "empty");
    }
}
