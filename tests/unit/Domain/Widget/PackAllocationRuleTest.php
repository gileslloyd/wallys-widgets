<?php

declare(strict_types=1);

use Widget\PackAllocationRule;

class PackAllocationRuleTest extends PHPUnit\Framework\TestCase
{
	/**
	 * @var PackAllocationRule
	 */
	private PackAllocationRule $rule;

	public function setUp()
	{
		$this->rule = new PackAllocationRule();
	}

	/**
	 * @dataProvider packAllocations
	 * @param $requiredWidgets
	 * @param $num_250
	 * @param $num_500
	 * @param $num_1000
	 * @param $num_2000
	 * @param $num_5000
	 */
	public function testTheCorrectPacksAreAllocatedForRequestedNumberOfWidgets(
		$requiredWidgets,
		$num_250,
		$num_500,
		$num_1000,
		$num_2000,
		$num_5000
	) {
		$allocation = $this->rule->calculatePackAllocation(
			$requiredWidgets,
			[1000, 500, 5000, 250, 2000]
		);

		$error_message = '%s packs of %s were allocated rather than %s';

		$this->assertEquals($num_250, $allocation[250] ?? 0, sprintf($error_message, $allocation[250] ?? 0, 250, $num_250));
		$this->assertEquals($num_500, $allocation[500] ?? 0, sprintf($error_message, $allocation[500] ?? 0, 500, $num_500));
		$this->assertEquals($num_1000, $allocation[1000] ?? 0, sprintf($error_message, $allocation[1000] ?? 0, 1000, $num_1000));
		$this->assertEquals($num_2000, $allocation[2000] ?? 0, sprintf($error_message, $allocation[2000] ?? 0, 2000, $num_2000));
		$this->assertEquals($num_5000, $allocation[5000] ?? 0, sprintf($error_message, $allocation[5000] ?? 0, 5000, $num_5000));
	}

	public function packAllocations(): array
	{
		return [
			[1, 1, 0, 0, 0, 0],
			[250, 1, 0, 0, 0, 0],
			[251, 0, 1, 0, 0, 0],
			[501, 1, 1, 0, 0, 0],
			[12001, 1, 0, 0, 1, 2],
		];
	}
}
