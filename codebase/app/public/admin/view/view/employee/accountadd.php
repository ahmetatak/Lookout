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
 if(isset($this->data["errorList"])){
    if(is_array($this->data["errorList"])){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>'._("We found some errors!").'</strong> 
  ';
      foreach ($this->data["errorList"] as $key => $value) {
        switch($key){
        
             case 'rank':
        foreach ($value as $val) {
        echo '' . $val . '';
        }
        break;
        
             case 'password':
        foreach ($value as $val) {
        echo '' . $val . '';
        }
        break;
        
         case 'email':
        foreach ($value as $val) {
        echo '' . $val . '';
        }
        break;
        
        case 'username':
        foreach ($value as $val) {
        echo '' . $val . '';
        }
        break;
        
        case 'fullname':
        foreach ($value as $val) {
        echo '' . $val . '';
        }
        break;
        
             
        
         case 'statu':
        foreach ($value as $val) {
        echo '' . $val . '';
        }
        break;
        
        default:
        break;
       }
       } 
       echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
       }}else if(isset($this->data["response"])){
 echo '<div class="alert alert-'.$this->data["response"]["statu"].' alert-dismissible fade show" role="alert">
  <strong>'.$this->data["response"]["title"].'</strong> '.$this->data["response"]["message"].'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';  
 }else{
    
        
  }
