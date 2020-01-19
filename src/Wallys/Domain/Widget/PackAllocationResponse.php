<?php

declare(strict_types=1);

namespace Widget;

class PackAllocationResponse
{
	private int $requestedWidgets;

	private array $allocatedPacks;

	private int $totalWidgets;

	/**
	 * @param int $requestedWidgets
	 * @param WidgetPack[] $allocatedPacks
	 * @param int $totalWidgets
	 */
	public function __construct(int $requestedWidgets, array $allocatedPacks, int $totalWidgets)
	{
		$this->requestedWidgets = $requestedWidgets;
		$this->allocatedPacks = $allocatedPacks;
		$this->totalWidgets = $totalWidgets;
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
		return $this->totalWidgets;
	}
}
