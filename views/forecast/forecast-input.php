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

    <div class="jumbotron">
        <p class="lead">Enter the city and number of days for forecast you need.</p>
    </div>

<?= $viewForm->field($form, 'city')->input('city', ['placeholder' => "London, Moscow etc"]);?>
<?= $viewForm->field($form, 'days')->input('days', ['placeholder' => "4, 5, 6 etc"]); ?>
<?= Html::submitButton('Send', ['class' => 'btn btn-success']); ?>
<?php ActiveForm::end(); ?>
