<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\VarDumper;

function prepareDay($day)
{
    $string = sprintf("%s (%+d / %+d)", $day['date']->format('d M'), $day['minTempC'], $day['maxTempC']);
    return Html::encode($string);
}
?>
<h3>SOOO</h3>
<table class="table table-bordered">
    <?php foreach ($weeklyWeather as $week) : ?>
        <tr>
            <?php foreach ($week as $day) : ?>
                <td>
                    <?= prepareDay($day)?>
                </td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>

