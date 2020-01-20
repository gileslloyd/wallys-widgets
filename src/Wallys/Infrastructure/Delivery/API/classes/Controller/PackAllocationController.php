<?php

declare(strict_types=1);

namespace Controller;

use Response\SuccessSingleResponse;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Widget\WidgetOrderRequest;
use Response\ErrorDetails;
use Response\ErrorResponse;

class PackAllocationController extends \Controller
{
	public function get(Request $request, Response $response, array $args): Response
	{
		try {
			$packAllocation = $this->command_bus->handle(
				new WidgetOrderRequest((int) $request->getQueryParams()['widgets'] ?? 0)
			);

			$api_response = new SuccessSingleResponse($packAllocation, 'Successful Pack Allocation');
		} catch (\Exception $e) {
			$api_response = new ErrorResponse('Failed to get Employees');
			$exception_string = get_class($e) . "[{$e->getFile()}:{$e->getLine()}]";
			$api_response->addError(new ErrorDetails(strval($e->getCode()), $e->getMessage(), $exception_string));
		}

		return $this->renderer->render($request, $response, $api_response->toArray());
	}
}
