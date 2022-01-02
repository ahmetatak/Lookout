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

if (isset($this->data["response"])) {
  echo '<div class="alert alert-' . $this->data["response"]["statu"] . ' alert-dismissible fade show" role="alert">
  <strong>' . $this->data["response"]["title"] . '</strong> ' . $this->data["response"]["message"] . '
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
?>

<script>
  $(document).ready(function() {
    $('[data-target="#deleteModal"]').click(function() {
      var id = $(this).attr("data-id");
      $("#btndelete").prop("href", "<?php echo URL . DS . FOLDER_ADMIN ?>/device/delete/" + id)

    });
  });
</script>
<!-- DataTables Example -->
<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-hdd"></i>
    Devices
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead style="font-size: 9pt;">
          <tr>
            <th></th>
            <th><?php echo _("Device id"); ?></th>
            <th><?php echo _("Serial Number"); ?></th>
            <th><?php echo _("OS Version"); ?></th>

            <th><?php echo _("Company"); ?></th>
            <th><?php echo _("Company Owner"); ?></th>
            <th><?php echo _("Vehicle"); ?></th>
            <th><?php echo _("Plate Number"); ?></th>
            <th><?php echo _("Statu"); ?></th>

            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>

        <tbody style="font-size: 10pt;">
          <?php


          if (isset($this->data["devices"]) && is_array($this->data["devices"]) && !empty($this->data["devices"])) {
            foreach ($this->data["devices"] as $key => $v) {
              if (isset($v["vehicle_type"])) {
                if ($v["vehicle_type"] == "truck")
                  $vehicle = "truck-moving";
                elseif ($v["vehicle_type"] == "car")
                  $vehicle = "car-side";
                else if ($v["vehicle_type"] == "bus")
                  $vehicle = "bus";
                else if ($v["vehicle_type"] == "van")
                  $vehicle = "shuttle-van";
                else if ($v["vehicle_type"] == "pickup")
                  $vehicle = "truck-pickup";
                else if ($v["vehicle_type"] == "motorcycle")
                  $vehicle = "motorcycle";
              }

              if (isset($v["device_statu"]) and $v["device_statu"] == 1)
                $statu = '<i title="' . _("Active") . '" class="fas fa-toggle-on text-success fa-2x"></i>';
              else {
                $statu = '<i title="' . _("Inactive") . '" class="fas fa-toggle-off text-secondary fa-2x"></i>';
              }
              echo '     <tr>
                        <th><i title="' . (isset($v["device_id"]) ? $v["device_id"] : '') . '" class="fas fa-hdd text-default fa-2x"></i></th>
                      <th><a href="#' . (isset($v["device_id"]) ? $v["device_id"] : '') . '">' . (isset($v["device_id"]) ? $v["device_id"] : '') . '</a></th>
                      <th>#' . (isset($v["device_serial_number"]) ? $v["device_serial_number"] : '') . '</th>
                      <th>' . (isset($v["device_version"]) ? $v["device_version"] : '') . '</th>
                      <th>' . (isset($v["company_name"]) ? $v["company_name"] : '') . '</th>
                      <th>' . (isset($v["company_owner"]) ? $v["company_owner"] : '') . '</th>
                      <th><i title="' . (isset($vehicle) ? $vehicle : '') . '" class="fas fa-' . (isset($vehicle) ? $vehicle : '') . ' text-primary fa-2x"></i></th>
                       <th>' . (isset($v["vehicle_plate_number"]) ? $v["vehicle_plate_number"] : '') . '</th>
                        <th>' . (isset($statu) ?  $statu : '') . '</th>
                        <th><a href="' . URL . DS . FOLDER_ADMIN . '/device/update/' . (isset($v["device_id"]) ? $v["device_id"] : '') . '/" class="btn btn-light btn-sm"><i class="fas fa-edit "></i></a> </th>
                         <th><button data-id="' . (isset($v["device_id"]) ? $v["device_id"] : '') . '" data-toggle="modal" data-target="#deleteModal" class="btn btn-light btn-sm"><i class="fas fa-trash-alt  "></i></button> </th>
                    </tr>';
            }

            echo '                    <!-- Logout Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">' . _("Are you sure to do this ?") . '</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">' . _("The device will be deleted are you sure about that ?") . '
              <div id="delete_id" class=""></div> 
              </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times-circle "></i> Cancel</button>
            <a id="btndelete" class="btn btn-danger" href="delete/"><i class="fas fa-trash"></i> ' . _("Delete ") . '</a>
          </div>
        </div>
      </div>
    </div>  ';

            ###########

            if (isset($this->data["total"]) and $this->data["total"] > 1) {
              #####################33 

              $previous = $this->data["page"] - 1;
              if ($previous <= 0) {
                $previous = 1;
                $cssPrev = "disabled";
              }

              echo '<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-end">
    <li class="page-item ' . (isset($cssPrev) ? $cssPrev : '') . '">
      <a class="page-link" href="' . URL . DS . FOLDER_ADMIN . '/device/all/' . $previous . '" tabindex="-1"><i title="' . _("Previous") . '" class="fas fa-chevron-left"></i></a>
    </li>';


              for ($x = 1; $x <= $this->data["total"]; $x++) {

                if (isset($this->data["page"])) {
                  if ($this->data["page"] == $x)
                    echo '<li class="page-item active"><a class="page-link " href="' . URL . DS . FOLDER_ADMIN . '/device/all/' . $this->data["page"] . '">' . $this->data["page"] . '</a></li>';
                  else
                    echo '<li class="page-item"><a  class="page-link" href="' . URL . DS . FOLDER_ADMIN . '/device/all/' . $x . '">' . $x . '</a></li>';
                }
              }
              $next = $this->data["page"] + 1;



              if ($next > $this->data["total"]) {
                $next = "";
                $cssNext = "disabled";
              }
              echo ' 
   
    <li class="page-item ' . (isset($cssNext) ? $cssNext : '') . '">
      <a class="page-link" href="' . URL . DS . FOLDER_ADMIN . '/device/all/' . (isset($next) ? $next : '') . '"><i title="' . _("Next") . '" class="fas fa-chevron-right"></i></a>
    </li>
  </ul>
</nav>';


              echo '</ul>';



              #####################
            }
          } else {
            echo _("it is empty!");
          }
          ?>


        </tbody>
      </table>
    </div>
  </div>
  <div class="card-footer small text-muted"><?php echo sprintf(_('%s Total record !'), (isset($this->data["count"]) ? $this->data["count"] : '0')); ?> </div>
</div>