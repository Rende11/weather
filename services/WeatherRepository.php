<?php

namespace app\services;

use app\models\Forecast;
use app\models\Cities;
use yii\helpers\VarDumper;


class WeatherRepository implements WeatherRepositoryInterface {

  public function saveForecast($city, $averegeByDay) {
      $currentCities = Cities::find()->all();
      VarDumper::dump($currentCities,10, true);
      exit();


      $cities = new Cities();
      $cities->city = $city;
      $cities->save();

      foreach ($averegeByDay as $day) {
        $weather = new Forecast();
        $weather->date = $day['date'];
        $weather->city_id = 11;
        $weather->averageTempC = $day['average'];
        $weather->save();
      }
  }

}