<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Knowledge;
use App\Models\Service;
use App\Models\Ticket;
use Illuminate\Http\Request;

class SearchController extends Controller
{   //

    public function index()
    {
        $result_ticket = $this->getTicket();
        $result_knowledge = $this->getKnowledge();
        return view('search', [
            'result_ticket' => $result_ticket,
            'result_ticket' => $result_knowledge
        ]);
    }
    public function getTicket()
    {
        $search = request()->input('search');
        $ticket = Ticket::where('title', 'like', "%$search%")
                                ->orWhere('message', 'like', "%$search%")
                                ->paginate(10);
        foreach($ticket as $resultatTicket)
        {
            $id = $ticket->id;
            $resultatTicket->service = Service::whereRelation('tickets','ticket_id', $id)->get(); 
            $resultatTicket->feedback = Feedback::where('ticket_id', $id)->get();
        }
        return  $resultatTicket;
    }

    public function getKnowledge()
    {
        $search = request()->input('search');
        $resultatKnowledge = Knowledge::where('title', 'like', "%$search%")
                                        ->orWhere('short_text', 'like', "%$search%")
                                        ->orWhere('full_text', 'like', "%$search%")
                                        ->get();
        return $resultatKnowledge;
        
    }
}
