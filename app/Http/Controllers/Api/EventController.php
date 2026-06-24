<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResponse;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Http\JsonResponse;

class EventController extends Controller
{
    public function index(EventService $events): JsonResponse
    {
        return ApiResponse::success('Events retrieved.', EventResource::collection($events->publicEvents()));
    }

    public function show(Event $event): JsonResponse
    {
        return ApiResponse::success('Event retrieved.', new EventResource($event));
    }
}
