<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckInRequest;
use App\Http\Resources\ApiResponse;
use App\Http\Resources\TicketResource;
use App\Services\CheckInService;
use DomainException;
use Illuminate\Http\JsonResponse;

class CheckInController extends Controller
{
    public function __invoke(CheckInRequest $request, CheckInService $checkIns): JsonResponse
    {
        try {
            $ticket = $checkIns->checkIn($request->ticketCode())->load('event');
        } catch (DomainException $exception) {
            return ApiResponse::error($exception->getMessage());
        }

        return ApiResponse::success('Ticket checked in.', new TicketResource($ticket));
    }
}
