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

          $weatherService = new WeatherService();
          $forecast = $weatherService->getForecastRequest($form->city, $form->days);
          $weatherService->saveForecast($forecast);
          return $this->render('forecast-success', ['form' => $form, 'forecast' => $forecast]);

      }
      return $this->render('forecast', ['form' => $form]);
  }

  public function actionWeather()
  {
		$form = new ForecastForm();
		
		if ($form->load(Yii::$app->request->post()) && $form->validate()) {
		    $weatherService = new WeatherService();
				$weather = $weatherService->getForecast($form->city, '2017-07-19', '2017-07-29');
				VarDumper::dump($weather, 10, true);
				return $this->render('forecast-success', ['form' => $form, 'forecast' => $weather]);
		}
		return $this->render('forecast', ['form' => $form]);
  }
}
