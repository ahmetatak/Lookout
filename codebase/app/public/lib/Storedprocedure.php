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
class StoredProcedure {
    protected $_protect_identifiers		= TRUE;
    protected $table;
    protected $conn;
 
 public function __construct(){ //açılışta çalıştır
     

        $this->connect();

    }
    protected function table($table=""){
        $this->table=DB_PREFIX.$table;
    }
        protected function where ($table=""){
        $this->table=DB_PREFIX.$table;
    }

    

    public function connect(){  

        try{

            $this->conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_DATABASE."",  DB_USER, DB_PW);

            $this->conn->query("SET NAMES 'utf8'");

            $this->conn->query('set character set utf8');
$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        }catch(PDOException $e){
         
             die(_("Database connection failed!"));

        } 

    }
    public function execute($func=""){
    $sth =$this->conn->prepare($sql);
    $sth->execute();

        return $sth->fetchAll($fetchMode);    
    }
 
}
