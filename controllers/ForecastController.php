<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\ForecastForm;
use yii\helpers\VarDumper;
use app\services\WeatherService;


class ForecastController extends Controller {

  public function actionIndex() {


    $form = new ForecastForm();

    if ($form->load(Yii::$app->request->post()) && $form->validate()) {
        $weatherService = new WeatherService($form->city, $form->days);
        $forecast = $weatherService->getForecast();


        return $this->render('forecast-success', ['form' => $form, 'forecast' => $forecast]);
      } else {
        return $this->render('forecast', ['form' => $form]);
      }
  }
}
