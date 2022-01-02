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
        <form action="<?php echo URL . DS . FOLDER_ADMIN . "/employee/add/"; ?>" method="post">

            <!-- Company owner | Select Basic -->
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="user"><?php echo _("Employee "); ?></label>
                <div class="col-md-5">
                    <input id="usertype" name="usertype" type="text" placeholder="Please enter a username" class="form-control input-md" required="">
                    <input hidden id="user" name="user" type="text" placeholder="Please enter a username" class="form-control input-md" required="">
                    <div id="display" class="dropdown-menu col-md-12">

                    </div>
                </div>
                <div class="col-md-12"></div>
            </div>
            <!-- Company | Select Basic -->
            <div class="form-group row">
                <label class="col-md-4 col-form-label" for="company"><?php echo _("Company "); ?></label>
                <div class="col-md-5">
                    <select id="company" name="company" class="form-control">

                        <?php


                        foreach ($this->data["com"] as $this->key => $this->value) {


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

                        <option selected value="ceo"><?php echo _("Manager (CEO)") ?></option>
                        <option value="driver"><?php echo _("Driver") ?></option>
                        <option value="manager"><?php echo _("Worker") ?></option>
                    </select>
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
<script>
    $(document).ready(function() {
        function clickable() {
            $(".listAccount").click(function() {
                var id = $(this).prop('id')
                var fullname = $(this).attr('fullname')

                $("#usertype").val(fullname);
                $("#user").val(id);
                $('#display').removeClass('show').addClass('hide');
            });
        }
        //On pressing a key on "Search box" in "search.php" file. This function will be called.

        $("#usertype").keyup(function() {

            //Assigning search box value to javascript variable named as "name".

            var name = $('#usertype').val();

            //Validating, if "name" is empty.

            if (name == "") {

                //Assigning empty value to "display" div in "search.php" file.

                $('#display').removeClass('show').addClass('hide');
                $("#display").html("");

            }

            //If name is not empty.
            else {

                //AJAX is called.

                $.ajax({

                    //AJAX type is "Post".

                    type: "POST",

                    //Data will be sent to "ajax.php".

                    url: "<?php echo URL . DS . FOLDER_ADMIN . "/employee/list/" ?>" + name,

                    //Data, that will be sent to "ajax.php".

                    data: {

                        //Assigning value of "name" into "search" variable.

                        username: name

                    },

                    //If result found, this funtion will be called.

                    success: function(html) {

                        //Assigning result to "display" div in "search.php" file.
                        var ii = "<?php echo URL . DS . FOLDER_ADMIN . "/employee/list/" ?>" + name;
                        $('#display').html(html);
                        clickable();
                        $('#display').removeClass('hide').addClass('show');

                    }

                });

            }

        });


        $(function() {
            $('#formAddAccount').on('submit', function(e) {
                var $form = $('#formAddAccount');
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: $form.attr('action'),
                    data: $form.serialize(),
                    success: function(response) {
                        console.log(response);

                        $("#ajaxResponse").html(response);

                    },
                    error: function() {
                        alert('Error');
                    }
                });
                return false;
            });
        });
    });
</script>
<!-- Modal -->
<div class="modal fade" id="addAccount" tabindex="-1" role="dialog" aria-labelledby="addAccount" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo _("Add A New Account"); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="ajaxResponse">

                </div>
                <form id="formAddAccount" method="post" class="form-signin" action="<?php echo URL . DS . FOLDER_ADMIN . "/employee/account/add" ?>">
                    <label for="username" class="sr-only"><?php echo _("Username"); ?></label>
                    <input maxlength="20" value="<?php echo (isset($this->data["form"]["username"]) ? $this->data["form"]["username"] : ''); ?>" name="username" type="text" id="username" class="form-control" placeholder="<?php echo _("Username"); ?>" required autofocus>
                    <label for="fullname" class="sr-only"><?php echo _("Name and surname"); ?></label>
                    <input value="<?php echo (isset($this->data["form"]["fullname"]) ? $this->data["form"]["fullname"] : ''); ?>" name="fullname" type="text" id="fullname" class="form-control" placeholder="<?php echo _("Name And Surname"); ?>" required autofocus>
                    <label for="email" class="sr-only"><?php echo _("Email address"); ?></label>
                    <input value="<?php echo (isset($this->data["form"]["email"]) ? $this->data["form"]["email"] : ''); ?>" name="email" type="text" id="email" class="form-control" placeholder="<?php echo _("Email address"); ?>" required>
                    <label for="password" class="sr-only"><?php echo _("Email address"); ?></label>
                    <input value="<?php echo (isset($this->data["form"]["password"]) ? $this->data["form"]["password"] : ''); ?>" name="password" type="password" id="password" class="form-control" placeholder="<?php echo _("Password"); ?>" required>


                    <div class="row">
                        <!-- Account  statu | Select Basic -->
                        <div class="col-md-12">
                            <select id="statu" name="statu" class="form-control">
                                <option selected value=""><?php echo _("Account Statu") ?></option>
                                <option value="1"><?php echo _("Active") ?></option>
                                <option value="0"><?php echo _("Inactive") ?></option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <select id="rank" name="rank" class="form-control">
                                <option selected value=""><?php echo _("Account Position") ?></option>
                                <option value="user"><?php echo _("User") ?></option>
                                <option value="admin"><?php echo _("Admin") ?></option>

                            </select>
                        </div>


                    </div>
                    <button class="btn btn-lg btn-danger btn-block" type="submit"><?php echo _("Sign up"); ?> <i class="fas  fa-sign-in-alt "></i></button>

                    <div style="color:white;margin-top: 30px; text-align: center;" class=" col-md-12"><label>

                        </label></div>

                </form>
            </div>

        </div>
    </div>
</div>