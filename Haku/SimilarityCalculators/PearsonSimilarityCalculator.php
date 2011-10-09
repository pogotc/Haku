<?php
namespace Haku\SimilarityCalculators;

use Haku\SimilarityCalculators\SimilarityCalculatorInterface;

/**
 * Pearson similarity calculator
 *
 * @author	Steven Ellis
 * @package	Haku
 */
class PearsonSimilarityCalculator implements SimilarityCalculatorInterface {

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
		$commonPrefCount = count($commonPrefs);
		
		//Nothing in common? Return 0
		if($commonPrefCount == 0){
			return 0;
		}
		$itm1Sum = 0;
		$itm2Sum = 0;
		$itm1SumOfSquares = 0;
		$itm2SumOfSquares = 0;
		$sumOfProducts = 0;
		foreach($commonPrefs as $key => $val){
			$p1Score = $item1Prefs[$key];
			$p2Score = $item2Prefs[$key];
			
			//Sum the preferences
			$itm1Sum+= $p1Score;
			$itm2Sum+= $p2Score;
			
			//Sum up the squares
			$itm1SumOfSquares+= pow($p1Score, 2);
			$itm2SumOfSquares+= pow($p2Score, 2);
			
			//Sum up the products
			$sumOfProducts+= $p1Score * $p2Score;
		}
		
		$numerator = $sumOfProducts - ($itm1Sum * $itm2Sum / $commonPrefCount);
		$denominator = sqrt(  
						($itm1SumOfSquares-pow($itm1Sum,2) / $commonPrefCount)  * 
						($itm2SumOfSquares-pow($itm2Sum,2) / $commonPrefCount) 
					);
		
		if($denominator == 0){
			return 0;
		}else{
			return $numerator / $denominator;
		}
	}

}
?>