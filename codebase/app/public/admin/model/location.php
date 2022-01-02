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

class ModelAdminLocation extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function location($array = array(), $s = 0, $l = 25)
    {

        $this->sql =  "SELECT location_id  FROM " . $this->table_location . " where vehicle_id=:id";
        $this->count = $this->db->row($this->sql, $array);

        if ($this->count > 0) {
            $this->sql =  "SELECT *  FROM " . $this->table_location . " where vehicle_id=:id order by location_time desc limit " . $s . "," . $l . "
";
            return $this->db->select($this->sql, $array);
        } else {
            return false;
        }
    }

    public function get($array = array())
    {

        $this->sql =  "SELECT vehicle_id FROM " . $this->table_vehicle . " where vehicle_id=:id";
        $this->count = $this->db->row($this->sql, $array);

        if ($this->count > 0) {

            $this->sql = "SELECT 
 V.vehicle_id,
 V.vehicle_serial_number,
 V.vehicle_plate_number,
 V.vehicle_statu,
 V.vehicle_type,
 U.fullname as vehicle_driver,
 U.username,
 U.account_id,
 C.company_name,
 L.log_datetime
FROM  " . $this->table_vehicle . " V
LEFT JOIN " . $this->table_company . " C on C.company_id= V.company_id
LEFT JOIN " . $this->table_employee . " E on V.employee_id=E.employee_id and E.employee_position='driver'
LEFT JOIN  " . $this->table_user . " U
ON   U.account_id   =  E.account_id
LEFT JOIN  " . $this->table_log . " L on L.log_data_id=V.vehicle_id and L.log_table='vehicle' and L.log_action='insert' 
GROUP BY V.vehicle_id
order by V.vehicle_id desc
limit 1
";
            return $this->db->select($this->sql, $array);
        } else {
            return false;
        }
    }
}
