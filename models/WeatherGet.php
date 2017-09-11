<?php

namespace app\models;

use yii\base\Model;

class WeatherGet extends Model
{
    public $city;
    public $from;
    public $to;

    public function rules()
    {
        return [
        [['city', 'from', 'to'], 'required'],
      ];
    }
}

/*
 * Number of week  W
 * Name of month F
 * */
