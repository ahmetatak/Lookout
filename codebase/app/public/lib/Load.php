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
class Load extends Response
{

    public static $css = array();
    public static $js = array();
    private $view;
    private $layout;
    private $data;
    private $title;
    private $model;
    private $path;


    public function model($model = "")
    {

        if (substr($model, 0, 6) === 'admin/') {

            $path = ROOT . DS . FOLDER_ADMIN . DS . "model" . DS . substr($model, 6) . '.php';
        } else
            $path = PATH_MODEL . $model . '.php';

        if ($model) {
            if (file_exists($path)) {

                require_once  $path;
                $model = str_replace('/', '', $model);
                $model = CLASS_MODEL . $model;
                if (class_exists($model)) {
                    return new $model();
                } else die('model class name is not true   !' . $model);
            } else
                return $this->error("ModelFileNotExist", _("Model file is not exist"));
        } else return $this->error("ModelName", _("Model name is not true!"));
    }
    public function view($view = "", $title = "", $data = array(), $layout = "")
    {
        $this->layout = $layout;
        $this->title = $title;
        $this->data = $data;
        $this->view = $view;
        $layout = new Layout();
        $layout->setLayout($this->layout);
        $layout->setView($this->view);
        $layout->setTitle($this->title);
        $layout->setData($this->data);
        return $layout->build();
    }
    public static function captcha()
    {
    }
}
