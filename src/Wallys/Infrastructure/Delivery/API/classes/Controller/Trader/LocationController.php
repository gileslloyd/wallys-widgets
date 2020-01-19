<?php
declare(strict_types=1);

namespace Controller\Trader;

use Slim\Psr7\Request;
use Slim\Psr7\Response;

class LocationController extends \Controller
{
	public function add(Request $request, Response $response, array $args): Response
	{
		try {
			$this->message_bus->async(
				'fmf-location',
				[
					'role' => 'location',
					'cmd' => 'add',
					'payload' => array_merge(
						['traderId' => $request->getAttribute('userId')],
						$request->getParsedBody()
					),
				]
			);

			$api_response = ['success' => true];
		} catch (\Exception $exception) {
			$response = new ErrorResponse('Error adding location');
			$exception_string = get_class($exception) . "[{$exception->getFile()}:{$exception->getLine()}]";
			$api_response->addError(new ErrorDetails(strval($exception->getCode()), $exception->getMessage(), $exception_string));
		}

		return $this->renderer->render($request, $response, is_array($api_response) ? $api_response :$api_response->toArray());
	}
}
