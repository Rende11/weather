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
<table class="table table-bordered">
        <tr>
            <td><b>Week number</b></td>
            <td colspan=7 align="center"><b>
                <?= 'Month: ' ?>
            </b></td>
        </tr>
    <?php foreach ($weeklyWeather as $key => $week) : ?>
        <tr>
            <td>
            </td>
            <?php foreach ($week['week'] as $day) : ?>
            <td bgcolor= <?="{$day['color']}"?>>
                    <?= prepareDay($day)?>
                </td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>

