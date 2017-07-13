<?php

namespace app\services;

interface WeatherRepositoryInterface {

  public function saveForecast($city, $averegeByDay);
}