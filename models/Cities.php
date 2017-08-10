<?php

namespace app\models;
use yii\db\ActiveRecord;

class Cities extends ActiveRecord {

  /**
   * @return string table name
   */

   public static function tableName() {
     return '{{cities}}';
   }

   public function rules()
   {
     return [['city', 'unique']];
   }
}
