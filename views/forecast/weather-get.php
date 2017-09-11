<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\jui\DatePicker;

?>


<?php $view = ActiveForm::begin(); ?>
  <?= $view->field($form, 'city'); ?>

<?= $view->field($form, 'from')->hint('set start date')->widget(DatePicker::classname(), [
                'language' => 'ru',
                'dateFormat' => 'yyyy-MM-dd'
        ]) ?>

<br>
<?= $view->field($form, 'to')->hint('set end date')->widget(DatePicker::classname(), [
                'language' => 'ru',
                'dateFormat' => 'yyyy-MM-dd'
        ]) ?>

<br>


<?= Html::submitButton('Send'); ?>
<?php ActiveForm::end(); ?>
