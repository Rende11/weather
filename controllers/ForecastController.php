<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\httpclient\Client;
use yii\helpers\VarDumper;





class ForecastController extends Controller {

  public function actionHistory ($city, $days, $format = 'json') {
    $apiKey = Yii::$app->params['apiKey'];
    $url = "http://api.worldweatheronline.com/premium/v1/weather.ashx?key={$apiKey}&q={$city}&num_of_days={$days}&format={$format}";

    $client = new Client();

    $response = $client->createRequest()
        ->setMethod('get')
        ->setUrl($url)
        ->send();

    if ($response->isOk) {
      $data = $response->data['data']['weather'];

      $callback = function($acc, $item) {
        $acc[$item['date']] = ($item['maxtempC'] + $item['mintempC']) / 2;
        return $acc;
      };
      
      $weather = array_reduce($data, $callback, []);
      VarDumper::dump($weather, 10, true);
    }
  }

}




