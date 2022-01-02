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

class Message
{
    public static function error($msj = FALSE, $canclose = FALSE, $title = 'ERROR !')
    {
        if ($canclose == TRUE)
            $canclose = '<button type="button" class="close" onClick="" data-dismiss="alert" aria-hidden="true">&times;</button>';
        return '<div class="alert alert-danger">
         ' . (isset($canclose) ? $canclose : '') . '
     
       <h4> <i class="glyphicon glyphicon-warning-sign"></i>   ' . (isset($title) ? $title : '') . '</h4></br>' . (isset($msj) ? $msj : '') . '</div>';
    }
    public static function info($msj = FALSE, $canclose = FALSE, $title = 'INFO !')
    {
        if ($canclose == TRUE)
            $canclose = '<button type="button" class="close" onClick="" data-dismiss="alert" aria-hidden="true">&times;</button>';
        return '<div class="alert alert-info">
         ' . (isset($canclose) ? $canclose : '') . '
     
       <h4> <i class="glyphicon glyphicon-info-sign"></i>   ' . (isset($title) ? $title : '') . '</h4></br>' . (isset($msj) ? $msj : '') . '</div>';
    }
    public static function warning($msj = FALSE, $canclose = FALSE, $title = 'WARNING !')
    {
        if ($canclose == TRUE)
            $canclose = '<button type="button" class="close" onClick="" data-dismiss="alert" aria-hidden="true">&times;</button>';
        return '<div class="alert alert-warning">
         ' . (isset($canclose) ? $canclose : '') . '
     
       <h4> <i class="glyphicon glyphicon-warning-sign"></i>   ' . (isset($title) ? $title : '') . '</h4></br>' . (isset($msj) ? $msj : '') . '</div>';
    }
    public static function success($msj = FALSE, $canclose = FALSE, $title = 'OK !')
    {
        if ($canclose == TRUE)
            $canclose = '<button type="button" class="close" onClick="" data-dismiss="alert" aria-hidden="true">&times;</button>';
        return '<div class="alert alert-success">
         ' . (isset($canclose) ? $canclose : '') . '
     
       <h4> <i class="glyphicon glyphicon-ok"></i>   ' . (isset($title) ? $title : '') . '</h4></br>' . (isset($msj) ? $msj : '') . '</div>';
    }
}
