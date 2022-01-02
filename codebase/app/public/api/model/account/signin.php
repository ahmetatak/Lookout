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
class ModelApiAccountSignin extends Model
{
    public $user_id = "account_identity";
    public $user_full_name = "account_name_surname";
    public $user_email = "account_email";
    public $user_nick = "account_username";
    public $user_rank = "account_rank";
    public $user_active = "account_active";
    public $user_token = "account_token";
    public function __construct()
    {
        parent::__construct();
    }

    public function login($array = array())
    {


        $this->sql =  "SELECT account_id FROM " . $this->table_user . " WHERE  (email=:user or username=:user) AND pw=:password ";
        $this->count = $this->db->row($this->sql, $array);

        if ($this->count > 0) {
            $this->sql = "SELECT "
                . "USER.account_id   ,"
                . "USER.fullname  , "
                . "USER.username   , "
                . "USER.email   , "
                . "USER.active   , "
                . "USER.rank  "
                . " FROM " . $this->table_user . " USER  WHERE (USER.email=:user or USER.username=:user) AND USER.pw=:password ";
            return $this->db->select($this->sql, $array);
        } else {
            return false;
        }
    }

    public function getAccont($array = array())
    {


        $this->sql =  "SELECT account_id FROM " . $this->table_user . " WHERE  account_id=:account ";
        $this->count = $this->db->row($this->sql, $array);

        if ($this->count > 0) {
            $this->sql = "SELECT "
                . "USER.account_id as " . $this->user_id . " ,"
                . "USER.fullname as " . $this->user_full_name . "  , "
                . "USER.username as " . $this->user_nick . "  , "
                . "USER.email as " . $this->user_email . "  , "
                . "USER.email as " . $this->user_email . "  , "
                . "USER.active as " . $this->user_active . " "
                . " FROM " . $this->table_user . " USER  WHERE  account_id=:account ";
            return $this->db->select($this->sql, $array);
        } else {
            return false;
        }
    }

    public function countSession($array = array())
    {

        $this->sql =  "SELECT account_id FROM " . $this->table_session . " WHERE  account_id=:account_id ";
        $this->count = $this->db->row($this->sql, $array);
        if ($this->count > 0) {
            return $this->count;
        } else {
            return false;
        }
    }
    public function closeSession()
    {
        $identitiy = "expire_time > CURRENT_TIMESTAMP";
        return $this->db->delete($this->table_session, $identitiy);
    }
    public function updateToken($array = array(), $id = "")
    {
        $where = 'account_id=' . $id . '';

        return $this->db->update($this->table_auth, $where, $array);
    }
    public function updateFirebase($id = "", $array = array())
    {
        $where = 'account_id=' . $id . '';

        return $this->db->update($this->table_user, $where, $array);
    }
}
