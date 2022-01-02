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

class ControllerAdminAccountAdd extends Controller
{
   private $id;
   private $file_id;
   private $file_uploaded;




   public function index($i = "")
   {

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


            if ($this->form->check("username", "POST") and  $this->form->check("fullname", "POST") and $this->form->check("rank", "POST") and $this->form->check("active", "POST")) {

               $this->form->post("username", _("Username"))

                  ->isEmpty()
                  ->length(3, 20)
                  ->isUserName();
               $this->form->post("email", _("Email"))
                  ->isEmpty()
                  ->length(1, 250)
                  ->isMail();
               $this->form->post("password", _("Password"))
                  ->isEmpty()
                  ->length(6, 100);
               $this->form->post("rank", _("Position"))
                  ->isEmpty()
                  ->length(1, 100);
               $this->form->post("fullname", _("Name and surname"))
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
                  if ($this->return == true) {
                     $this->data["response"] = array(
                        "title" => "Wrong info!",
                        "statu" => "danger",
                        "code" => "UserNotExist",
                        "message" => _('that username is already in use.')
                     );
                  } else if (!$checkEmail == FALSE) {
                     $this->data["response"] = array(
                        "title" => "Wrong info!",
                        "statu" => "danger",
                        "code" => "UserNotExist",
                        "message" => _('that email address is already in use.')
                     );
                  } else {
                     $this->data["add"] = array(
                        "username" =>  $this->form->values['username'],
                        "pw" =>  md5($this->form->values['password']),
                        "fullname" =>  $this->form->values['fullname'],
                        "email" =>  $this->form->values['email'],
                        "rank" =>  $this->form->values['rank'],
                        "active" =>  $this->form->values['active']

                     );


                     if (isset($_FILES['fileToUpload']) and !empty($_FILES['fileToUpload'])) {

                        $handle = new Upload(Protection::SqlInject($_FILES['fileToUpload']));
                        if ($handle->uploaded) {
                           $handle->file_new_name_body   = $this->return;
                           $handle->image_resize         = true;
                           $handle->image_x              = 200;
                           $handle->image_ratio_y        = true;
                           $handle->file_new_name_ext = "jpg";
                           $handle->allowed = array('image/*');
                           $handle->process("upload/img/profiles/$this->return/");
                           if ($handle->processed) {
                              $upload = $this->call->model("file");
                              $this->data["file"] = array(
                                 "file_path" => "upload/img/profiles/$this->return/$this->return.jpg",
                                 "file_statu" => 1
                              );
                              $this->file_id = $upload->insert($this->data["file"]);
                              $this->file_uploaded = true;
                              $handle->clean();
                           } else {
                              $this->data["response"] = array(
                                 "title" => "Error!",
                                 "statu" => "danger",
                                 "code" => "UploadError",
                                 "message" => $handle->error
                              );
                              $this->call->view("account/insert", _("Add A New Account"), $this->data, "admin");
                              die();
                           }
                        }
                        $this->return = $this->model->insert($this->data["add"]);
                        if ($this->return) {

                           $this->data["response"] = array(
                              "title" => "Success!",
                              "statu" => "success",
                              "code" => "UpdateSuccess",
                              "message" => _('Employee added sccessfully!')
                           );
                           if ($this->file_uploaded)
                              $update = $this->model->update($this->return, array("file_id" => $this->file_id), FALSE);
                        } else {

                           $this->data["response"] = array(
                              "title" => "Error!",
                              "statu" => "danger",
                              "code" => "EmployeeAddFail",
                              "message" => _('Soryy! account could not add to the database')
                           );
                        }
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

      $this->call->view("account/insert", _("Add A New Account"), $this->data, "admin");
   }
}
