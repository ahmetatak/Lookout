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


if (isset($this->data["employee"][0]["employee_statu"])) {
    if ($this->data["employee"][0]["employee_statu"] == 0)
        $statu = _("Inactive");
    else   if ($this->data["employee"][0]["employee_statu"] == 1)
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


                case 'user':
                    foreach ($value as $val) {
                        echo '' . $val . '';
                    }
                    break;

                case 'company':
                    foreach ($value as $val) {
                        echo '' . $val . '';
                    }
                    break;

                case 'position':
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
        <i class="fas fa-plus "></i>
        <?php echo _("Add A New Employee"); ?>
    </div>
    <div class="card-body">
        <form action="<?php echo URL . DS . FOLDER_ADMIN . "/employee/update/" . (isset($this->data["employee"][0]["employee_id"]) ? $this->data["employee"][0]["employee_id"] : ''); ?>" method="post">

            <!-- Company owner | Select Basic -->
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="user"><?php echo _("Employee "); ?></label>
                <div class="col-md-5">
                    <select id="user" name="user" class="form-control">
                        <?php
                        if (isset($this->data["employee"][0]["account_id"]) and isset($this->data["employee"][0]["account_id"]))
                            echo ' <option selected value="' . $this->data["employee"][0]["account_id"] . '">' . $this->data["employee"][0]["username"] . '</option>';

                        foreach ($this->data["accounts"] as $this->key => $this->value) {

                            echo ' <option value="' . $this->value["account_id"] . '">' . $this->value["username"] . '</option>';
                        }

                        ?>
                    </select>
                </div>
            </div>
            <!-- Company owner | Select Basic -->
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="company"><?php echo _("Company "); ?></label>
                <div class="col-md-5">
                    <select id="company" name="company" class="form-control">

                        <?php


                        foreach ($this->data["com"] as $this->key => $this->value) {
                            if (isset($this->data["employee"][0]["company_id"]) and $this->data["employee"][0]["company_id"] == $this->value["company_id"])
                                echo ' <option selected value="' . $this->value["company_id"] . '">' . $this->value["company_name"] . '</option>';
                            else

                                echo ' <option value="' . $this->value["company_id"] . '">' . $this->value["company_name"] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>


            <!-- Employee position | Select Basic -->
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="position"><?php echo _("Employee position"); ?></label>
                <div class="col-md-5">
                    <select id="position" name="position" class="form-control">
                        <?php



                        if (isset($this->data["employee"][0]["employee_position"])) {
                            $position = "";
                            if ($this->data["employee"][0]["employee_position"] == "ceo")
                                $position = _("Manager (CEO)");
                            else    if ($this->data["employee"][0]["employee_position"] == "driver")
                                $position = _("Driver");
                            else    if ($this->data["employee"][0]["employee_position"] == "worker")
                                $position = _("Worker");

                            echo ' <option selected value="' . $this->data["employee"][0]["employee_position"] . '">' . $position . '</option>';
                        }


                        ?>
                        <option value="ceo"><?php echo _("Manager (CEO)") ?></option>
                        <option value="driver"><?php echo _("Driver") ?></option>
                        <option value="worker"><?php echo _("Worker") ?></option>
                    </select>
                </div>
            </div>

            <!-- Company statu | Select Basic -->
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="statu"><?php echo _("Company statu"); ?></label>
                <div class="col-md-5">
                    <select id="statu" name="statu" class="form-control">
                        <?php echo ' <option selected value="' . (isset($this->data["employee"][0]["employee_statu"]) ? $this->data["employee"][0]["employee_statu"] : '') . '">' . (isset($statu) ? $statu : '') . '</option>';     ?>
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