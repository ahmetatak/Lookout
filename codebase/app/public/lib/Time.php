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
class Time
{
    public function getTime($format = FALSE)
    {
        if ($format == FALSE)
            return date(time());
        else
            return date($format, time());
    }
    private function MonthConvert($ay)
    {
        if ($ay == "01")
            $ay = "Ocak";
        elseif ($ay == "02")
            $ay = "Şubat";
        else
     if ($ay == "03")
            $ay = "Mart";
        else
     if ($ay == "04")
            $ay = "Nisan";
        else
     if ($ay == "05")
            $ay = "Mayıs";
        else
      if ($ay == "06")
            $ay = "Haziran";
        else
      if ($ay == "07")
            $ay = "Temmuz";
        else
      if ($ay == "08")
            $ay = "Ağustos";
        else
      if ($ay == "09")
            $ay = "Eylül";
        else
      if ($ay == "10")
            $ay = "Ekim";
        else
      if ($ay == "11")
            $ay = "Kasım";
        else
      if ($ay == "12")
            $ay = "Aralık";

        return $ay;
    }

    public static function get($time = false, $print = false)
    {
        if ($time and $print) {
            //default format 'm/d/Y H:i:s'

            $time = date($print, $time);

            return $time;
        } else return date(time());
    }
}
