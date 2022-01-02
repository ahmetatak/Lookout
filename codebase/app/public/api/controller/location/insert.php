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

class ControllerApiLocationInsert extends Controller
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

        if ($this->serviceName == "lastLocation") {
            $this->form->param("latitude", $this->getParam("lat"))
                ->isEmpty()
                ->isDouble()
                ->length(1, 100);
            $this->form->param("longitude", $this->getParam("lon"))
                ->isEmpty()
                ->isDouble()
                ->length(1, 100);
            $this->form->param("device_Identity", $this->getParam("device_Identity"))
                ->isEmpty()
                ->length(1, 1000);

            if (!$this->form->submit() == TRUE) {

                $this->data["error"] = $this->form->errors;
                $this->print->init(false, "ErrorList", $this->data["error"]);
            } else {

                $this->lat = $this->form->values['latitude'];
                $this->lon = $this->form->values['longitude'];
                $this->device_Identitiy = $this->form->values['device_Identity'];
                $this->model["device"] = $this->call->model("location/insert");
                $this->return = $this->model["device"]->searchDevice(array("id" => $this->device_Identitiy));
                if (!$this->return)
                    $this->print->init(false, "ErrorDeviceIdentity", _("device identitiy not found in our database"));
                else {
                    foreach ($this->return as $key => $v) {
                        if (isset($v["device_statu"]) && !empty(isset($v["device_statu"])))
                            $this->device_statu = $v["device_statu"];
                        else
                            $this->print->init(false, "ErrorDeviceStatu", _("device is not exist"));
                        if (isset($v["device_id"]) && !empty(isset($v["device_id"])))
                            $this->device_id = $v["device_id"];
                        else
                            $this->print->init(false, "ErrorDeviceStatu", _("device identity not exist"));


                        if (isset($v["vehicle_id"]) && !empty(isset($v["vehicle_id"])))
                            $this->vehicle_id = $v["vehicle_id"];
                        else
                            $this->print->init(false, "ErrorDeviceVehicleId", _("vehicle identity not exist"));
                    }
                    if (!$this->device_statu)
                        $this->print->init(false, "ErrorDeviceInactive", _("device is not active in our database"));
                    else {
                        if (!$this->vehicle_id)
                            $this->print->init(false, "ErrorDeviceVehicleIdentity", _("device identity not found"));
                        else {
                            $this->model["vehicle"] = $this->call->model("location/vehicle");
                            $this->return = $this->model["vehicle"]->getVehicle(array("id" => $this->vehicle_id));
                            if (!$this->return)
                                $this->print->init(false, "ErrorVehicleNotExist", _("Vehicle is not exist"));
                            else {
                                foreach ($this->return as $key => $v) {
                                    if (isset($v["vehicle_statu"]) && !empty(isset($v["vehicle_statu"])))
                                        $this->vehicle_statu = $v["vehicle_statu"];
                                    else
                                        $this->print->init(false, "ErrorVehicleStatuNotExist", _("vehicle is not exist"));
                                    if (isset($v["vehicle_id"]) && !empty(isset($v["vehicle_id"])))
                                        $this->vehicle_id = $v["vehicle_id"];
                                    else
                                        $this->print->init(false, "ErrorVehicleIdNotExist", _("vehicle is not exist"));
                                }
                                if (!$this->vehicle_statu)
                                    $this->print->init(false, "ErrorVehicleInactive", _("vehicle is not active in our database"));
                                else {
                                    $this->model["location"] = $this->call->model("location/insert");
                                    $this->model["location"]->setLat($this->lat);
                                    $this->model["location"]->setLon($this->lon);
                                    $this->model["location"]->setTime(Time::get());
                                    $this->model["location"]->setVehicleId($this->vehicle_id);
                                    $this->return = $this->model["location"]->getLastLocation(array("id" => $this->vehicle_id));

                                    if ($this->return) {
                                        $meters = $this->calculate($this->return[0]["location_lat"], $this->return[0]["location_lon"], $this->lat, $this->lon, "MT", true, 3);
                                        if ($meters <= 10)
                                            $this->print->init(FALSE, "LocationSoClosed", _("it is closed so we did not insert the new location"));
                                        else {
                                        }
                                        $this->return = $this->model["location"]->insert();
                                        $this->print->init(TRUE, "LocationInsertSuccess", _("added new location"));
                                    } else
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

    private function calculate($latitudeOne = '', $longitudeOne = '', $latitudeTwo = '', $longitudeTwo = '', $distanceUnit = '', $round = false, $decimalPoints = '')
    {
        if (empty($decimalPoints)) {
            $decimalPoints = '3';
        }
        if (empty($distanceUnit)) {
            $distanceUnit = 'KM';
        }
        $distanceUnit = strtolower($distanceUnit);
        $pointDifference = $longitudeOne - $longitudeTwo;
        $toSin = (sin(deg2rad($latitudeOne)) * sin(deg2rad($latitudeTwo))) + (cos(deg2rad($latitudeOne)) * cos(deg2rad($latitudeTwo)) * cos(deg2rad($pointDifference)));
        $toAcos = acos($toSin);
        $toRad2Deg = rad2deg($toAcos);

        $toMiles  =  $toRad2Deg * 60 * 1.1515;
        $toKilometers = $toMiles * 1.609344;
        $toNauticalMiles = $toMiles * 0.8684;
        $toMeters = $toKilometers * 1000;
        $toFeets = $toMiles * 5280;
        $toYards = $toFeets / 3;


        switch (strtoupper($distanceUnit)) {
            case 'ML': //miles
                $toMiles  = ($round == true ? round($toMiles) : round($toMiles, $decimalPoints));
                return $toMiles;
                break;
            case 'KM': //Kilometers
                $toKilometers  = ($round == true ? round($toKilometers) : round($toKilometers, $decimalPoints));
                return $toKilometers;
                break;
            case 'MT': //Meters
                $toMeters  = ($round == true ? round($toMeters) : round($toMeters, $decimalPoints));
                return $toMeters;
                break;
            case 'FT': //feets
                $toFeets  = ($round == true ? round($toFeets) : round($toFeets, $decimalPoints));
                return $toFeets;
                break;
            case 'YD': //yards
                $toYards  = ($round == true ? round($toYards) : round($toYards, $decimalPoints));
                return $toYards;
                break;
            case 'NM': //Nautical miles
                $toNauticalMiles  = ($round == true ? round($toNauticalMiles) : round($toNauticalMiles, $decimalPoints));
                return $toNauticalMiles;
                break;
        }
    }
}
