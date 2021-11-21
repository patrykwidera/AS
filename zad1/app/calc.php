<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';

$k = $_REQUEST ['k'];
$l = $_REQUEST ['l'];
$o = $_REQUEST ['o'];

if ( ! (isset($k) && isset($l) && isset($o))) {
	$messages [] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
}

if ( $k == "") {
	$messages [] = 'Nie podano kwoty';
}
if ( $l == "") {
	$messages [] = 'Nie podano okresu';
}
if ( $o == "") {
	$messages [] = 'Nie podano oprocentowania';
}
if (empty( $messages )) {
	
	if (! is_numeric( $k )) {
		$messages [] = 'Pierwsza wartość nie jest liczbą całkowitą';
	}
	
	if (! is_numeric( $l )) {
		$messages [] = 'Druga wartość nie jest liczbą całkowitą';
	}
if (! is_numeric( $o )) {
		$messages [] = 'trzecia wartość nie jest liczbą';
	}	

}

if (empty ( $messages )) { 
	
	$k = intval($k);
	$l = intval($l);
	$o = intval($o);
	
			$rata = ($k + ($k * $o/ 100))/$l;
}
include 'calc_view.php';