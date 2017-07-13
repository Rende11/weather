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

      $location = $response->data['data']['request'][0]['query'];
      $weather = $response->data['data']['weather'];
      // VarDumper::dump($response, 10, true);
      // exit();
      $everyDay = array_map(function ($value) use ($location) {
            $average = ($value['maxtempC'] + $value['mintempC']) / 2;
            return ['date' => $value['date'], 'average' => $average];
        }, $weather);

      $repos = new WeatherRepository();
      $repos->saveForecast(null, null);
      return [
        'city' => $location,
        'weather' => $everyDay
      ];
    } else {
      throw new Exception("Request failed");
    }

  }
}