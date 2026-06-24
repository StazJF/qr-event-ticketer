<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckInRequest;
use App\Services\CheckInService;
use DomainException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CheckInController extends Controller
{
    public function create(): View
    {
        return view('admin.checkin.create');
    }

    public function store(CheckInRequest $request, CheckInService $checkIns): RedirectResponse
    {
        try {
            $ticket = $checkIns->checkIn($request->ticketCode());
        } catch (DomainException $exception) {
            return back()->withErrors(['ticket_code' => $exception->getMessage()])->withInput();
        }

        return back()->with('status', "Approved: {$ticket->full_name} checked in.");
    }
}
