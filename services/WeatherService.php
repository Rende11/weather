<?php
namespace app\services;

use Yii;
use yii\httpclient\Client;

// use app\services\WeatherRepository;

use yii\helpers\VarDumper;
use yii\base\Exception;

class WeatherService {
  private $city;
  private $days;
  private $format;

  public function __construct($city, $days, $format = 'json') {
      $this->city = $city;
      $this->days = $days;
      $this->format = $format;
  }

  public function getForecast(){
    $apiKey = Yii::$app->params['apiKey'];
    $url = "http://api.worldweatheronline.com/premium/v1/weather.ashx?key={$apiKey}&q={$this->city}&num_of_days={$this->days}&format={$this->format}";
    $client = new Client();

    $response = $client->createRequest()
        ->setMethod('get')
        ->setUrl($url)
        ->send();

    if ($response->isOk ) {
      if (isset($response->data['data']['error'])) {
        throw new Exception("Wrong input");
      }

      $city = $response->data['data']['request'][0]['query'];
      $weather = $response->data['data']['weather'];

      if ($weather) {
        $dailyWeather = array_map(function ($day) use ($city) {
            $average = ($day['maxtempC'] + $day['mintempC']) / 2;
            return ['city' => $city, 'date' => $day['date'], 'average' => $average];
        }, $weather);
      } else {
        throw new Exception("Error Processing Request", 1);
      }

      return $dailyWeather;
    } else {
      throw new Exception("Request failed");
    }

  }

  public function saveForecast($dailyWeather)
  {
    $repository = new WeatherRepository();
    $repository->saveForecast($dailyWeather);
  }

  public function getData($city, $from, $to)
  {
    $repository = new WeatherRepository();
    return $repository->getForecast($city, $from, $to);
  }
}