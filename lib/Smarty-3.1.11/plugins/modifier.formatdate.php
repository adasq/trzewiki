<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsFilter
 */

/**
 * Smarty htmlspecialchars variablefilter plugin
 *
 * @param string                   $source input string
 * @param Smarty_Internal_Template $smarty Smarty object
 * @return string filtered output
 */

function smarty_modifier_formatdate($date){

	$date1 = new DateTime($date);
	$date2 = new DateTime();//date("Y-m-d H:i:s")
	$diff = $date2->diff($date1);

	if($diff->y > 0){
		$out= ($diff->y==1? '1 rok' : $diff->y.' lata').' '.($diff->m>=1? $diff->m.' mies.':'');
	}elseif($diff->m > 0){
		$out= $diff->m.' mies.';
	}elseif($diff->d > 0){
		$tyg=round($diff->d/7);
		$out=  ($diff->d>=7) ? ($tyg==1? '1 tydz.':$tyg.' tyg.') : ($diff->d==1? '1 dzień '.($diff->h>0? $diff->h.' godz.':'') : $diff->d.' dni');
	}elseif($diff->h > 0){
		$out= $diff->h.' godz.';
	}elseif($diff->i > 0){
		$out= $diff->i.' min.';
	}else{
		$out= $diff->s.' sec.';
	}

	return $out.' temu.';
}










?>