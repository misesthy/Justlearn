<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Requests\FeedbackRequest;
use Coderflex\LaravelTicket\Models\Label;
use Illuminate\Database\Eloquent\Builder;
use Coderflex\LaravelTicket\Models\Category;
use App\Notifications\AssignedFeedbackNotification;
use App\Notifications\NewFeedbackCreatedNotification;

class FeedbackController extends Controller
{
    public function index(): View
    {
        
        // $feedbacks = Feedback::with('user')
        //     // ->when($request->has('category'), function (Builder $query) use ($request) {
        //     //     return $query->whereRelation('categories', 'id', $request->input('category'));
        //     // })
        //     // ->when(auth()->user()->hasRole('agent'), function (Builder $query) {
        //     //     $query->where('assignedToUser', auth()->user()->id);
        //     // })
        //     ->when(auth()->user()->hasRole('user'), function (Builder $query) {
        //         $query->where('user_id', auth()->user()->id);
        //     })
        //     ->latest()
        //     ->paginate();



        if(auth()->user()->hasRole('user')){

        }else if(auth()->user()->hasRole('admin')){
            // dd(Feedback::paginate(10));
            //j'affiche pour l'administrateur l'ensemble des derniers feedback faits sur la plateforme
            $feedbacks = Feedback::latest()->simplePaginate(10);
        }else if(auth()->user()->hasRole('agent')){

            // dd(auth()->user()->services);
            // dd(Feedback::all()->where('services', auth()->user()->id)->latest()->simplePaginate(10));

            // $feedbacks = Feedback::all()->belongsToMany(Role::class)
            //     ->wherePivotIn('priority', [1, 2]);

            $user = auth()->user();
            // $feedbacks = Feedback::whereHas('services', function ($query) use ($user) {
            //     $query->whereIn('service_id',  $user->services->pluck('id'));
            // })->get();

            // $feedbacks = Feedback::join('tickets', 'feedbacks.ticket_id', '=', 'tickets.id')
            // ->join('services', 'tickets.service_id', '=', 'services.id')
            // ->whereIn('services.id', $user->services->pluck('id'))
            // ->get();

            /**** PROMPT GPT *******************************************
            la table feedback est en relation many to many avec la table service. 
            la table feedback est en relation many to one avec la table tickets. 
            la table ticket est en relation many to one avec la table user. 
            la table ticket est en relation many to many avec la table service. 


            J'aimerais faire une requête eloquent qui cherche les feedback des tickets ayant pour services les services de l'utilisateur courant ***/

            $feedbacks = Feedback::join('tickets', 'feedback.ticket_id', '=', 'tickets.id')
            ->join('service_ticket', 'tickets.id', '=', 'service_ticket.ticket_id')
            ->join('services', 'service_ticket.service_id', '=', 'services.id')
            ->whereIn('services.id', $user->services->pluck('id'))
            ->with('user:id,name,email')
            ->with('ticket')
            ->latest('feedback.created_at')
            ->paginate();

            // $feedback = Feedback::whereHas('owners', function($q) use($ownerIds) {
            //     $q->whereIn('id', $ownerIds);
            // })->get();

            // dd($feedbacks);




            // $feedbacks = Feedback::all()->where('likes', '>', request('likes_amount', 0))
            // ->latest()
            // ->paginate();
        }
        
        // dd('bonjour');

        return view('feedbacks.index', compact('feedbacks'));
    }

    public function create($id): View
    {
        $ticket = Ticket::findOrFail($id);
        return view('feedbacks.create', compact('ticket'));
    }

    public function store(Request $request, $id)
    {
        // Valider les données du formulaire de réponse
        $this->validate($request, [
            'title' => 'required|string',
            'message' => 'required|string',
        ]);

       
        // Récupérer le ticket correspondant à l'ID
        $ticket = Ticket::findOrFail($id);

        // Créer une nouvelle réponse
        $feedback = new Feedback();
        $feedback->title = $request->input('title');
        $feedback->message = $request->input('message');
        $feedback->ticket_id = $ticket->id;
        $feedback->user_id = auth()->user()->id;
        $feedback->save();

        // dd($feedback);
        // Rediriger l'utilisateur vers la page du ticket avec un message de succès
        return redirect()->route('feedbacks.show', $feedback)->with('success', 'La réponse a été ajoutée avec succès.');

        // Vous pouvez également effectuer d'autres actions ici, comme envoyer une notification aux utilisateurs concernés

        // return response()->json(['message' => 'Réponse envoyée avec succès']);
    }

    public function show(Feedback $feedback): View
    {
    
        // dd($feedback);
        // $feedback->load(['media', 'messages' => fn ($query) => $query->latest()]);

        return view('feedbacks.show', compact('feedback'));
    }

    public function edit(Feedback $feedback): View
    {
        // $this->authorize('update', $feedback);

        // $labels = Label::visible()->pluck('name', 'id');

        $categories = Category::visible()->pluck('name', 'id');

        $users = User::role('agent')->orderBy('name')->pluck('name', 'id');

        return view('feedbacks.edit', compact('feedback', 'labels', 'categories', 'users'));
    }

    public function update(FeedbackRequest $request, Feedback $feedback)
    {
        // $this->authorize('update', $feedback);

        $feedback->update($request->only('title', 'message', 'status', 'priority', 'assigned_to'));

        $feedback->syncCategories($request->input('categories'));

        $feedback->syncLabels($request->input('labels'));

        if ($feedback->wasChanged('assigned_to')) {
            User::find($request->input('assigned_to'))->notify(new AssignedFeedbackNotification($feedback));
        }

        if (!is_null($request->input('attachments')[0])) {
            foreach ($request->input('attachments') as $file) {
                $feedback->addMediaFromDisk($file, 'public')->toMediaCollection('feedbacks_attachments');
            }
        }

        return to_route('feedbacks.index');
    }

    public function destroy(Feedback $feedback)
    {
        // $this->authorize('delete', $feedback);

        $feedback->delete();

        return to_route('feedbacks.index');
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

    public function close(Feedback $feedback)
    {
        // $this->authorize('update', $feedback);

        $feedback->close();

        return to_route('feedbacks.show', $feedback);
    }

    public function reopen(Feedback $feedback)
    {
        // $this->authorize('update', $feedback);

        $feedback->reopen();

        return to_route('feedbacks.show', $feedback);
    }

    public function archive(Feedback $feedback)
    {
        // $this->authorize('update', $feedback);

        $feedback->archive();

        return to_route('feedbacks.show', $feedback);
    }
}
