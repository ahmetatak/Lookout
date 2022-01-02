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
class ModelLocation extends model
{
  public $location_id = "location_id";
  public $location_lat = "location_latitude";
  public $location_lon = "location_longitude";
  public $location_time = "location_time";
  public $location_vehicle_id = "location_vehicle_identity";
  public $vehicle_id = "vehicle_identity";
  public $vehicle_access_token = "vehicle_access_key";
  public $vehicle_company_id = "vehicle_company";
  public $vehicle_type = "vehicle_kind";
  public $vehicle_plate_number = "vehicle_palete";
  public $vehicle_serial_number = "vehicle_serial_";
  public $vehicle_statu = "vehicle_statu";
  public function searchDevice($array = array())
  {


    $this->sql =  "SELECT vehicle_id  FROM " . $this->table_vehicle . " WHERE   vehicle_access_token =:id ";
    $this->count = $this->db->row($this->sql, $array);

    if ($this->count > 0) {
      $this->sql =  "SELECT vehicle_id as " . $this->vehicle_id . ","

        . "vehicle_type as " . $this->vehicle_type . ","
        . "statu as " . $this->vehicle_statu . " "
        . "  FROM " . $this->table_vehicle . " WHERE   vehicle_access_token =:id ";
      return $this->db->select($this->sql, $array);
    } else {
      return false;
    }
  }
  public function insert()
  {

    return $this->db->insert($this->table_location, array(
      "location_lat" => $this->location_lat,
      "location_lon" => $this->location_lon,
      "location_time" => $this->location_time,
      "location_vehicle_id" => $this->vehicle_id,
      "location_statu" => 1,
    ));
  }

  public function setLat($l = 0)
  {
    $this->location_lat = $l;
  }
  public function setLon($ln = 0)
  {
    $this->location_lon = $ln;
  }
  public function setTime($t = "")
  {
    $this->location_time = $t;
  }
  public function setVehicleId($id = "")
  {
    $this->vehicle_id = $id;
  }
}
