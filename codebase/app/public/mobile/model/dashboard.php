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

class ModelAdminDashboard extends Model
{
  public function __construct()
  {
    parent::__construct();
  }
  public function getDevices()
  {

    $this->sql =  "SELECT vehicle_id  FROM " . $this->table_device . "";
    $this->count = $this->db->row($this->sql);

    if ($this->count > 0) {

      return $this->db->select($this->sql);
    } else {
      return false;
    }
  }
  public function getVehicles()
  {

    $this->sql =  "SELECT vehicle_id  FROM " . $this->table_vehicle . "";
    $this->count = $this->db->row($this->sql);

    if ($this->count > 0) {

      return $this->db->select($this->sql);
    } else {
      return false;
    }
  }
  public function getAccounts()
  {

    $this->sql =  "SELECT account_id  FROM " . $this->table_user . "";
    $this->count = $this->db->row($this->sql);

    if ($this->count > 0) {

      return $this->db->select($this->sql);
    } else {
      return false;
    }
  }
  public function getCompanies()
  {

    $this->sql =  "SELECT company_id  FROM " . $this->table_company . "";
    $this->count = $this->db->row($this->sql);

    if ($this->count > 0) {

      return $this->db->select($this->sql);
    } else {
      return false;
    }
  }

  public function getLog($s = 0, $l = 25)
  {

    $this->sql =  "SELECT * FROM " . $this->table_log . "";
    $this->count = $this->db->row($this->sql);

    if ($this->count > 0) {
      $this->sql = "SELECT   L.*,U.fullname,U.username From " . $this->table_log . " L
  LEFT JOIN " . $this->table_user . " U on U.account_id = L.account_id
      
GROUP BY L.log_datetime
  ORDER BY log_datetime DESC
limit " . $s . "," . $l . "
    

";

      return $this->db->select($this->sql, array());
    } else {
      return false;
    }
  }
}
