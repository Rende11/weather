<?php

namespace app\models;


use yii\base\Model;

class ForecastGet extends Model {

    public $city;

    public function rules() {
      return [
        ['city', 'required'],
      ];
    }

}
