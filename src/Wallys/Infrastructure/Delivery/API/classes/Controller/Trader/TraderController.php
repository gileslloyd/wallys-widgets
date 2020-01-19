<?php
declare(strict_types=1);

namespace Controller\Trader;

use Message\MessagePayload;
use Response\ErrorDetails;
use Response\ErrorResponse;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Trader\CreateTraderRequest;

class TraderController extends \Controller
{
	public function create(Request $request, Response $response, array $args): Response
	{
		try {
			$api_response = array_merge(
				$this->createTrader($request)->toArray(),
				$this->login($request)->toArray()
			);
		} catch (\Exception $exception) {
			$api_response = new ErrorResponse('Failed to create trader');
			$exception_string = get_class($exception) . "[{$exception->getFile()}:{$exception->getLine()}]";
			$api_response->addError(new ErrorDetails(strval($exception->getCode()), $exception->getMessage(), $exception_string));
			$api_response = $api_response->toArray();
		}

		return $this->renderer->render($request, $response, $api_response);
	}

	public function get(Request $request, Response $response, array $args): Response
	{
		try {
			$api_response = $this->message_bus->scatter(
				'trader',
				'info',
				[
					'role' => 'info',
					'cmd' => 'get',
					'payload' => ['id' => $args['id']],
				]
			);
		} catch (\Exception $exception) {
			$response = new Error('Failed to create trader');
			$exception_string = get_class($exception) . "[{$exception->getFile()}:{$exception->getLine()}]";
			$api_response->addError(new ErrorDetails(strval($exception->getCode()), $exception->getMessage(), $exception_string));
		}

		return $this->renderer->render($request, $response, $api_response->toArray());
	}

	public function me(Request $request, Response $response, array $args): Response
	{
		try {
			$api_response = $this->message_bus->scatter(
				'trader',
				'info',
				[
					'role' => 'info',
					'cmd' => 'get',
					'payload' => ['id' => $request->getAttribute('userId')],
				]
			);
		} catch (\Exception $exception) {
			$response = new Error('Failed to create trader');
			$exception_string = get_class($exception) . "[{$exception->getFile()}:{$exception->getLine()}]";
			$api_response->addError(new ErrorDetails(strval($exception->getCode()), $exception->getMessage(), $exception_string));
		}

		return $this->renderer->render($request, $response, $api_response->toArray());
	}

	private function createTrader(Request $request): MessagePayload
	{
		return $this->command_bus->handle(
			new CreateTraderRequest($request->getParsedBody())
		);
	}

	private function login(Request $request): MessagePayload
	{
		return $this->message_bus->sync(
			'fmf-auth',
			[
				'role' => 'auth',
				'cmd' => 'login',
				'payload' => [
					'emailAddress' => $request->getParsedBody()['emailAddress'],
					'password' => $request->getParsedBody()['password'],
				],
			]
		);
	}
}
