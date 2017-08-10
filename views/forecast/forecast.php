<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<?php $f = ActiveForm::begin(); ?>
  <?= $f->field($form, 'city'); ?>
  <?= $f->field($form, 'days'); ?>
  <?= Html::submitButton('Send'); ?>
<?php ActiveForm::end(); ?>
