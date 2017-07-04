<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
// use yii\models\ForecastForm;
use app\models\ForecastForm;
use yii\httpclient\Client;
use yii\helpers\VarDumper;





class ForecastController extends Controller {

  public function actionHistory ($city, $date, $enddate = '', $format = 'json') {

    $apiKey = Yii::$app->params['apiKey'];
    $url = "http://api.worldweatheronline.com/premium/v1/weather.ashx?key={$apiKey}&q={$city}&date={$date}&enddate={$enddate}&format={$format}";

    $client = new Client();

    $response = $client->createRequest()
        ->setMethod('get')
        ->setUrl($url)
        ->send();

    if ($response->isOk) {
      $data = $response->data;

      // $callback = function($acc, $item) {
      //   $acc[$item['date']] = ($item['maxtempC'] + $item['mintempC']) / 2;
      //   return $acc;
      // };
      //
      // $weather = array_reduce($data, $callback, []);
      VarDumper::dump($data, 10, true);
    }
  }

  public function actionEnter() {
    $form = new ForecastForm();
    return $this->render('form', ['form' => $form]);
  }

}




