<?php 
 
if(isset($this->data["errorlist"]))
{
    $this->print->init(FALSE,"ErroList",_("Error!"),$this->data["errorlist"]);
}elseif(isset ($this->data["response"]))
{
 if($this->data["response"]["statu"]=="error")
    $this->print->init(FALSE, $this->data["response"]["code"], $this->data["response"]["message"]);
   else
$this->print->init(TRUE, $this->data["response"]["code"], $this->data["response"]["message"],$this->data["response"]["data"]);       
 
}else 
?>