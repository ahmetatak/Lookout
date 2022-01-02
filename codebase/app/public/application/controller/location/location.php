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

class ControllerLocationLocation extends Controller
{
    private $device_Identitiy;
    private $device_id;
    private $device_statu;
    private $vehicle_id;
    private $vehicle_statu;
    private $lat;
    private $lon;


    public function __construct()
    {
        parent::__construct();
    }


    public function index($i = "")
    {
        $this->api(TRUE, TRUE, TRUE);
        // $this->Response->success("merhaba");
        // $this->model= $this->call->model("product");
        die("si");
        if ($this->serviceName == "lastLocation") {
            $this->form->param("latitude", $this->getParam("lat"))
                ->isEmpty()
                ->length(1, 100);
            $this->form->param("longitude", $this->getParam("lon"))
                ->isEmpty()
                ->length(1, 100);
            $this->form->param("device_Identitiy", $this->getParam("device_Identitiy"))
                ->isEmpty()
                ->length(1, 1000);

            if (!$this->form->submit() == TRUE) {

                $this->data["error"] = $this->form->errors;
                $this->print->init(false, "ErrorList", $this->data["error"]);
            } else {
                $this->lat = $this->form->values['latitude'];
                $this->lon = $this->form->values['longitude'];
                $this->device_Identitiy = $this->form->values['device_Identitiy'];
                $this->model["device"] = $this->call->model("device");
                $this->return = $this->model["device"]->searchDevice(array("id" => $this->device_Identitiy));
                if (!$this->return)
                    $this->print->init(false, "ErrorDeviceIdentity", _("device identitiy not found in our database"));
                else {
                    foreach ($this->return as $key => $v) {
                        if (isset($v[$this->model["device"]->device_statu]) && !empty(isset($v[$this->model["device"]->device_statu])))
                            $this->device_statu = $v[$this->model["device"]->device_statu];
                        else
                            $this->print->init(false, "ErrorDeviceStatu", _("device is not exist"));
                        if (isset($v[$this->model["device"]->device_id]) && !empty(isset($v[$this->model["device"]->device_id])))
                            $this->device_id = $v[$this->model["device"]->device_id];
                        else
                            $this->print->init(false, "ErrorDeviceStatu", _("device identity not exist"));


                        if (isset($v[$this->model["device"]->device_vehicle_id]) && !empty(isset($v[$this->model["device"]->device_vehicle_id])))
                            $this->vehicle_id = $v[$this->model["device"]->device_vehicle_id];
                        else
                            $this->print->init(false, "ErrorDeviceVehicleId", _("vehicle identity not exist"));
                    }
                    if (!$this->device_statu)
                        $this->print->init(false, "ErrorDeviceInactive", _("device is not active in our database"));
                    else {
                        if (!$this->vehicle_id)
                            $this->print->init(false, "ErrorDeviceVehicleIdentity", _("device identity not found"));
                        else {
                            $this->model["vehicle"] = $this->call->model("vehicle");
                            $this->return = $this->model["vehicle"]->getVehicle(array("id" => $this->vehicle_id));
                            if (!$this->return)
                                $this->print->init(false, "ErrorVehicleNotExist", _("Vehicle is not exist"));
                            else {
                                foreach ($this->return as $key => $v) {
                                    if (isset($v[$this->model["vehicle"]->vehicle_statu]) && !empty(isset($v[$this->model["vehicle"]->vehicle_statu])))
                                        $this->vehicle_statu = $v[$this->model["vehicle"]->vehicle_statu];
                                    else
                                        $this->print->init(false, "ErrorVehicleStatuNotExist", _("vehicle is not exist"));
                                    if (isset($v[$this->model["vehicle"]->vehicle_id]) && !empty(isset($v[$this->model["vehicle"]->vehicle_id])))
                                        $this->vehicle_id = $v[$this->model["vehicle"]->vehicle_id];
                                    else
                                        $this->print->init(false, "ErrorVehicleIdNotExist", _("vehicle is not exist"));
                                }
                                if (!$this->vehicle_statu)
                                    $this->print->init(false, "ErrorVehicleInactive", _("vehicle is not active in our database"));
                                else {
                                    $this->model["location"] = $this->call->model("location");
                                    $this->model["location"]->setLat($this->lat);
                                    $this->model["location"]->setLon($this->lon);
                                    $this->model["location"]->setTime(Time::get());
                                    $this->model["location"]->setVehicleId($this->vehicle_id);

                                    $this->return = $this->model["location"]->insert();
                                    if ($this->return)
                                        $this->print->init(TRUE, "LocationInsertSuccess", _("added new location"));
                                }
                            }
                        }
                    }
                }
            }
        }
        //return $this->call->view("home/index","Title", $this->data,"default");
    }

    public function fresh($i = "")
    {
        $this->controller_validation(TRUE, TRUE, FALSE);
        // $this->Response->success("merhaba");
        // $this->model= $this->call->model("product");

        if ($this->serviceName == "refleshtoken") {
            $this->form->param("token", $this->getParam("token"))
                ->isEmpty();


            if (!$this->form->submit() == TRUE) {

                $this->data["error"] = $this->form->errors;
                $this->print->init(false, "ErrorList", $this->data["error"]);
            } else {
                $this->total = $this->form->values['token'];

                $this->print->init(TRUE, "new token", Access::refresh($this->total));
            }
        }
        //return $this->call->view("home/index","Title", $this->data,"default");
    }
}
