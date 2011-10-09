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
	 * @param mixed $person1 Person1
	 * @param mixed $person2 Person2
	 * @return Float
	 */
	public function getSimilarity( $preferences, $person1, $person2 );
}
?>