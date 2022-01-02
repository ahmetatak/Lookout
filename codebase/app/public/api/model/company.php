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

class ModelAdminCompany extends Model
{
  public function __construct()
  {
    parent::__construct();
  }
  public function all($s = 0, $l = 25)
  {

    $this->sql =  "SELECT company_id  FROM " . $this->table_company . "";
    $this->count = $this->db->row($this->sql);

    if ($this->count > 0) {
      $this->sql = "SELECT  C.* , U.fullname   AS company_owner , U.account_id,COUNT(E.employee_id) AS total_employee,  COUNT(V.vehicle_id) AS total_vehicle
            
FROM  " . $this->table_company . " C 
 LEFT JOIN " . $this->table_vehicle . " V on V.company_id= C.company_id
 LEFT JOIN " . $this->table_employee . " E on E.company_id= C.company_id
 LEFT JOIN  " . $this->table_user . " U
ON   E.account_id   =  U.account_id

GROUP BY C.company_id
order by C.company_id desc
limit " . $s . "," . $l . "
    

";

      return $this->db->select($this->sql, array());
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

  public function get($array = array())
  {

    $this->sql =  "SELECT company_id FROM " . $this->table_company . " where company_id=:id";
    $this->count = $this->db->row($this->sql, $array);

    if ($this->count > 0) {
      $this->sql =  "SELECT * FROM " . $this->table_company . " where company_id=:id";

      return $this->db->select($this->sql, $array);
    } else {
      return false;
    }
  }
  public function getEmployee($array = array())
  {

    $this->sql =  "SELECT employee_id FROM " . $this->table_employee . " where employee_position=:position";
    $this->count = $this->db->row($this->sql, $array);

    if ($this->count > 0) {

      $this->sql = "SELECT 
      U.account_id,
 E.employee_id,E.company_id,U.fullname as employee_name           
FROM  " . $this->table_employee . " E 
 LEFT JOIN  " . $this->table_user . " U
ON   E.account_id   =  U.account_id
 where E.employee_position=:position
GROUP BY E.employee_id


";
      return $this->db->select($this->sql, $array);
    } else {
      return false;
    }
  }
  public function update($id = 1, $array = array())
  {
    $this->sql = "company_id=$id";
    $update = $this->db->update($this->table_company, $this->sql, $array);
    if ($update) {
      $this->log(array(
        "account_id" => Session::decodeToken()->data->userId,
        "log_table" => "company",
        "log_data_id" => $id,
        "log_action" => "update",
        "log_datetime" => Time::get(),
        "log_ip" => Protection::ip(),
        "log_detail" => "",
      ));
      return $update;
    } else {
      return false;
    }
  }
  public function insert($array = array())
  {

    $insert = $this->db->insert($this->table_company, $array);
    if ($insert) {
      $this->log(array(
        "account_id" => Session::decodeToken()->data->userId,
        "log_table" => "company",
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
  public function delete($id = "")
  {
    $identitiy = "company_id=" . $id;
    $del = $this->db->delete($this->table_company, $identitiy);
    if ($del) {

      $this->log(array(
        "account_id" => Session::decodeToken()->data->userId,
        "log_table" => "company",
        "log_data_id" => $id,
        "log_action" => "delete",
        "log_datetime" => Time::get(),
        "log_ip" => Protection::ip(),
        "log_detail" => "",
      ));
      return $del;
    } else {
      return false;
    }
  }
}
