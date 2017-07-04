<?php

namespace app\models;

use yii;
use yii\base\Model;

class ForecastForm extends Model {

    public $city;
    public $date;

    public function rules() {
      return [
        [['city', 'date'], 'required'],
        ['date', 'date']
      ];
    }

}
