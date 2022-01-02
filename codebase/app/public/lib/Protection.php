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
class Protection
{
    private $formKey;

    //Here we store the old form key (more info at step 4)
    private $old_formKey;
    private function generateKey()
    {
        //Get the IP-address of the user
        $ip = $_SERVER['REMOTE_ADDR'];

        //We use mt_rand() instead of rand() because it is better for generating random numbers.
        //We use 'true' to get a longer string.
        //See http://www.php.net/mt_rand for a precise description of the function and more examples.
        $uniqid = uniqid(mt_rand(), true);

        //Return the hash
        return md5($ip . $uniqid);
    }
    public  function getKey()
    {
        //Generate the key and store it inside the class
        $pro = new Protection();
        $this->formKey = $pro->generateKey();
        //Store the form key in the session

        Session::set(SESSION_FORM_KEY, $this->formKey);

        //Output the form key
        return  $this->formKey;
    }
    public static function checkKey($post = false)
    {
        //Validate the form key
        if (!isset($post) || !$this->validate()) {
            //Form key is invalid, show an error
            return false;
        } else {
            return true;
        }
    }

    public function validate($post = false)
    {
        //We use the old formKey and not the new generated version
        if ($post == $this->old_formKey) {
            //The key is valid, return true.
            return true;
        } else {
            //The key is invalid, return false.
            return false;
        }
    }
    public   function timeout()
    {
        if (Session::get(MEMBER_SESSION_LOGIN) == TRUE) {
            if (Session::get('timeout') == FALSE)
                Session::set('timeout', time());
            if (Session::get('timeout') + 15 * 60 < time()) {
                session_destroy();
                Session::set('timeout', time());
                die('<META HTTP-EQUIV="REFRESH" CONTENT="3;URL=' . URL . '"><center>10 dk icinde hiç bir işlem yapmadığınız için çıkış işlemi gerçekleşti<br> lütfen bekleyiniz...</center> ');
            } else {
                Session::set('timeout', time());
            }
        }
    }
    public static function SqlInject($mVar = "")
    {

        if (is_array($mVar)) {

            foreach ($mVar as $gVal => $gVar) {

                if (!is_array($gVar)) {

                    $mVar[$gVal] = htmlspecialchars(strip_tags(urldecode(addslashes(stripslashes(stripslashes(trim(htmlspecialchars_decode($gVar))))))));  // -> Dizi olmadığını fark edip temizledik.

                } else {

                    $mVar[$gVal] = clearMethod($gVar);
                }
            }
        } else {

            $mVar = htmlspecialchars(strip_tags(urldecode(addslashes(stripslashes(stripslashes(trim(htmlspecialchars_decode($mVar)))))))); // -> Dizi olmadığını fark edip temizledik.

        }
        $mVar = str_replace("\r\n", '', $mVar);
        return $mVar;
    }
    public function isInt($id = 0)
    {
        if (!is_numeric($id) or mb_substr($id, 0, 1, "UTF-8") == 0)
            return false;
        else
            return true;
    }

    public static function sefurl($s)
    {
        $s = trim($s);
        $tr = array('ş', 'Ş', 'ı', 'I', 'İ', 'ğ', 'Ğ', 'ü', 'Ü', 'ö', 'Ö', 'Ç', 'ç', '(', ')', '/', ':', ',');

        $eng = array('s', 's', 'i', 'i', 'i', 'g', 'g', 'u', 'u', 'o', 'o', 'c', 'c', '', '', '-', '-', '');

        $s = str_replace($tr, $eng, $s);



        $s = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s);

        $s = preg_replace('/\s+/', '-', $s);

        $s = preg_replace('|-+|', '-', $s);

        $s = preg_replace('/#/', '', $s);

        $s = str_replace('.', '.', $s);

        $s = trim($s, '-');

        $s = htmlspecialchars(strip_tags(urldecode(addslashes(stripslashes(stripslashes(trim(htmlspecialchars_decode($s))))))));

