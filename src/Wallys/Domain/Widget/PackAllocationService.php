<?php

declare(strict_types=1);

namespace Widget;

class PackAllocationService
{
	private WidgetPackRepository $packRepository;

	private PackAllocationRule $allocationRule;

	public function __construct(
		WidgetPackRepository $packRepository,
		PackAllocationRule $allocationRule
	) {
		$this->packRepository = $packRepository;
		$this->allocationRule = $allocationRule;
	}

	public function handle(WidgetOrderRequest $request): PackAllocationResponse
	{
		$allocation = $this->getPackAllocation($request);

		return new PackAllocationResponse(
			$request->getNumberOfWidgets(),
			$allocation
		);
	}

	/**
	 * @param WidgetOrderRequest $request
	 * @return WidgetPack[]
	 */
	private function getPackAllocation(WidgetOrderRequest $request): array
	{
		$packs = [];

		foreach ($this->getCalculatedPackAllocation($request) as $size => $number) {
			for ($i = 0; $i < $number; $i++) {
				$packs[] = new WidgetPack($size);
			}
		}

		return $packs;
	}

	private function getCalculatedPackAllocation(WidgetOrderRequest $request): array
	{
		return $this->allocationRule->calculatePackAllocation(
			$request->getNumberOfWidgets(),
			$this->getPackSizes()
		);
	}

	private function getPackSizes(): array
	{
		return array_map(
			function ($pack) {
				return $pack->getPackSize();
			},
			$this->packRepository->getAll()
		);
	}
}
