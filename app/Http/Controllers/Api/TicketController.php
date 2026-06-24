<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResponse;
use App\Http\Resources\TicketResource;
use App\Services\TicketService;
use Illuminate\Http\JsonResponse;

class TicketController extends Controller
{
    public function __invoke(string $code, TicketService $tickets): JsonResponse
    {
        $ticket = $tickets->findByCode($code) ?? abort(404);

        return ApiResponse::success('Ticket retrieved.', new TicketResource($ticket));
    }
}
