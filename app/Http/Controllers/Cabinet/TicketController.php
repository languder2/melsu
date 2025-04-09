<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Ticket\Ticket;
use Illuminate\Http\Request;
class TicketController extends Controller
{
    public function list()
    {
        dd(1);
    }
    public function form(?Ticket $ticket)
    {
        return view('cabinet.tickets.form', compact('ticket'));
    }
    public function save(?Ticket $ticket)
    {
        dd($ticket);
    }
}
