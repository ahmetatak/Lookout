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
class Layout  extends Controller
{
    private $layout;
    private $view;
    private $title;
    private $key;
    private $value;
    private $css;
    private $js;
    private $template_path;
    public function setTitle($title = "")
    {
        $this->title = $title;
    }
    public function setView($view = "")
    {
        $this->view = $view;
    }
    public function setData(array $data = array())
    {
        $this->data = $data;
    }


    public function setLayout($layout)
    {
        $this->layout = $layout;
    }


    public function build()
    {

        $this->Render();
        if (!file_exists($this->layout))
            $this->print->init(false, "LayoutNotExist", _("Layout file could not be found!"));
        else
            require $this->layout;
    }

    public function Render()
    {
        (defined("DIR_TEMPLATE") ? true : $this->error("ConfigrationFail", _("Template path could not be found")));



        if (!file_exists(PATH_VIEW . "/config.php"))
            $this->print->init(false, "ConfigFileNotExist", _("Configration file is not exist for the template"));
        else {
            $this->template_path = PATH_VIEW;
            require_once PATH_VIEW . "/config.php";
        }

        (defined("PATH_TEMPLATE_VIEW") ? true : $this->error("ViewPathNotExist", _("View path could not be found in configration")));
        (defined("PATH_TEMPLATE_LAYOUT") ? true : $this->error("LayoutPathNotExist", _("Layout path could not be found in configration")));
        $this->layout = PATH_VIEW . DS . PATH_TEMPLATE_LAYOUT . $this->layout . ".php";
        $this->view = PATH_VIEW . DS . PATH_TEMPLATE_VIEW . $this->view . ".php";

        if (!file_exists($this->view))
            $this->print->init(false, "ViewNotExist", _("View file could not be found!"));
        else
            $this->loadView();
    }

    private    function loadView()
    {

        ob_start();
        require($this->view);
        $this->view = ob_get_contents();
        ob_end_clean();
        return $this->view;
    }

    protected function loadCSS($file = array())
    {

        $content = "";
        foreach ($file as $css) {
            if (empty($content))
                $content = "\n" . '<link rel="stylesheet" type="text/css" href="' . URL . DS . $css . '.css">' . "";
            else
                $content = $content . "\n" . '<link rel="stylesheet" type="text/css" href="' . URL . DS . $css . '.css">';
        }
        $this->css = $content;
    }
    protected function loadJS($file = array())
    {


        $content = "";
        foreach ($file as $js) {
            $url = "";
            if (substr($js, 0, 7) == "http://" or substr($js, 0, 8) == "https://" or substr($js, 0, 4) == "www.") {
            } else {
                $js = URL . DS . $js . ".js";
            }
            if (empty($content))
                $content = "\n" . ' <script src="' . $js . '" type="text/javascript" language="JavaScript"> </script>' . "";
            else
                $content = $content . ' <script src="' . $js . '" type="text/javascript" language="JavaScript"> </script>' . "\n";
        }
        $this->js = $content;
    }
}
