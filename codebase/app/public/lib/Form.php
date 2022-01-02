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

class Form extends Controller
{
    public $currentValue;
    public $values = array();
    public $errors = array();
    private $Filter;
    private $type;
    private $class;
    private $id;
    private $value;
    private $required;
    private $max;
    private $min;
    private $name;
    private $step;
    private $checked;
    private $option;

    public function __construct()
    {

        $this->protection = new Protection();
    }
    public function check($key, $type = "POST")
    {
        if ($type == "POST") {
            if (isset($_POST[$key]))
                return true;
            else
                return false;
        } elseif ($type == "GET") {
            if (isset($_GET[$key]))
                return true;
            else return FALSE;
        }
    }
    public function param($key = "", $value = "", $type = "post")
    {
        if (isset($key) && isset($value)) {
            $this->values[$key]     = $this->protection->SqlInject(trim($value));
            $this->name = $this->protection->SqlInject(trim($key));
            $this->currentValue    = $key;
            return $this;
        } else {

            return $this->print->init("MissingFormValue", _("There are some missing form values!"));
        }
    }
    public function post($key = "", $name = "", $type = "POST")
    {

        if (isset($_POST[$key]) and $type == "POST") {

            $this->values[$key]     = $this->protection->SqlInject(trim($_POST[$key]));
            $this->name = $this->protection->SqlInject(trim($name));

            $this->currentValue    = $key;
            return $this;
        } elseif (isset($_GET[$key]) and $type == "GET") {
            $this->values[$key]     = $this->protection->SqlInject(trim($_GET[$key]));
            $this->currentValue    = $key;
            return $this;
        } else {
            $response = new Response();
            return $response->init(false, "MissingFormValue", _("There are some missing form values!" . $key));
        }

        return $this;
    }
    public function isEmpty($postname = "")
    {
        if (empty($this->values[$this->currentValue])) {
            if (isset($postname) and !empty($postname))
                $this->name = $postname;

            $this->errors[$this->currentValue]['empty'] = sprintf(_('%s cannot be empty!'), $this->name);
        }

        return $this;
    }
    public function isDouble()
    {


        if (is_double(doubleval(trim($this->values[$this->currentValue]))) == FALSE or doubleval(trim($this->values[$this->currentValue])) == 0) {

            $this->errors[$this->currentValue]['isDouble'] = sprintf(_('%s must be intager, float or double !'), $this->name);
        }
        return $this;
    }
    public function isInt()
    {

        if (ctype_digit($this->values[$this->currentValue]) == FALSE) {

            $this->errors[$this->currentValue]['isInt'] = sprintf(_('%s must be intager or number !'), $this->name);
        }
        return $this;
    }
    public function length($min = 0, $max)
    {
        $this->values[$this->currentValue] = str_replace("\r\n", '', $this->values[$this->currentValue]);
        if (strlen(utf8_decode($this->values[$this->currentValue])) < $min or strlen(utf8_decode($this->values[$this->currentValue])) > $max) {

            $this->errors[$this->currentValue]['length'] = sprintf(_(' %s must be bigger than %s and  smaller than %s characters!'), $this->name, $min, $max);
        }
        return $this;
    }
    public function isMail()
    {
        if (!filter_var($this->values[$this->currentValue], FILTER_VALIDATE_EMAIL)) {

            $this->errors[$this->currentValue]['mail'] = sprintf(_(' %s must be in  email format ex: a@b.com!'), $this->name);
        }
    }
    public function captcha()
    {

        if ($this->values[$this->currentValue] !== Session::get(SECURITY_SESSION_CAPTCHA)) {


            $this->errors[$this->currentValue]['captcha'] = sprintf(_('wrong %s '), $this->name);
        } else {
            Session::set(SECURITY_SESSION_CAPTCHA, false);
        }


        return $this;
    }
    public function issame($post1, $post2, $valu1 = "", $valu2 = "")
    {

        if ($valu1 != $valu2) {
            if (isset($postname) and !empty($postname))
                $this->name = $postname;

            $this->errors[$this->currentValue]['issame'] = sprintf(_(' %s and %s must be same!'), $post1, $post2);
        } else


            return $this;
    }


    public function isUserName($postname = "")
    {
        if (empty($this->values[$this->currentValue])) {
            $this->errors[$this->currentValue]['user'] = sprintf(_('%s canno bet empty'), $this->name);
        } else {
            $valu = $this->values[$this->currentValue];

            if (!preg_match('/^[A-Za-z0-9_]+$/', $valu) | !ctype_alpha($valu[0])) {
                if (isset($postname) and !empty($postname))
                    $this->name = $postname;
                $this->errors[$this->currentValue]['user'] = sprintf(_('%s should not be contained unknow characters'), $this->name);
            } else


                return $this;
        }
    }


