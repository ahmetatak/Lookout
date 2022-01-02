<?php

/* 
 *  ..:: ENGLISH ::..
 *  © 2017-2019 Aljazarisoft.com all rights reserved. Please Read "Licence Agreement & Terms And Conditions" carefully before using this software!
 *  You agree to the Licence Agreement & Terms and Conditions by using this software
 *  Programmed by Ahmet ATAK <info@ahmetatak.net>, <ahmet_atak@msn.com> 
 *  Powered by Aljazarisoft.com | Software & Design <info@aljazarisoft.com>
 *  ..:: Türkçe ::..
 *  © 2017 Aljazarisoft.com her hakkı saklıdır. Bu uygulamayı kullanmadan önce lütfen Lisans Sözleşmesi'ni ve koşulları dikkatle okuyun!
 *  Bu yazılımı kullanarak Lisans Sözleşmesi'ni ve koşulları kabul etmiş olursunuz.
 *  Ahmet ATAK tarafından programlandı <info@ahmetatak.net>, <ahmet_atak@msn.com> 
 *  Aljazarisoft.com [El-Cezerî yazılım] tarafından desteklenmektedir! | Yazılım & Tasarım <info@aljazarisoft.com>
 */

class ModelApiVehicleFind extends Model{
    public function __construct() {
        parent::__construct();
  
    }       public function getVehicle($array=array(),$s=0,$l=25){

     $this->sql=  "SELECT vehicle_id  FROM ".$this->table_vehicle."  ";
        $this->count= $this->db->row($this->sql,$array);
       
      if($this->count>0)
      {   
 $this->sql="SELECT 
 V.vehicle_id,
 V.vehicle_serial_number,
 V.vehicle_plate_number,
 V.vehicle_statu,
 V.vehicle_type,
 U.fullname as vehicle_driver,
 U.username,
 U.account_id,
 C.company_name,
 C.company_id,
 L.log_datetime
FROM  ".$this->table_vehicle." V
LEFT JOIN ".$this->table_company." C on C.company_id= V.company_id
LEFT JOIN ".$this->table_employee." E on V.employee_id=E.employee_id and E.employee_position='driver'
LEFT JOIN  ".$this->table_user." U
ON   U.account_id   =  E.account_id
LEFT JOIN  ".$this->table_log." L on L.log_data_id=V.vehicle_id and L.log_table='vehicle' and L.log_action='insert' 
where V.vehicle_id=:vehicle
 
GROUP BY V.vehicle_id
order by V.vehicle_id desc
limit ".$s.",".$l."
    

";
        
          return $this->db->select($this->sql,$array);
      }else{
          return false;
      }
    }
   public function isEmployeeExist($array=array()){

        $this->sql=  "SELECT employee_id FROM ".$this->table_employee." where company_id=:company and account_id=:account ";
        $this->count= $this->db->row($this->sql,$array);
       
      if($this->count>0)
      {   
        
          return true;
      }else{
          return false;
      }
    }
           public function location($array=array(),$s=0,$l=25){

     $this->sql=  "SELECT location_id  FROM ".$this->table_location." where vehicle_id=:id";
        $this->count= $this->db->row($this->sql,$array);
       
      if($this->count>0)
      {   
 $this->sql=  "SELECT  location_lat as latitude,location_lon as longitude ,location_time as time  FROM ".$this->table_location." where vehicle_id=:id order by location_time desc limit ".$s.",".$l. "
"; 
          return $this->db->select($this->sql,$array);
      }else{
          return false;
      }
    }
      }