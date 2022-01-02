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
if (isset($this->data["company"][0]["company_statu"])) {
    if ($this->data["company"][0]["company_statu"] == 0)
        $statu = _("Inactive");
    else   if ($this->data["company"][0]["company_statu"] == 1)
        $statu = _("Active");
}

?>

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

if (isset($this->data["vehicle"][0]["vehicle_statu"])) {
    if ($this->data["vehicle"][0]["vehicle_statu"] == 0)
        $statu = _("Inactive");
    else   if ($this->data["vehicle"][0]["vehicle_statu"] == 1)
        $statu = _("Active");
}

?>

<!-- DataTables Example -->
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-plus "></i>
        <?php echo _("Add A New Vehicle"); ?>
    </div>
    <div class="card-body">
        <form action="<?php echo URL . DS . FOLDER_ADMIN . "/vehicle/update/" . '' . (isset($this->data["vehicle"][0]["vehicle_id"]) ? $this->data["vehicle"][0]["vehicle_id"] : '') . '/'; ?>" method="post">

            <!-- Company | Select Basic -->
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="company"><?php echo _("Company "); ?></label>
                <div class="col-md-5">
                    <select id="company" name="company" class="form-control">

                        <?php


                        foreach ($this->data["com"] as $this->key => $this->value) {

                            if (isset($this->data["vehicle"][0]["company_id"]) and $this->data["vehicle"][0]["company_id"] == $this->value["company_id"])
                                echo ' <option selected value="' . $this->value["company_id"] . '">' . $this->value["company_name"] . '</option>';
                            else
                                echo ' <option value="' . $this->value["company_id"] . '">' . $this->value["company_name"] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>

            <!-- Employee | Select Basic -->
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="driver"><?php echo _("Employee (Driver) "); ?></label>
                <div class="col-md-5">
                    <select id="driver" name="driver" class="form-control">
                        <?php

                        if (isset($this->data["employee"]) and !empty($this->data["employee"])) {
                            foreach ($this->data["employee"] as $this->key => $this->value) {
                                echo ' <option value="' . $this->value["employee_id"] . '">' . $this->value["employee_name"] . '</option>';
                            }
                        } else
                            echo ' <option selected value="">' . _("Please add driver before!") . '</option>';

                        ?>
                    </select>
                </div>
            </div>
            <!-- Company name | Text input-->
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="serial"><?php echo _("Vehicle Serial Number"); ?></label>
                <div class="col-md-5">
                    <input value="<?php echo (isset($this->data["vehicle"][0]["vehicle_serial_number"]) ? $this->data["vehicle"][0]["vehicle_serial_number"] : '') ?>" id="serial" name="serial" type="text" placeholder="Please enter vehicle serial number" class="form-control input-md" required="">

                </div>
            </div>

            <!-- Serial Number | Text input-->
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="plate"><?php echo _("Plate Number "); ?></label>
                <div class="col-md-5">
                    <input value="<?php echo (isset($this->data["vehicle"][0]["vehicle_plate_number"]) ? $this->data["vehicle"][0]["vehicle_plate_number"] : '') ?>" id="plate" name="plate" type="text" placeholder="Please enter plate number of the vehicle" class="form-control input-md" required>

                </div>
            </div>

            <!-- Company statu | Select Basic -->
            <div class="form-group row">

                <label class="col-md-4 col-form-label" for="vehicle"><?php echo _("Vehicle Type"); ?></label>
                <div class="col-md-5">
                    <select id="vehicle" name="vehicle" class="form-control">
                        <?php

                        if (isset($this->data["vehicle"][0]["vehicle_type"])) {
                            if ($this->data["vehicle"][0]["vehicle_type"] == "car") {

                                $vehicle = _("Car");
                                $vehiclecss = "car-side";
                            } elseif ($this->data["vehicle"][0]["vehicle_type"] == "truck") {
                                $vehicle = _("Truck");
                                $vehiclecss = "truck-moving";
                            } else if ($this->data["vehicle"][0]["vehicle_type"] == "bus") {
                                $vehicle = _("Bus");
                                $vehiclecss = "bus";
                            } else if ($this->data["vehicle"][0]["vehicle_type"] == "van") {
                                $vehicle = _("Van");
                                $vehiclecss = "shuttle-van";
                            } else if ($this->data["vehicle"][0]["vehicle_type"] == "pickup") {
                                $vehicle = _("Pickup");
                                $vehiclecss = "truck-pickup";
                            } else if ($this->data["vehicle"][0]["vehicle_type"] == "motorcycle") {
                                $vehicle = _("Motorcycle");
                                $vehiclecss = "motorcycle";
                            }
                        }

                        echo ' <option selected value="' . $this->data["vehicle"][0]["vehicle_type"] . '">' . (isset($vehicle) ? $vehicle : '') . '</option>';
                        ?>

                        <option value="truck"><?php echo _("Truck") ?></option>
                        <option value="car"><?php echo _("Car") ?></option>
                        <option value="bus"><?php echo _("Bus") ?></option>
                        <option value="van"><?php echo _("Van") ?></option>
                        <option value="pickup"><?php echo _("Pickup") ?></option>
                        <option value="motorcycle"><?php echo _("Motorcycle") ?></option>
                        <option value="other"><?php echo _("Other") ?></option>
                    </select>

                </div>
                <div class="col-auto"> <i id="vehicleType" class="fas <?php echo '' . (isset($vehiclecss) ? "fa-" . $vehiclecss : '') . ''; ?> text-primary fa-2x"></i></div>

            </div>





            <!-- Company statu | Select Basic -->
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="statu"><?php echo _("Device statu"); ?></label>
                <div class="col-md-5">
                    <select id="statu" name="statu" class="form-control">
                        <?php echo ' <option selected value="' . (isset($this->data["vehicle"][0]["vehicle_statu"]) ? $this->data["vehicle"][0]["vehicle_statu"] : '') . '">' . (isset($statu) ? $statu : '') . '</option>';     ?>
                        <option value="1"><?php echo _("Active") ?></option>
                        <option value="0"><?php echo _("Inactive") ?></option>
                    </select>
                </div>
            </div>

            <!--  | Button -->
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="submit"></label>
                <div class="col-md-4">
                    <button id="submit" name="submit" class="btn btn-primary"><i class="fas fa-save  "></i> <?php echo _("Save"); ?></button>
                </div>
            </div>

        </form>

    </div>
    <div class="card-footer small text-muted">Updated yesterday at 18:20 PM</div>
</div>

<script>
    $(document).on('change', '#vehicle', function() {
        var value = $(this).val();
        var icon = $("#vehicleType");
        icon = $(icon).removeClass();


        switch (value) {
            case "truck":
                $(icon).attr("class", "fas fa-truck animated bounceInLeft text-primary fa-2x");
                break;
            case "car":
                $(icon).attr("class", "fas fa-car animated bounceInRight text-primary fa-2x");
                break;
            case "bus":
                $(icon).attr("class", "fas fa-bus animated bounceInUp text-primary fa-2x");
                break;
            case "van":
                $(icon).attr("class", "fas fa-bus animated bounceInDown text-primary fa-2x");
                break;
            case "pickup":
                $(icon).attr("class", "fas fa-truck-pickup  animated wobble text-primary fa-2x");
                break;
            case "pickup":
                $(icon).attr("class", "fas fa-truck-pickup  animated slideInLeft text-primary fa-2x");
                break;
            case "motorcycle":
                $(icon).attr("class", "fas fa-motorcycle   animated slideInLeft text-primary fa-2x");
                break;
            default:
            case "pickup":
                $(icon).attr("class", "fas fa-car animated bounceInRight text-primary fa-2x");
                break;
        }
    });
</script>