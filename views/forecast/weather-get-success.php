<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\VarDumper;

$this->registerCssFile("../../web/css/weather.css");
ActiveForm::begin();

?>
		<table border="1" > 
		<?php 
			array_map(function($week) {
							echo "<tr>";
							array_map(function($day) {
								echo "<td>";
								echo Html::encode("Temp: {$day['averageTempC']}");
								echo "</td>";
							}, $week);
							echo "</tr><br/>";
				}, $weather);
		?>
		</table>

<?php
 ActiveForm::end();
?>

