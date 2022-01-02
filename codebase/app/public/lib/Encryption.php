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
class Encryption
{
  // DECLARE THE REQUIRED VARIABLES
  public $ENC_METHOD = "AES-256-CBC"; // THE ENCRYPTION METHOD.
  public $ENC_KEY = "SOME_RANDOM_KEY"; // ENCRYPTION KEY
  public $ENC_IV = "SOME_RANDOM_IV"; // ENCRYPTION IV.
  public $ENC_SALT = "xS$"; // THE SALT FOR PASSWORD ENCRYPTION ONLY.
  private $ENC_TYPE = "sha256";
  // DECLARE  REQUIRED VARIABLES TO CLASS CONSTRUCTOR
  function __construct($METHOD = NULL, $KEY = NULL, $IV = NULL, $SALT = NULL)
  {
    try {
      // Setting up the Encryption Method when needed.
      $this->ENC_METHOD = (isset($METHOD) && !empty($METHOD) && $METHOD != NULL) ?
        $METHOD : $this->ENC_METHOD;
      // Setting up the Encryption Key when needed.
      $this->ENC_KEY = (isset($KEY) && !empty($KEY) && $KEY != NULL) ?
        $KEY : $this->ENC_KEY;
      // Setting up the Encryption IV when needed.
      $this->ENC_IV = (isset($IV) && !empty($IV) && $IV != NULL) ?
        $IV : $this->ENC_IV;
      // Setting up the Encryption IV when needed.
      $this->ENC_SALT = (isset($SALT) && !empty($SALT) && $SALT != NULL) ?
        $SALT : $this->ENC_SALT;
    } catch (Exception $e) {
      return "Caught exception: " . $e->getMessage();
    }
  }
  // THIS FUNCTION WILL ENCRYPT THE PASSED STRING
  public   function encrypt($string)
  {
    try {
      $output = false;
      $key = hash($this->ENC_TYPE, $this->ENC_KEY);
      // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
      $iv = substr(hash($this->ENC_TYPE, $this->ENC_IV), 0, 16);
      $output = openssl_encrypt($string, $this->ENC_METHOD, $key, 0, $iv);
      $output = base64_encode($output);
      return $output;
    } catch (Exception $e) {
      return "Caught exception: " . $e->getMessage();
    }
  }
  // THIS FUNCTION WILL DECRYPT THE ENCRYPTED STRING.
  public   function decrypt($string)
  {
    try {
      $output = false;
      // hash
      $key = hash($this->ENC_TYPE, $this->ENC_KEY);
      // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
      $iv = substr(hash($this->ENC_TYPE, $this->ENC_IV), 0, 16);
      $output = openssl_decrypt(base64_decode($string), $this->ENC_METHOD, $key, 0, $iv);
      return $output;
    } catch (Exception $e) {
      return "Caught exception: " . $e->getMessage();
    }
  }
  // THIS FUNCTION FOR PASSWORDS ONLY, BECAUSE IT CANNOT BE DECRYPTED IN FUTURE.
  public    function password($Input)
  {
    try {
      if (!isset($Input) || $Input == null || empty($Input)) {
        return false;
      }
      // GENERATE AN ENCRYPTED PASSWORD SALT
      $SALT = $this->Encrypt($this->ENC_SALT);
      $SALT = md5($SALT);
      // PERFORM MD5 ENCRYPTION ON PASSWORD SALT.
      // ENCRYPT PASSWORD
      $Input = md5($this->Encrypt(md5($Input)));
      $Input = $this->Encrypt($Input);
      $Input =  md5($Input);
      // PERFORM ANOTHER ENCRYPTION FOR THE ENCRYPTED PASSWORD + SALT.
      $Encrypted = $this->Encrypt($SALT) . $this->Encrypt($Input);
      $Encrypted = sha1($Encrypted . $SALT);
      // RETURN THE ENCRYPTED PASSWORD AS MD5
      return md5($Encrypted);
    } catch (Exception $e) {
      return "Caught exception: " . $e->getMessage();
    }
  }
}
