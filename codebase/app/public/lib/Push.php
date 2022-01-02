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
class Push
{
    private $user;
    private $title;
    private $from;
    private $message;
    private $time;
    private $sound;
    private $vibrate;
    private $conversation;

    private $from_id;
    private $to;




    public function sendit($arr = array())
    {
        $this->user         = $arr[0]["who"];
        $this->title        = $arr[0]["title"];
        $this->conversation = $arr[0]["conversation"];
        $this->from         = $arr[0]["from"];
        $this->from_id      = $arr[0]["from_id"];
        $this->to           = $arr[0]["to"];
        $this->message      = $arr[0]["message"];
        $this->time         = $arr[0]["time"];
        $this->sound        = $arr[0]["sound"];
        $this->vibrate      = $arr[0]["vibrate"];




        $large_icon = '';
        $small_icon = '';
        // API access key from Google API's Console
        define('API_ACCESS_KEY', 'xxxxx');
        $registrationIds = array($this->user);
        // prep the bundle
        $msg = array(
            'message'     => $this->message,
            'title'        => $this->title,
            'subtitle'    => $this->from,
            'conversation'    => $this->conversation,
            'fromuser'      => $this->from,
            'from_id'    => $this->from_id,
            "to"            => $this->to,
            "time"          => $this->time,
            'tickerText'    => $this->time,
            'vibrate'    => $this->vibrate,
            'sound'        => $this->sound,
            'largeIcon'    => 'large_icon',
            'smallIcon'    => 'small_icon'
        );
        $fields = array(
            'registration_ids'     => $registrationIds,
            'data'            => $msg
        );

        $headers = array(
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: api/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}
