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
class Controller
{
    public $data = array();
    public $column = array();
    public $total;
    public $mail;
    public $model;
    protected $limit;
    protected $start;
    protected $page;
    protected $call;
    public $form;
    protected $param;
    protected $load = array();
    protected $protection;
    protected $return;
    protected $token_acccount_rank;
    private $token_finger_print;
    protected $payload;
    protected $request = array();
    protected $session;
    protected $push;
    protected $print;
    protected $serviceName;
    protected $encryption;
    protected $requared_request = true;
    protected $requared_request_method = true;
    protected $requared_token = true;
    protected $requared_param = true;
    protected  $access;
    public    function __construct()
    {
        $this->access = new Access();
        $this->print = new Response();
        $this->encryption = new Encryption();
        $this->protection = new Protection();
        $this->form = new Form();
        $this->mail = new Mail();
        $this->call = new Load();

        $this->session = new Session();
        $this->push = new Push();

        $this->protection->timeout();
    }

    public function check($arr)
    {
        if (isset($arr) and is_array($arr) and !empty($arr))
            return true;
        else
            return false;
    }

    protected function validateRequest()
    {

        if ($this->requared_request && $_SERVER['REQUEST_METHOD'] !== SERVER_REQUEST_METHOD) {
            $this->print->init(false, ERROR_CODE_REQUEST_METHOD_NOT_VALID, _('Request Method is not valid.'));
        }
        $handler = fopen('php://input', 'r');
        $this->request = stream_get_contents($handler);
        if ($this->requared_request_method && isset($_SERVER['CONTENT_TYPE']) and $_SERVER['CONTENT_TYPE'] !== SERVER_CONTENT_TYPE) {
            $this->print->init(false, ERROR_CODE_REQUEST_CONTENTTYPE_NOT_VALID, _('Request content type is not valid'));
        }

        $data = json_decode($this->request, true);

        if (isset($data['action']))
            $this->serviceName = $data['action'];
        if (isset($data['param']))
            $this->param = $data['param'];
        if ($this->requared_param == true) {

            if (isset($data['param']) && is_array($data['param']) && !empty($data['param'])) {
                $this->param = $data['param'];
            } else
                $this->print->init(false, ERROR_CODE_API_PARAM_REQUIRED, "API PARAM is required.");
        }
    }

    protected function api($req = true, $param = true, $token = true)
    {

        $this->requared_request = $req;
        if ($req)
            $this->requared_request_method = $req;
        else
            $this->requared_request_method = FALSE;
        $this->requared_token = $token;
        $this->requared_param = $param;
        if ($this->requared_token)
            $this->validateToken();

        return $this->validateRequest();
    }
    public function validateToken($token = "")
    {

        try {
            if (empty($token))
                $token = $this->access->getBearerToken();

            $this->payload = Access::decode($token, ACCESS_SECRETE_KEY, ACCESS_SECRETE_KEY_ENCRYPTION);
            $this->model["token"] = $this->call->model("account/token");
            if (!isset($this->payload->data->account))
                $this->print->init(false, "ERROR_ACCOUNT_TYPE_NOT_EXIST", _('Account type is not exist!'));
            else {
                $this->token_acccount_rank = $this->protection->SqlInject($this->payload->data->account);
            }
            if (!isset($this->payload->data->fingerMark))
                $this->print->init(false, "ERROR_FINGER_PRINT", _('fingerprint is not valid!'));
            else {
                $this->token_finger_print = $this->encryption->decrypt($this->protection->SqlInject($this->payload->data->fingerMark));
            }
            if (!isset($this->payload->data->userId) or !is_numeric($this->payload->data->userId))
                $this->print->init(false, ERROR_CODE_VALIDATE_PARAMETER_REQUIRED, _('user identitiy must be intager!'));


            $this->payload->userId = $this->protection->SqlInject($this->payload->data->userId);
            $access = $this->model["token"]->getuser(array("user_id" => $this->payload->data->userId));

            if (!is_array($access)) {
                $this->print->init(false, ERROR_CODE_VALIDATE_PARAMETER_REQUIRED, _('This user is not found in our database.'));
            } else {

                if (is_array($access) and !empty($access)) {
                    foreach ($access as $key => $v) {
                        if ($v["rank"] !== $this->token_acccount_rank) {
                            $this->print->init(false, "ERROR_ACCOUNT_DELETED", _("you do not have permission to do that! please contat to admin"));
                        }
                        $s = $v["active"];
                        if ($s == 0) {
                            $this->print->init(false, ERROR_CODE_USER_NOT_ACTIVE, _("This user may be decactived. Please contact to admin."));
                        } else if ($s == 2) {
                            $this->print->init(false, "ERROR_ACCOUNT_DELETED", _("thisaccount is not exist anymore! please contact to admin!"));
                        }
                    }
                }
            }



            $this->userId = $this->payload->userId;
        } catch (Exception $e) {
            if (isset($e)) {


                if (strpos($e->getMessage(), '.php') or strpos($e->getMessage(), 'Syntax error or access violation'))
                    $this->print->init(false, "UNKNOW_ERROR", _("Database error  error code :") . $e->getCode());
                else if ($e->getMessage() == "Expired token") {
                    $this->print->init(false, ERROR_CODE_ACCESS_TOKEN_ERRORS, $e->getMessage());
                } else if ($e->getMessage() == "Signature") {
                    $this->print->init(false, "ErrorSignature", "Signature verification failed");
                } else if ($e->getMessage() == "Syntax error, malformed JSON") {
                    $this->print->init(false, "ErrorTokenSyntax", "Syntax error, malformed JSON");
                }
            }
        }
    }


    protected function getParam($parname)
    {
        if (!empty($this->param["$parname"]))
            return $this->param["$parname"];
        else {
            return false;
        }
    }

    protected function isAccount($type = "")
    {

        if ($type == $this->token_acccount_rank)
            return true;
        else {
            $this->print->init(false, "ERROR_PERMISSION", _("you do not have permission for the request"));
        }
    }
}
