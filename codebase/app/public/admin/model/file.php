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

class ModelAdminFile extends Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function insert($array = array()) {

        $insert = $this->db->insert($this->table_file, $array);
        if ($insert) {
            $this->log(array(
                "account_id" => Session::decodeToken()->data->userId,
                "log_table" => "file",
                "log_data_id" => $insert,
                "log_action" => "insert",
                "log_datetime" => Time::get(),
                "log_ip" => Protection::ip(),
                "log_detail" => "",
            ));
            return $insert;
        } else {
            return false;
        }
    }
}
