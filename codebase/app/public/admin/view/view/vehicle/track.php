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
$this->loadJS(array("https://api-maps.yandex.ru/2.1/?lang=en_US&amp;apikey=c18b0152-a0ea-4925-ad3d-e5a6cfede05e"));
if (isset($this->data["company"][0]["company_statu"])) {
  if ($this->data["company"][0]["company_statu"] == 0)
    $statu = _("Inactive");
  else   if ($this->data["company"][0]["company_statu"] == 1)
    $statu = _("Active");
}

?>
<style>
  /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
  #YMapsID {
    width: 100%;
    height: 100%;
  }

  /* Optional: Makes the sample page fill the window. */
  html,
  body {
    height: 100%;
    margin: 0;
    padding: 0;
  }
</style>
<?php

if (isset($this->data["errorList"])) {
  if (is_array($this->data["errorList"])) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>' . _("We found some errors!") . '</strong> 
  ';
    foreach ($this->data["errorList"] as $key => $value) {
      switch ($key) {


        case 'company':
          foreach ($value as $val) {
            echo '' . $val . '';
          }
          break;

        case 'driver':
          foreach ($value as $val) {
            echo '' . $val . '';
          }
          break;

        case 'plate':
          foreach ($value as $val) {
            echo '' . $val . '';
          }
          break;
        case 'serial':
          foreach ($value as $val) {
            echo '' . $val . '';
          }
          break;

        case 'vehicle':
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
  }
}
if (isset($this->data["response"])) {
  echo '<div class="alert alert-' . $this->data["response"]["statu"] . ' alert-dismissible fade show" role="alert">
  <strong>' . $this->data["response"]["title"] . '</strong> ' . $this->data["response"]["message"] . '
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

?>

<!-- DataTables Example -->
<div class="card mb-12">
  <div class="card-header">
    <i class="fas fa-search "></i>
    <?php echo _("Find The Vehicle");

    ?>
  </div>
  <div class="card-body">
    <?php if (!empty($this->data["location"])) {
      echo ' <div id="YMapsID" style="min-width: 600px; min-height: 400px"></div>';
    } else {
      echo '<div class="alert alert-warning" role="alert">
  <h4 class="alert-heading">' . _("Warning") . '</h4>
  <p>' . _("There is not any record for the vehicle") . '</p>
  <p class="mb-0">' . _("Please be sure you have data to display") . '</p>
</div>';
    }
    ?>

  </div>
  <div class="card-footer small text-muted">Updated yesterday at 18:20 PM</div>
</div>
<script>
  <?php
  $a = end($this->data["location"]);
  if (sizeof($this->data["location"]) == 1) {
    $lat = $this->data["location"][0]["location_lat"];
    $lon = $this->data["location"][0]["location_lon"];
  } elseif (isset($a["location_lat"]) and isset($a["location_lat"])) {
    $lat = $a["location_lat"];
    $lon = $a["location_lon"];
  } else {
    $lat = 0;
    $lon = 0;
  }
  ?>
  ymaps.ready(init);

  function init() {
    var myMap = new ymaps.Map("YMapsID", {
      center: [<?php echo $lat; ?>, <?php echo $lon; ?>],

      zoom: 18

    }, {
      searchControlProvider: 'yandex#search',
      iconContent: '<i class=\"fas fa-car\"></i>'
    });

    <?php if (sizeof($this->data["location"]) == 1) { ?>
      myMap.geoObjects.add(new ymaps.Placemark(["<?php echo $lat; ?>", "<?php echo $lon; ?>"], {
        balloonContent: '<strong>Vehicle</strong> color'
      }, {
        preset: 'islands#governmentCircleIcon',
        iconColor: '#3b5998'
      }));
    <?php } ?>
    /**
     * Adding driving directions to the map
     * from Krylatsky Hills street to the metro station "Kuntsevskaya"
     * via the station "Molodezhnaya" and then to the metro station "Pionerskaya".
     * Route points can be set in 3 ways:
     * as a string, as an object, or as an array of geocoordinates.
     */
    <?php
    if (sizeof($this->data["location"]) >= 2) {

    ?>
      ymaps.route([
        <?php
        $i = 0;
        foreach ($this->data["location"] as $this->key => $this->value) {

          echo "{ iconContent:'<i class=\"fas fa-car\"></i>',type: 'wayPoint', point: [" . $this->value["location_lat"] . ", " . $this->value["location_lon"] . "] },";
          $i = $i + 1;
        }



        ?>


      ]).then(function(route) {
        myMap.geoObjects.add(route);
        /**
         * Setting the contents of the icons for the start and end points of the route.
         * Using the getWayPoints() method to get an array of waypoints.
         * The getViaPoints method can be used for getting the route's through points.
         */
        var points = route.getWayPoints(),
          lastPoint = points.getLength() - 1;
        /**
         * 
         * 
         * Setting the placemark style - icons will be red,
         * and their images will stretch to fit the content.
         */



        points.options.set('preset', 'islands#darkOrangeStretchyIcon');
        // Setting the placemark content in the start and end points.
        for (var i = 0; i < points.getLength(); i++) {
          if (i == 1) {
            points.get(i).properties.set('iconContent', '<i class="fas fa-car"></i>');
          } else if (i == lastPoint) {
            points.get(lastPoint).properties.set('iconContent', '<i class="fas fa-map-pin "></i>');
          } else {
            points.get(i).properties.set('iconContent', '<i class="fas fa-map-pin"></i>');
          }

        }



        /**
         * Analyzing the route by segments.
         * A segment is a section of the route up
         * to the next change of direction.
         * In order to obtain the route segments, you first need to obtain
         * each path of the route separately.
         * The entire route is divided into two paths:
         * 1) from Krylatsky Hills street to the station "Kuntsevskaya";
         * 2) from "Kuntsevskaya" station to "Pionerskaya".
         */

        var moveList = 'Let\'s go,</br>',
          way,
          segments;
        // Getting an array of paths.
        for (var i = 0; i < route.getPaths().getLength(); i++) {
          way = route.getPaths().get(i);

          segments = way.getSegments();
          for (var j = 0; j < segments.length; j++) {
            var street = segments[j].getStreet();
            moveList += ('Going ' + segments[j].getHumanAction() + (street ? ' to ' + street : '') + ', passing through ' + segments[j].getLength() + ' m.,');
            moveList += '</br>'
          }
        }
        moveList += 'Stopping.';
        // Printing itinerary.
        $('#list').append(moveList);
      }, function(error) {
        alert('An error occurred: ' + error.message);
      });
    <?php
    } ?>
  }
</script>