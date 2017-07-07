<?php

namespace app\models;
use yii\db\ActiveRecord;

class Forecast extends ActiveRecord {

  /**
   * @return string table name
   */

   public function tableName() {
     return '{{weather}}';
   }

}