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
class ModelApiAccountToken extends Model
{
  public $user_id = "account_identity";
  public $user_fullname = "account_fullname";
  public $user_email = "account_email";
  public $user_nick = "account_username";
  public $user_rank = "account_rank";
  public $user_active = "account_active";
  private $model_authentication;
  public function getuser($array = array())
  {
    $this->sql =  "SELECT account_id FROM " . $this->table_user . " WHERE  account_id=:user_id ";
    $this->count = $this->db->row($this->sql, $array);

    if ($this->count > 0) {
      $this->sql = "SELECT "

        . "USER.account_id as $this->user_id ,"
        . "USER.rank  , "
        . "USER.active  "

        . " FROM " . $this->table_user . " USER 
          WHERE    account_id=:user_id ";
      return $this->db->select($this->sql, $array);
    } else {
      return false;
    }
  }
}
