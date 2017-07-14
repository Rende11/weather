<?php

namespace app\services;

use app\models\Forecast;
use app\models\Cities;
use yii\helpers\VarDumper;
use yii;


class WeatherRepository implements WeatherRepositoryInterface {

  public function saveForecast($dailyWeather)
  {
      
      $city = $dailyWeather[0]['city'];
      $cities = new Cities();
      $cities->city = $city;
      $cities->save();

      $city_id = Cities::findOne(['city' => $city])->attributes['id'];

      $data = array_map(function ($day) use ($city_id){
        return [$city_id, $day['date'], $day['average']];
      }, $dailyWeather);

      $connection = Yii::$app->db;
      $connection->createCommand()->batchInsert('weather', ['city_id', 'date', 'averageTempC'],
          $data)->execute();

  }

}