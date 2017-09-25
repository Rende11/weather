<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>
<?php $viewForm = ActiveForm::begin(); ?>
    <?php if (isset($error)) :?>
        <div class="site-error">
            <div class="alert alert-danger">
                <?= nl2br(Html::encode($error)); ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="jumbotron">
        <h2>Enter the city and number of days for forecast you need.</h2>
    </div>

<?= $viewForm->field($form, 'city')->input('city', ['placeholder' => "London, Moscow etc"]);?>
<?= $viewForm->field($form, 'days')->input('days', ['placeholder' => "4, 5, 6 etc"]); ?>
<?= Html::submitButton('Send', ['class' => 'btn btn-success']); ?>
<?php ActiveForm::end(); ?>
