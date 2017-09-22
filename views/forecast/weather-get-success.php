<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\VarDumper;

function prepareDay($day)
{

    $string = sprintf("%s (%+d / %+d)", $day['date']->format('d M'), $day['minTempC'], $day['maxTempC']);
    return Html::encode($string);
}
VarDumper::dump($weeklyWeather, 10, true);
exit(1);
?>
<table class="table table-bordered">
        <tr>
            <td><b>Week number</b></td>
            <td colspan=7 align="center"><b>
                <?= 'Month: ' . $month ?>
            </b></td>
        </tr>
    <?php foreach ($weeklyWeather as $week) : ?>
        <tr>
            <td>
                <?php /*$weekNumber =  $week['date']->format('W');
echo $weekNumber;*/
                ?>
            </td>
            <?php foreach ($week as $day) : ?>
                <td>
                    <?= prepareDay($day)?>
                </td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>

