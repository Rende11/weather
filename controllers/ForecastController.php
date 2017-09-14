<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\VarDumper;

use app\services\WeatherService;

use app\models\ForecastInput;
use app\models\WeatherGet;

class ForecastController extends Controller
{
    public function actionIndex()
    {
        $form = new ForecastInput();
 
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $weatherService = new WeatherService();
            $forecast = $weatherService->getForecastRequest($form->city, $form->days);
            if (sizeof($forecast) == 0) {
                return $this->render('forecast-input', ['form' => $form, 'error' => "Bad request to remote server please repeat"]);
            }
            $weatherService->saveForecast($forecast);
            return $this->render('forecast-save-success', ['form' => $form, 'forecast' => $forecast]);
        }
        return $this->render('forecast-input', ['form' => $form]);
    }

    public function actionWeather()
    {
        $form = new WeatherGet();
        
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $weatherService = new WeatherService();
            $weeklyWeather = $weatherService->getWeeklyForecast($form->city, $form->from, $form->to);
            if (sizeof($weeklyWeather) == 0) {
                return $this->render('weather-get', ['form' => $form, 'error' => 'Data is not avalible']);
            }
            
            return $this->render('weather-get-success', ['form' => $form, 'weeklyWeather' => $weeklyWeather]);
        }
        
        return $this->render('weather-get', ['form' => $form]);
    }
}
