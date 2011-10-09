<?php
namespace Haku\SimilarityCalculators;

/**
 * Similarity calculator interface
 *
 * @author	Steven Ellis
 * @package	Haku
 */
interface SimilarityCalculatorInterface {

	/**
	 * Get similarity
	 * 
	 * @param mixed $preferences Preferences
	 * @param mixed $item1 Item1
	 * @param mixed $item2 Item2
	 * @return Float
	 */
	public function getSimilarity( $preferences, $item1, $item2 );
}
?>