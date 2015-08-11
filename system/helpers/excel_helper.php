<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');
function excel_create($data, $filename = '', $stream = TRUE){
	require_once("excel/class-excel-xml.inc.php");

	$excel = new Excel_XML();
	$excel->addArray($data);
	$excel->generateXML($filename);
}
?>