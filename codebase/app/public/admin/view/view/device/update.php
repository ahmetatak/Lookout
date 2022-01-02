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

if (isset($this->data["device"][0]["device_statu"])) {
    if ($this->data["device"][0]["device_statu"] == 0)
        $statu = _("Inactive");
    else   if ($this->data["device"][0]["device_statu"] == 1)
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


                case 'key':
                    foreach ($value as $val) {
                        echo '' . $val . '';
                    }
                    break;

                case 'serial':
                    foreach ($value as $val) {
                        echo '' . $val . '';
                    }
                    break;

                case 'os':
                    foreach ($value as $val) {
                        echo '' . $val . '';
                    }
                    break;
                case 'owner':
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
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-edit "></i>
        <?php echo _("Update The Device"); ?>
    </div>
    <div class="card-body">
        <form action="<?php echo URL . DS . FOLDER_ADMIN . "/device/update/" . (isset($this->data["device"][0]["device_id"]) ? $this->data["device"][0]["device_id"] : ''); ?>" method="post">

            <!-- Company name | Text input-->
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="key"><?php echo _("Device Access Key "); ?></label>
                <div class="col-md-5">
                    <input value="<?php echo (isset($this->data["device"][0]["device_access_key"]) ? $this->data["device"][0]["device_access_key"] : '') ?>" id="key" name="key" type="text" placeholder="Please enter the a valid access Key" class="form-control input-md" required="">

                </div>
            </div>

            <!-- Serial Number | Text input-->
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="serial"><?php echo _("Serial Number "); ?></label>
                <div class="col-md-5">
                    <input value="<?php echo (isset($this->data["device"][0]["device_serial_number"]) ? $this->data["device"][0]["device_serial_number"] : '') ?>" id="serial" name="serial" type="text" placeholder="Please enter serial number of the device" class="form-control input-md" required="">

                </div>
            </div>


            <!-- Company owner | Select Basic -->
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="owner"><?php echo _("Vehicle"); ?></label>
                <div class="col-md-5">
                    <select id="owner" name="owner" class="form-control">
                        <?php foreach ($this->data["vehicles"] as $this->key => $this->value) {
                            if (isset($this->data["device"][0]["vehicle_id"]) and $this->data["device"][0]["vehicle_id"] == $this->value["vehicle_id"]) {
                                echo ' <option selected value="' . $this->value["vehicle_id"] . '">' . $this->value["vehicle_plate_number"] . '</option>';
                            } else {
                                echo ' <option value="' . $this->value["vehicle_id"] . '">' . $this->value["vehicle_plate_number"] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>








            <!-- Device version | Select Basic -->
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="os"><?php echo _("Device OS Version"); ?></label>
                <div class="col-md-5">
                    <select id="os" name="os" class="form-control">

                        <option selected value="V 1.0.1"><?php echo _("V 1.0.1") ?></option>

                    </select>
                </div>
            </div>
            <!-- Company statu | Select Basic -->
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="statu"><?php echo _("Device statu"); ?></label>
                <div class="col-md-5">
                    <select id="statu" name="statu" class="form-control">
                        <?php echo ' <option selected value="' . (isset($this->data["device"][0]["device_statu"]) ? $this->data["device"][0]["device_statu"] : '') . '">' . (isset($statu) ? $statu : '') . '</option>';     ?>
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

<?php

?>