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
 if(isset($this->data["response"])){
 echo '<div class="alert alert-'.$this->data["response"]["statu"].' alert-dismissible fade show" role="alert">
  <strong>'.$this->data["response"]["title"].'</strong> '.$this->data["response"]["message"].'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';  
 }else{
    
if(isset($this->data["accounts"]) and !empty($this->data["accounts"]))
{   echo '

<div style="min-height: 200px; max-height: 300px; overflow-y: scroll;" class="list-group">
 <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addAccount">
<i class="fas fa-user-plus "></i> '._("Add A New Account").'
</button>
';
    foreach ($this->data["accounts"] as $this->key=>$this->value)
    {
        echo ' 
<a fullname="'.$this->value["fullname"].'" id="'.$this->value["account_id"].'" href="#" class="listAccount list-group-item list-group-item-action flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
   <div class="media">
   <img class="mr-3" height="64"   src="'.Protection::img($this->value["file_path"].$this->value["file_id"].''.$this->value["file_type"]).'" > 
  <div class="media-body">
    <h5 class="mt-0">'.$this->value["username"].'</h5>
     '.$this->value["fullname"].' 
  </div>
</div>
    </div>
  
  </a>';
    }
    echo ' 
</div> ';
}
  }
