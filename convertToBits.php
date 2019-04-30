<?php
/**
 *  Convert a bit formatted string (ie. 5,000.47k) to the full bit value (ie. 5000470).
 *  
 *  @param string $value The value to convert.
 *  @return int Returns the integer value of the bit converted string.
 *  
 *  @details This function converts a bit formatted string into an integer value. Helpful when working with video bitrates.
 *  
 *  @author Ash Bulcroft <ashbulcroft@gmail.com>
 */
function convertToBits($value){
	## DEFAULT BIT UNITS US KEY FOR POWER
	$bit_units = array('b', 'k', 'm', 'g', 't');
	
	## EXTRACT UNIT FROM STRING
	$unit = strtolower(preg_replace('/[\d\.,]+/u', '', $value));
    
	## CONVERT THE STRING TO A NUMBER
	$value = filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	
	## CONVERT UNIT TO POWER BY RETURNING THE KEY OF THE UNIT
	$power = array_search($unit, $bit_units);
	
	## CONVERT THE VALUE TO BITS
	$value = $value * pow(1000, $power);
	
	return $value;
}
