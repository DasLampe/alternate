<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2012 DasLampe <daslampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
/**
 * Add useful PHP functions wich blocked or extensions not loaded.
 * E.g. json_encode
 */

if(!function_exists("json_encode"))
{
	function json_encode(array $array){
		require_once dirname(__FILE__).'/lib/PEAR/JSON.php';
		$json = new Services_JSON;

		return $json->encode($array);
	}
}

if(!function_exists('json_decode'))
{
	function json_decode($content, $assoc=false){
		require_once dirname(__FILE__).'/lib/PEAR/JSON.php';
		if ( $assoc ){
			$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
		} else {
			$json = new Services_JSON;
		}
		return $json->decode($content);
	}
}

if(!function_exists("easter_date"))
{
	function easter_date($Year = null) {
		/* 
		G is the Golden Number-1 
		H is 23-Epact (modulo 30) 
		I is the number of days from 21 March to the Paschal full moon 
		J is the weekday for the Paschal full moon (0=Sunday, 
		1=Monday, etc.) 
		L is the number of days from 21 March to the Sunday on or before 
		the Paschal full moon (a number between -6 and 28) 
		*/ 
		if($Year == null) {
			$Year = date("Y", time());
		}

		$G = $Year % 19; 
		$C = (int)($Year / 100); 
		$H = (int)($C - (int)($C / 4) - (int)((8*$C+13) / 25) + 19*$G + 15) % 30; 
		$I = (int)$H - (int)($H / 28)*(1 - (int)($H / 28)*(int)(29 / ($H + 1))*((int)(21 - $G) / 11)); 
		$J = ($Year + (int)($Year/4) + $I + 2 - $C + (int)($C/4)) % 7; 
		$L = $I - $J; 
		$m = 3 + (int)(($L + 40) / 44); 
		$d = $L + 28 - 31 * ((int)($m / 4)); 
		$y = $Year; 
		$E = mktime(0,0,0, $m, $d, $y); 

		return $E; 
	}
}