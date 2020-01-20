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
		foreach ($packSizes as $key => $size) {
			if (($this->totalWidgets + $size) >= $requiredWidgets) {
				return [$size];
			} else if (isset($packSizes[$key+1]) && (($this->totalWidgets + $packSizes[$key+1]) >= $requiredWidgets)) {
				return [$packSizes[$key+1]];
			} else if ($multiple = $this->getMultiple($packSizes, $requiredWidgets)) {
				return $multiple;
			}

			return [$packSizes[count($packSizes)-1]];
		}
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
}
