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

?>


<!-- DataTables Example -->
<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-table"></i>
    Companies
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Id</th>
            <th>Company Name</th>
            <th>Company Owner</th>
            <th>Total Employe</th>
            <th>Total Vehicles</th>
            <th>Phone</th>
            <th>Active</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>

        <tbody>
          <?php


          if (isset($this->data["companies"]) && is_array($this->data["companies"]) && !empty($this->data["companies"])) {
            foreach ($this->data["companies"] as $key => $v) {

              if (isset($v["company_statu"]) and $v["company_statu"] == 1)
                $statu = '<i title="' . _("Active") . '" class="fas fa-toggle-on text-success fa-2x"></i>';
              else {
                $statu = '<i title="' . _("Inactive") . '" class="fas fa-toggle-off text-secondary fa-2x"></i>';
              }
              echo '     <tr>
                      <th><a href="#' . (isset($v["company_id"]) ? $v["company_id"] : '') . '">' . (isset($v["company_id"]) ? $v["company_id"] : '') . '</a></th>
                      <th>' . (isset($v["company_name"]) ? $v["company_name"] : '') . '</th>
                      <th>' . (isset($v["company_owner"]) ? $v["company_owner"] : '') . '</th>
                      <th>' . (isset($v["total_employee"]) ? $v["total_employee"] : '') . '</th>
                      <th>' . (isset($v["total_vehicle"]) ? $v["total_vehicle"] : '') . '</th>
                      <th>' . (isset($v["company_phone"]) ? $v["company_phone"] : '') . '</th>
                        <th>' . (isset($statu) ?  $statu : '') . '</th>
                        <th><button class="btn btn-light btn-sm"><i class="fas fa-edit "></i></button> </th>
                         <th><button data-toggle="modal" data-target="#deleteModal" class="btn btn-light btn-sm"><i class="fas fa-trash-alt  "></i></button> </th>
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
          <div class="modal-body">' . _("Company will be deleted are you sure about that ?") . '</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times-circle "></i> Cancel</button>
            <a class="btn btn-danger" href="https://lookout.aljazarisoft.com//account/profile/signout"><i class="fas fa-trash"></i> ' . _("Delete ") . '</a>
          </div>
        </div>
      </div>
    </div>  ';
          } else {
            echo _("it is empty!");
          }
          ?>


        </tbody>
      </table>
    </div>
  </div>
  <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>