<?php
namespace Haku;


/**
 * Recommender
 *
 * @author	Steven Ellis
 * @package	Haku
 */
class Recommender {

	/**
	 * Get default similarity algorithm
	 * 
	 */
	private function getDefaultSimilarityCalculator() {
		return new \Haku\SimilarityCalculators\EuclideanSimilarityCalculator();
	}

	/**
	 * Get closest
	 * 
	 * @param mixed $preferences Preferences
	 * @param mixed $item Item
	 * @param mixed $limit Limit Optional (Defaults to 5)
	 * @param mixed $algorithm Algorithm Optional (Defaults to Euclidean)
	 */
	public function getClosest( $preferences, $item, $limit=5, $algorithm=null ) {
		if(!$algorithm){
			$similarityClass = $this->getDefaultSimilarityCalculator();
		}else{
			$similarityClass = new $algorithm();
		}
		
		$closestItems = array();
		foreach($preferences as $other => $data){
			if($other != $item){
				$similarity = $similarityClass->getSimilarity($preferences, $item, $other);
				$closestItems[$other] = $similarity;
			}
		}

		arsort($closestItems);
		return array_slice($closestItems, 0, $limit);
	}

}
?>