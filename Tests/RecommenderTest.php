<?php
require_once dirname(__file__).'/../Haku/autoload.php';

use Haku\Recommender;

/**
 * Pearson similarity calculator test
 *
 * @author	Steven Ellis
 * @package	Haku
 */
class RecommenderTest extends PHPUnit_Framework_TestCase {
	
	private function getMovieDataVSmall(){
		return include dirname(__file__).'/../SampleData/movies_vsmall.php';
	}
	
	public function testGetClosestAlgorithmSpecified(){
		$recommender = new Recommender();
		$vsmallMovieData = $this->getMovieDataVSmall();
		$closest = $recommender->getClosest($vsmallMovieData, "Toby", 3, "\Haku\SimilarityCalculators\PearsonSimilarityCalculator");
		$this->assertTrue(is_array($closest));
		
		//Check we have the correct number of people
		$this->assertEquals(3, count($closest));
		
		//And that the scores are correct
		$this->assertEquals(0.99124, $closest['Lisa Rose'], '', 0.05);
		$this->assertEquals(0.92447, $closest['Mick LaSalle'], '', 0.05);
		$this->assertEquals(0.89340, $closest['Claudia Puig'], '', 0.05);
		
		//And in the correct order
		$first = array_shift($closest);
		$second = array_shift($closest);
		$third = array_shift($closest);
		$this->assertEquals(0.99124, $first, '', 0.05);
		$this->assertEquals(0.92447, $second, '', 0.05);
		$this->assertEquals(0.89340, $third, '', 0.05);
	}
}