<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterAttendeeRequest;
use App\Http\Resources\ApiResponse;
use App\Http\Resources\TicketResource;
use App\Repositories\Contracts\EventRepositoryInterface;
use App\Services\RegistrationService;
use DomainException;
use Illuminate\Http\JsonResponse;

class RegistrationController extends Controller
{
    public function __invoke(
        RegisterAttendeeRequest $request,
        EventRepositoryInterface $events,
        RegistrationService $registrations
    ): JsonResponse {
        $event = $events->find((string) $request->validated('event_id')) ?? abort(404);

        try {
            $ticket = $registrations->register($event, $request->validated())->load('event');
        } catch (DomainException $exception) {
            return ApiResponse::error($exception->getMessage());
        }

        return ApiResponse::success('Registration completed.', new TicketResource($ticket), 201);
    }
}
