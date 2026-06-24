<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(EventService $events): View
    {
        return view('admin.events.index', ['events' => $events->paginated()]);
    }

    public function create(): View
    {
        return view('admin.events.create');
    }

    public function store(EventRequest $request, EventService $events): RedirectResponse
    {
        $event = $events->create($request->validated());

        return redirect()->route('admin.events.show', $event)->with('status', 'Event created.');
    }

    public function show(Event $event, EventService $events): View
    {
        return view('admin.events.show', ['event' => $event, 'attendeeCount' => $events->attendeeCount($event)]);
    }

    public function edit(Event $event): View
    {
        return view('admin.events.edit', ['event' => $event]);
    }

    public function update(EventRequest $request, Event $event, EventService $events): RedirectResponse
    {
        $events->update($event, $request->validated());

        return redirect()->route('admin.events.show', $event)->with('status', 'Event updated.');
    }

    public function destroy(Event $event, EventService $events): RedirectResponse
    {
        $events->delete($event);

        return redirect()->route('admin.events.index')->with('status', 'Event deleted.');
    }
}
