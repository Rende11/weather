<?php

namespace app\services;

interface WeatherRepositoryInterface {

  public function saveForecast($dailyWeather);
}