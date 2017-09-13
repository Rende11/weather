<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

?>
<?php $viewForm = ActiveForm::begin(); ?>
    <?php if (isset($error)) :?>
    <div class="site-error">
      <div class="alert alert-danger">
      <?= nl2br(Html::encode($error)); ?>
      </div>
    </div>
  <?php endif; ?>
  <?= $viewForm->field($form, 'city'); ?>
  <?= $viewForm->field($form, 'days'); ?>
  <?= Html::submitButton('Send'); ?>
<?php ActiveForm::end(); ?>
