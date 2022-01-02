<?php

/*
 *  ..:: ENGLISH ::..
 *  © 2017 Aljazarisoft.com all rights reserved. Please Read "Licence Agreement & Terms And Conditions" carefully before using this software!
 *  You agree to the Licence Agreement & Terms and Conditions by using this software
 *  Programmed by Ahmet ATAK <info@ahmetatak.net>, <ahmet_atak@msn.com> 
 *  Powered by Aljazarisoft.com | Software & Design <info@aljazarisoft.com>
 *  ..:: Türkçe ::..
 *  © 2017 Aljazarisoft.com her hakkı saklıdır. Bu uygulamayı kullanmadan önce lütfen Lisans Sözleşmesi'ni ve koşulları dikkatle okuyun!
 *  Bu yazılımı kullanarak Lisans Sözleşmesi'ni ve koşulları kabul etmiş olursunuz.
 *  Ahmet ATAK tarafından programlandı <info@ahmetatak.net>, <ahmet_atak@msn.com> 
 *  Aljazarisoft.com [El-Cezerî yazılım] tarafından desteklenmektedir! | Yazılım & Tasarım <info@aljazarisoft.com>
 */

class ModelAdminAccount extends Model {

    public function __construct() {
        parent::__construct();
    }
    public function searchAccount($q=array()) {
 
            $this->sql = "SELECT U.account_id, U.username, U.fullname, F.file_id, F.file_path ,F.file_type
 
FROM  " . $this->table_user . " U
LEFT JOIN " . $this->table_file . " F on F.file_id= U.file_id
where U.username like :username or U.fullname like :username
GROUP BY U.account_id
order by U.account_id desc
 limit 25
    

";

            return $this->db->find($this->sql,$q);
     
    }
    public function all($s = 0, $l = 25) {

        $this->sql = "SELECT account_id  FROM " . $this->table_user . "";
        $this->count = $this->db->row($this->sql);

        if ($this->count > 0) {
            $this->sql = "SELECT 
 U.account_id,U.username,U.fullname,U.email,U.rank,U.active,F.file_id, F.file_path,F.file_type  
FROM  " . $this->table_user . " U
LEFT JOIN  " . $this->table_file . " F
ON   F.file_id   =  U.file_id

GROUP BY U.account_id
order by U.account_id desc
limit " . $s . "," . $l . "
    

";

            return $this->db->select($this->sql, array());
        } else {
            return false;
        }
    }

   public function addAccount($array = array()) {

        $insert = $this->db->insert($this->table_user, $array);
        if ($insert) {
            $this->log(array(
                "account_id" => Session::decodeToken()->data->userId,
                "log_table" => "account",
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
    
       public function checkUserName($array=array()){
        $this->sql=  "SELECT account_id FROM ".$this->table_user." WHERE  username=:user ";
        $this->count= $this->db->row($this->sql,$array);
      if($this->count>0)
      {   
          return $this->db->select($this->sql, $array);
 
      }else{
          return false;
      }
 
    } 
       public function checkEmail($array=array()){
        $this->sql=  "SELECT account_id FROM ".$this->table_user." WHERE  email=:email or femail=:email   ";
        $this->count= $this->db->row($this->sql,$array);
      if($this->count>0)
      {   
         return $this->db->select($this->sql, $array);
 
      }else{
          return false;
      }
 
    }
    
  

    public function getAccount($array = array()) {

        $this->sql = "  
 
 

SELECT * FROM  " . $this->table_user . " 
WHERE account_id=:userid 
  ";
        $this->count = $this->db->row($this->sql, $array);

        if ($this->count > 0) {

            return $this->db->select($this->sql, $array);
        } else {
            return false;
        }
    }

    public function getAccounts() {

        $this->sql = "  
SELECT U.account_id,U.username FROM  " . $this->table_user . " U
WHERE U.account_id NOT IN
(
  SELECT DISTINCT(e.account_id)  
  FROM  " . $this->table_employee . " e  
 
);
  ";
        $this->count = $this->db->row($this->sql);

        if ($this->count > 0) {

            return $this->db->select($this->sql);
        } else {
            return false;
        }
    }
 
 
    public function update($id = 1, $array = array(), $log=true) {
        $this->sql = "account_id=$id";
        $update = $this->db->update($this->table_user, $this->sql, $array);
        if ($update) {
           if($log)
           {
                $this->log(array(
                "account_id" => Session::decodeToken()->data->userId,
                "log_table" => "account",
                "log_data_id" => $id,
                "log_action" => "update",
                "log_datetime" => Time::get(),
                "log_ip" => Protection::ip(),
                "log_detail" => "",
            ));
           }
            return $update;
        } else {
            return false;
        }
    }
 

    public function delete($id = "") {
        $identitiy = "account_id=" . $id;
        $del = $this->db->delete($this->table_user, $identitiy);
        if ($del) {

            $this->log(array(
                "account_id" => Session::decodeToken()->data->userId,
                "log_table" => "account",
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
    public function insert($array = array()) {

        $insert = $this->db->insert($this->table_user, $array);
        if ($insert) {
            $this->log(array(
                "account_id" => Session::decodeToken()->data->userId,
                "log_table" => "account",
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
