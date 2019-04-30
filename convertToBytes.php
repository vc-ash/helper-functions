<?php
/**
 *  Convert a byte formatted string (ie. 1,000.50KB) to the full byte value (ie. 1024512).
 *  
 *  @param string $value The value to convert.
 *  @return int Returns the integer value of the byte converted string.
 *  
 *  @details This function converts a byte formatted string into an integer value. Helpful when working with file sizes.
 *  
 *  @author Ash Bulcroft <ashbulcroft@gmail.com>
 */
function convertToBytes($value){
	## DEFAULT BIT UNITS US KEY FOR POWER
	$bit_units = array('B', 'KB', 'MB', 'GB', 'TB');
	
	## EXTRACT UNIT FROM STRING
	$unit = strtoupper(preg_replace('/[\d\.,]+/u', '', $value));
	
	## CONVERT THE STRING TO A NUMBER
	$value = filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	
	## CONVERT UNIT TO POWER BY RETURNING THE KEY OF THE UNIT
	$power = array_search($unit, $bit_units);
	
	## CONVERT THE VALUE TO BITS
	$value = $value * pow(1024, $power);
	
	return $value;
}