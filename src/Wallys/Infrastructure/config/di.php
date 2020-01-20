<?php

return [
	'pack_repository' => [
		\Infrastructure\Domain\Widget\DoctrinePackRepository::class,
		[],
		\DI\InjectionType::SHARED
	],
	'pack_allocation_service' => [
		\Widget\PackAllocationService::class,
		[
			'pack_repository',
			new \Widget\PackAllocationRule(),
		]
	],
];
