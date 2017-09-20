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

<div class="jumbotron">
    <p class="lead">Enter data for more info</p>
</div>


<?= $view->field($form, 'city')->input('city', ['placeholder' => "London, Moscow etc"]); ?>

<div class="row">

    <div class="col-lg-6">
        <?= $view->field($form, 'from')
            ->widget(DatePicker::classname(), [
                'language' => 'ru',
                'dateFormat' => 'yyyy-MM-dd'
            ])
            ->input('from', ['placeholder' => "Start date - like 2017-02-21"]);
        ?>
        <br>
    </div>
    <div class="col-lg-6">
        <?= $view->field($form, 'to')
            ->widget(DatePicker::classname(), [
                     'language' => 'ru',
                        'dateFormat' => 'yyyy-MM-dd'
                    ])
            ->input('to', ['placeholder' => "End date - like 2017-03-05"]);
        ?>
        <br>
    </div>
</div>

<?= Html::submitButton('Send', ['class' => 'btn btn-success']); ?>
<?php ActiveForm::end(); ?>
