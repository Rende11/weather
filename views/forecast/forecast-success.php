<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\VarDumper;

$f = ActiveForm::begin();

?>
<p> <?= Html::encode("City: {$forecast['city']}") ?> </p>
<?php foreach ($forecast['weather'] as $day): ?>

    <li>
        <?= Html::encode("Date: {$day['date']} Temp: {$day['average']}") ?>
    </li>
<?php endforeach; ?>

<?php
 ActiveForm::end();
?>