    public function finduser($postname = "")
    {
        $valu = $this->values[$this->currentValue];

        $data = array(
            ":user" => $valu,
        );

        $sql = 'CALL checkUserName(:user)';
        $count = $this->db->affectedRows($sql, $array);
        if ($count == true) {
            if (isset($postname) and !empty($postname))
                $this->name = $postname;
            $message = sprintf(_('  %s is exist please try another one'), $this->name);
            $this->errors[$this->currentValue]['finduser'] = $message;
        } else {
            return $this;
        }
    }
    public function findmail($postname = "")
    {
        $valu = $this->values[$this->currentValue];
        $data = array(
            ":email" => $valu,
        );
        $sql = 'CALL checkUserEmail(:email)';
        $count = $this->db->affectedRows($sql, $data);

        if ($count == true) {
            if (isset($postname) and !empty($postname))
                $this->name = $postname;

            $message = sprintf(_('  %s is exist please try another one'), $this->name);
            $this->errors[$this->currentValue]['findmail'] = $message;
        } else {
            return $this;
        }
    }

    public function submit()
    {
        if (empty($this->errors)) {
            return true;
        } else {
            return false;
        }
    }

    public function build($data = array())
    {

        if (isset($data) and is_array($data) and !empty($data)) {
            $this->type = (isset($data["type"]) ? $data["type"] : die(_("form type must be entered")));
            $this->name = (isset($data["name"]) ? $data["name"] : die(_("form name must be entered")));
            $this->id = (isset($data["id"]) ? $data["id"] : die(_("form id must be entered")));
            $this->value = (isset($data["value"]) ? 'value="' . $data["value"] . '"' : '');
            $this->class = (isset($data["class"]) ? $data["class"] : 'form-control');
            $this->max = (isset($data["max"]) ? 'max="' . $data["max"] . '"' : '');
            $this->min = (isset($data["min"]) ? 'min="' . $data["min"] . '"' : '');
            $this->required = (isset($data["required"]) ? 'required' : '');
            $this->checked = (isset($data["checked"]) ? 'checked' : '');
            $this->step = (isset($data["step"]) ? 'step="' . $data["step"] . '"' : '');
            if (isset($data["type"]) and $data["type"] == "select" and isset($data["option"]) and is_array($data["option"])) {
                $this->option = (isset($data["step"]) ? 'step="' . $data["step"] . '"' : '');
                foreach ($data["option"] as $key => $opt) {
                    if (isset($opt["selected"]))
                        $this->option = $this->option . ' <option selected value="' . $key . '">' . $opt . ' </option>';
                    else
                        $this->option = $this->option . ' <option   value="' . $key . '">' . $opt . ' </option>';;
                }
            }
        }
        if ($this->type == "text") {
            return '<input type="text" name="' . $this->name . '" id="' . $this->id . '" class="' . $this->class . '" ' . $this->required . ' ' . $this->value . '>';
        } elseif ($this->type == "password") {
            return '<input type="password" name="' . $this->name . '" id="' . $this->id . '" class="' . $this->class . '" ' . $this->required . ' ' . $this->value . '>';
        } elseif ($this->type == "email") {
            return '<input type="email" name="' . $this->name . '" id="' . $this->id . '" class="' . $this->class . '" ' . $this->required . ' ' . $this->value . '>';
        } elseif ($this->type == "checkbox") {
            return '<input  type="checkbox" name="' . $this->name . '" id="' . $this->id . '" class="' . $this->class . '" ' . $this->required . ' ' . $this->checked . ' ' . $this->value . '>';
        } elseif ($this->type == "radio") {
            return '<input  type="radio" name="' . $this->name . '" id="' . $this->id . '" class="' . $this->class . '" ' . $this->required . ' ' . $this->checked . ' ' . $this->value . '>';
        } elseif ($this->type == "number") {
            return '<input  ' . $this->step . ' ' . $this->max . ' ' . $this->min . ' type="number" name="' . $this->name . '" id="' . $this->id . '" class="' . $this->class . '" ' . $this->required . ' ' . $this->checked . ' ' . $this->value . '>';
        } elseif ($this->type == "select") {
            return '<select name="' . $this->name . '" id="' . $this->id . '" class="' . $this->class . '">' . $this->option . '<select>';
        }
    }

