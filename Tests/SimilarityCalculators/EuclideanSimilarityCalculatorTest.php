<?php
require_once dirname(__file__).'/../../Haku/autoload.php';

use Haku\SimilarityCalculators\EuclideanSimilarityCalculator;

/**
 * Euclidean similarity calculator test
 *
 * @author	Steven Ellis
 * @package	Backstage CMS
 */
class EuclideanSimilarityCalculatorTest extends PHPUnit_Framework_TestCase {
	
	private function getMovieDataVSmall(){
		return include dirname(__file__).'/../../SampleData/movies_vsmall.php';
	}
	
	public function testAutoload(){
		$edc = new EuclideanSimilarityCalculator();
		$this->assertEquals(get_class($edc), "Haku\SimilarityCalculators\EuclideanSimilarityCalculator");
		
		$vsmallMovieData = $this->getMovieDataVSmall();
	}
	
	public function testMadeUpUser(){
		$edc = new EuclideanSimilarityCalculator();
		$vsmallMovieData = $this->getMovieDataVSmall();
		$this->assertEquals(0, $edc->getSimilarity($vsmallMovieData, 'Lisa Rose', 'Fake Name'));
	}
	
	public function testNothingInCommon(){
		$edc = new EuclideanSimilarityCalculator();
		$vsmallMovieData = $this->getMovieDataVSmall();
		$this->assertEquals(0, $edc->getSimilarity($vsmallMovieData, 'Toby', 'Fred'));
	}
	
	public function testRealUsers(){
		$edc = new EuclideanSimilarityCalculator();
		$vsmallMovieData = $this->getMovieDataVSmall();
		$this->assertEquals(0.184, $edc->getSimilarity($vsmallMovieData, 'Lisa Rose', 'Gene Seymour'), '', 0.05);
		$this->assertEquals(0.184, $edc->getSimilarity($vsmallMovieData, 'Gene Seymour', 'Lisa Rose'), '', 0.05);
		$this->assertEquals(0.117, $edc->getSimilarity($vsmallMovieData, "Jack Matthews", "Toby"), '', 0.05);		
		$this->assertEquals(0.117, $edc->getSimilarity($vsmallMovieData, "Toby", "Jack Matthews"), '', 0.05);
	}
}
?>