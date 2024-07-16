<?php

use App\Http\Controllers\WeatherController;

require_once dirname(__FILE__) . "/vendor/autoload.php";
require_once dirname(__FILE__) . "/config/config.php";

if ( isset($_GET['name']) ) {

    $name = trim(strip_tags($_GET['name']));
    $WeatherController  = new WeatherController();
    $WeatherController->outputLocations($name);

} else if ( isset($_GET['lat']) && isset($_GET['long']) ) {

    $lat    = trim($_GET['lat']);
    $long   = trim($_GET['long']);
    if ( is_numeric($lat) && is_numeric($long) ) {
        $WeatherController = new WeatherController();
        $WeatherController->outputWeatherData((float)$lat,(float)$long);
    }

} else {

    $Smarty = new \Smarty\Smarty();
    $Smarty->assign('APP_URL', APP_URL);
    $Smarty->display(TEMPLATE_DIR . '/index.tpl');

}


?>