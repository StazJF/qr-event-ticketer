<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterAttendeeRequest;
use App\Models\Event;
use App\Services\EventService;
use App\Services\RegistrationService;
use DomainException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PublicEventController extends Controller
{
    public function index(EventService $events): View
    {
        return view('events.index', ['events' => $events->publicEvents()]);
    }

    public function show(Event $event, EventService $events): View
    {
        return view('events.show', ['event' => $event, 'attendeeCount' => $events->attendeeCount($event)]);
    }

    public function register(RegisterAttendeeRequest $request, Event $event, RegistrationService $registrations): RedirectResponse
    {
        try {
            $attendee = $registrations->register($event, $request->validated());
        } catch (DomainException $exception) {
            return back()->withErrors(['email' => $exception->getMessage()])->withInput();
        }

        return redirect()->route('tickets.show', $attendee->ticket_code);
    }
}
