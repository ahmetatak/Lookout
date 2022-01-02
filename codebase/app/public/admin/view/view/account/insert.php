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


if (isset($this->data["account"][0]["active"])) {
    if ($this->data["account"][0]["active"] == 0)
        $statu = _("Inactive");
    else   if ($this->data["account"][0]["active"] == 1)
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


                case 'username':
                    foreach ($value as $val) {
                        echo '' . $val . '';
                    }
                    break;

                case 'fullname':
                    foreach ($value as $val) {
                        echo '' . $val . '';
                    }
                    break;
                case 'email':
                    foreach ($value as $val) {
                        echo '' . $val . '';
                    }
                    break;
                case 'rank':
                    foreach ($value as $val) {
                        echo '' . $val . '';
                    }
                    break;
                case 'password':
                    foreach ($value as $val) {
                        echo '' . $val . '';
                    }
                    break;
                case 'active':
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
        <i class="fas fa-user-plus "></i>
        <?php echo _("Add A New Account"); ?>
    </div>
    <div class="card-body">
        <form enctype="multipart/form-data" action="<?php echo URL . DS . FOLDER_ADMIN . "/account/add/" . (isset($this->data["account"][0]["account_id"]) ? $this->data["account"][0]["account_id"] : ''); ?>" method="post">


            <!-- Username |   -->
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="username"><?php echo _("Username "); ?></label>
                <div class="col-md-5">
                    <input maxlength="20" id="username" name="username" type="text" placeholder="Please enter username" class="form-control input-md" required="">

                </div>
                <div class="col-md-2">
                    <div style="  position: relative;
  overflow: hidden;" class="file btn btn btn-primary">
                        <i class="fas fa-upload  "></i> <?php echo _("Upload"); ?></button>
                        <input style="position: absolute;
  font-size: 50px;
  opacity: 0;
  right: 0;
  top: 0;" type="file" name="fileToUpload" id="fileToUpload" />
                    </div>

                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="fullname"><?php echo _("Name & Surname "); ?></label>
                <div class="col-md-5">
                    <input id="fullname" name="fullname" type="text" placeholder="Please enter name and surname" class="form-control input-md" required="">

                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="password"><?php echo _("Password"); ?></label>
                <div class="col-md-5">
                    <input id="password" name="password" type="password" placeholder="Please enter password" class="form-control input-md" required="">

                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="email"><?php echo _("Email "); ?></label>
                <div class="col-md-5">
                    <input id="email" name="email" type="text" placeholder="Please enter email" class="form-control input-md" required="">

                </div>
            </div>
            <!-- Employee position | Select Basic -->
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="rank"><?php echo _("Account Type"); ?></label>
                <div class="col-md-5">
                    <select id="rank" name="rank" class="form-control">

                        <option value="user"><?php echo _("User") ?></option>
                        <option value="editor"><?php echo _("Editor") ?></option>
                        <option value="admin"><?php echo _("Admin") ?></option>
                    </select>
                </div>
            </div>

            <!-- Company statu | Select Basic -->
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="active"><?php echo _("Account Active"); ?></label>
                <div class="col-md-5">
                    <select id="active" name="active" class="form-control">

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