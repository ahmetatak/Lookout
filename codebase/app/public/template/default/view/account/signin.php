    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo _("Forgot Password !")?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    <form class="form-inline">
 
  <div class="form-group mx-sm-3 mb-2">
    <label for="identity" class="sr-only">Password</label>
    <input  type="text" class="form-control" id="inputPassword2" placeholder="<?php echo _("Please enter username or email address")?>">
  </div>
  <button type="submit" class="btn btn-primary mb-2"><?php echo _("Send")?> <i class="fas  fa-paper-plane  "></i></button>
</form>
      </div>
    
    </div>
  </div>
</div>
<div id="loginServerMessage" >
<?php  
        
 $this->loadCSS(array("template/".TEMPLATE."/css/site/account/login"));
 $this->LoadJS(array("template/".TEMPLATE."/js/site/account/login"));
 if(isset($this->data["errorList"])){
    if(is_array($this->data["errorList"])){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>'._("We found some errors!").'</strong> 
  ';
      foreach ($this->data["errorList"] as $key => $value) {
        switch($key){
        
        
        case 'identity':
        foreach ($value as $val) {
        echo '' . $val . '';
        }
        break;
        
        case 'password':
        foreach ($value as $val) {
        echo '' . $val . '';
        }
        break;
        
        case 'captcha':
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
       }}
 if(isset($this->data["response"])){
 echo '<div class="alert alert-'.$this->data["response"]["statu"].' alert-dismissible fade show" role="alert">
  <strong>'.$this->data["response"]["title"].'</strong> '.$this->data["response"]["message"].'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';  
 }  
        
 ?>
</div>
<?php if(isset($this->data["redirect"]) and $this->data["redirect"]==TRUE)
{
 echo '<script>
        var timer = setTimeout(function() {
            window.location=\''.URL.'\'
        }, 3000);
    </script>';   
}else
{?>
    <script>
    $(document).ready(function() {
                $('#reflesh').click(function() {
 
 
    $('#captcha_img').attr('src','<?php echo URL ?>/captcha/?' + (new Date()).getTime());
});
$("#reflesh").mouseenter(function() {
     $(this).addClass("fa-spin");
}).mouseleave(function() {
 $(this).removeClass("fa-spin");
});
  $('#signin').on('click', function() {
    var $this = $("#signin");
    var loadingText = '<i class="fas fa-circle-notch fa-spin"></i>'+' <?php echo _("loading...")?>';
    if ($(this).html() !== loadingText) {
      $this.data('original-text', $(this).html());
      $this.html(loadingText);
    }
    setTimeout(function() {
      $this.html($this.data('original-text'));
    }, 2000);
  });
})</script>
   <form data-result="loginServerMessage" method="post"  class="form-signin">
    <img  class="img-fluid" src=' data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAUIAAAB6CAYAAAG99Gp+AAAABGdBTUEAALGPC/xhBQAAQABJREFUeAHtnQncb1PVxzMTGUpkfq6haBLJlIwpKkmDQrkaqKj0llIphNJARSG8GfJKCIkyTylTCIWiuNeUIVOR2X2/v/Psde46+7/P8J+e4XbW57Oetfaa9trrnP8Z9tnnPC94wawAMxIw7HHR5Rmu2zNK+3NGYt8StW9Uu9S5T4WP7flCWCkEXjgqmSkL7Ye8zSD5uL9C7DJlSo5sDvCQQoDQQP6HlLypDP83gGtn9jCXg39WA/pYVRD0gvlTNlJ4edz2ujpevsCI2c1uTKDJBLzNbLPN9rhvG498NkW2tqeI/2Zt2Qh82/Fbo5ottG+Hv0V8niQCOT4roXgPknlA95WUPpWo7PA9SP7iZQO7dpBL7OFEGl8PgimYvlz8nEFgZE5zDsEU+H6Tych403uZBTHqbH8Y+K2kw/dK2mZWS/NKVlguVaGrVNlAQoI/x/i0SodR5WVJGwUxkEHgLzI+dkrY3pyyMZnsLZb5miyWh/Zewe4ei5GkFiypRIj+lGCzQJnNwOR0pJ1Vnb6jLKiS8Tq1BV5mPOJlxJfp63QWp5ISfGNwUXBZM1SHAV5nMlHJovZ2iKaAj0sXwffNFvlj0sUxED0kuYMfmU/eGcrPg9mPCXpoCPKD4PQw9M7cCUbyYPMJ2KNAdTIlyGAz+K0x5kv7OHDpIH9FoDpGFsDsx4TSsw5tT8edKaNYNqna5L+7Eq48RmJ0gkYawZnDHqn6o49sn072hf458C4ZAtnmgd4G7iaBIOk4IKHFN1oIK6GgIKSB6DaTZQYJG9P3Sy2+6OzgNAsIf7p4O32ZPKamV4BYN6D21YqT9eM78XzcETpt4j1iudrIdfjIkxUPjKRsm8jknNsVGrm0k8Eu38Sd2lEJNpuJU0xgxHhRwag4+/uFUcmoLObNLpOrIcao8WYEzS4QoHmCTpexWaAQA8HOQT9isYxK7vhnjBcVeP2ohM0soba1KaWwfUy8l6ttYDaxviyW7MxHMaxttExWeRy0ZBL0owlZLJoSJxsbNGprBAZygP+M2oHPVHGgTDhjxjzQ74gv0Y9YjEBXCH4ZMR8vg7/YfCQ3myQNjtcmlQiDvjpImXO3cjpb3XzUsXijJvdUOuAiLzMeeR7LZJ5mnlzRxDLfLvDBwcgdgbnMBGZMe3HJ1IZ80cklFjwSdGvB2y2mmcnn7KDPqy4nk8HGSa+ObFsfQPYZOCe1twjtX8BfF/hUgtofDwSVYJ5EsD/CZNCPgTeoHWB70WD3SVEDxDcYP1RqCfhOUjKvN75jU5iipZ0VSBXVH9s7PSokCubgm443dqoxEb2rIuyEVtk4fJIpmdd38OYAPdH4DiMEQacLtPj3bG4ZTflOZBlJb1IYwMzGJrV5z7Qd5eocgn1HEc0v6A8PdGeTTxYa8s5InjOt3wdFxxFcchkGfTckK2KNw8ElsbPZijxBx7h4yzrxmLC+b/iphU4RaP5dkM3Bm1IC47uluFoRv91LHPkI4n5HpdnfkVg37HZV3x03ARhrfqtjAErSBfJscau40XDm2t2fvXB6uXc03rlkbPB5W5ne22NzWMrOZCka+WcmXibe+e0T6W43ncnjRwOSLxyUms7/HryeaeQ3t1FRdkJ3DHbHQMU/H/BFUCWynYh44PhR8oLfEOPtgc+TDW3ZdwBxFsTnX06hg/znaL/SZJYX8q8j21Nyk5mNKPoMUjpvV8FPwXdaQU/E/OcMn81qFQxojHab3jtl21SP3epx7Dp/xTYf6ydFEzbrmMxT8zVZ3I7l6LM90eygI2aTU4TfN4NcGDGmhxbm2mXmdJdHbnkTG83BZ5ALA4MwezAmZayL21mA0T8jXmdyk1kber/JRJ0876tE9lGTm7+1oduYrEBRZDM3zjBjvRGC6bHe2t6uijf7BNVhoBbw+7d8Y0OLVyY3PfTe2MbazsbYT5jOKIqnTAltlLP5trRJBahq/kDc7JHprLeg2lCB2muG9sbObk/kq8nAyXaiWZhJCH75rEVo/8L5/NL4oNuCGF8Dp4BrBdn88L5vPSLOAZ1yWS8XwNDWSWgOk8G/2fHri0d2YaCwMy4I/ILwJ4g3oJ0twYHuAr7T5BlFkD3WhX5LAqg9P/xSaPsCHYo+axv1NpIFuBuaTf9IL6CdF1E2QbYQ7Nsyg1Gbn5gu6FXEDELb/Iz+1stjXm0DH0ey0F4u0B1Fg9zGL9FLzdbTwN8gOsuAK8Ac8KXHK3RH26DhrzS+pWNYAQr/JuEYdjlrdEXRlgNjWK7nyVgizU1pnmpYHt1p/Luh7YQ0U+VCYlcFmp1cu06WOCcrWIBHob4t8TpBZ+QZY7rubAI5xGOI27Wp4qDH+AbrGxPokVC707B1gC9DpjOywXmBWaS2swloYIOw1OK2yZMU4/cHh73NEZq65pM6K6APhOx6KYC3j5IZ83j9ZOBD3h2kNnc8bG9bKngX7jt9gKDvKKBs0G0W9NuKer/JwJNy6ha4/hwSBr1eoOtWDTbYJAsoP/S2nPJp2VbFmog6Ur5PeQe4L8uRxnZgciVFMDw40BXrBhXsSgso/2DzZKBdFRGfk8BsLrIul0Hrre+OvDsEoWeTQ7NZEdeuY99cZyC9uoHoLO7h0aqBm2GVzbB0pX2XKSTvNZkQU2fh5Hq1VFxsVwx+ItmERmxn+lg+Fu2yvmdPdY7xx1PyLmX/wL7xz40L7b+BOii/FdSeWX+A7jKhoZinKhtkPa+2lX8/yeL+41QMyQQ+Ns1nY5n0yNaV3IP3Mz7oP2Rto+YXt2O5HdTzpDoMQgTkjZ66yVwxrGNPLXZEp3ob453Nr2KZtUXNLiUzXUTzkyHyPUzn/VNxzc6o2Rd+wlKiyOYIzSAE+wr0r15mfPCxZimtsDsGXcdrLAR6MgQrzC36DvC7yLfFI/O/nE/rsCBwdrc6vmt2NNrMePFjzyeIuKSiksgPIJq1fg60CdGOR5bosr0AsiOoubhsPg7/DxoPtUeehUeR2OyE7nBwZfhtoR40c60YHYCtNug3nMLyk8geqRYmMDRw/LJfBuR+mos5/95ZBRUowihX/jfVS7l1p6bE//5Oy4LkPPMrSGc2njG9qIm9zPNeD9/1T9jHEl/4CQflArabijqH1zu+g/U+Md9h7ATY5ntCwk/PTPLnGc7Ns5rESB5evNGw+PgnrN1f702l+tOz4mtTCsm0Zct0VXLc5jJ9KoaKanqjJsN+NWTK6eWmq6LY65AksGn/y0abffxV0oKyEKh0q5dBbIPQprBK/eUT3EW0EQrgdJcXFImG2XqVyaDZy5zQB0wW2f2mRG7i/NmwCUQthsmsnVMUT5gyon8xo0g+j+TItKDaIHUWNXfZZi8OBOOLTGHOoiarombvbZBlT9V8DLMroV+N/M8rsSvkFNv4GBrg87EB7ae9UUJvIvs5ePMOHuPp5hDTDuMSgfl5NTK9rSH4UyQ/d1Rc+BsfsjIXLPIlHmbtYxlvOlGTdUXxs+koi7VAVwEwNsdAS4+p3cZt7SdrBbQnWO6eN5ko8vx2KrRzH7Mr8/V62QhM1oTG9nG7Lgb2+8tH0MC2MM46+0zvA8PrrkMFWxU8xALAnw3+zLXfFey0liS7y4DmCcL62ylzy36+1sBmLfAjIc674QvPWGifGnRZXNqHhbb1rad/+cJQeOVytMU3iizPK/hvGejWgU7F5PzAPygqQKY1N+uOtrL2DrSzOyPoL00uw9eAel5xXHA8ED57cRZqyXdQVHp9/SELVGZr+hA7Hwz2DwSZZqc3BbVWptCP9/E6eN36XQguDur1aOVi8fI+gv816ARrlcS7Q3IBNmcFanl8D9kloF4H0UbeBTTdzH4kFJjzaCv7u3FJYCkfl84g+OwOtcuihU1nVDbiIVPAwoCCXCZ6fDrV+0gI2K9D/LGRPs8FXVYE0xv1/pIpiFHH5wWUDPgVqInhzNbsPRWfBTMj6FLigb31J+jzwGZvFJOdjTeKbFvzlczAZFBfwGNp6+JXe5T1J3YH+XmZtZEVCujkXzZ7yQS0dYnyMZOLAqfpT9Bv4/gngkwivYmgyzvtedUFlNNkBsanxwGv1hj8YFNjQp9d39bZpXxnaRkFeURFAZIXyzZ49PapkWVM1tK2AhOuAuyos4HxU1dEGRSeeaWmBMd8QKSl84ouvW7KUqz/o3VLWhVcN1045mNpO8xPRZomWbCkHpLrHJ2dnzumLEucBiKmz/iJRiruswhvAXVK+A94Djg3uCy4NLhUoJAkaGCvZOo1n5RLWrXCoVTAdiwXfB22xRXWRr82fO0MsNn3TenwS0oqAj0R/wT4x0he1dTKpduqDNDpl/X9hE3Zr7Hv8bUBOisQ1T+/VfSW2Pj3SvK7FW/TF08Hq0aJPENbt4pPR3I1rwJXKOvQ2Rd2wtgeu+yG39mL3TxqtztjXLghtKOaq/mw70bt2Mbr++IJnN2juw6WgdfMk4c9uunEOVbuhD4mPv55lkK8zcUZ/K/Od97yWQWod9MlpoN5E4YOsxk0t6Ff7Xix3+t127g4jXdC6wvfTzp/FeVk1z7K7Fo6nApQ6x1cvVPsDgPpmcg61RpsYUygpafZpp27eF3vhNYHMfyvcl4XU+z2ZtfS4VQgqnfWjHvSc4l459k2Norb+CypaMh1B/sIeDUYPyr8m2z6AWImoZuYBPCLAjSVr+c/2bIVqB4zeLiChh4L6G68LyDGgz5wX8EmkXM87rBAzF7c/IMtGPND0oSibpd122xwI4bZowcTeIr9K2jb9MdO2B4pPfLNIYuD2ujayFrRNkdAzUdqOsimhEQlMzlstlBW6yg1RSOQr+aaLqGPS4l/O/wIKPjuKOn670PEyr584D2JramjT4Mv83LHa7GrxtYYiBlff04hxrTGASapYU/jxsm+eSR/QeFTZnEtRk2yvwfFumG26dFP0eQ5Ij92yP2e4sYsVnOVtRD5qDlS6zQLGPQ0bpwa74TYPmSdjHW96DffCce6b/VH/6+1sUNr7+qcrbEjVXljtB24aZVNSofPGqBWF3waXB+0s03KPCnD57Pg8kllQojtCPg/oM5kBUAWg/51xt4BNysYWwNl7U6IjU7bWvRjsKb5V1GMXwNeZk6O6rHbO6t8Yx32Pe2E+A0sB+XkxiD2dnClONeEnWxHSuzml9JDys5k2OlFgW5gXvONKUE+FQeKbeI29s9HPp/3NpEu2fT24jv2ZG9AhNMVBZmuzW42Hdc2dqFpopxinj8lQXgDuE6unMksCZvFVnygNN5Ml+Yc8YaWA2P3R5oRsrolG8GMGaUbuybzxyJ9tlgtkmnnzzY+8vljXU3bFtXpGjuGhWJBg7Yfv8y7iXEP9h15VO6EONjR6iH1FuBjxnhKkVbRxkC2v5cH/ufQd4Abg98JMk/eIF/g217YLY//WOWQ3YxF+W0XtSub5JqdgWIj9nHNOBRAhUEQb/w59IMoA+zjR2Z6XNroDFbovP/GFJfjUvA6oBXBiqGBBvAX/fHTB7NpQuMpm2LHtAjyriaB+rAZqxyujwfXQ846a3RAIs70DqMSAb57xP7etE7vbY2P49Hex3SiCf2I1yd5nJLXhMg/7AJ2/Dp9MGdn7CFeX8Xj8CpzMlplX6YzX0eHngN9lV6nujyasvFpORtqwnmpshqk5LG/t0FXuZN6W+PjeLT73glLdy4Om0fTwVGhcz0ZsTx0mPeH1FxhBtADHF/J0s+NLnZmS1sT4P1CvzmkxlWWU+EhfYnRFMY6TTrGp+uiS0F/vZzdoCDbArszoWVwMIr3lCm9nH50+VMF8Sm7yrZM138MEr0I9HB33BvKA0EtOH3KGzo+XqhQO4VhfRDjJy7OINl+c9AHDKrwfPTr2zhimhjISGyjNnbbJmzzSXN0iyT0tadkfH6U8CvcyYb+Y7MfpvIMtgfExrFtrKc9EtvEbU296G4rdSo4G7nuZmK4lF/qMbFQnccy2lOwnZaQq/izI0/dCc6Pjxazdg0TIQdLOpFLVS1+it+HzBf6L2qQ33USS0dOe5LkzDJW2+5kUDXTPNwKYApWJ+YfYwWxX4Xsz7E8tGWvbbRGib4jZmLccj0NfBi8ghxSN3WySV5QKl4pjHoV/2LcdHl+Kq4/xRcDd9GaCDko3cQAlysbBrYfiO1Tttjoxcxu4b2pWLGMoH/oInDHzuzjESc+MxZCe9skj/UrwQvAfxU8ZzZ0LVMJmB4x07yW01L+gcMEyeFC8pgGLlo3QGx0g/YAqKNaI8D2LeCZ4J3gg6D6+3gj5wojYqwOngX+A7wPPAd8Q4VLUoXPOuBVoO4pBFckDVthW4HxrkA2AcoeqpdRLo+TQf5W5HrRqBawXQnbW8sM0eu6Zk5sniqzkRw73bHPg11Pd134a7XLmxXLA/GO9+1B8vS5MfEvTMVsOu6UbzeyULcP4KOj7uPkU37t1SAw8Sq3Z4MQzU3obAlQ8DnvRftaCb2sipctcFaZDboXg0uU6U2uIAJr90oJ8cVBxKnrnz6mqB9grZQt8kbjTvk2lWW9j546527qU2cXYpZuzzr/rvV0eJ06NUfYF6kN5Lf08NMzSfFP9qUV+RXFees6FzMTuvZBuVVgfBxnF784ZW4vNJsUxSi5EyL3z6yzO05k/n82WHzRN/rYXhH4N0ILOyHteYJuN/kG3tf2LyZzVOsvM0DWURdkpfOm6Ky/8y2Gp9ZHmQy9rik9rCZbL4B/XZClcitMhUV+aqZuUgo+eW7B+U6fgCktcNDlH68L8uwIEPgrzcfF2dfx2cbA9jzZe1vjQxyz00YW6JmwlubfrEaAx8wnRbHp2AmRjQTf1M71fR8Hu8WCbfb8PPAnehvxyG0nDCYZOdDsTBhss1dSTRdkmqy38Sbrgjp7RcH7xTw284G6gTDQQt18Z/L2ZuD1yHZO2ORHQvR5bvB6j+gp0CCrizUScQrbOthdYnaaqzPQWralMTg0CLwuE8kZ5g6uN3QtaYs7/eJWv9AhhHnBS4xxNLt2JJxW01RBZofBTeAZdLtK6PuftDW/2S1k18A4pebc3h8Fs7vMdzm5alQGa4fcvoHB5xjbHgnDFydk+QfA0FldlonsFojaHU36fgLUNbzGeBuoPATiS0H2AQ7V9hWUGFtu0r8PH123Wz23LvGpEi+SVNK/nXI7VrqgW0MJRpBf4wX5MT5wkO0lGXz2yzE97blBrezIIdg9JoHZBdlNudEoc67Xp3jMpsrU62guIhkwxcvFI8s3QmYxY8YNgX7TbGnvH2RG1ofpiInsaTCb94Tm44b/DhjndLKXwXfUBdk13sbyCXnvKl0E90U260X6rBn8Y1U2nYRwX6fYMtimctvR+sJeY83G7WQK84C1QxzJzvOylp8gFWDDzKatE+AZaL5AAn6uXtLEb5MQT+RKx1deU/fSV68+djjt1b/1aytQWQF2el22bRyMLuQMflelQ6tsKzCoCrDz7e6OujG7+6D6aeO0FUhWgD3OX0bEO6C1K2+YkoGHJSQjXQdphfUpYMfHcpDF8DyC34K6A03dbQ4r1TZugwqwTQ4Dm8JhDUIOx4QMtdM12eGaDuZJDD88nGzbqN1UoGSDaZI7NdGdzRSM2Y0JSejW/xpw2ZpB3Y3+X6DuBm8HrwK1yFPTKppzfDWo59BlcBoXv+8uU7by4VWAbbwP0b/meniObaG1ADlgozlav/2yhxm5wTAYOtXTDp1CU6A5Mj1FuCulNJnyMr4L+rZhjKeNWV4Btk223sBto1Via3TaHzxcG9sMrE0vc4GFL3KGns+AfjXwjYiSamCoZ6B3RHYXDmxAbaDaClB7rWn0kHrqNoc3gPdPjGr7aGxA4L2ijtTcGTwnITfR1TCfBZdXR9BvmCK0rfkamDeCupFJwfsiYeUq4MaDag1rK0Ddj49qv3/shD5+6nR8bNN3m07ujhI5kHbyohT5F8s6RFe2E+raMAfs9OA+Pp0fjMx/l7Bd0ZtXbHgMNV8TjCF/dwbFh2Il7TUHmhEB9czUQEt4lrCGo3+Fr118gE2jndAGgL2Wx3u4hIa/HGhPzVasIVK/AZrwSqXjnN1rfnSoux57vvlneN0p+bf1tIZMb9K9Auxp1TT+pUBMfVdRd/vPB6P1oZeBtpJ7I3IsLNcKdi0ZbAVGugjXjW11WDbuE26v/yW8f1Au1TbVETq1+HR1JPQR8P2POg2wB9TfnS/lbVt+8BWg3npRrg4uGFjP9OTvSH8VtZVIYZ6oacf49bwTqg917MB/1q6wlKppPq1ddxVwtU+yPlpfp2Oia0WtLcCcDr+Ga+vTvILUAlKfw7B4P7ab6WQ960hVMb6lQ6vAYhWRCzq/oSp8OlVsR11zbR00z0HvBG2R6zR2vtSK6mA+fEL/2tH8ZOnRtL9hPZP/eP04LIVZmlJ/LWQ9PDHII4OuqGKDnAueX5RWt7D3sI1rFFb1Vkcp1xKvr9OxRSbOhS63FeBPcm2x9sMxl4FQ4q4K3gp2rFIfSAcTNEg8btrPgAbpH75pjTYZG7aPmj10iuOHwiqnQQUOsX6RiKdFEIeAXX9pIK4ZMRaN4v8stpkV26lxI5vT1SJ9f+AMMrauOBit43z07FeTxUMF5TSoDmx8xPt4g5iHmn03lLhfjmN34z9ZbcvGjXxhcKGycWktX+EinfO15tpKAXPNw2U2Zovspcg2AdXRfODcoPZ6rZbQdafsDWEzmXTWl3J4JqCuL+Uj1Nt7h9CP0rQ8j0D2KNgtKK5i3eUdCft62nuC2audXuf49+J3imtXssTcA4P9vJHVystmNb7nceNYgKrCYLiQM961ynbQOtevTv8fAfcEtxt0P4oX4vtLDkTNr5mx1dxkAYaR50SLyYB7G3ehUjSqBob6IrOvshuGzvqF5ne46of254fRX4i9hOtX7C1N+sKut43RJPgEtul13N1O0WwYavDXcazFaQz2EnBv8CbyOHVYuXAK/Uc4jT4W+liJPn89rP7+W+Om71YS1aD4fof9aMJkrEQPsmNsEDrbeyw6pb8XMX59D0bXvG+DXw7Z9EH1TTxNE+nS4kfEfbJpXPz0js064GvBv4F/xF+0MRBD873L43dMUyd8PoTt3fhcWOeD7d7B5j/QH+DzdIcPRgXoMAgCjD5vhmU2w5Rb39Apw+ynKrbLoe6ypfHpmJgb+7jwurGrBGx+F/nEzYcQzFsZBCU2Z3nHOnvpvT38Bd6Hdse4I3s1O16690c3H6/A47gMgk8XhA0a+H0F1JKuGI5A0JFMg5Bdm9DPIHN4hyUQBuS/w2OqbulvIocDo3bepM8t1S+CN+bCNKPvvGhRyQlpdS7VN65zwD79fZhggT7+Js7GuXNzpnN8BC6Aj4XCf0LC7G71NikeQ123NYE7Uv4pmQvW6EiI/cBzUF4uD88WfswoOo4IqTGVxPtwypaYR/oOu+ALU1I+diLGiNfHPPbxjVrhjIC+Y9yJPt4Sxy0UL1bSTj3KOythl4voVPOI/ktWuS7BLBOSHOijsyHnUJj/C2O6PzG2WhF5po4kHUcv7LYi2MdqA6YNlsJf/4lhIsAXuSbs/JgVCRbAMkXolz/pPWGD0plvM+iRlsZVTi5m5ZHQ2fXCVuYQ8vCPof5unVjdgk3HEcHrg038wk8WKrYLttaNp/fRsEXEuRuyi72R41fKjQLjdMaOxDa+jVHXR0LvX8ZXHQn9ofYkC8Ce/KjxnpKgTWN4sXjdVepbf2uC24KaVkmB7PqCsciB8fuH8Mv3kjB5roqfj2Nh8jqbANsrjXf0UPJYHHzGyTIW2YYwG8Vy2o3mOBN+QxfNWdHD7U5nv7hbKcpByHXKNdTOuhSYem9kYYrid9o/YJedboijW3WLC5sd7a6GHC42gYgy2Apfnf7MJohfsDLMIHLQS1EHW9CGtHZahZz1Qv7W4HvAZN2p1fsT/enH6+FO7HbxgphHr6Pht5Hv7nXIZken7TaxgMQK4LMrKLpvVB1ls24I6Zfdd99DvcdY5aBn5TmQVsfpuD7VGfrKRAHw6Tj9IdMz90aQ6LNwPZvQj1QFTuXj7dF3jNvry/jSjUTAy8qcGsg/0vAXV3sN1qCvMpMxy4Gx6qjeD7yKGPcmAqwXy7DTQoymcE9k2BEv0o9Ls3QnJBvNxAv+xMBLAf36mZX7g/HRrlnKYvfvhPKk0s5KFMQY8xzoc3HLnR9s4bRn8i7ojcRIreJ5TRcxUqZXRUI9WZlwULUTWrLxBKXJjeoiux+4PHLuJV4vPr7brnPg96DrUoOFjemDns6O+MLI/7ao3W1z2cih33hRuME0kxfIIfTvoZqZ19Ip3QQIngfjd4YLNxeZVXd/4rtiLRKIZXUR56kzqNHH/b3CjbnGNVN/s85IB3GzIfam8Oda21HVNreDv87pemFXj5zq4um6dFrk45sd161e2TOvYnvwgZD7T2l4s0rex6jjCRSv26uM3VRZ16/X95nDD3ws8cRrdIGO3d2J8bzJx0voD/D6Mh4/P89rYbT4OAcTOvrjXJlgsDvI2WasN0PQaNzeJ+OrgsoA/Ybg2eD9sW1F+yUdHZUIKmL0q+onB/0wNN4yvBfd18DkWQB5442BbQyFmxyU/lMmZrtYSTlzsRl6misDg+5mrxcf2/h2bEv775G+8bi9n3ayGI4qGDRoxAFoP9nATX37N+GyME38UjYTIQfLi1wabwxsN4pztzii6BaM9aH9Dm9nPDr9Q6QU7Gg2RjFKfcBIZz9/SZCZI0udseKj9q5xx9ZXJcVJb5nF8ACCnyTwB8jii2cVaj8whj9VdYyxvtYVQzylUBWioCPQuOdgCZFL451QPnERLI5R9IUlV5H9ObS/BabeIDTT+DreQqvv58wootovTgS1GicFuj8oAEb6d2MxKI72pR+CixQcrIGi7JeDqhQ61ryVWs6YES8X0rVK2cAaT8Ra/p5OhByUD3n0tRPi/3o/rhDznxXjq1TFsXwbR/8svDJOpCy7FInMOppaiFsAPca5C8lxBWl946sJk7KJ58KvGL+bwXkT/u8hl24mYhMhspXPKflY5qD+K6+tUglGsgWj9guozaLI4qmk2Cxu/we/jlOrN0KtZ9h67NoNLItfx3PrECA13+lj63FiGthf9+7YZ8sFK6eiYL5quUul5mupeL3IJkgO8eO2X1WNhZzv9NWpsV3N21bwO1fFiXXEmQ1M3a37Lv4hu9g3bmOjtyHLYN3YvqON5+7grSURdNG6eYeTE6CfB+zmmXA8l+Wi9cZOkBzeRB6PgD9pMgrszgC1kUca2uufHeoa/Q/gU6Ceuvwf2O1RraM7Yuh12uvAp8HrwX3A2p0vDoSPrlXvAQX6XN8HYpuhtulwU1A7bRl8aagJEJyOxz2HYY+xjd9WoK1AW4G2ArNCBXQxuhID+Rt3O4U7OuQvQv4s8ieaDBT7V2P75zJb9Ouh/12Z3uTYbYTdRdbuluKv6454qud2YvazNK00DfqbW/0RP1mnpuMu7aChgn5ejembg/lx5PNgQ9ekmeIRo3R7Jp16FdKZ4MbYf1Rc/RjHfLDVZGRhJzadKKoNpQc+6OUxj36RzGr0hexYXdvGd+vg30FqnXs0sI5S7ugajTvl243McnC0YyK5y3iV27ObWI1sSTy7k42Nw4DOieWpNrbHyj6lMxnq7Y0vo9i8VHGATcpsmspHw8y4val9r3ahn9Kxo68dd699y4/4t4Qc3t5PHO9LvNrt6e375bWe8AsKQsf5TDa8zTFN9R0g3wnUv+/6pJcbj1yfyNDH07OYJg+08OREMuy2AE8FK+cJ0Wv+8TDwELBjIjfqp7ZJDD3RKCylov0ScF9QL+a/IRUEuZ7javrieHC1EpslZeN0qXFrGuxnYPz+SOaG3OryGRenjNXl1DOcOn+dMlA/sRzZ8SaDnx08ErwY3NXkoiUyy20fb2s8PqrjQeABYPYqL/R1oPrQVE96DSsKwckukOad8l83bNkkdPYcGX32y5FPBNk6P2QjQb626yMyzf5VWMeREKPpsSHt0y1OGQ0+HUfCKNYy8kemnSqGe31slCpsAYJvJjNbGo9JEHSFcSOeX7oICmv8Ip01S49yGDwTjDp+nMinBN1aLr+NgyxbiRP4nIS8C9vT+eZ2jsnnjZF90smNvdoYR19uMXNqShOE9h+jtsSLSwbVnp1BaFvSF4b24kH9XGjHG+ORoN9OegNkhZ2Qti1yyHc6ZHcE343NL0WDTWEnRHZFkOsiPgParwqyO53smCA7RjJ4e77+kNkYDXa2060X2v8IfvG4bRJfj+AU97Jgv2xoW13eG9r6Cm7yckl6Afp5QwwjR49qMl3lTojDZ4JT4UYOWbY9LU7ox3LLthk2+TNnswux8sd5oS1yX4gxl8nMJ6covhOUs0E3CHy2oeDfGNqrQDXgm0Nb5LEQPJX0jTII+nhjSHVinkBgkMU7oewsxo5ZY+af/Ncdxwl9yvJ2rzPXSHaD5F4W/PONj/q8lE2wk6oAFgthatxXmt757+v4wumTGNoRBTt6v5hHvwNoR0WrWd1OuLkCAzpaLW8x4VPbU3bZNoMepYYD7Td2U5lffiCzbfZSF/tH8rO2qJ2fdw/CvaH/K97dnq+nNnAt+AS4MngPqGU524BlkJwioH/r8zdljpE8++9MyI4I8i9DNyG/wsaMfLpplr1M5E+T9c87XY+MMbnWL5h0HE2R6zrK6nKeC6XtoJoLthwl6b/YHQPOhXYNWRDvnWnLmVLsz6L1W1Crdv6OT2HnMEuX25uDzYfRyXYD8KPEEb8wKHh4lBT4lCw3ywYegkioC+oVQa2sMTg6MPNCz8dWsBT8rWDlg/ngVyD4Ph8E3y8oyhu2fnEzdYzZceAFFOOKcpeuNKfKmnj6UXlYzTWOFY/Nkk5WYENutiOdUVA2aLi6FF4XoM+dgnujZ7fEuSbYLwZ/e+C3dylMdbx28g1Axf6k5PTX8SwftW0z3bzq4KKvP2isOuppOke0Z7CiKcBPXZQ8UTq7H/kjQfcoHW4L6vpJ1zXXB3m35Ls46PD9ELgDeGBJgKWd/NXY7U3bfiBdHZ1cnALL+N4TBMrlEPBr4AxvhI3NFtyN6gfgzuAW3kY8dvL7kHj0dmRQsymoLroD/1foQ3e8h1c5Y7cC+LGAu0Bthzkm+D0KVb66PPoLvN8hlec2QuRbBftp0FvEI/8s+BLxgHITPA5uhvwXUJ2VNO6zRfsGgtq1R2EDWGD0N4EeznW67JrS2qIYnizjwC8cHJc3G9r7B5mR9WEsB3/jsIYZOLqExSmjwbZwtESmu37bSLkrstRd6yWKYUawc4PPSmYgHXwhJm27NhqBL4w7+B1jMYO/xHuZDD6uy97B7wCz8TToYlL4gaDMTrXByMawGO2DIse/Wmwvd7I4Nx0VM8Dexj3Fyd4U4uRHcdqfksxsWjrBKsC2eQSc7tOinf0YoCNe3pTHT/A+s4c/QwJrt7StQKEC7BunaQcJcK0x0KsLhl008LV3iHSDp0sOgU7LLbQVSFeAHcROv9newp8905bNpcTQYlmDwt138yitZVuBtgJtBdoK5BXgiLoA+Ekwex5hR9gElV435gvkzi3TVqCtQFuByVoBDmaagMnuq6G9gvwXiWuQz97EirY9WgGKNi/cyxxqClpnl/lA6TTd/yyoh2v/BjWtLxT/ZODvYzrXHr4haqGtQFuBphXgN6i1eL8DswfSTf1q7DTfpHc9npLdf+WBkMLOydj1zG9jcENwNXBBcKxBM8Y3gZeAeu51IRtGz8RaaCvQVoAK8Ft9M2SYc4qb8ps7f5YuNkXUGrcNQC3XtycFsJMCHidLrU5ZZZbeSO3g2gqUVIB9f3nwObAKHkaZLRiKw0gOSl8Fip+vZ4ljTMo2A9JKr/8FnwC7hUdxuBQ8FTw90N9ALwfvBctAr5Ps4AtGezfwFlAHMz221SKbfkELpg8BF/J9tXxbgVm1Auzrv6j50ezfZOzEiBd+xWF/0STOhLVhNFqtdxxYd9awgf8b5qegln1+FbwKHBTspkIRzBZddRtXB0ut1jwffLCB83ex0S1+C20FZskKsH9XXc3pIkPz87WA3Ryg7MvAv3hSG29CGDCS9cAby0bk5DqYfBvUGvTDQF259QO6ItN7pjp4TksE+ooKhPy2hK4XkQ6M3wP1vmvVFeU16PWORQttBWapCrBfXwlWQaNpIwKsUhUE3ZWTonAk+jLwwprB6PZVL+S8Cvw5+DzYFP6I4V6gDrLZ1yKqCoPNN8AYqg6EU1LxCKCXk3SwrrsC1K2+3t39HJi/Uwzv4WoavbxUlUqtlbUVGPcKsD9/3e/gCf5ZZGtXJSo9KLsq+HpVjHHXkfmmoN56LAN9PeO14DvBu8qMnFzvD+kqa4V+Bof/QA6EcQ7EfSG4D1h1Bah1UHr3XLf5Kfg9wvnj2G27rcBkrAD78hWpnTwh09XjQeCnAq27mrQQhRdxJ1SNyPADYNlR/B50G4I6SOoqsApkuxM40Lk04g3lQOg3An3MCx4JloE29Fag3p1LwUkIG82h+H5bvq3ARKsA+/GpqR18ALLsmysTbbyaX9sSLDsA6tZYX508BayCM1FmHxsc1gCJP/QDoc+d/t4Dll0lamnQ28GnwRTYNz18yJZvKzCpKsCOrQecg4RdJlwBGJ1ub3XbmoJfIlwJ1HKUMvgtCr39MSZAX2N6ILRB0e9bwdSJQvOhOlh+HkyB6qNPxbXQVmDSVoB9eFlQy9z6AfkvO6GKQELzgWVLWHTr93qw7PZXt4TvH48B0e+4HAhtrPT/LTAFWn6zNFg2X5p/8MtitbStwGSrAPv3aamdv4HstAk3VpIuu3rREXsTcHrJwDTv98rxHBD9j+uBUGMnhxeBfwFTsBHCj6QUyHT1uMN41q/tu61AvxVgH96iZP8uExe+0tlv/337k+WioP82mU/8kzR+5AWO14FxQlzSkse4HwhtQ5CLvg2cAj19ng08OqVEpgPirhanpW0FJlsF2H+1yuKvYBXcirJ2FUX20QUMD6cI9lV4X48TeCF5Wy/oh6efj+P/40SMq5B9CrwYfCEYgz5KoK9FPA/qH/KI6oMFQuNhc5nxogZmH1PTi6oec4B62ioqlExofupvE/CNoIc9qNU3GePtCEe8Av7bYP4950g3iObLCfKxRKAzyUlnTs0P6gnZOxI2EqmmF4H67wtaTnA9fk9DJxwwFn3Y/gQwnvNU3dck739OuKTbhHquQJPtjc2edPD1RCf7sj9IVw8EOQqsgpPro9Rb0EHZe4Pbolu8KoFJovuSqkCut02wfHWSy4C8Zgf1vnIvoEXdeuiyH6hb77kt7lhR+nw3WAV6e6hdMjRWG2TI/bAtG29vbF8OPgQK9GreK7pKDwd9VKAK/txVwIQxwX+T6OBBZC81c3jNaT2ZsJsMIq3Zy9YqQifSgVA7xkpWY0+RLwF+Hfw72A/oTRcdXDs+dun7GwRPH3s0SHRkEH21Mca/AmO6velsqAdC4qfm/LQURredsxwwrtSBcMpkGihjWAZ8F6gD5elg2ZN7VB2gg+JAF7Bb7YjbHgitGP8FdCy391B2WNtGDESLFuOFi/py8xrcu2te6r8F9IDoNgb7U/AuUPNvurXcGlwRnI96PAmdEEAud5KI8JephBiLPmL7afCLYPxBW/3jyZ2xuR6q/8J6L7SFtgITuwLssEO5IiTuUuDzYAyrTuyK9Jcdg01dEe6LPJ+r8z0gPxjMPuHl5ZOJJ3897dctcgq0xEf/ErlvIE57Rdh3FSdPgLHc3sO8IjyYkutpqwc9xdGVwn8bHMWA9YqcnmD9B5wP1KS+XgXcnZoM84kyXQwXyP8wetCnztaAng2+xPWoSWvNB++C3aFO3rJtBSZOBdhBB35FSEy9ERKDviIzzAPvhCgqY0xdEU6qOcJ+C0kN3gmm7gZ0kOwZiDm0K0Jibw9qH/VwPQ0tTRoYEO814FfAy8AmHxS+G7sjQNU0tbSs59yItxh4DujhaRrZJ+V6Dhw5Em83MH4QejGyJSLTQhN9k+2NWSlo+zX6ZqGWewzjQHhqIrXPF0Y5wAZ9vRhcA9THBz4Kfhn8NPg+cH1wRTC+Oh1gBjND0c+4HQjpeyLV4UXkcwcYw3UI5plZseYcfk1+GCPNI45aEvesOMmovVO3Mc2eOFrW0esrYVEaeVN1nWp99ELxXzePlma0LrNvIHTZ20/W60ZlnWDQZHtbnCpav/3w7utAiL/OKj8G9WpcGehDAT3t/HGRiKMN+LuyjhrKtazkC6D+HedAgZhjciCknwldBysqeV4AVsEzKL8L1q4iwKbJD2PE+m5CibkFWAffaxLL2xDwS+DzdYEHoNe7+pVXVj4v4/EZeC0ttlHl1WB8+5h9TBvm2KCLGd+KY8ftnhef0vurwccIeB/4cTB+euj7Oof5oae8oBuefvR5rsfAGfj9Hozf6ugmnGy15u07oBYJC04AB35QVEeDBHKcjHXYlBpMq6iDpkv0sEgny90r7Ial+mGDwMc3sMlMGMNXQO2n+4NjcRfyBvq5hy5vBhfKkmj/+Aocy7Ene9nBC2O+pwMhBdfSj6vA+B0+HRhTcHRKWCejnyNB7VRaxhH3Vefejf4DGOugeBeo5SwTCshp0taBnfB5ivmuhgXVV3XWa2jblxn9LA7eQ5DlagJdwxiuqbHRFNMqoPb/b9TZOv0j8D8HdSGh1x/XBDcG9VqrTtQ3gU1hZQz1KTu9zvnfBLoo0kNHj4uyzQx2aFQMCtf1rTE+rwJjuBbBcbGQ9iWNEnFG+GwFjsVtRSLdTHQ2f2tv1VzKOYvfwG6NiTVp65AXJDCMRbdwMeiHG8MXYl9rY9j37Rwx9CGK78WdlrSfRF679AebDUr8U+JfI+z6yg2fncCnUwETspOtZmUUn75rWRbb5PQxFrfGI9ZfP7SnK0I6fDTR6WrIPhjJH6a9eSSrbFK8MzE4FWxyW3E/dlrYO7cd/ssoNmuDTQ/Kb8VWP4KVoOMCs2AdTkkUMnVA+EPCri8RtdSDmwPBZwmkK9T/aRDwSWxWZX96qMqWmGugv7jKJujOgM5BvLeDqd9PZQh8jgB1J7YVqLukKngveR1TZdDqogpQsK6vCBUCv8PB8QK9xtXrQVy5bwhmc47jNYAB9Tur1UG3g6VAzZpcxQyitFcQpNEdAXbXNOjww6WD6kFBfzqw39+g33XKwuPbpJYjZf5N5PQxa18RMkAVeKAbt0lhsdFrXwtyZtTiXJ3ZewJ8LwYXwHmyzqfMinV4C9vkiz1t0ME5XUGoF5PH2mDtK6D8Dt6E/eo13R9KrJ7myMviEu/f6DYq0zv5Zx3fshUV6HqBMxt/FeJdloj5N2R6uqbb1dkCQnLeZCmqJ85flXEF3IFu+SY7aEWMgopYWuKgnWq/gqKz8UdENmGu/AVlVLcvvYKeXL+7xnk86/BncruhJr8yta7gNb7FwVXBF4IezmVb6B10q7PXjRWvByfLg01z0Djq4Cd1Br3oqdON1OtyfEuv+tA1ya+X7mc5n64PhFQg9XHPg9kwu/ZaHTbo+xr47koftWfpBnEKJsTU16Z3RrhkQVFs/Au7HYuiwbdCHeoOhONZhwepw3aDGDlj/TJxvhnF0tPSpgehyHUgzSWIcjW5aS5xXcZaN1+pu4o6eLjOoA+9njpXQZP8qvz/a3S9HAh/TXXiuZzPsPNsgfxr4J/A+8BH2JGegjaB1zQwqtspG4QoNbkKTdUSj9eWeg5WMdHrsCrb+aV9DFlXgbpK0UkldUK9so/Y5qo1Yw+Ehg4EugJdAdwUfDHYBPS70FPuw9mHP1HhcH2FzlQbwdxujUFRcpuLWHXraZvkN6iUJnWcrg+E7Bj6T2mvZNTXgrrVMZgC83/WEMXON/vllyXA3f0GKfFX7CpYhLEMdDBVndXoxrMOC5Pb/TX59ar+DPvWSb06O78TiTPNtTtYNqWuao8AdWCugo9juw7xym4xz8NZV2WqSxkcRIzTifFgmUGP8h/jpymlKqiq59+rHINuM6j66RXkXwdN8qiL0bde8zZdAxv1ZnA+HLWDXNJ1gN4cduvNrdqLnXRjLFavtppQ2lmpDtOp7DbsS4IfjlWV6et4cH7603b/T02/r2UfOSFlQwzdQn8qpXMyXZXqwwmvc7KeWeLMCV5IgI/UBLmC/I6tsNH8Yh1oDl116hrw00XSVxo4NsmjQZg+TUj452AdvKyXbgg6B7gAqMf9KVwQuXAh8GSwDg7oJY8yHzpbGdSrXVWgL4QsDyrHscCy/+3icxyvOvRzW1y2GRrLKcBQlnwQt8m766U/avz38xungv8TupHGA3aG+M0OHlgR26v0yl3d1a7u2L7jnUp4vdiwoUullsVe78E3+bLOQVXBiNFke+tOtH+gM32SvQkcgJG/Fe6/cxeB2Lr9fLxBItOxWcy59sQS40cN+pLJ53vqoEcn+mvrUFI7atPkhzFS4l4qJq4OMnXr8q4rDYACf82TdwMXYbwZOE9ZXHQ6UetgZe/Ew9aC3jlutAZS/WJ7Rm3EmQbnw64Oan4yB9q6StX88VlgUzg3D1DCEOj9DYJdgc1LSkJ0JybQUQ067MfkVpxrHwRgo6vDBxp2pB33Hd2MFPulwdQ/kirrcsdu4g/KlmTaOiSKSV2GciBUV8Tes2wncPLKhy3YabtpDn08QFdu706UrVaE3/fHOOFDa5MKBuQ1rY/c7sJ33SZ9zWZGOGju6bvWHhL9APMWJ1bFJg+dzc4Em0y0+lCP0dD6Rj1QuR/U3Ixu6TU3o6eG3YDmjdYj1z924zRI27YOndWkJnsg3a9TU5BMYbtNK0gaNIi9DWY/qzHdhNian6sEYmnu/FegHmwNG/QQby/y2refjshZD3z01P7l/cSp8b0Nvf73dOMHR+Sl37EeqPRzF6gHcc3noOl0HvAkcFjwqZpC5WoSWAH857ASqYhbt7A7z3EsmLYOM6tMLbau2G5S6Ray65UQ6gG/NRSgBpaZmU09Ryz9no4AdbU2aLiFgHrYM1Ag5nzgiQNO9lTi9fTQxQaH/xf6yGkfi9M1pdNu7/nr8vxc10ngQNDFwcvqgvep19zke3vJb6x8yK+tw+j+sD21SE3E6wHBkv1sD/w3AvWxjRj0Cf++n/oSY1PwFPDfYLdwLQ56iqsrpDEB+tJB8cugbjG7gX9grKmGvg5+qUESczVQc5VNYf9UnEktY+Qqgl7FGgTcS5CdwZ6uIMazkOTc1mE8N0Db9yxXgXyOcDKOjAPC3OS9Ifg2cEVQbxFoXlDzCZozvBe8D7wHvBQ8k7mCYS3KJvz4QFuH8al722tbgbYCbQXaCrQVaCvQVqCtQFuBtgKzTAW4rdoRtLcrdm4yMOzt4YUmRfuaoPb9EWtz0J6wbe91TXh8tbDzr6BAc4ALNfGrsiGGTcxqwriwkLTKbxA6+hsBnwK7gb6WUQwi725jMDgtihVovensTf2xHfj2btr3MOwYzxagflNloFf1xm1Om777+n0Oo2YDi8ngPhFVXXNtpYDt3s7+aXitPxoIEOtYF/usboPiq6dctuRGSyk0Z9gz4P9S0MMmPQfrwZGO5wV/CepJ5jMB4yemJhfVkoo399DVuLmQ7xTQw1pNk8FpoNu7ab+DtmMcepocg7anvqJueB/8XoPuu5t49N/X77ObvsbFlgH+HjS4uCwJDJYxo0A/UWbbi5yYE6rQ5DOuB8JUDcnpi6H2IrenbCaTjDH0fCCcTOMsy5Xxx/tYty8SlIUeuJxcJ9Tvc5ADtNuQD7mgGzBg33aqFxzpGr/nCWzHJ3rw1WtGR4FloP9cthdofbuQBfatZQGQHwZ2rFFCNg9or+jpijD5DiJyxS5bG6Uz8SqFTGoa2A9qzDU9da8mtxeCPwRtygE2h5XjiGi0aNmuqnNDx+jjGIvGfnEbm4HVmFg/df3ni/KR1W5vbOq2TXJf8uMhRtVYlNo54NLepws+9rupqS996o7BtpX29xenfJEvCWq/FhRur2kvDl4qRQlskIqJbLPIfv3YDn1d3X6Ljd7CKQX0VdMFGruupmcDdaea2scRz1A/y5d24hUY7gUaaAFp4WVw2u81ZaCFrz4g00aJ37PUxrkC/AV4PWgbAzaDY6Ic/BnHbB6E0e3hr8CHTRjotyN/zal5WDvST/XKwE+Hng6eB94O5gd3+PhsXbg1Rt/3mH1+TXj6bHxFiO32YAza6XVgLOy4tH1c+WinuhH8OXgh+Cjo4Q4aHXOwyKZ6o8BX1XhKZF+4NUb3kUiffyQXed32PiTy1b6kbV27L2lbYDcVjEHTDzoZ6OBnByGzeQhmqSbb0dvgc7AFCFS/v6PBLcHSr8igq6yd9YHdxqCH7HU1BOt6IfzN4BHg4eChYOHqlPaxoIG2v9ltbn2JIp9qRo7aPqA5d93me9DUzyuiGCsie9wbwV8JHg/eEMl9U8eYC0Dtt9O8Av5ycA7fT5LH6G/O8VAzkjOonchgT9OJIlwA9HNXF9HO1yiKB98O6gcVw2EWC4UvtA6i+nR6AZAtBz4LGrzHDBCMmDDQ/EBI+9tOpx/5RuZXRrEpPRCiG8iYy/ouk9OvP2CV3hpjp232H9CgcNLw8TE4xoyg2ilf5fWeR6eDgIf8igZhLzWe4oPB7wR+EFRO2k4eCh/BQFG1vac6x172JT8W7dtv8nXwPDqdWDy83uub8Djr6nYfMD7ZW1zV4jAw/yHDx7UrnESsX+zKDoS7oTPQR0ySd1Aujv99nmVyT4nh69bxO0P/MnA/0B9PaGawuMWiNT3IRA40uafI49eBt/V68djogZpO6AaVn/7K/LFcx6wDzTYo/IFOfkuis085vc6KOoDsBaq4KdArRgeB8VVlbaHD4H7rgvoDdtUPw5+9PxOPIdWmj6oD4UDGnOq3SkZOTQ+ETX8k+gH6K/Xa/x+Dva6KDPIJfAS91DjO0+LG9N1xXTCo2t797kt+LPnteJyDtcnlEpdwfnI3fS+UeC8BPwdqOsngaZjsqhMa167bA6FOlldb4IjqTu6dPm/atTXFxtdtV9pvAXX1XAZ/QPF+sJcDfHyXmnyiTux9Xec3+DEZX5inY87vchR+I/4vATRf5t8TTs0f3moBoYuA+vrL3qB9yPNP8DuA89CHrhQ/AOpgdBvxD4eOBfgcCwfgHjv38SbqmGuHxubQ/5W50xmu5PgOlu2lt3mWcwrP+5r0WuOtib06OBW81PVzCn3fB1ZetTj7flk/lsqahI78V1uW7bdz+bNt9M+yvgdqZcb1IaaWcNlvUF9xmRHkImVzt0k5cZ8D9Z8D9Zt8A3gAeBMo0EFV0wiaEim9Pc8si3983X6A6hzwLcHkSegR4MqhT43lGfDnoKYDKlesYDN2QDK6lNRVnYG/5f1hWSYYn2UOge4T2yLX1Yc/c8o0v5yFrz3jKCZ2vVwRroufH8vvaC8Z5+jb6EuvCEMefY/Z99eEJ6eBXhGGcbyTuB7OpbFYnA+yD4G6IvFwlNkh7KXGlVc1xJwN9PvMdNffMK8I47HoCskf9LM0kG0B6g7Hw68tx0FQAm/vg8PrRJEB/HFOp/1bJ5AcaO/i9MZ2bNvcAQajBUG/nTeUHtnRoMF5ksWAMq6bPoaxVMJOU2W6dTa4GSa7KoRW7hMWC7uBXRFazAKlg3eBMeiSN3npac7odYnrb7PiGL59K41lzFeU9rHO4Cyv8zw2XR8IQ3wdiHUpXgVPoczO6NDKA2GI2deY/bia8OQ08ANhGMfCxP4r2C3kB8IQp9sa1+70JPSaKKnsSSOyoR0IuxiLpaa5VYMzmmzL0MdaOPkDgsVIUe2bHU9ZkW0L+pN8ytfLsgMhgneDdX2fZGPBdnUw1c/jyPP5fPgm+wBmOXzJ+gg1qd0ngt1wD4ShkzeQptYXPgDqrKNbokaA7byg5gd+BupI/xh4A3gCuH5ZEHQqwOXgdffL5qIAAAG0SURBVGDpF63RrQH+CdQBsXBVR1sHCp2FSh8OqH/0a4Ka+7wQ1BWwfC4GPwvqViED+M+A0h1sshRF39OYU7GqZPQzP/hr8O9g4Wld7Id+d1C5fyvWVbWx3wg8GLwU1K3RdPBsULWdC3wdeD2o/aPjKslio2ta49o8ifUlUGMpfFaJdnJ7Ix/EvrQacXYDFwDjsehErt+FDiZLg/4KSlM/jQC/RcELwBTod3MZ+H3QppkKcZHrDu5j4Dqg9o2twH3AE8HDwF3AnUGDJ2CyCxroymA8R6hxaNt+C5yv0FloIH8fqLyUnw6Mp4HJ4wPyuG53I9Nv7mvggqn4kqGr3SeC3dHY3gV+uCKWTvLngjrRb1hm18rbCrQViCrAD+aNoAedLHUbnB8c4FcCdTLw8J0o1FCbdPwX17nuxj4MzqtOoXOB/ikuzRnfHGpCbfC2Am0FZq0KcNDQFVZ8oNPBJAW6spoyHhWg3y1BHQSr4BGU+dzieOQ5kfvMbwEncpJtbm0FxrsCHER0laWpiFeCmg+7F7xayBPQf0LHHchRT2G3ALUOVPOAN4PXgFeRo3+6jKgFX4H/B4pxWMAaRvJIAAAAAElFTkSuQmCC'/>
      <label for="identity" class="sr-only"><?php echo _("Email address");?></label>
      <input value="admin" name="identity" type="text" id="identity" class="form-control" placeholder="<?php echo _("Username or email address");?>"  autofocus>
      <label for="password" class="sr-only"><?php echo _("Password");?></label>
      <input value="ahmetatak"  name="password" type="password" id="password" class="form-control" placeholder="<?php echo _("Password");?>" required>
      <div class="row">
          <div class="checkbox col-sm-12 col-md-6"><label>
          <input type="checkbox" name="remember" value="remember-me"> <?php echo _("Remember me");?>
        </label></div>
          <div class="col-sm-12 col-md-6"><label data-toggle="modal" data-target="#exampleModal">
            
            <?php echo _("forgot password");?>
        </label></div>
      </div>
           
         <?php 
        
       if(SESSION_MEMBER_LOGIN_FAIL_CONTROL==TRUE AND Session::get(SESSION_MEMBER_LOGIN_FAIL_COUNT)>SESSION_MEMBER_LOGIN_FAIL_COUNT_LIMIT )
         {
            echo ' <div class="row">
          <div class="checkbox col-sm-12 col-md-12"><label>
           <div class="row">
                      <div id="captcha_content" class="col-md-10"><img id="captcha_img" src="'.Protection::captcha().'"></div>
                      <div class="col-md-2"><a id="reflesh" style="color: white; float: left;" class="btn btn-link"><i   class="fas  fa-redo-alt fa-lg"></i></a></div>
                  </div>
        </label> 
       <input  name="captcha"   type="text" id="captcha" class="form-control" placeholder="'._("captcha").'" required>
</div> </div>'; 
         }
         ?>
          <button id="signin" class="btn btn-lg btn-danger btn-block" type="submit"><?php echo _("Sign in");?> <i class="fas  fa-sign-in-alt "></i></button>
          
          <div style="color:white;margin-top: 30px; text-align: center;" class=" col-md-12"><label>
      <a style="color:white;" href="<?php echo URL;?>/account/signup/"><?php echo _("Sign up now !")?></a>
        </label></div>
          <p class="mt-5 mb-3 text-"><i class="fas  fa-copyright "></i>  <?php echo _("2018  Powered by");?>  <a style="color:white;" href="https://aljazarisoft.com">Aljazarisoft.com</a></p>
    </form>
     
<?php } ?>
 