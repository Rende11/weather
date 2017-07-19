<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\VarDumper;

use app\services\WeatherService;

use app\models\ForecastForm;



use yii\base\Exception;

class ForecastController extends Controller {

  public function actionIndex() {

    $form = new ForecastForm();
    if ($form->load(Yii::$app->request->post()) && $form->validate()) {

          $weatherService = new WeatherService($form->city, $form->days);
          $forecast = $weatherService->getForecast();
          $weatherService->saveForecast($forecast);
          return $this->render('forecast-success', ['form' => $form, 'forecast' => $forecast]);

      }
      return $this->render('forecast', ['form' => $form]);
  }

  public function actionWeather()
  {
    $data = [];
    return $this->render('weather', ['data' => $data]);
  }
}
