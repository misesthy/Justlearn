<?php

namespace App\Repositories;

use App\Models\Service;
use App\Models\Ticket;
use App\Models\User;
use App\Utils\Notification;
use Illuminate\Support\Facades\DB;

class TicketRepository
{
    public function add($data){
        DB::beginTransaction();
        $ticket = Ticket::create($data);
       
        $ticket->categories()->attach($data['id_categorie']);
        $ticket->services()->attach($data['id_service']);
        if($ticket->id) {
            $id = $data['user_id'];
            $service = $data['id_service'];
           
            $noms = User::where('id', $id)->first();
            foreach($service as $services){
                $user = User::whereRelation('services', 'service_id', $services)->role('agent')->get();
                $name = $noms->name;
            
                $message="L'utilisateur ". $name ." vient de créér un nouveau ticket. vous pouvez consulter votre tableau de bord pour avoir accès à cela";
                $mail = [
                    "subject" => "Creation d'un nouveau ticket",
                    "msg" => $message,
                ];
                // if(count($user)){
                //     Notification::worker($user, $mail);
                // }
            }
            

        }
        DB::commit();
        return $ticket;
    }
}