<?php
require_once dirname(__FILE__).'/../config.php';

// KONTROLER strony kalkulatora

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

//ochrona kontrolera - poniższy skrypt przerwie przetwarzanie w tym punkcie gdy użytkownik jest niezalogowany
include _ROOT_PATH.'/app/security/check.php';

//pobranie parametrów
function getParams(&$k,&$l,&$o){
	$k = isset($_REQUEST['k']) ? $_REQUEST['k'] : null;
	$l = isset($_REQUEST['l']) ? $_REQUEST['l'] : null;
	$o = isset($_REQUEST['o']) ? $_REQUEST['o'] : null;	
}

//walidacja parametrów z przygotowaniem zmiennych dla widoku
function validate(&$k,&$l,&$o,&$messages){
	// sprawdzenie, czy parametry zostały przekazane
	if ( ! (isset($k) && isset($l) && isset($o))) {
		// sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
		// teraz zakładamy, ze nie jest to błąd. Po prostu nie wykonamy obliczeń
		return false;
	}

	// sprawdzenie, czy potrzebne wartości zostały przekazane
	if ( $k == "") {
		$messages [] = 'Nie podano kwoty';
	}
	if ( $l == "") {
		$messages [] = 'Nie podano okresu';
	}
	if ( $o == "") {
		$messages [] = 'Nie podano oprocentowania';
	}
	//nie ma sensu walidować dalej gdy brak parametrów
	if (count ( $messages ) != 0) return false;
	
	// sprawdzenie, czy $k i $l są liczbami całkowitymi
	if (! is_numeric( $k )) {
		$messages [] = 'Pierwsza wartość nie jest liczbą całkowitą';
	}
	
	if (! is_numeric( $l )) {
		$messages [] = 'Druga wartość nie jest liczbą całkowitą';
	}	
	
	if (! is_numeric( $o )) {
		$messages [] = 'trzecia wartość nie jest liczbą całkowitą';
	}
	if (count ( $messages ) != 0) return false;
	else return true;
}

function process(&$k,&$l,&$o,&$messages,&$result){
	global $role;
	
	//konwersja parametrów
	$k = intval($k);
	$l = intval($l);
	$o = floatval($o);
	
	if ($role == 'admin'){
				$result = ($k + ($k * $o/ 100))/$l;
			} else {
				$messages [] = 'Tylko administrator może obliczyć rate !';
			}
			
}

	

//definicja zmiennych kontrolera
$k = null;
$l = null;
$o = null;
$result = null;
$messages = array();

//pobierz parametry i wykonaj zadanie jeśli wszystko w porządku
getParams($k,$l,$o);
if ( validate($k,$l,$o,$messages) ) { // gdy brak błędów
	process($k,$l,$o,$messages,$result);
}

// Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($messages,$k,$l,$o,$result)
//   będą dostępne w dołączonym skrypcie
include 'calc_view.php';