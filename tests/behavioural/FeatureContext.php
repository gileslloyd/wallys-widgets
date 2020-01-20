<?php

use Behat\Behat\Context\Context;
use Widget\PackAllocationService;
use Widget\WidgetPack;
use Widget\PackAllocationRule;
use Widget\PackAllocationResponse;
use Widget\WidgetOrderRequest;
use Infrastructure\Domain\Widget\InMemoryPackRepository;

require_once 'tests/behavioural/context/bootstrap.php';

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
	private PackAllocationService $allocationService;

	private PackAllocationResponse $allocation;

	/**
	 * @Given /^the pack sizes are (\d+), (\d+), (\d+), (\d+) and (\d+)$/
	 */
	public function thePackSizesAreAnd($arg1, $arg2, $arg3, $arg4, $arg5)
	{
		$repository = new InMemoryPackRepository();

		foreach (func_get_args() as $packSize) {
			$repository->add(new WidgetPack($packSize));
		}

		$this->allocationService = new PackAllocationService($repository, new PackAllocationRule());
	}

	/**
	 * @When /^I order (.*) widgets$/
	 */
	public function iOrderWidgets($ordersize)
	{
		$this->allocation = $this->allocationService->handle(
			new WidgetOrderRequest($ordersize)
		);
	}

	/**
	 * @Then /^I should be allocated (.*) packs of (\d+)$/
	 */
	public function iShouldBeAllocatedPacksOf($expectedAllocation, $packSize)
	{
		$actualAllocation = $this->getNumberOfPacksOfSize($packSize);

		if ($actualAllocation != $expectedAllocation) {
			throw new \Exception(
				sprintf(
					'We\'ve been allocated %s packs of %s instead of %s',
					$actualAllocation,
					$packSize,
					$expectedAllocation
				)
			);
		}
	}

	private function getNumberOfPacksOfSize(int $packSize): int
	{
		$count = 0;

		foreach ($this->allocation->getAllocatedPacks() as $pack) {
			($pack->getPackSize() === $packSize) and $count++;
		}

		return $count;
	}
}
