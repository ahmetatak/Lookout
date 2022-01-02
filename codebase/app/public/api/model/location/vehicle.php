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

class ModelApiLocationVehicle extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getVehicle($array = array())
    {


        $this->sql =  "SELECT vehicle_id  FROM " . $this->table_vehicle . " WHERE   vehicle_id =:id ";
        $this->count = $this->db->row($this->sql, $array);

        if ($this->count > 0) {
            $this->sql =  "SELECT vehicle_id ,"
                . "vehicle_statu  "

                . "  FROM " . $this->table_vehicle . " WHERE   vehicle_id =:id ";
            return $this->db->select($this->sql, $array);
        } else {
            return false;
        }
    }
}
