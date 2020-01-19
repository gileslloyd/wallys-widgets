<?php
declare(strict_types=1);

namespace Controller\User;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use User\UpdateUserRequest;

class UserController extends \Controller
{
	public function create(Request $request, Response $response, array $args): Response
	{
		try {
			$api_response = $this->message_bus->sync(
				'fmf-user',
				[
					'role' => 'user',
					'cmd' => 'create',
					'payload' => $request->getParsedBody(),
				]
			);
		} catch (\Exception $exception) {
			$response = new ErrorResponse('Failed to get Employees');
			$exception_string = get_class($exception) . "[{$exception->getFile()}:{$exception->getLine()}]";
			$api_response->addError(new ErrorDetails(strval($exception->getCode()), $exception->getMessage(), $exception_string));
		}

		return $this->renderer->render($request, $response, $api_response->toArray());
	}

	public function update(Request $request, Response $response, array $args): Response
	{
		try {
			$this->command_bus->handle(
				new UpdateUserRequest(
					array_merge(
						['id' => $args['id']],
						$request->getParsedBody()
					)
				)
			);
		} catch (\Exception $exception) {
			$response = new ErrorResponse('Failed to get Employees');
			$exception_string = get_class($exception) . "[{$exception->getFile()}:{$exception->getLine()}]";
			$api_response->addError(new ErrorDetails(strval($exception->getCode()), $exception->getMessage(), $exception_string));
		}

		return $this->renderer->render($request, $response, ['success' => true]);
	}

	/*public function all(Request $request, Response $response, array $args): Response
	{
		try {
			$employees = $this->get_employee_service->getAll();

			$api_response = new SuccessCollectionResponse($employees, 'Found Employees');
		} catch (\Exception $exception) {
			$api_response = new ErrorResponse('Failed to get Employees');
			$exception_string = get_class($exception) . "[{$exception->getFile()}:{$exception->getLine()}]";
			$api_response->addError(new ErrorDetails(strval($exception->getCode()), $exception->getMessage(), $exception_string));
		}

		return $this->renderer->render($request, $response, $api_response->toArray());
	}

	public function getByID(Request $request, Response $response, array $args)
	{
		try {
			$api_response = new SuccessSingleResponse(
				$this->get_employee_service->getByID($args['id']),
				'Employee found'
			);
		} catch (EmployeeNotFoundException $e) {
			$response = $response->withStatus(404);
			$api_response = new ErrorResponse($e->getMessage(), 404);
		} catch (\EmployeeDomainException $e) {
			$response = $response->withStatus(500);
			$api_response = new ErrorResponse($e->getMessage(), 500);
		} catch (\Exception $e) {
			$api_response = new ErrorResponse('An unknown error occurred', 500);
		}

		return $this->renderer->render($request, $response, $api_response->toArray());
	}

	public function getAbsent(Request $request, Response $response)
	{
		try {
			$api_response = $this->absent_employee_service->now();
		} catch (\EmployeeDomainException $e) {
			$response = $response->withStatus(500);
			$api_response = new ErrorResponse($e->getMessage(), 500);
		} catch (\Exception $e) {
			var_dump($e); die;
			$api_response = new ErrorResponse('An unknown error occurred', 500);
		}

		return $this->renderer->render($request, $response, $api_response->toArray());
	}*/
}