    public static function listCurrency()
    {
        $array = array(
            "USD" => _("United States Dollars"),
            "EUR" => _("Euro"),
            "TRL" => _("Turkey Lira"),


        );
        //    return '<select id="'.$id.'" class="'.$class.'" name="'.$name.'">
        //	<option value="USD" selected="selected">United States Dollars</option>
        //	<option value="EUR">Euro</option>
        //	<option value="GBP">United Kingdom Pounds</option>
        //	<option value="DZD">Algeria Dinars</option>
        //	<option value="ARP">Argentina Pesos</option>
        //	<option value="AUD">Australia Dollars</option>
        //	<option value="ATS">Austria Schillings</option>
        //	<option value="BSD">Bahamas Dollars</option>
        //	<option value="BBD">Barbados Dollars</option>
        //	<option value="BEF">Belgium Francs</option>
        //	<option value="BMD">Bermuda Dollars</option>
        //	<option value="BRR">Brazil Real</option>
        //	<option value="BGL">Bulgaria Lev</option>
        //	<option value="CAD">Canada Dollars</option>
        //	<option value="CLP">Chile Pesos</option>
        //	<option value="CNY">China Yuan Renmimbi</option>
        //	<option value="CYP">Cyprus Pounds</option>
        //	<option value="CSK">Czech Republic Koruna</option>
        //	<option value="DKK">Denmark Kroner</option>
        //	<option value="NLG">Dutch Guilders</option>
        //	<option value="XCD">Eastern Caribbean Dollars</option>
        //	<option value="EGP">Egypt Pounds</option>
        //	<option value="FJD">Fiji Dollars</option>
        //	<option value="FIM">Finland Markka</option>
        //	<option value="FRF">France Francs</option>
        //	<option value="DEM">Germany Deutsche Marks</option>
        //	<option value="XAU">Gold Ounces</option>
        //	<option value="GRD">Greece Drachmas</option>
        //	<option value="HKD">Hong Kong Dollars</option>
        //	<option value="HUF">Hungary Forint</option>
        //	<option value="ISK">Iceland Krona</option>
        //	<option value="INR">India Rupees</option>
        //	<option value="IDR">Indonesia Rupiah</option>
        //	<option value="IEP">Ireland Punt</option>
        //	<option value="ILS">Israel New Shekels</option>
        //	<option value="ITL">Italy Lira</option>
        //	<option value="JMD">Jamaica Dollars</option>
        //	<option value="JPY">Japan Yen</option>
        //	<option value="JOD">Jordan Dinar</option>
        //	<option value="KRW">Korea (South) Won</option>
        //	<option value="LBP">Lebanon Pounds</option>
        //	<option value="LUF">Luxembourg Francs</option>
        //	<option value="MYR">Malaysia Ringgit</option>
        //	<option value="MXP">Mexico Pesos</option>
        //	<option value="NLG">Netherlands Guilders</option>
        //	<option value="NZD">New Zealand Dollars</option>
        //	<option value="NOK">Norway Kroner</option>
        //	<option value="PKR">Pakistan Rupees</option>
        //	<option value="XPD">Palladium Ounces</option>
        //	<option value="PHP">Philippines Pesos</option>
        //	<option value="XPT">Platinum Ounces</option>
        //	<option value="PLZ">Poland Zloty</option>
        //	<option value="PTE">Portugal Escudo</option>
        //	<option value="ROL">Romania Leu</option>
        //	<option value="RUR">Russia Rubles</option>
        //	<option value="SAR">Saudi Arabia Riyal</option>
        //	<option value="XAG">Silver Ounces</option>
        //	<option value="SGD">Singapore Dollars</option>
        //	<option value="SKK">Slovakia Koruna</option>
        //	<option value="ZAR">South Africa Rand</option>
        //	<option value="KRW">South Korea Won</option>
        //	<option value="ESP">Spain Pesetas</option>
        //	<option value="XDR">Special Drawing Right (IMF)</option>
        //	<option value="SDD">Sudan Dinar</option>
        //	<option value="SEK">Sweden Krona</option>
        //	<option value="CHF">Switzerland Francs</option>
        //	<option value="TWD">Taiwan Dollars</option>
        //	<option value="THB">Thailand Baht</option>
        //	<option value="TTD">Trinidad and Tobago Dollars</option>
        //	<option value="TRL">Turkey Lira</option>
        //	<option value="VEB">Venezuela Bolivar</option>
        //	<option value="ZMK">Zambia Kwacha</option>
        //	<option value="EUR">Euro</option>
        //	<option value="XCD">Eastern Caribbean Dollars</option>
        //	<option value="XDR">Special Drawing Right (IMF)</option>
        //	<option value="XAG">Silver Ounces</option>
        //	<option value="XAU">Gold Ounces</option>
        //	<option value="XPD">Palladium Ounces</option>
        //	<option value="XPT">Platinum Ounces</option>
        //</select>';
        return $array;
    }
}
