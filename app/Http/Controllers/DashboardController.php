<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $totalUsers = User::count();
        // $totalTickets = Ticket::count();
        // $openTickets = Ticket::opened()->count();
        // $closedTickets = Ticket::closed()->count();

        return view('dashboard', compact('totalUsers'));
    }
}
