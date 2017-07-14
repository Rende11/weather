<?php

namespace app\services;

use app\models\Forecast;
use app\models\Cities;
use yii\helpers\VarDumper;
use yii;


class WeatherRepository implements WeatherRepositoryInterface {

  public function saveForecast($city, $averegeByDay)
  {

      $cities = new Cities();
      $cities->city = $city;
      $cities->save();

      $city_id = Cities::findOne(['city' => $city])->attributes['id'];

      $data = array_map(function ($item) use ($city_id){
        return [$city_id, $item['date'], $item['average']];
      }, $averegeByDay);

      $connection = Yii::$app->db;
      $connection->createCommand()->batchInsert('weather', ['city_id', 'date', 'averageTempC'], $data)->execute();

  }

}