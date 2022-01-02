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
class ModelDevice extends model
{
  public $location_id = "location_id";
  public $location_lat = "location_latitude";
  public $location_lon = "location_longitude";
  public $location_time = "location_time";
  public $location_vehicle_id = "location_vehicle_identity";
  public $device_id = "device_identitiy";
  public $device_access_token = "device_access_token";
  public $device_version = "device_version";
  public $device_vehicle_id = "device_vehicle_identity";
  public $device_serial_number = "device_serial_";
  public $device_statu = "device_statu";

  public $vehicle_id = "vehicle_identitiy";
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
      $this->sql =  "SELECT device_id as " . $this->device_id . ","
        . "vehicle_id as " . $this->device_vehicle_id . ","
        . "device_version as " . $this->device_version . ","
        . "device_statu as " . $this->device_statu . " "
        . "  FROM " . $this->table_device . " WHERE   device_access_key =:id ";
      return $this->db->select($this->sql, $array);
    } else {
      return false;
    }
  }

  public function getVehicle($array = array())
  {


    $this->sql =  "SELECT vehicle_id  FROM " . $this->table_vehicle . " WHERE   device_access_key =:id ";
    $this->count = $this->db->row($this->sql, $array);

    if ($this->count > 0) {
      $this->sql =  "SELECT device_id as " . $this->device_id . ","
        . "vehicle_id as " . $this->device_vehicle_id . ","
        . "device_version as " . $this->device_version . ","
        . "device_statu as " . $this->device_statu . " "
        . "  FROM " . $this->table_device . " WHERE   device_access_key =:id ";
      return $this->db->select($this->sql, $array);
    } else {
      return false;
    }
  }
}
