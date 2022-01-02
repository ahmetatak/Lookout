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

class ModelApiDevice extends Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getVehicle($array = array())
  {


    $this->sql =  "SELECT vehicle_id  FROM " . $this->table_vehicle . " WHERE   device_access_key =:id ";
    $this->count = $this->db->row($this->sql, $array);

    if ($this->count > 0) {
      $this->sql =  "SELECT device_id ,"
        . "vehicle_id ,"
        . "device_version ,"
        . "device_statu  "
        . "  FROM " . $this->table_device . " WHERE   device_access_key =:id ";
      return $this->db->select($this->sql, $array);
    } else {
      return false;
    }
  }
  public function searchDevice($array = array())
  {


    $this->sql =  "SELECT device_id  FROM " . $this->table_device . " WHERE   device_access_key =:id ";
    $this->count = $this->db->row($this->sql, $array);

    if ($this->count > 0) {
      $this->sql =  "SELECT device_id,"
        . "vehicle_id,"
        . "device_version,"
        . "device_statu "
        . "  FROM " . $this->table_device . " WHERE   device_access_key =:id ";
      return $this->db->select($this->sql, $array);
    } else {
      return false;
    }
  }

  public function insert($array = array())
  {

    $insert = $this->db->insert($this->table_device, $array);
    if ($insert) {
      $this->log(array(
        "account_id" => Session::decodeToken()->data->userId,
        "log_table" => "device",
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
