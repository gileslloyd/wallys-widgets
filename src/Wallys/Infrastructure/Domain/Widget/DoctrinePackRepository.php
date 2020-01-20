<?php

declare(strict_types=1);

namespace Infrastructure\Domain\Widget;

use Repository\DoctrineRepository;
use Widget\WidgetPack;
use Widget\WidgetPackRepository;

class DoctrinePackRepository extends DoctrineRepository implements WidgetPackRepository
{
	const ENTITY_CLASS = WidgetPack::class;
}