<?php

namespace app\models;
use yii\db\ActiveRecord;

class Forecast extends ActiveRecord {

  /**
   * @return string table name
   */

   public static function tableName() {
     return '{{weather}}';
   }

}