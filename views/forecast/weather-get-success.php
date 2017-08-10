<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\VarDumper;

ActiveForm::begin();

?>
<?php foreach ($weather as $day): ?>

    <li>
        <?= Html::encode("Date: {$day['date']} Temp: {$day['averageTempC']}") ?>
    </li>
<?php endforeach; ?>

<?php
 ActiveForm::end();
?>

