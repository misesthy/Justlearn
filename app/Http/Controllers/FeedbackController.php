<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Category;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Requests\FeedbackRequest;
use App\Repositories\FeedbackRepository;
use Coderflex\LaravelTicket\Models\Label;
use Illuminate\Database\Eloquent\Builder;
use App\Notifications\AssignedFeedbackNotification;
use App\Notifications\NewFeedbackCreatedNotification;

class FeedbackController extends Controller
{

    private $feedbackRepository = null;

    public function __construct(FeedbackRepository $feedbackRepository) {
        $this->feedbackRepository = $feedbackRepository;
    }

    public function index(Request $request): View
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
            $feedbacks = Feedback::with('user:id,name,email')
            ->with('ticket')->latest()->simplePaginate(10);
        }else if(auth()->user()->hasRole('agent')){
            // dd(auth()->user()->services);
            // dd(Feedback::all()->where('services', auth()->user()->id)->latest()->simplePaginate(10));

            // $feedbacks = Feedback::all()->belongsToMany(Role::class)
            //     ->wherePivotIn('priority', [1, 2]);

            $user = auth()->user();
            $currentUserParam = $request->input('user');
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

            // $feedbacks = Feedback::where('ticket_id', function ($query) {
            //         $user = auth()->user();
            //         // dd($user->services->pluck('id'));
            //         $query->where('service_ticket.service_id', '=', $user->services->pluck('id'));
            //         // $query->where('tickets.id', '=', 'feedback.ticket_id');
            //     })->get()

                // $feedbacks = Feedback::where('ticket_id', function ($query) {
                //     $query->select('ticket_id')
                //         ->from('service_ticket')
                //         ->where('service_id', $user->services->pluck('id'));
                // })->get();

                $feedbacks = Feedback::whereIn('ticket_id', function ($query) {
                    $user = auth()->user();

                    $query->select('ticket_id')
                        ->from('service_ticket')
                        ->whereIn('service_id', $user->services->pluck('id'));
                })
                ->whereNull('deleted_at')
                ->with('user:id,name,email')
                ->with('ticket')
                ->when($currentUserParam, function (Builder $query,$currentUserParam){
                    return $query->where('user_id', '=', $currentUserParam);
                })
                ->latest('feedback.created_at')
                ->paginate();

            // $feedbacks = Feedback::all();

            // if($currentUserParam){
            //     $feedbacks 
            // }

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
        // $feedback = new Feedback();


        // $feedback->title = $request->input('title');
        // $feedback->message = $request->input('message');
        // $feedback->ticket_id = $ticket->id;
        // $feedback->user_id = auth()->user()->id;
        // $feedback->save();



        $feedback = new Feedback();
        $feedback->created_at = Carbon::parse($feedback->date)->format('Y-m-d H:i:s'); 
        $feedback = $this->feedbackRepository->add([
            'title'=> $request->input('title'),
            'message'=> $request->input('message'),
            'ticket_id'=> $ticket->id,
            'user_id' => auth()->user()->id,
            'created_at' => $feedback->created_at,
        ]);

        // dd($feedback);
        // Rediriger l'utilisateur vers la page du ticket avec un message de succès
        return redirect()->route('feedbacks.show', $feedback)->with('success', 'La réponse a été ajoutée avec succès.');

        // Vous pouvez également effectuer d'autres actions ici, comme envoyer une notification aux utilisateurs concernés

        // return response()->json(['message' => 'Réponse envoyée avec succès']);
    }

    public function show($id): View
    {
    
        // dd($feedback);
        // $feedback->load(['media', 'messages' => fn ($query) => $query->latest()]);
        // $feedback = $feedback::with('user:id,name,email')
        //     ->with('ticket')->get;

        
        $feedbacks = [Feedback::findOrFail($id)];
        if($feedbacks[0]){
            $ticket = Ticket::Where('id','=',$feedbacks[0]->ticket_id)->first();
        }

        return view('feedbacks.show', compact('feedbacks','ticket'));
    }
    public function showAll($id): View
    {   
        $ticket = Ticket::findOrFail($id);
        $feedbacks = Feedback::where('ticket_id', '=', $ticket->id)->latest()->paginate();
        return view('feedbacks.show', compact('feedbacks','ticket'));
    }

    public function edit($id): View
    {
        // $this->authorize('update', $feedback);

        // $labels = Label::visible()->pluck('name', 'id');

        $categories = Category::all();

        // $users = User::role('agent')->orderBy('name')->pluck('name', 'id');
        $feedback = Feedback::findOrFail($id);

        return view('feedbacks.edit', compact('feedback',  'categories'));
    }

    public function update(FeedbackRequest $request, $id)
    {
        // $this->authorize('update', $feedback);

        Feedback::where('id', $id)
        ->update([
               'title' => $request->title,
               'message' => $request->message,
        ]);
    

        // if ($feedback->wasChanged('assigned_to')) {
        //     User::find($request->input('assigned_to'))->notify(new AssignedFeedbackNotification($feedback));
        // }

        // if (!is_null($request->input('attachments')[0])) {
        //     foreach ($request->input('attachments') as $file) {
        //         $feedback->addMediaFromDisk($file, 'public')->toMediaCollection('feedbacks_attachments');
        //     }
        // }

        return $this->index();
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
