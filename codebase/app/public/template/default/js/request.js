var serverResponse;
 var URL,METHOD,VALUES,RESPONSE,RESULT,EMPTY;
    var alertDanger="alert alert-danger";
    var alertSuccess="alert alert-success";
    function getBaseUrl() {
    var re = new RegExp(/^.*\//);
    return re.exec(window.location.href);
}
    function getURL(e){
        
        var url="http://localhost/lookout/";
      
        if(e=="signin")
        {
            url=url+"account/login";
     
        }
      
   return url;
    }
 
   
    function POSTDATA(URL,METHOD,VALUES,RESPONSE,RESULT,EMPTY){
 function setServerResponse(response)
 {
     serverResponse=response;
 }
  function getServerResponse()
 {
     return serverResponse;
 }
$.ajax({
    type: "post",
    url: URL,
    // The key needs to match your method's input parameter (case-sensitive).
    data: JSON.stringify(VALUES),
    contentType: "application/json",
    dataType: "json",
    success: function(data){ 
       setServerResponse(data);
      },
   
    failure: function(errMsg) {
    setServerResponse(errMsg);
    }
});
    
}
function createAlert(id,divclass,title,response,anim){
    $( '#'+id ).empty();
  
    $('#'+id).append(
        '<div class="'+divclass+' '+anim+'">' +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
            '<span aria-hidden="true">&times;</span></button>\n\
<h4>'+title+'</h4>' + response + '</div>');
  
}
function organizeErrorList(data){
   $.each(data, function (index, value) {
       
        if(index=="detail")
        {
             var v = [];
             v.push(value)
for(var i = 0; i < v.length; i++) {
    var obj = v[i];

    console.log(obj);
}
        }  
        });  
}
function organizeError(data){
   $.each(data, function (index, value) {
        if(index=="error_code" && value=="ErrorList")
        {
       organizeErrorList(data);
        }  
        });
}
function responseToDiv(data,div)
{
     alert(JSON.stringify(data));
    var statu;
    var errorCode;
     $.each(data, function (index, value) {
        if(index=="statu" && value=="error")
        {
         organizeError(data);   
        }else  if(index=="statu" && value=="success"){
            
        }
     
                 
     
});
 
    
}
 
$('body').on('change',"[data-post^='optionclick']",function(){
 
 var element = $(this).find('option:selected'); 
            //      var a_href = $(this).find('div.cpt h2 a').attr('href');
      VALUES = "";
      RESPONSE = element.attr('data-response');
      EMPTY = element.attr('data-delete');
      RESULT = element.attr('data-result');
      URL = element.attr('href');
      METHOD = "get";
 
      
      POSTDATA(URL,METHOD,VALUES,RESPONSE,RESULT,EMPTY);
 
  });
 
$('body').on("submit","form",function(e){
 
 e.preventDefault();
    e.stopPropagation(); 
   //      var a_href = $(this).find('div.cpt h2 a').attr('href');

   
      VALUES = $(this).serializeArray();
      RESPONSE = $(this).attr('data-response');
      RESULT = $(this).attr('data-result');
      URL = $(this).attr('action');
      METHOD = $(this).attr('method');
      EMPTY = $(this).attr('data-delete');
 var param=getFormData(VALUES);
 
 

 var data = { action: URL, param: param};
 
      // trım trım dale dale dale don dale pasivana on agale :D
      POSTDATA(getURL(URL),METHOD,data,RESPONSE,RESULT,EMPTY);
     return false;
      
  });
 
function getFormData($form){
    var unindexed_array = $form;
    var indexed_array = {};

    $.map(unindexed_array, function(n, i){
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
}
 $('body').keyup('change',"[data-post^='postback']",function(e){ 
      //  $("[data-post^='postback']").keyup(function(e){
        e.preventDefault();
            //      var a_href = $(this).find('div.cpt h2 a').attr('href');
      var my_form = $(this).closest("form");
     
      VALUES = my_form.serializeArray();
      RESPONSE = $(this).attr('data-response');
      RESULT = $(this).attr('data-result');
      URL = $(my_form).attr('action');
      METHOD = $(my_form).attr('method');
      EMPTY = $(this).attr('data-delete');
 

      // trım trım dale dale dale don dale pasivana on agale :D
      POSTDATA(URL,METHOD,VALUES,RESPONSE,RESULT,EMPTY);
    
 return false;
  });
$('body').on('click',"[data-post^='postclick']",function(event){  
   //     $("[data-post^='postclick']").on('click',function(event){
    
         event.preventDefault();
            //      var a_href = $(this).find('div.cpt h2 a').attr('href');
      VALUES = "";
      RESPONSE = $(this).attr('data-response');
      EMPTY = $(this).attr('data-delete');
      RESULT = $(this).attr('data-result');
      URL = $(this).attr('href');
      METHOD = "get";

      
      POSTDATA(URL,METHOD,VALUES,RESPONSE,RESULT,EMPTY);
      false;
  });
 
 
 