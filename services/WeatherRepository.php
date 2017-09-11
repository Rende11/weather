<?php

namespace app\services;

use app\models\Forecast;
use app\models\Cities;
use yii\helpers\VarDumper;
use yii;

class WeatherRepository implements WeatherRepositoryInterface
{
    public function saveForecast($dailyWeather)
    {
        $city = $dailyWeather[0]['city'];
        $cities = new Cities();
        $cities->city = $city;
        $cities->save();

        $city_id = Cities::findOne(['city' => $city])->attributes['id'];

        $data = array_map(function ($day) use ($city_id) {
            return [$city_id, $day['date'], $day['minTempC'], $day['maxTempC']];
        }, $dailyWeather);

        $currentCityForecast = Forecast::findAll(['city_id' => $city_id]);

        $currentForecastDays = array_map(function ($day) {
            return $day['date'];
        }, $currentCityForecast);

            
        $filteredData = array_filter($data, function ($day) use ($currentForecastDays) {
            list($id, $date, $averageTemp) = $day;
            return !in_array($date, $currentForecastDays);
        });


        $connection = Yii::$app->db;
        $connection->createCommand()->batchInsert(
            'weather',
            ['city_id', 'date', 'minTempC', 'maxTempC'],
          $filteredData
        )->execute();
    }

    public function getForecast($city, $from, $to)
    {
        $citySelect = Cities::find()->where(['like', 'city', $city])->one();
        $query = [];
        if ($citySelect) {
            $city_id = $citySelect->attributes['id'];
            $query = Forecast::find()
          ->where(['city_id' => $city_id])
          ->andWhere(['between', 'date', $from, $to])
          ->asArray()
          ->all();
        }
        return $query;
    }
}
