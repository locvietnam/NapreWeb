<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty convert_vnd Vietnamese modifier plugin
 * bang.webdeveloper@gmail.com
 *
 * @param string $str
 * @return string
 */
function smarty_modifier_convert_vnd($priceFloat){ 
	
	$priceFloat = $priceFloat+0;
	if($priceFloat == 0) {
		return 'Call';
	}
	
	$arr = explode('.', $priceFloat);
	$priceFloat = $arr[0];
	$priceAfter = !empty($arr[1]) ? '.'.$arr[1] : '';
	
	$symbol = ' đ';
	$symbol_thousand = '.';
	$decimal_place = 0;
	$price = number_format($priceFloat, $decimal_place, '', $symbol_thousand);
	return $price.$priceAfter.$symbol;	
}

?>