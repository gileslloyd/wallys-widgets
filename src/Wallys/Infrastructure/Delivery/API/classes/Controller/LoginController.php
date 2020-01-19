<?php
declare(strict_types=1);

namespace Controller;

use Response\ErrorDetails;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class LoginController extends \Controller
{
	public function login(Request $request, Response $response, array $args): Response
	{
		try {
			$api_response = $this->message_bus->sync(
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
		} catch (\Exception $exception) {
			$response = new Error('Failed to create trader');
			$exception_string = get_class($exception) . "[{$exception->getFile()}:{$exception->getLine()}]";
			$api_response->addError(new ErrorDetails(strval($exception->getCode()), $exception->getMessage(), $exception_string));
		}

		return $this->renderer->render($request, $response, $api_response->toArray());
	}
}
