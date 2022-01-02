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
$this->loadCSS(array("template/" . TEMPLATE . "/css/animation"));
$this->loadJS(array("template/" . TEMPLATE . "/js/animation"));
?>

<header>
  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active  ">


        <img title="Slider image 1" alt="Slider image 1" class="d-block w-100" src="<?php echo URL; ?>/template/<?php echo TEMPLATE; ?>/img/bg.jpg" alt="First slide">
        <div class="carousel-caption d-none d-md-block img-intro">

          <div class="row">
            <div class="col-md-5"><img title="intro mobile application" alt="intro mobile application" data-aos-delay="50" data-aos-duration="5000" data-aos-easing="ease-in-out" class="img-fluid animated bounceInUp" src="<?php echo URL; ?>/template/<?php echo TEMPLATE; ?>/img/mobile_intro.gif"></div>
            <div class="col-md-5">
              <div data-aos-offset="200" data-aos-delay="100" data-aos-duration="1000" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true" data-aos="fadeInUp">
                <div class="intro-box">
                  <h5>Join us!</h5>
                  <p>You can track your vehicle by using our API
                  <p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item  ">
        <img title="Slider image 2" alt="Slider image 2" class="d-block w-100" src="<?php echo URL; ?>/template/<?php echo TEMPLATE; ?>/img/bg.jpg" alt="Second slide">
      </div>
      <div class="carousel-item  ">
        <img title="Slider image 3" alt="Slider image 3" class="d-block w-100" src="<?php echo URL; ?>/template/<?php echo TEMPLATE; ?>/img/bg.jpg" alt="Third slide">
      </div>
    </div>
    <a title="Previous" alt="Previous" class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a title="Next" alt="Next" class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</header>
<section class="pricing py-5">
  <div class="container">
    <div class="row">

      <!-- Free Tier -->
      <div data-aos-offset="200" data-aos-delay="50" data-aos-duration="100" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true" data-aos="fadeInLeft" class="col-lg-4">
        <div class="card mb-5 mb-lg-0">
          <div class="card-body">
            <h5 class="card-title text-muted text-uppercase text-center">Basic</h5>
            <h6 class="card-price text-center">$20<span class="period">/month (per a vehicle )</span></h6>
            <hr>
            <ul class="fa-ul">

              <li><span class="fa-li"><i class="fas fa-check"></i></span>1 GB data storage</li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span>Community Access</li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span>Mobile application support</li>
              <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Access API</li>
              <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Unlimited Subaccount</li>
              <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Dedicated Phone Support</li>

              <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Monthly Status Reports</li>
            </ul>
            <a href="#" class="btn btn-block btn-primary text-uppercase">Apply</a>
          </div>
        </div>
      </div>

      <!-- Plus Tier -->
      <div data-aos-offset="200" data-aos-delay="50" data-aos-duration="1000" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true" data-aos="fadeInDown" class="col-lg-4">
        <div class="card mb-5 mb-lg-0">
          <div class="card-body">
            <h5 class="card-title text-muted text-uppercase text-center">Plus</h5>
            <h6 class="card-price text-center">$40<span class="period">/month (per a vehicle )</span></h6>
            <hr>
            <ul class="fa-ul">

              <li><span class="fa-li"><i class="fas fa-check"></i></span>1 GB data storage</li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span>Community Access</li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span>Mobile application support</li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span>Access API</li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span>Unlimited Subaccount</li>
              <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Dedicated Phone Support</li>

              <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Monthly Status Reports</li>
            </ul>
            <a href="#" class="btn btn-block btn-primary text-uppercase">Apply</a>
          </div>
        </div>
      </div>
      <!-- Pro Tier -->
      <div data-aos-offset="200" data-aos-delay="50" data-aos-duration="1000" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true" data-aos="fadeInDown" class="col-lg-4 ">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-muted text-uppercase text-center">Pro</h5>
            <h6 class="card-price text-center">$50<span class="period">/month (per a vehicle )</span></h6>
            <hr>
            <ul class="fa-ul">

              <li><span class="fa-li"><i class="fas fa-check"></i></span>1 GB data storage</li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span>Community Access</li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span>Mobile application support</li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span>Access API</li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span>Unlimited Subaccount</li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span>Dedicated Phone Support</li>

              <li><span class="fa-li"><i class="fas fa-check"></i></span>Monthly Status Reports</li>
            </ul>
            <a href="#" class="btn btn-block btn-primary text-uppercase">Apply</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>




<script>
  $(function() {
    $('.carousel').carousel({
      interval: 15000
    })
    AOS.init();
  });
</script>

<!-- Page Content -->