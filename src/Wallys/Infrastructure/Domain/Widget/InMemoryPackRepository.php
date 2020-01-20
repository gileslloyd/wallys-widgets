<?php

declare(strict_types=1);

namespace Infrastructure\Domain\Widget;

use Widget\WidgetPack;
use Widget\WidgetPackRepository;

class InMemoryPackRepository implements WidgetPackRepository
{
	/**
	 * @var WidgetPack[]
	 */
	private array $packs = [];

	public function add(WidgetPack $pack): void
	{
		$this->packs[] = $pack;
	}

	/**
	 * @return WidgetPack[]
	 */
	public function getAll(): array
	{
		return $this->packs;
	}
}
