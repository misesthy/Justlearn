<?php
namespace App\Utils;

use App\Notifications\UserNotification;

class Notification {
    public static function worker($user, $data){
        foreach ($user as $users) {
            $users->notify(new UserNotification($users, $data));
        }
    }
}