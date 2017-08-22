<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\VarDumper;

ActiveForm::begin();

?>
		<table>
		<?php 
				for($i = 0; $i < sizeof($weather); $i++) {
						array_map(function($day) {
							echo	Html::encode("Temp: {$day['averageTempC']} ");
						}, $weather[$i]);
						echo "<br>";
				}
		?>
		</table>

<?php
 ActiveForm::end();
?>

