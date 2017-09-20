<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\VarDumper;

function showDay($day)
{
    $string = sprintf("%s (%+d / %+d)", $day['date']->format('d M'), $day['minTempC'], $day['maxTempC']);
    return "<td>" . Html::encode($string) . "</td>";
}

function showWeek($week)
{
    return array_map(function ($day) {
        return showDay($day);
    }, $week);
}

function showForecast($weeklyWeather)
{
    foreach ($weeklyWeather as $week) {
        $weekNumber = $week[0]['date']->format('W');
    }
}

ActiveForm::begin();
?>

<table border="1">

<?php

$month = $weeklyWeather[0][0]['date']->format('F');
echo "<caption>{$month}</caption>";
    /*array_map(function ($week) {
        echo "<tr>";
        echo "<td>";
        echo Html::encode($week[0]['date']->format('W'));
        echo "</td>";
        showWeek($week);
    }, $weather);*/

    showForecast($weeklyWeather);
?>

</table>

<?php
 ActiveForm::end();
?>

