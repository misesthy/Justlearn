<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Service;
use App\Models\Feedback;
use App\Models\Knowledge;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    
    //
    function index(){
        $results_knowleges=$this->getKnowledge();
        $results_tickets=$this->getTicket();
        return view('resutls', compact('results_knowleges','results_tickets'));
    }



    public function getTicket()
    {
        $search = request()->input('s');
        $ticket = Ticket::where('title', 'like', "%$search%")
                                ->orWhere('message', 'like', "%$search%")
                                ->paginate(10);
    
        foreach($ticket as $resultatTicket)
        {
            $id = $resultatTicket->id;
            $resultatTicket->service = Service::whereRelation('tickets','ticket_id', $id)->get(); 
            $resultatTicket->feedback = Feedback::where('ticket_id', $id)->get();
        }
        return  $ticket;
    }

    public function getKnowledge()
    {
        $search = request()->input('s');
        $resultatKnowledge = Knowledge::where('title', 'like', "%$search%")
                                        ->orWhere('short_text', 'like', "%$search%")
                                        ->orWhere('full_text', 'like', "%$search%")
                                        ->paginate(10);
        return $resultatKnowledge;
        
    }

}
