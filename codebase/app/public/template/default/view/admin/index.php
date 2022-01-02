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
<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="/dashboard/">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">Overview</li>
</ol>

<!-- Icon Cards-->
<div class="row">
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-primary o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fas fa-fw fa-handshake "></i>
        </div>
        <div class="mr-5">
          <?php
          if (isset($this->data["companyCount"]))
            echo sprintf(_('%s Company  '), $this->data["companyCount"]);

          ?>
        </div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="<?php echo URL . DS . FOLDER_ADMIN . "/company/all"; ?>">
        <span class="float-left"> <?php
                                  if (isset($this->data["companyCount"]))
                                    echo _("View All Companies"); ?></span>
        <span class="float-right">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-warning o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fas fa-fw fa-truck-moving "></i>
        </div>
        <div class="mr-5"> <?php
                            if (isset($this->data["vehicleCount"]))
                              echo sprintf(_('%s Vehicles  '), $this->data["vehicleCount"]);

                            ?></div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="<?php echo URL . DS . FOLDER_ADMIN . "/vehicle/all"; ?>">
        <span class="float-left"><?php
                                  if (isset($this->data["companyCount"]))
                                    echo _("View All Vehicles");

                                  ?></span>
        <span class="float-right">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-success o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fas fa-fw fa-hdd "></i>
        </div>
        <div class="mr-5"><?php
                          if (isset($this->data["deviceCount"]))
                            echo sprintf(_('%s Device  '), $this->data["deviceCount"]);
                          ?></div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="<?php echo URL . DS . FOLDER_ADMIN . "/device/all"; ?>">
        <span class="float-left"><?php
                                  if (isset($this->data["companyCount"]))
                                    echo _("View All Devices");

                                  ?></span>
        <span class="float-right">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-danger o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fas fa-fw fa-user"></i>
        </div>
        <div class="mr-5"> <?php
                            if (isset($this->data["accountCount"]))
                              echo sprintf(_('%s Account  '), $this->data["accountCount"]);

                            ?></div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="#">
        <span class="float-left"><?php
                                  if (isset($this->data["companyCount"]))
                                    echo _("View All Accounts");

                                  ?></span>
        <span class="float-right">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
</div>

<!-- Area Chart Example-->
<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-history"></i>
    <?php echo _("Last Actions"); ?>
  </div>
  <div style="min-height: 200px; max-height: 300px; overflow-y: scroll;" class="card-body nav nav-pills nav-stacked">
    <?php
    if (isset($this->data["log"]) and !empty($this->data["log"])) {
      foreach ($this->data["log"] as $this->key => $this->value) {

        switch ($this->value["log_action"]) {
          case "signin":
            $actionico = '<i class="fas fa-sign-in-alt"></i> ';
            $action = _("logged in ");
            $css = "text-primary";
            break;
          case "delete":
            $actionico = '<i class="fas fa-trash-alt"></i> ';

            $css = "text-danger";
            $action = _("deleted");
            break;
          case "update":
            $actionico = '<i class="fas fa-edit"></i> ';
            $css = "text-success";
            $action = _("updated");
            break;
          case "insert":
            $actionico = '<i class="fas fa-plus"></i> ';
            $css = "text-success";
            $action = _("added");
            break;
          default:
            $deleted = "";
            $deletedend = "";
            $css = "text-dark";
            $action = _("unknow");
        }

        switch ($this->value["log_table"]) {
          case "account":
            $table = _("account");
            break;
          case "company":
            $table = _("company");
            break;
          case "device":
            $table = _("device");
            break;
          case "employee":
            $table = _("employee");
            break;
          case "vehicle":
            $table = _("vehicle");
            break;
          case "setting":
            $table = _("setting");
            break;


          default:
            $table = _("unknow");
        }

        if ($this->value["log_action"] == "delete")
          echo   "<del><p class=" . $css . ">" . (isset($actionico) ? $actionico : '') . " | " . sprintf(_('%s (%s) %s  %s  (#%s) at  %s from  %s'), '<i class="fas fa-user"></i> ' . $this->value["username"], $this->value["fullname"], $action, $table, $this->value["log_data_id"], Time::get($this->value["log_datetime"], "d.m.Y H:i"), $this->value["log_ip"]) . "</p></del>";

        else
          echo   "<p class=" . $css . ">" . (isset($actionico) ? $actionico : '') . " | " . sprintf(_('%s (%s) %s  %s  (#%s) at  %s from  %s'), '<i class="fas fa-user"></i> ' . $this->value["username"], $this->value["fullname"], $action, $table, $this->value["log_data_id"], Time::get($this->value["log_datetime"], "d.m.Y H:i"), $this->value["log_ip"]) . "</p>";
      }
    } else
      echo _("No log record!")

    ?>
  </div>

</div>