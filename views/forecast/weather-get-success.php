<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\VarDumper;

ActiveForm::begin();

?>
		<table>
			<?php 
				for($i = 0; $i < sizeof($weather); $i++) {
				echo	Html::encode("Temp: {$weather[$i]['averageTempC']} ");
				if ($i > 0 && $i % 7 === 0) {
						echo '<br>';
					}
				} ?>
		</table>

<?php
 ActiveForm::end();
?>

