<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\status;
use App\Models\Ticket;
use App\Models\Service;
use App\Models\Category;
use App\Models\Feedback;
use App\Models\Priority;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Requests\TicketRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Builder;
use App\Notifications\AssignedTicketNotification;
use App\Notifications\NewTicketCreatedNotification;

class TicketController extends Controller
{
    public function index(Request $request): View
    { 
        $tickets = Ticket::with('services', 'categories', 'priority','user')
            ->when($request->has('status'), function (Builder $query) use ($request) {
                return $query->where('status', $request->input('status'));
            })
            ->when($request->has('priority'), function (Builder $query) use ($request) {
                return $query->withPriority($request->input('priority'));
            })
            ->when($request->has('category'), function (Builder $query) use ($request) {
                return $query->whereRelation('categories', 'id', $request->input('category'));
            })
            ->when($request->has('assigned_to'), function (Builder $query) use ($request) {
                return $query->where('services',$request->input('services') );
            })
            ->when(auth()->user()->hasRole('agent'), function (Builder $query) {
                $query->whereHas('services', function ($query) { 
                    $query->whereHas('users', function ($query) {
                        $query->where('users.id', auth()->user()->id);
                    });
                    // dd($query);
                });
            })
            // ->when(auth()->user()->hasRole('user|agent'), function (Builder $query) {
            //     $query->where('user_id', auth()->user()->id);
            // })
            
            ->latest()
            ->paginate();

        return view('tickets.index', compact('tickets'));
    }

    public function create(): View
    {
        
        $categories = Category::all()->pluck('name', 'id');
        $priority = Priority::all()->pluck('name', 'id');
        $services = Service::all();
        $status = Status::all()->pluck('name', 'id');
        // dd($categories);
        return view('tickets.create', compact('categories','priority','services', 'status'));
    }

    public function storage(TicketRequest $request)
    {

        $user = auth()->user();

        $ticket = new Ticket();
        $ticket->title = $request->input('title');
        $ticket->message = $request->input('message');
        
        
        // $services = Service::whereIn('id', $serviceIds)->get();
        
        // $ticket->services()->sync($input);
        
        $priority = Priority::find($request->input('priority_id'));
        $ticket->priority()->associate($priority);

        $ticket->created_at = Carbon::parse($ticket->date)->format('Y-m-d H:i:s'); 
        
        $request->validated([
            'title' => 'required|string',
            'message' => 'required|string',
        ]);
        $user->tickets()->save($ticket);
        
        $ticket->categories()->sync($request->input('categories'));
        
        $services =$request->input('assigned_to');
        $input = implode(',',$services);
        
        // Associer le ticket aux services sélectionnés
        $ticket->services()->sync(explode(',', $input));

        // // Envoyer le ticket à chaque utilisateur des services sélectionnés
        // foreach ($services as $service) {
        //     $users = $service->users()->get();
        //     foreach ($users as $user) {
        //       // Envoyer le ticket par e-mail (vous pouvez modifier le code pour utiliser d'autres canaux de communication)
        //        Mail::to($user->email)->send(new AssignedTicketNotification($ticket));
        //     }

        // }

        
        return redirect()->route('tickets.index');

    }

    public function show(Ticket $ticket): View
    {
        $this->authorize('view', $ticket);

        $ticket->load(['media', 'messages' => fn ($query) => $query->latest()]);

        return view('tickets.show', compact('ticket'));
    }

    // public function view(User $user)
    // {
    //     $tickets = $user->tickets;

    //     return view('tickets', compact('tickets'));
    // }

    public function edit(Ticket $ticket): View
    {
        $this->authorize('update', $ticket);

        $categories = Category::all()->pluck('name', 'id');
        $priority = Priority::all()->pluck('name', 'id');
        $services = Service::all();
        $status = Status::all()->pluck('name', 'id');
        $users = User::role('agent')->orderBy('name')->pluck('name', 'id');

        return view('tickets.edit', compact('ticket', 'categories', 'users', 'priority', 'status', 'services'));
    }

    public function update(TicketRequest $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $ticket->update($request->only('title', 'message', 'status', 'priority', 'assigned_to'));

        $ticket->syncCategories($request->input('categories'));

        if ($ticket->wasChanged('assigned_to')) {
            Service::find($request->input('assigned_to'))->notify(new AssignedTicketNotification($ticket));
        }

        if (!is_null($request->input('attachments')[0])) {
            foreach ($request->input('attachments') as $file) {
                $ticket->addMediaFromDisk($file, 'public')->toMediaCollection('tickets_attachments');
            }
        }

        return redirect()->route('tickets.index');
    }

    public function replyToTicket(Request $request, $ticketId)
    {
        $ticket = Ticket::findOrFail($ticketId);
        $message = $request->input('message');

        // Créer une nouvelle réponse
        $feedback = new Feedback();
        $feedback->message = $message;
        $feedback->ticket()->associate($ticket);
        $feedback->save();

        // Vous pouvez également effectuer d'autres actions ici, comme envoyer une notification aux utilisateurs concernés

        return response()->json(['message' => 'Réponse envoyée avec succès']);
    }

    public function destroy(Ticket $ticket)
    {
        $this->authorize('delete', $ticket);

        $ticket->delete();

        return redirect()->route('tickets.index');
    }

    public function upload(Request $request)
    {
        $path = [];

        if ($request->file('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('tmp', 'public');
            }
        }

        return $path;
    }

    public function close(Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $ticket->close();

        return redirect()->route('tickets.show', $ticket);
    }

    public function reopen(Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $ticket->reopen();

        return redirect()->route('tickets.show', $ticket);
    }

    public function archive(Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $ticket->archive();

        return redirect()->route('tickets.show', $ticket);
    }
}
