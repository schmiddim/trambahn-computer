<?php
namespace TrambahnComputer;


class Departures
{

	/**
	 * @var \Mvg\Factories\Departures
	 */
	protected $departuresFactory = null;

	/**
	 * @var mixed
	 */
	protected $filter = null;

	protected $colors = array();

	/**
	 * Departures constructor.
	 * @param $departuresFactory
	 * @param array $colors
	 * @param null $filter
	 */
	public function __construct($departuresFactory, $colors = array(), $filter = null)
	{
		$this->setDeparturesFactory($departuresFactory);
		$this->setColors($colors);
		$this->setFilter($filter);

	}

	/**
	 * @return mixed
	 */
	protected function getFilter()
	{
		return $this->filter;
	}

	/**
	 * @param mixed $filter
	 */
	protected function setFilter($filter)
	{
		$this->filter = $filter;
	}


	/**
	 * @return \Mvg\Factories\Departures
	 */
	protected function getDeparturesFactory()
	{
		return $this->departuresFactory;
	}


	/**
	 * @param \Mvg\Factories\Departures $departuresFactory
	 */
	protected function setDeparturesFactory($departuresFactory)
	{
		$this->departuresFactory = $departuresFactory;
	}

	/**
	 * @return array
	 */
	public function getColors()
	{
		return $this->colors;
	}

	/**
	 * @param array $colors
	 */
	public function setColors($colors)
	{
		$this->colors = $colors;
	}

	/**
	 * @return array|null
	 */
	public function getOutput()
	{


		$returnValue = array();
		$returnValue['departures'] = array();
		$departuresItems = $this->getDeparturesFactory()->getItems($this->getFilter());
		if (count($departuresItems) == 0) {
			return null;
		}
		foreach ($departuresItems as $departureObject) {
			$returnValue['departures'][] = intval($departureObject->time);

		}
		$returnValue['name'] = $departureObject->lineNumber;
		$returnValue['color'] = $this->getColorForLineNumber($departureObject->lineNumber);
		$returnValue['departureCount'] = count($departuresItems);

		return $returnValue;
	}


	/**
	 * @param $lineNumber
	 * @return array
	 */
	protected function getColorForLineNumber($lineNumber)
	{

		if (array_key_exists($lineNumber, $this->getColors())) {
			return $this->getColors()[$lineNumber];
		}
		if (false === array_key_exists('default', $this->getColors())) {
			return array(
				'red' => 255,
				'green' => 127,
				'blue' => 0);
		}
		return $this->getColors()['default'];
	}

}