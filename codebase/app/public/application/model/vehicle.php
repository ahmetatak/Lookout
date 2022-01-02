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
class ModelVehicle extends model
{


  public $vehicle_id = "vehicle_identity";
  public $vehicle_access_token = "vehicle_access_key";
  public $vehicle_company_id = "vehicle_company";
  public $vehicle_type = "vehicle_kind";
  public $vehicle_plate_number = "vehicle_palete";
  public $vehicle_serial_number = "vehicle_serial_";
  public $vehicle_statu = "vehicle_statu";


  public function getVehicle($array = array())
  {


    $this->sql =  "SELECT vehicle_id  FROM " . $this->table_vehicle . " WHERE   vehicle_id =:id ";
    $this->count = $this->db->row($this->sql, $array);

    if ($this->count > 0) {
      $this->sql =  "SELECT vehicle_id as " . $this->vehicle_id . ","
        . "vehicle_statu as " . $this->vehicle_statu . " "

        . "  FROM " . $this->table_vehicle . " WHERE   vehicle_id =:id ";
      return $this->db->select($this->sql, $array);
    } else {
      return false;
    }
  }
}
