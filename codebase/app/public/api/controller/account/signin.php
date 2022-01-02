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

class ControllerApiAccountSignin extends Controller {

    private $user_id;
    private $user_identitiy;
    private $user_pw;
    private $user_type;
    private $tokenLength = 60;
    private $tokenKey;
    private $Auth;
    private $retun;
    private $ip;
    private $captcha;
    private $firebase;
    private $active;



    public function __construct() {
        parent::__construct();
    }

    public function index($i = "") {
        $this->api(TRUE, TRUE, FALSE);
 
     
        if ($this->serviceName=="signin") {
         
            
    
            $this->form->param("identity", $this->getParam("identity"))
                    ->isEmpty()
                    ->length(4, 100);
            $this->form->param("password",  $this->getParam("password"))
                    ->isEmpty()
                    ->length(6, 100);
 
            if (!$this->form->submit() == TRUE) {

                $this->data["errorlist"] = $this->form->errors;
            } else {
 

                $this->user_identitiy = $this->form->values['identity'];
                $this->user_pw = $this->form->values['password'];
                $this->model["login"] = $this->call->model("account/signin");
                
                   $this->data["user"] = $this->model["login"]->login(array("user" => $this->user_identitiy, "password" => md5($this->user_pw)));
                if ($this->data["user"] == FALSE) {
                    $this->data["response"] = array(
                        "title" => "Wrong info!",
                        "statu" => "error",
                        "code" => "UserNotExist",
                        "message" => _('username or password is  not correct!')
                    );
                } else {
                    $this->return = $this->model["login"]->closeSession();
                    $this->user_type = $this->data["user"][0]["rank"];
                    $this->user_id = $this->data["user"][0]["account_id"];
                     $this->return = $this->model["login"]->countSession(array("account_id" => $this->user_id));
                     $this->active=$this->data["user"][0]["active"];
                   if($this->active==0)
                       $this->print->init(false,"UserInActive",_("This user may be decactived. Please contact to admin."));
                     if ($this->return > 5) {
                    $this->data["response"] = array(
                        "title" => "Error",
                        "statu" => "error",
                        "code" => "UserNotExist",
                        "message" => _('you have over 5 different active sessions so we only letyou have max 5 sessions')
                    );
                }else{
                  
                    
         $this->data["token"]=
             array(
              
              'full_name'=>$this->data["user"][0]["fullname"],
              'username'=>$this->data["user"][0]["username"],
              'email'=>$this->data["user"][0]["email"],
              'account' =>$this->user_type,
              'fingerMark'=> $this->encryption->password(Protection::ip()),
	      'userId' =>  $this->user_id,
              'permissions'=>array()
             );
                    $this->tokenKey = $this->generateToken($this->data["token"]);
               
                 
                    $this->return = $this->model["login"]->log(array(
                        "account_id" => $this->user_id,
                        "log_table" => "account",
                        "log_data_id" =>$this->user_id,
                        "log_action" => "signin",
                        "log_datetime" => Time::get(),
                        "log_ip" => Protection::ip(),
                        "log_detail" => "",
                    ));
 $this->data["login"] = array(
     0=>array("account_name_surname" =>$this->data["user"][0]["fullname"],
                        "account_token" => $this->tokenKey)
     
                    );
 
 
                        if(!$this->getParam("firebase")==false and !empty($this->getParam("firebase")))
                        {
                            $this->retun=  $this->model["login"]->updateFirebase($this->user_id,array("firebase_id"=> Protection::SqlInject($this->getParam("firebase"))));
                            
                        }
                        $this->data["response"] = array(
                        "title" => "Successful",
                        "statu" => "success",
                        "code" => "LoginSuccessful",
                        "message" => _("you have logged in successfully"),
                         "data"=> $this->data["login"]
                    ); 
                }
                   
                   
                }    
               



             
            }
        } else {
            
            $this->data["response"] = array(
                        "title" => "Unsuccess",
                        "statu" => "error",
                        "code" => "LoginSuccessful",
                        "message" => _("please be sure your action name is  true!"),
                         );}

        $this->call->view("account/signin", _("Sign in! "), $this->data, "api");
    }

    private function getPermissions() {
        if (isset($this->user_id) and ! empty($this->user_id))
            $this->data["permissions"] = $this->model->getPermissions();
    }

    private function generateToken($data = array()) {
        $token = false;
        $paylod = ['iat' => time(),
            'exp' => time() + (1440 * 60),
            'data'=> $data
        ];

        try {
            $token = Access::encode($paylod, ACCESS_SECRETE_KEY);
        } catch (Exception $e) {
            $this->Response->error(ERROR_CODE_REQUEST_METHOD_NOT_VALID, _("failed to create token key"));
        }

        return $token;
    }

    public function token() {
        $this->controller_validation(TRUE, TRUE, TRUE);
    }

}
