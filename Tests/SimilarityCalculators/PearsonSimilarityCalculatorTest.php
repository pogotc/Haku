<?php
require_once dirname(__file__).'/../../Haku/autoload.php';

use Haku\SimilarityCalculators\PearsonSimilarityCalculator;

/**
 * Pearson similarity calculator test
 *
 * @author	Steven Ellis
 * @package	Backstage CMS
 */
class PearsonSimilarityCalculatorTest extends PHPUnit_Framework_TestCase {
	
	private function getMovieDataVSmall(){
		return include dirname(__file__).'/../../SampleData/movies_vsmall.php';
	}
	
	public function testAutoload(){
		$edc = new PearsonSimilarityCalculator();
		$this->assertEquals(get_class($edc), "Haku\SimilarityCalculators\PearsonSimilarityCalculator");
		
		$vsmallMovieData = $this->getMovieDataVSmall();
	}
	
	public function testMadeUpUser(){
		$edc = new PearsonSimilarityCalculator();
		$vsmallMovieData = $this->getMovieDataVSmall();
		$this->assertEquals(0, $edc->getSimilarity($vsmallMovieData, 'Lisa Rose', 'Fake Name'));
	}
	
	public function testNothingInCommon(){
		$edc = new PearsonSimilarityCalculator();
		$vsmallMovieData = $this->getMovieDataVSmall();
		$this->assertEquals(0, $edc->getSimilarity($vsmallMovieData, 'Toby', 'Fred'));
	}
	
	public function testRealUsers(){
		$edc = new PearsonSimilarityCalculator();
		$vsmallMovieData = $this->getMovieDataVSmall();
		$this->assertEquals(0.396, $edc->getSimilarity($vsmallMovieData, 'Lisa Rose', 'Gene Seymour'), '', 0.05);
		$this->assertEquals(0.396, $edc->getSimilarity($vsmallMovieData, 'Gene Seymour', 'Lisa Rose'), '', 0.05);
		$this->assertEquals(0.662, $edc->getSimilarity($vsmallMovieData, "Jack Matthews", "Toby"), '', 0.05);		
		$this->assertEquals(0.662, $edc->getSimilarity($vsmallMovieData, "Toby", "Jack Matthews"), '', 0.05);
	}
}
?>