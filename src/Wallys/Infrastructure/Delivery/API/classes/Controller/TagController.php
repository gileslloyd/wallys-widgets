<?php
declare(strict_types=1);

namespace Controller;

use Response\ErrorDetails;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class TagController extends \Controller
{
	public function autocomplete(Request $request, Response $response, array $args): Response
	{
		try {
			$api_response = $this->message_bus->sync(
				'fmf-search',
				[
					'role' => 'tag',
					'cmd' => 'autocomplete',
					'payload' => [
						'tag' => $request->getQueryParams()['tag'] ?? [],
					],
				]
			);
		} catch (\Exception $exception) {
			$response = new Error('Could not find tag');
			$exception_string = get_class($exception) . "[{$exception->getFile()}:{$exception->getLine()}]";
			$api_response->addError(new ErrorDetails(strval($exception->getCode()), $exception->getMessage(), $exception_string));
		}

		return $this->renderer->render($request, $response, $api_response->toArray());
	}
}
