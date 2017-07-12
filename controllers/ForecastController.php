<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\VarDumper;

use app\services\WeatherService;
use app\models\ForecastForm;

// DB models
use app\models\Forecast;
use app\models\Cities;

use yii\base\Exception;

class ForecastController extends Controller {

  public function actionIndex() {


    $form = new ForecastForm();

    if ($form->load(Yii::$app->request->post()) && $form->validate()) {

          $weatherService = new WeatherService($form->city, $form->days);
          $forecast = $weatherService->getForecast();

          $cities = new Cities();
          $cities->city = $forecast['city'];
          $cities->save();

          $c = Cities::find()
            ->where(['id' => 1])
            ->one();

          VarDumper::dump($c);
          exit();
          foreach ($forecast['weather'] as $day) {
            $weather = new Forecast();
            $weather->date = $day['date'];
            $weather->city_id = 11;
            $weather->averageTempC = $day['average'];
            $weather->save();
          }
          return $this->render('forecast-success', ['form' => $form, 'forecast' => $forecast]);
        // } catch (Exeption $e) {
        //   // return $this->render('error', ['message' => $e->getMessage()]);
        //   return 'LOLO';
        // }

      }
      return $this->render('forecast', ['form' => $form]);
  }
}
