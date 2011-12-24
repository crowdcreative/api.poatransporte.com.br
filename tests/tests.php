<?php

require dirname(__FILE__).'/../src/poatransporte.php';

class PoaTransporteTestCase extends PHPUnit_Framework_TestCase {
	
	private $buses;
	private $lotacoes;

	protected function setUp()
	{
		parent::setUp();
		$this->buses = PoaTransporte::onibus();
		$this->lotacoes = PoaTransporte::lotacoes();
	}

	public function testDataLoad()
	{
		$this->assertEquals(gettype($this->buses), 'object');
		$this->assertEquals(gettype($this->lotacoes), 'object');
	}

	public function testCollections()
	{
		$this->assertEquals(get_class($this->buses), 'PoaTransporte_Collection');
		$this->assertGreaterThan(1, count($this->buses));
		$this->assertEquals(get_class($this->buses[0]), 'PoaTransporte_Unit');

		$this->assertEquals(get_class($this->lotacoes), 'PoaTransporte_Collection');
		$this->assertGreaterThan(1, count($this->lotacoes));
		$this->assertEquals(get_class($this->lotacoes[0]), 'PoaTransporte_Unit');
	}

	public function testUnitData()
	{
		$bus = $this->buses[0];
		$this->assertNotNull(@$bus->nome);
		$this->assertNotNull(@$bus->codigo);

		$lotacao = $this->lotacoes[0];
		$this->assertNotNull(@$lotacao->nome);
		$this->assertNotNull(@$lotacao->codigo);
	}

	public function testUnitRoute()
	{
		$bus = $this->buses[0];
		$route = $bus->route();
		$this->assertGreaterThan(1, count($route));

		$point = array_pop($route);;
		$this->assertObjectHasAttribute('lat', $route[0]);
		$this->assertObjectHasAttribute('lng', $route[0]);
	}

}