        return $s;
    }

    public static function ip()
    {
        if (getenv("HTTP_CLIENT_IP")) {
            $ip = getenv("HTTP_CLIENT_IP");
        } elseif (getenv("HTTP_X_FORWARDED_FOR")) {
            $ip = getenv("HTTP_X_FORWARDED_FOR");
            if (strstr($ip, ',')) {
                $tmp = explode(',', $ip);
                $ip = trim($tmp[0]);
            }
        } else {
            $ip = getenv("REMOTE_ADDR");
        }
        return $ip;
    }
    public function rename_array_key($oldkey, $newkey, array &$arr)
    {
        foreach ($arr as &$val) {
            $val[$newkey] = $val[$oldkey];
            unset($val[$oldkey]);
        }
        return $arr;
    }

    public function rename(&$array, $old_keys, $new_keys)
    {
        if (!is_array($array)) {
            ($array == "") ? $array = array() : false;
            return $array;
        }
        foreach ($array as &$arr) {
            if (is_array($old_keys)) {
                foreach ($new_keys as $k => $new_key) {
                    (isset($old_keys[$k])) ? true : $old_keys[$k] = NULL;
                    $arr[$new_key] = (isset($arr[$old_keys[$k]]) ? $arr[$old_keys[$k]] : null);
                    unset($arr[$old_keys[$k]]);
                }
            } else {
                $arr[$new_keys] = (isset($arr[$old_keys]) ? $arr[$old_keys] : null);
                unset($arr[$old_keys]);
            }
        }
        return $array;
    }

    public static function img($img = '')
    {
        if (substr($img, 0, 7) == "http://" or substr($img, 0, 8) == "https://" or substr($img, 0, 4) == "www.") {
            if (@file_get_contents($img, 0, NULL, 0, 1)) {
                $img = $img;
            } else  $url = URL . DS . "content/img/64x64.png";
        } else {
            $img = Protection::imgexits($img);
            $img = URL . "/" . $img;
        }
        return $img;
    }
    public static function imgexits($img)
    {

        $url = $img;
        if (!empty($url) and file_exists(ROOT . DS . $url))
            return $url;
        else $url = "content/img/64x64.png";
        return $url;
    }
    public static function captcha($c = array())
    {

        Session::set(SECURITY_CAPTCHA_TIME, time());
        $kod = substr(md5(rand(0, 999999)), 0, 6);
        if (isset($c["font"]) and file_exists(ROOT . DS . "content/captcha/fonts/" . $c["font"])) {
            $font = ROOT . DS . "content/captcha/fonts/" . $c["font"];
        } else
            $font = ROOT . DS . "content/captcha/fonts/captcha.ttf";



        if (isset($c["height"]) and ctype_digit($c["height"]) and $c["height"] < 500 and isset($c["width"]) and ctype_digit($c["width"]) and $c["width"] < 500) {
            $img = imagecreate($c["width"], $c["height"]);
        } else
            $img = imagecreate(250, 65);
        if (isset($c["font_color"])) {
            $x = explode(',', trim($c["font_color"]));
            if (isset($x[0]) and isset($x[1]) and isset($x[2]) and ctype_digit($x[0])  and ctype_digit($x[1]) and ctype_digit($x[2])) {
                $beyaz = ImageColorAllocate($img, $x[0], $x[1], $x[2]);
            }
        } else
            $beyaz = ImageColorAllocate($img, rand(0, 255), rand(0, 255), rand(0, 255));

        if (isset($c["background_color"])) {
            $x = explode(',', trim($c["background_color"]));
            if (isset($x[0]) and isset($x[1]) and isset($x[2]) and ctype_digit($x[0])  and ctype_digit($x[1]) and ctype_digit($x[2])) {
                $mavi = ImageColorAllocate($img, $x[0], $x[1], $x[2]);
            } elseif ($c["background_color"] == "transparent") {
                imagesavealpha($img, true);
                $mavi = imagecolorallocatealpha($img, 0, 0, 0, 127);
            } else {
                $mavi = ImageColorAllocate($img, 250, 250, 250);
            }
        } else
            $mavi = ImageColorAllocate($img, 250, 250, 250);
        //imagefill($rsm,4,5,$mavi);
        //imagettftext($rsm,15,rand(-15,15),20,40,$beyaz,$font,$kod);


        imagefill($img, 4, 5, $mavi);
        imagettftext($img, 25, rand(-5, 5), 20, 40, $beyaz, $font, $kod);
        // Draw text

        Session::set(SECURITY_SESSION_CAPTCHA, false);

        Session::set(SECURITY_SESSION_CAPTCHA, $kod);





        ob_start(); // Let's start output buffering.
        imagepng($img); //This will normally output the image, but because of ob_start(), it won't.
        $contents = ob_get_contents(); //Instead, output above is saved to $contents
        ob_end_clean(); //End the output buffer.

        $dataUri = "data:image/png;base64," . base64_encode($contents);
        return $dataUri;
    }
}
