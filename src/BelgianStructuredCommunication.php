<?php

class BelgianStructuredCommunication {

	public static function create($transactionID, $format=1) {

		$transactionID = preg_replace("/\D/", "", $transactionID);
		$modulo = str_pad(bcmod($transactionID, 97),2,"0", STR_PAD_LEFT);
		$control = ($modulo <= 0) ? 97 : $modulo;
		$transactionID = str_pad($transactionID, 10, 0, STR_PAD_LEFT);
		$com = $transactionID . $control;

		if(strlen($transactionID) > 10 || strlen($transactionID) <= 0) return 0;

		switch ($format) {
			case 1: // return not formated
			return (string)$com;
			break;
			case 2: // return formated with short format
			return (string)substr($com, 0, 3) . '/' . substr($com, 3, 4) . '/' . substr($com, 7, 5);
			break;
			case 3: // return formated with long format
			return (string)'+++' . substr($com, 0, 3) . '/' . substr($com, 3, 4) . '/' . substr($com, 7, 5) . '+++';
			break;
			case 4: // return modulo
			return (int)$modulo;
			break;
		}

	}

	public static function check($Reference, $mode=1) {

		$Reference = preg_replace("/\D/", "", $Reference);
		$transactionID = substr($Reference, 0, 10);
		$mod = substr($Reference, 10, 2);

		$check = self::create($transactionID, 4);

		if(strlen($Reference)> 12 || strlen($Reference) <= 0) return 0;

		switch ($mode) {
			case 1: // return transactionID
			return (string)$transactionID;
			break;
			case 2: // return modulo
			return (string)$mod;
			break;
			case 3: // return validity (0/1)
			return ($mod == $check);
			break;
		}

	}


}
