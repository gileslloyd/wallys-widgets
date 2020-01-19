<?php
declare(strict_types=1);

namespace Controller\Trader;

use Response\ErrorDetails;
use Response\ErrorResponse;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class TagController extends \Controller
{
	public function add(Request $request, Response $response, array $args): Response
	{
		try {
			$this->message_bus->async(
				'fmf-tag',
				[
					'role' => 'trader',
					'cmd' => 'add',
					'payload' => [
						'traderId' => $args['id'],
						'tag' => $request->getParsedBody()['tag'],
					],
				]
			);

			$api_response = ['success' => true];
		} catch (\Exception $exception) {
			$api_response = new ErrorResponse('Failed to add tag');
			$exception_string = get_class($exception) . "[{$exception->getFile()}:{$exception->getLine()}]";
			$api_response->addError(new ErrorDetails(strval($exception->getCode()), $exception->getMessage(), $exception_string));
		}

		return $this->renderer->render($request, $response, is_array($api_response) ? $api_response : $api_response->toArray());
	}
}
