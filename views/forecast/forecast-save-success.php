<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\VarDumper;

$f = ActiveForm::begin();

?>
<?php foreach ($forecast as $day): ?>

    <li>
        <?= Html::encode("Date: {$day['date']} Temp: {$day['minTempC']}/{$day['maxTempC']}") ?>
    </li>
<?php endforeach; ?>

<?php
 ActiveForm::end();
?>

