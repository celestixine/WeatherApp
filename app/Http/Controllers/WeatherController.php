<?php declare(strict_types=1);

namespace App\Http\Controllers;

class WeatherController
{

    public function __construct(){}

    public function getCurlResponse($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    private static function setHeader() : void {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Origin: " . APP_URL);
        header('Access-Control-Allow-Headers: Content-Type');
    }

    public function outputLocations($name) {
        $url        = 'https://geocoding-api.open-meteo.com/v1/search?name=' . urlencode($name) . '&language=de&format=json';
        $json       = $this->getCurlResponse($url);
        self::setHeader();
        echo $json;
    }

    public function outputWeatherData(float $lat, float $long)
    {
        $DateTime = new \DateTime();
        $DateTime->add(\DateInterval::createFromDateString('-2 day'));
        $to = $DateTime->format('Y-m-d');
        $DateTime->add(\DateInterval::createFromDateString('-1 year'));
        $from = $DateTime->format('Y-m-d');
        $url = 'https://archive-api.open-meteo.com/v1/archive?latitude=' . $lat . '&longitude=' . $long . '&start_date=' . $from . '&end_date=' . $to . '&hourly=temperature_2m';
        $json       = $this->getCurlResponse($url);
        $hottestDay = $this->getHottestOrColdestDay($json,true);
        $coldestDay = $this->getHottestOrColdestDay($json,false);
        self::setHeader();
        echo json_encode(array('hot' => $hottestDay,'cold' => $coldestDay));
    }

    public function getHottestOrColdestDay($json,$hot=false) : array {
        $jsonArray  = json_decode($json, true);
        $minMax     = [];
        foreach ($jsonArray['hourly']['temperature_2m'] as $k => $data) {
            if ( count($minMax)>0 ) {
                if ($hot && (float)$data <= $minMax['temperature']) {
                    continue;
                } elseif (!$hot && (float)$data >= $minMax['temperature']) {
                    continue;
                }
            }
            $minMax = [
                'datetime' => $jsonArray['hourly']['time'][$k],
                'temperature' => $data
            ];
        }
        $DateTime       = new \DateTime($minMax['datetime']);
        $minMax['hour'] = $DateTime->format('H:i');
        $minMax['day']  = $DateTime->format('d.m.Y');
        return $minMax;
    }

}
