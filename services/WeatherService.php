<?php
namespace app\services;

use Yii;
use yii\httpclient\Client;
use yii\helpers\VarDumper;

class WeatherService {
  private $city;
  private $days;

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
    if ($response->isOk) {
      $location = $response->data['data']['request'][0]['query'];

      $weather = $response->data['data']['weather'];
      $everyDay = array_map(function ($value) use ($location) {
          $average = ($value['maxtempC'] + $value['mintempC']) / 2;
          return ['date' => $value['date'], 'average' => $average];
      }, $weather);
      return [
        'city' => $location,
        'weather' => $everyDay
      ];
    } else {
      return 'Error';
    }

  }
}