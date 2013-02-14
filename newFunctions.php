<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2013 DasLampe <daslampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// | License: GPLv3 
// +----------------------------------------------------------------------+

/**
 * Throw exception if $file not exists.
 *
 * @param $file path to file
 * @return void
 * @author DasLampe
 **/
function exception_include($file) {
	if(file_exists($file) === false) {
		throw new Exception("File ".$file." not exists. Can not include.");
	}
	include_once($file);
}