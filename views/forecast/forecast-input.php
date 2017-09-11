<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<?php $viewForm = ActiveForm::begin(); ?>
  <?= $viewForm->field($form, 'city'); ?>
  <?= $viewForm->field($form, 'days'); ?>
  <?= Html::submitButton('Send'); ?>
<?php ActiveForm::end(); ?>
