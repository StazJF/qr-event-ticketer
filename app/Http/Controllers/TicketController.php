<?php

namespace App\Http\Controllers;

use App\Services\TicketService;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class TicketController extends Controller
{
    public function show(string $code, TicketService $tickets): View
    {
        $ticket = $tickets->findByCode($code) ?? abort(404);

        return view('tickets.show', ['ticket' => $ticket]);
    }

    public function download(string $code, TicketService $tickets): StreamedResponse
    {
        $ticket = $tickets->findByCode($code) ?? abort(404);

        return Storage::disk('public')->download($ticket->qr_code_path, "{$ticket->ticket_code}.png");
    }
}
