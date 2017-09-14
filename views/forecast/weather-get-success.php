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
    foreach ($week as $day) {
        echo showDay($day);
    }
}

function showForecast($weeklyWeather) 
{ 
    foreach ($weeklyWeather as $week) {
        $weekNumber = $week[0]['date']->format('W');
        $forecast = "<tr><td>" . Html::encode($weekNumber) . showWeek($week) . "</td>" ;
        echo $forecast;
    }
}

ActiveForm::begin();
?>

<table border="1"> 

<?php

$month = $weather[0][0]['date']->format('F');
echo "<caption>{$month}</caption>";
    /*array_map(function ($week) {
        echo "<tr>";
        echo "<td>";
        echo Html::encode($week[0]['date']->format('W'));
        echo "</td>";
        showWeek($week);
    }, $weather);*/

    showForecast($weather);
?>

</table>

<?php
 ActiveForm::end();
?>

