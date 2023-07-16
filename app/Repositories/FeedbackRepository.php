<?php

namespace App\Repositories;

use App\Models\Service;
use App\Models\Ticket;
use App\Models\Feedback;
use App\Models\User;
use App\Utils\Notification;
use Illuminate\Support\Facades\DB;

class FeedbackRepository
{
    public function add($data){
        DB::beginTransaction();
        $feedback = Feedback::create($data);
        $ticket = Ticket::find($data['ticket_id']);
       
        if($feedback->id) {
            $id = $data['user_id'];
           
            $user =User::find( $ticket->user_id);
            $sender =User::find($data['user_id']);
            
            $name = $sender->name;
        
            $message="L'agent ". $name ." vient de créér un feedBack pour votre ticket. vous pouvez consulter votre tableau de bord pour avoir accès à cela";
            $mail = [
                "subject" => "Creation d'un nouveau ticket",
                "msg" => $message,
            ];

            if($user->id != null){
                Notification::worker([$user], $mail);
            }
            
            

        }
        DB::commit();
        return $feedback;
    }
}