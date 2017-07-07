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

        try {
          $weatherService = new WeatherService($form->city, $form->days);
          $forecast = $weatherService->getForecast();
          return $this->render('forecast-success', ['form' => $form, 'forecast' => $forecast]);
        } catch (Exeption $e) {
          // return $this->render('error', ['message' => $e->getMessage()]);
          return 'LOLO';
        }

      }
      return $this->render('forecast', ['form' => $form]);
  }
}
