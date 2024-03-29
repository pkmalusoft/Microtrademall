<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.{receiverid}', function ($user, $receiverid) {
    return auth()->check();
     // $chat->user_id;
    // return $user;
});

Broadcast::channel('chat', function ($user) {
    if(auth()->check()){
        return $user;
    }
});