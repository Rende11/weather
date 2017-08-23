<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\VarDumper;

//$this->registerCssFile("../../web/css/weather.css");
ActiveForm::begin();

?>
		<table border="1"> 
<?php
			echo "<caption>{$weather[0][0]['date']->format('F')}</caption>";
			array_map(function($week) {
							echo "<tr>";
							array_map(function($day) {
								echo "<td>";
								$string = sprintf("%s (%+d / %+d)", $day['date']->format('d M'), $day['minTempC'], $day['maxTempC']);
								echo Html::encode($string);
								echo "</td>";
							}, $week);
							echo "</tr><br/>";
				}, $weather);
		?>
		</table>

<?php
 ActiveForm::end();
?>

