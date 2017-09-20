<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\jui\DatePicker;

$view = ActiveForm::begin(); ?>

<?php if (isset($error)) :?>
    <div class="site-error">
        <div class="alert alert-danger">
            <?= nl2br(Html::encode($error)); ?>
        </div>
    </div>
<?php endif; ?>

<?= $view->field($form, 'city'); ?>
<?= $view->field($form, 'from')
    ->hint('set start date')
    -> widget(DatePicker::classname(), [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd'
    ]); ?>
<br>

<?= $view->field($form, 'to')
    ->hint('set end date')
    ->widget(DatePicker::classname(), [
                'language' => 'ru',
                'dateFormat' => 'yyyy-MM-dd'
    ]); ?>
<br>

<?= Html::submitButton('Send', ['class' => 'btn btn-success']); ?>
<?php ActiveForm::end(); ?>
