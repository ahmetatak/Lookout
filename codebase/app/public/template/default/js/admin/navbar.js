$(document).ready(function()
{
    $("#sidebarToggle").click(function(){
 if ( $('.navbar-nav').css('display') == 'none')
    {
        $('.navbar-nav').show();
     $('.navbar-nav').removeClass('slideOutLeft').addClass('slideInleft');
    }else{
      
     $('.navbar-nav').removeClass('slideInleft').addClass('slideOutLeft');  
          $('.navbar-nav').hide();
    }
    });
    

 });