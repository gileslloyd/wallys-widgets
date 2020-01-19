<?php

declare(strict_types=1);

namespace Widget;

class WidgetPack
{
	private int $packSize;

	public function __construct(int $packSize)
	{
		$this->packSize = $packSize;
	}

	/**
	 * @return int
	 */
	public function getPackSize(): int
	{
		return $this->packSize;
	}
}
