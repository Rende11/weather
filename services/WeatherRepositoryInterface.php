<?php

namespace app\services;

interface WeatherRepositoryInterface
{
    public function saveForecast($dailyWeather);

    public function getForecast($city, $from, $to);
}
