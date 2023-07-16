<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
       // decompte
        $totalUsers = User::count();
        $totalTickets = Ticket::count();
        $openTickets =  Ticket::where('status', 'open')->count();
        $closedTickets =  Ticket::where('status', 'closed')->count();
        $deletedTickets = Ticket::onlyTrashed()->count();
        $deletedUsers =  User::onlyTrashed()->count();

        // mettre le pourcentage par jour & par mois
        $currentDate = Carbon::now();

        // Dates du jour précédent
        $previousDay = $currentDate->copy()->subDay();
        $previousDayTickets = Ticket::whereDate('created_at', $previousDay)->count();
    
        // Dates du mois précédent
        $previousMonth = $currentDate->copy()->subMonth();
        $previousMonthTickets = Ticket::whereMonth('created_at', $previousMonth)->count();
    
        // Tickets créés aujourd'hui
        $currentDayTickets = Ticket::whereDate('created_at', $currentDate)->count();
    
        // Tickets créés ce mois-ci
        $currentMonthTickets = Ticket::whereMonth('created_at', $currentDate)->count();
    
        $percentagePreviousDay = ($previousDayTickets > 0) ? ($currentDayTickets / $previousDayTickets) * 100 : 0;
        $percentagePreviousMonth = ($previousMonthTickets > 0) ? ($currentMonthTickets / $previousMonthTickets) * 100 : 0;
    

        // Faire un diagramme area
        $ticketsPerDay = Ticket::select('created_at')
        ->whereDate('created_at', '>=', Carbon::now()->subDays(30))
        ->get()
        ->groupBy(function ($ticket) {
            return $ticket->created_at->format('Y-m-d');
        })
        ->map(function ($tickets) {
            return $tickets->count();
        });

        // Tickets créés par mois
        $ticketsPerMonth = Ticket::select('created_at')
            ->whereDate('created_at', '>=', Carbon::now()->subMonths(12))
            ->get()
            ->groupBy(function ($ticket) {
                return $ticket->created_at->format('Y-m');
            })
            ->map(function ($tickets) {
                return $tickets->count();
            });

            // Faire un diagramme donut
            $users = User::with(['roles', 'services', 'tickets'])->get();

            $data = [];
        
            foreach ($users as $user) {
                $totalTickets = $user->tickets->count();
        
                $label = $user->name;
                $label .= ($user->services->count() > 0) ? ' (avec service)' : ' (sans service)';
        
                foreach ($user->roles as $role) {
                    $data[] = [
                        'label' => $label . ' - ' . $role->name,
                        'value' => $totalTickets
                    ];
                }
            }
// dd($deletedUsers);
        return view('dashboard', compact('totalUsers','totalTickets','openTickets',
            'closedTickets','deletedTickets','deletedUsers',
            'percentagePreviousDay','percentagePreviousMonth',
            'ticketsPerDay','ticketsPerMonth','data'));
        }
}
