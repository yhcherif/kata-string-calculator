<?php

class StringCalculator
{
	const MAX_NUMBER = 1000;

	/**
	 * Find fum on numbers
	 * @param String $numbers
	 * @return Integer
	 */
    public function add($numbers)
    {

    	$sum = $this->filterQuery($numbers);

    	$total = 0;
    	$negatives = [];
        foreach ($sum as $value) {
        	if ($value >= self::MAX_NUMBER) {
        		continue;
        	}
        	if ($value < 0 ) {
        		$negatives[] = $value;
        		continue;
        	}
        	$total += $value;
        }

        if (!empty($negatives)) {
        	throw new \InvalidArgumentException("The negative numbers are not allowed : ". implode(",", $negatives));
        }

        return $total;
    }


    /**
     * convert an array elements into int
     * @param  array $numbers
     * @return array
     */
    function parse($numbers)
    {
    	return array_map("intval", $numbers);
    }

    /**
     * Apply regex on a query, and parse all elements to int
     * @param  string $query
     * @return array
     */
    function filterQuery($query)
    {
    	$matches = null;
    	$delimiter = ",|\\\n";
    	$found = preg_match("@^//(\[?.+\]?)|(.{1})\\n@", $query, $matches);

    	if ($found == 1) {
    		$patterns = explode("\n", $matches[1]);
    		$delimiter .= "|".preg_replace("@\]\[@", "]|[", $matches[1]);
    		$query = preg_replace("@^//(.+)\\\n@", "", $query);
    	}

    	return $this->parse( preg_split("@($delimiter)@", $query));
    }
}
