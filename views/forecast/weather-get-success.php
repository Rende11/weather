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
<div class="container">
    <div class="jumbotron">
        <h2>Your forecast below</h2>
        <p>Have a nice day!</p>
    </div>
</div>

<table class="table table-bordered">
        <tr>
            <td><b>Week number</b></td>
            <td colspan=7 align="center"><b>
                <?= "Month: ${month}" ?>
            </b></td>
        </tr>
    <?php foreach ($weeklyWeather as $key => $week) : ?>
        <tr>
            <td>
                <?php
                   echo  $weekNumber = $week[0]['date']->format('W');
                ?>
            </td>
            <?php foreach ($week as $day) : ?>
            <td bgcolor= <?="{$day['color']}"?>>
                    <?= prepareDay($day)?>
                </td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>



<table class="table">
    <thead>
    Highlight days with:
    </thead>
    <tr>
        <td bgcolor= <?="{$colors['warm']}"?>>
        </td>
        <td>
        - Bigger than average weekly amplitude </td>
        <td bgcolor= <?="{$colors['hot']}"?>>
        </td>
        <td>
        - The largest amplitude for whole selected period
        </td>
    </tr>
</table>


