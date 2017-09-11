<?php

namespace app\models;

use yii\base\Model;

class ForecastInput extends Model
{
    public $city;
    public $days;

    public function rules()
    {
        return [
        [['city', 'days'], 'required'],
      ];
    }
}
