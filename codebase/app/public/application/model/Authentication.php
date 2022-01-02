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

class ModelAuthentication extends model
{
    public $access_statu = "access_key_statu";
    public $access_key = "access_key";
    public $access_signature = "client_id";



    public function getTheToken($array = array())
    {
        $this->sql =  "SELECT " . $this->access_key . " , $this->access_statu, $this->access_signature   FROM " . $this->table_auth . " WHERE access_key=:tokenKey";
        $this->count = $this->db->row($this->sql, $array);
        if ($this->count > 0) {
            return $this->db->select($this->sql, $array);
        } else {
            return false;
        }
    }

    public function insertToken($array = array())
    {

        $this->count = $this->db->insert($this->table_auth, $array);
        if ($this->count > 0) {
            return true;
        } else {
            return false;
        }
    }
}
