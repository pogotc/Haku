<?php
namespace Haku\SimilarityCalculators;

use Haku\SimilarityCalculators\SimilarityCalculatorInterface;

/**
 * Euclidean similarity calculator
 *
 * @author	Steven Ellis
 * @package	Haku
 */
class EuclideanSimilarityCalculator implements SimilarityCalculatorInterface {

	/**
	 * Get similarity
	 * 
	 * @param mixed $preferences Preferences
	 * @param mixed $person1 Person1
	 * @param mixed $person2 Person2
	 * @return Float
	 */
	public function getSimilarity( $preferences, $person1, $person2 ) {
		$person1Prefs = array_key_exists($person1, $preferences) ? $preferences[$person1] : null;
		$person2Prefs = array_key_exists($person2, $preferences) ? $preferences[$person2] : null;
		
		//If either user has no preferences return nothing
		if($person1Prefs === null || $person2Prefs === null){
			return 0;
		}
		
		$commonPrefs = array_intersect_key($person1Prefs, $person2Prefs);
		
		//Nothing in common? Return 0
		if(count($commonPrefs) == 0){
			return 0;
		}
		$sum = 0;
		foreach($commonPrefs as $key => $val){
			$sum+= pow($person1Prefs[$key] - $person2Prefs[$key], 2);
		}
		
		//Add 1 to avoid divide by zero errors
		$result = 1 / (1 + $sum);
		return  $result;
	}

}
?>