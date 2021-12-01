<?php require_once dirname(__FILE__) .'/../config.php';?>

<?php //góra strony z szablonu 
include _ROOT_PATH.'/templates/top.php';
?>

<div class="pure-g">
<div class="l-box-lrg pure-u-1 pure-u-med-2-5">
<form class="pure-form pure-form-stacked" action="<?php print(_APP_URL);?>/app/calc.php" method="post">
	<label for="id_k">Kwota: </label>
	<input id="id_k" type="text" name="k" value="<?php if (isset($k)) print($k); ?>" /><br />
	<label for="id_l">okres (miesiące): </label>
	<input id="id_l" type="text" name="l" value="<?php if (isset($l)) print($l); ?>" /><br />
	<label for="id_o">Oprocentowanie: </label>
	<input id="id_o" type="text" name="o" value="<?php if (isset($o)) print($o); ?>" /><br />
	<input type="submit" value="Oblicz" />
</form>	
<div class="l-box-lrg pure-u-1 pure-u-med-3-5">
<?php
//wyświeltenie listy błędów, jeśli istnieją
if (isset($messages)) {
	if (count ( $messages ) > 0) {
		echo '<ol style="margin: 20px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:300px;">';
		foreach ( $messages as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>


<?php if (isset($rata)){ ?>
<div style="margin: 20px; padding: 10px; border-radius: 5px; background-color: #ff0; width:300px;">
<?php echo 'Miesięczna rata: '.$rata; ?>
<br>
<?php echo 'Łącznie zapłacimy: '. 12*$rata; ?>
</div>
<?php } ?>

</div>

<?php //dół strony z szablonu 
include _ROOT_PATH.'/templates/bottom.php';
?>