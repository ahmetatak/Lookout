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
class Model
{
    #Database Tables name
    protected $table_session;
    protected $table_user;
    protected $table_log;
    protected $table_auth;
    protected $table_vehicle;
    protected $table_device;
    protected $table_location;
    protected $table_company;
    protected $table_employee;
    protected $table_file;
    public $count;
    protected $sql;
    protected $model;
    protected $call;


    public $column = array();
    public function __construct()
    {
        $this->prepareTables();
        $this->call = new Load();
        $this->db = new Database();
    }
    protected function getTable($tbl = "")
    {
    }
    protected function prepareTables($tbl = "")
    {
        $this->table_device = DB_PREFIX . "device";
        $this->table_user = DB_PREFIX . "account";
        $this->table_auth = DB_PREFIX . "access";
        $this->table_vehicle = DB_PREFIX . "vehicle";
        $this->table_location = DB_PREFIX . "location";
        $this->table_company = DB_PREFIX . "company";
        $this->table_employee = DB_PREFIX . "employee";
        $this->table_session = DB_PREFIX . "session";
        $this->table_file = DB_PREFIX . "file";
        $this->table_log = DB_PREFIX . "log";
    }

    public function log($array = array())
    {
        return $this->db->insert($this->table_log, $array);
    }
}
