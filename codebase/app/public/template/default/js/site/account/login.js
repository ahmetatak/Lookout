$(document).ready(function(){
    
 if( getCookie("token").length>0)
  {
     var URL = getBaseUrl()+'panel/index.html'; 
     var delay =5000; 

setTimeout(function(){ window.location = URL; }, delay);
  }

      
});

$(document).ajaxComplete(function(event, xhr, options){ 
    var response =$.parseJSON(xhr.responseText);
    
 for (item in response) {
     if(item =="statu")
     {
      if(response[item] =="success")
     {
     return success(response);  
     } else if(response[item] =="error")
     {
    return error(response);
      
     }
     
     } 
 
}     
function success(response){
  string="";
  for (item in response) {
     if(item =="data")
     {
 setCookie("token",response["data"][0].account_token,7);
 setCookie("fullname",response["data"][0].account_name_surname,7);
 
 
  
  
 
 
   var URL = getBaseUrl()+'panel/index.html';
createAlert("loginServerMessage",alertSuccess,"Success  !","you have logged in successfuly you will be redirect to panel. click <a href=\""+URL+"\"> here</a> for redirection","animated fadeIn");
  var delay =3000; 

setTimeout(function(){ window.location = URL; }, delay);
     
     } 
 
} 


}
function error(response){
 var string="";

  for (item in response) {
     if(item =="error_code")
     {
     if(response[item] =="ErrorList")
     {
         
response["detail"]["identity"];

for (item in response["detail"]["identity"]) {
 
 if (response["detail"]["identity"][item] === undefined || response["detail"]["identity"][item] === null) {
     // do something 
}else
{
  string=string+response["detail"]["identity"][item]+"<br>";  
}
  
  
}
  for (item in response["detail"]["password"]) {
 
 if (response["detail"]["password"][item] === undefined || response["detail"]["password"][item] === null) {
     // do something 
}else
{
  string=string+response["detail"]["password"][item]+"<br>";  
}
  
  
} 
createAlert("loginServerMessage",alertDanger,"Error !",string,"animated fadeInLeftBig");
 
     } else     if(response[item] =="ErrorUserLogin"){
  string="";
 
  string=string+response["detail"] +"<br>";  
 
   createAlert("loginServerMessage",alertDanger,"Error !",string,"animated shake");      
     }
     
     } 
 
}  
 

}
});
   