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
class ModelAccountSignup extends Model
{
  private $username;
  private $email;
  private $password;
  private $rank;
  private $active;
  private $fullname;

  public function setUsername($i = "")
  {
    $this->username = $i;
  }
  public function setEmail($i = "")
  {
    $this->email = $i;
  }
  public function setFullname($i = "")
  {
    $this->fullname = $i;
  }
  public function setPassword($i = "")
  {
    $this->password = $i;
  }
  public function setRank($i = "")
  {
    $this->rank = $i;
  }
  public function setActive($i = "")
  {
    $this->active = $i;
  }
  public function insert()
  {

    return $this->db->insert($this->table_user, array(
      "fullname" => $this->fullname,
      "username" => $this->username,
      "femail" => $this->email,
      "email" => $this->email,
      "pw" => $this->password,
      "rank" => $this->rank,
      "active" => $this->active,
    ));
  }
  public function checkUserName($array = array())
  {
    $this->sql =  "SELECT account_id FROM " . $this->table_user . " WHERE  username=:user ";
    $this->count = $this->db->row($this->sql, $array);
    if ($this->count > 0) {
      return true;
    } else {
      return false;
    }
  }
  public function checkEmail($array = array())
  {
    $this->sql =  "SELECT account_id FROM " . $this->table_user . " WHERE  email=:email or femail=:email ";
    $this->count = $this->db->row($this->sql, $array);
    if ($this->count > 0) {
      return true;
    } else {
      return false;
    }
  }
}
