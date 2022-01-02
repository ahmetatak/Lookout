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

class ModelApiLocationInsert extends model
{
  public $location_id = "location_id";
  public $location_lat = "location_latitude";
  public $location_lon = "location_longitude";
  public $location_time = "location_time";
  public $location_vehicle_id = "vehicle_id";
  public $vehicle_id = "vehicle_identity";
  public $vehicle_access_token = "vehicle_access_key";
  public $vehicle_company_id = "vehicle_company";
  public $vehicle_type = "vehicle_kind";
  public $vehicle_plate_number = "vehicle_palete";
  public $vehicle_serial_number = "vehicle_serial_";
  public $vehicle_statu = "vehicle_statu";
  public function searchDevice($array = array())
  {


    $this->sql =  "SELECT device_id  FROM " . $this->table_device . " WHERE   device_access_key =:id ";
    $this->count = $this->db->row($this->sql, $array);

    if ($this->count > 0) {
      $this->sql =  "SELECT device_id , vehicle_id, device_statu  FROM " . $this->table_device . " WHERE   device_access_key =:id ";
      return $this->db->select($this->sql, $array);
    } else {
      return false;
    }
  }
  public function getLastLocation($array = array())
  {


    $this->sql =  "SELECT location_id  FROM " . $this->table_location . " WHERE   vehicle_id =:id ";
    $this->count = $this->db->row($this->sql, $array);

    if ($this->count > 0) {
      $this->sql =  "SELECT location_lat,location_lon,location_time  FROM " . $this->table_location . " WHERE   vehicle_id =:id order by location_id DESC limit 1 ";
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
      "vehicle_id" => $this->vehicle_id,
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
