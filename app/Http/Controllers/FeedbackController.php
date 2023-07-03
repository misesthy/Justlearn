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
    public function index(Request $request): View
    {
        $feedbacks = Feedback::with('user', 'categories', 'assignedToUser')
            ->when($request->has('category'), function (Builder $query) use ($request) {
                return $query->whereRelation('categories', 'id', $request->input('category'));
            })
            ->when(auth()->user()->hasRole('agent'), function (Builder $query) {
                $query->where('assigned_to', auth()->user()->id);
            })
            ->when(auth()->user()->hasRole('user'), function (Builder $query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->latest()
            ->paginate();

        return view('feedbacks.index', compact('feedbacks'));
    }

    public function create(): View
    {

        $ticket = Ticket::findOrFail('ticket_id');

        return view('feedbacks.create', compact('ticket'));
    }

    public function store(Request $request, $ticketId)
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

    public function show(Feedback $feedback): View
    {
        $this->authorize('view', $feedback);

        $feedback->load(['media', 'messages' => fn ($query) => $query->latest()]);

        return view('feedbacks.show', compact('feedback'));
    }

    public function edit(Feedback $feedback): View
    {
        $this->authorize('update', $feedback);

        $labels = Label::visible()->pluck('name', 'id');

        $categories = Category::visible()->pluck('name', 'id');

        $users = User::role('agent')->orderBy('name')->pluck('name', 'id');

        return view('feedbacks.edit', compact('feedback', 'labels', 'categories', 'users'));
    }

    public function update(FeedbackRequest $request, Feedback $feedback)
    {
        $this->authorize('update', $feedback);

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
        $this->authorize('delete', $feedback);

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
        $this->authorize('update', $feedback);

        $feedback->close();

        return to_route('feedbacks.show', $feedback);
    }

    public function reopen(Feedback $feedback)
    {
        $this->authorize('update', $feedback);

        $feedback->reopen();

        return to_route('feedbacks.show', $feedback);
    }

    public function archive(Feedback $feedback)
    {
        $this->authorize('update', $feedback);

        $feedback->archive();

        return to_route('feedbacks.show', $feedback);
    }
}
