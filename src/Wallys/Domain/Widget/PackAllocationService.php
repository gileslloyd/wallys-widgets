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
	{}
}
