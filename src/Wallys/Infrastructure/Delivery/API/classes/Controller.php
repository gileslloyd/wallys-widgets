<?php
declare(strict_types=1);

use RKA\ContentTypeRenderer\Renderer;

abstract class Controller
{
	/**
	 * @var League\Tactician\CommandBus
	 */
	protected $command_bus;

	/**
	 * @var League\Container\Container
	 */
	protected $container;

	/**
	 * @var \RKA\ContentTypeRenderer\Renderer
	 */
	protected $renderer;

	/**
	 * @var \Message\MessageBus
	 */
	protected $message_bus;

	public function __construct()
	{
		$this->command_bus = CommandBus::instance();
		$this->container = \DI\Container::instance();
		$this->renderer = new Renderer();
		$this->message_bus = $this->container->get('message_bus');
	}
}
