<?php

declare(strict_types=1);

namespace Widget;

class PackAllocationResponse
{
	private int $requestedWidgets;

	private array $allocatedPacks;

	/**
	 * @param int $requestedWidgets
	 * @param WidgetPack[] $allocatedPacks
	 */
	public function __construct(int $requestedWidgets, array $allocatedPacks)
	{
		$this->requestedWidgets = $requestedWidgets;
		$this->allocatedPacks = $allocatedPacks;
	}

	/**
	 * @return int
	 */
	public function getRequestedWidgets(): int
	{
		return $this->requestedWidgets;
	}

	/**
	 * @return WidgetPack[]
	 */
	public function getAllocatedPacks(): array
	{
		return $this->allocatedPacks;
	}

	/**
	 * @return int
	 */
	public function getTotalWidgets(): int
	{
		$totalWidgets = 0;

		foreach ($this->allocatedPacks as $pack) {
			$totalWidgets += $pack->getPackSize();
		}

		return $totalWidgets;
	}
}
