<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\jui\DatePicker;

const SEC_IN_SIX_DAYS = 518400;

$view = ActiveForm::begin(); ?>

<?php if (isset($error)) :?>
    <div class="site-error">
        <div class="alert alert-danger">
            <?= nl2br(Html::encode($error)); ?>
        </div>
    </div>
<?php endif; ?>

<div class="jumbotron">
    <h2>Enter data for more info</h2>
</div>


<?= $view->field($form, 'city')->input('city', ['placeholder' => "London, Moscow etc"]); ?>

<div class="row">

    <div class="col-lg-6">
        <?= $view->field($form, 'from')
            ->widget(DatePicker::classname(), [
                'language' => 'ru',
                'dateFormat' => 'yyyy-MM-dd',
            ])
            ->input('from', ['value' => date('Y-m-d')]);
        ?>
        <br>
    </div>
    <div class="col-lg-6">
        <?= $view->field($form, 'to')
            ->widget(DatePicker::classname(), [
                     'language' => 'ru',
                        'dateFormat' => 'yyyy-MM-dd'
             ])
             ->input('to', ['value' => date('Y-m-d', time() + SEC_IN_SIX_DAYS)]);
        ?>
        <br>
    </div>
</div>

<?= Html::submitButton('Send', ['class' => 'btn btn-success']); ?>
<?php ActiveForm::end(); ?>
