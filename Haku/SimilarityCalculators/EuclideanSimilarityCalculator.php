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
	 * @param mixed $item1 Item1
	 * @param mixed $item2 Item2
	 * @return Float
	 */
	public function getSimilarity( $preferences, $item1, $item2 ) {
		$item1Prefs = array_key_exists($item1, $preferences) ? $preferences[$item1] : null;
		$item2Prefs = array_key_exists($item2, $preferences) ? $preferences[$item2] : null;
		
		//If either user has no preferences return nothing
		if($item1Prefs === null || $item2Prefs === null){
			return 0;
		}
		
		$commonPrefs = array_intersect_key($item1Prefs, $item2Prefs);
		
		//Nothing in common? Return 0
		if(count($commonPrefs) == 0){
			return 0;
		}
		$sum = 0;
		foreach($commonPrefs as $key => $val){
			$sum+= pow($item1Prefs[$key] - $item2Prefs[$key], 2);
		}
		
		//Add 1 to avoid divide by zero errors
		$result = 1 / (1 + $sum);
		return  $result;
	}

}
?>