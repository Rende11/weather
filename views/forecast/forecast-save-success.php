<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\VarDumper;

$f = ActiveForm::begin();

?>
<div class="alert alert-success">
  <strong>Success!</strong> Data saved to database.
</div>
<?php foreach ($forecast as $day) : ?>

    <li class="list-group-item">
        <?= Html::encode("Date: {$day['date']} Temp: {$day['minTempC']}/{$day['maxTempC']}") ?>
    </li>
<?php endforeach; ?>

<?php
 ActiveForm::end();
?>

