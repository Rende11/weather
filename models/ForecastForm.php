<?php

namespace app\models;


use yii\base\Model;

class ForecastForm extends Model {

    public $city;
    public $days;

    public function rules() {
      return [
        [['city', 'days'], 'required'],
      ];
    }

}
