<?php
namespace app\services;

use Yii;
use yii\httpclient\Client;

use yii\helpers\VarDumper;
use yii\base\Exception;

class WeatherService
{
    private $colorMap = [
        'usual' => '#FFFFFF',
        'warm' => '#FFFF00',
        'hot' => '#FF0000'
    ];
    public function getForecastRequest($city, $days, $format = 'json')
    {
        $apiKey = Yii::$app->params['apiKey'];
        $url = $this->constructUrl($apiKey, $city, $days, $format);
        $client = new Client();

        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl($url)
            ->send();
            //VarDumper::dump($response, 10, true);

        if ($response->isOk) {
            if (!isset($response->data)) {
                return ['error' => 'Empty data from remote server - please try again later'];
            }
            if (isset($response->data['data']['error'])) {
                return ['error' => $response->data['data']['error'][0]['msg']];
            }

            $city = $response->data['data']['request'][0]['query'];
            $weather = $response->data['data']['weather'];

            $dailyWeather = array_map(function ($day) use ($city) {
                return ['city' => $city, 'date' => $day['date'],
                        'minTempC' => $day['mintempC'], 'maxTempC' => $day['maxtempC']];
            }, $weather);

            return $dailyWeather;
        }
        return ['error' => "Bad response from remote server - {$response}"];
    }

    public function saveForecast($dailyWeather)
    {
        $repository = new WeatherRepository();
        $repository->saveForecast($dailyWeather);
    }

    public function getForecast($city, $from, $to)
    {
        $repository = new WeatherRepository();
        return $repository->getForecast($city, $from, $to);
    }

    public function getWeeklyForecast($city, $from, $to, $size = 7)
    {
        $daily = $this->getForecast($city, $from, $to);
        if (sizeof($daily) === 0) {
            return [];
        }

        $maxAmplitude = max($this->calcAmplitude($daily));

        $dateObjects = array_map(function ($day) use ($maxAmplitude) {
            $day['date'] = new \DateTime($day['date']);
            $day['amplitude'] = $this->getDailyAmplitude($day);
            $day['color'] = $day['amplitude'] === $maxAmplitude ? $this->colorMap['hot'] : $this->colorMap['usual'];
            return $day;
        }, $daily);

        $weeklyForecast =  array_chunk($dateObjects, $size);

        $weeklyWithAverage = array_map(function ($week) {
            $weeklyAverage = array_sum($this->calcAmplitude($week)) / count($week);
            return ['week' => $week, 'weeklyAverage' => $weeklyAverage] ;
        }, $weeklyForecast);

        return [$weeklyWithAverage, $maxAmplitude];
    }

    private function constructUrl($apiKey, $city, $days, $format)
    {
        $url = "http://api.worldweatheronline.com/premium/v1/weather.ashx?key={$apiKey}&q={$city}&num_of_days={$days}&format={$format}";
        return $url;
    }

    private function getDailyAmplitude($day)
    {
        return $day['maxTempC'] - $day['minTempC'];
    }
    private function calcAmplitude($forecast)
    {
        $dailyAmp = array_map(function ($day) {
            return $day['maxTempC'] - $day['minTempC'];
        }, $forecast);
        return $dailyAmp;
    }
}
