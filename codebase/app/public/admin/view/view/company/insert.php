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


                case 'name':
                    foreach ($value as $val) {
                        echo '' . $val . '';
                    }
                    break;


                case 'website':
                    foreach ($value as $val) {
                        echo '' . $val . '';
                    }
                    break;
                case 'phone':
                    foreach ($value as $val) {
                        echo '' . $val . '';
                    }
                    break;
                case 'fax':
                    foreach ($value as $val) {
                        echo '' . $val . '';
                    }
                    break;
                case 'gsm':
                    foreach ($value as $val) {
                        echo '' . $val . '';
                    }
                    break;
                case 'address':
                    foreach ($value as $val) {
                        echo '' . $val . '';
                    }
                    break;
                case 'statu':
                    foreach ($value as $val) {
                        echo '' . $val . '';
                    }
                    break;
                case 'email':
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
        <?php echo _("Add A New Company"); ?>
    </div>
    <div class="card-body">
        <form action="<?php echo URL . DS . FOLDER_ADMIN . "/company/add/"; ?>" method="post">

            <!-- Company name | Text input-->
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="name"><?php echo _("Company name "); ?></label>
                <div class="col-md-5">
                    <input id="name" name="name" type="text" placeholder="Please enter the company name" class="form-control input-md" required="">

                </div>
            </div>


            <!-- Company email | Text input-->
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="email"><?php echo _("Company email"); ?></label>
                <div class="col-md-5">
                    <input id="email" name="email" type="text" placeholder="Enter an email" class="form-control input-md" required="">

                </div>
            </div>

            <!-- Company website | Text input-->
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="website"><?php echo _("Company website"); ?></label>
                <div class="col-md-5">
                    <input id="website" name="website" type="text" placeholder="Enter a website" class="form-control input-md" required="">

                </div>
            </div>

            <!-- Company phone number | Text input-->
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="phone"><?php echo _("Company phone number"); ?></label>
                <div class="col-md-5">
                    <input id="phone" name="phone" type="text" placeholder="Enter phone number of the company" class="form-control input-md" required="">

                </div>
            </div>

            <!-- Company fax number | Text input-->
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="fax"><?php echo _("Company fax number"); ?></label>
                <div class="col-md-5">
                    <input id="fax" name="fax" type="text" placeholder="Enter the fax number of the company" class="form-control input-md">

                </div>
            </div>

            <!-- Company GSM number | Text input-->
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="gsm"><?php echo _("Company GSM number"); ?></label>
                <div class="col-md-5">
                    <input aria-describedby="gsmHelpBlock" id="gsm" name="gsm" type="text" placeholder="Enter GSM number of the company" class="form-control input-md">

                </div>
            </div>



            <!-- Company address | Textarea -->
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="address"><?php echo _("Company address"); ?></label>
                <div class="col-md-8">
                    <textarea class="form-control" id="address" name="address"></textarea>
                </div>
            </div>

            <!-- Company statu | Select Basic -->
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="statu"><?php echo _("Company statu"); ?></label>
                <div class="col-md-5">
                    <select id="statu" name="statu" class="form-control">

                        <option selected value="1"><?php echo _("Active") ?></option>
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