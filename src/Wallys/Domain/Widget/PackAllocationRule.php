<?php

declare(strict_types=1);

namespace Widget;

class PackAllocationRule
{
	private int $totalWidgets;

	public function calculatePackAllocation(int $requiredWidgets, array $packSizes): array
	{
		$packs = [];
		$this->totalWidgets = 0;
		asort($packSizes);
		$packSizes = array_values($packSizes);

		while ($this->totalWidgets < $requiredWidgets) {
			foreach ($this->getNext($packSizes, $requiredWidgets) as $pack) {

				if (!isset($packs[$pack])) {
					$packs[$pack] = 0;
				}

				$packs[$pack] += 1;
				$this->totalWidgets += $pack;
			}
		}

		return $packs;
	}

	private function getNext(array $packSizes, int $requiredWidgets): array
	{
		$single = $this->getSingle($packSizes, $requiredWidgets);
		$multiple = $this->getMultiple($packSizes, $requiredWidgets);

		if ($single && $multiple) {
			if ($this->getExcessWidgets($requiredWidgets, [$single]) > $this->getExcessWidgets($requiredWidgets, $multiple)) {
				return $multiple;
			}

			return [$single];
		}

		return [$packSizes[count($packSizes)-1]];
	}

	private function getSingle(array $packSizes, int $requiredWidgets): ?int
	{
		foreach ($packSizes as $key => $size) {
			if (($this->totalWidgets + $size) >= $requiredWidgets) {
				return $size;
			}
		}

		return null;
	}

	private function getMultiple(array $packSizes, int $requiredWidgets): ?array
	{
		for ($pack1 = 0; $pack1 < count($packSizes)-1; $pack1++) {
			for ($pack2 = ($pack1 + 1); $pack2 < count($packSizes)-1; $pack2++) {
				if (($this->totalWidgets + $packSizes[$pack1] + $packSizes[$pack2]) >= $requiredWidgets) {
					return [$packSizes[$pack1], $packSizes[$pack2]];
				}
			}
		}

		return null;
	}

	private function getExcessWidgets(int $requiredWidgets, array $packs): int
	{
		return array_sum($packs) - $requiredWidgets - $this->totalWidgets;
	}
}
