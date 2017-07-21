<?php
namespace app\services;

use Yii;
use yii\httpclient\Client;

// use app\services\WeatherRepository;

use yii\helpers\VarDumper;
use yii\base\Exception;

class WeatherService {


  public function getForecastRequest($city, $days, $format = 'json'){
    $apiKey = Yii::$app->params['apiKey'];
    $url = "http://api.worldweatheronline.com/premium/v1/weather.ashx?key={$apiKey}&q={$city}&num_of_days={$days}&format={$format}";
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

  public function getForecast($city, $from, $to)
  {
    $repository = new WeatherRepository();
    return $repository->getForecast($city, $from, $to);
  }
}