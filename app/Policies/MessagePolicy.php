<?php

namespace App\Policies;

use App\models\Message;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy extends EntityPolicy
{

    public static function reply(User $user,Message $message)
    {
      $b=$user->hasPermissions(['message_reply']);
        return $b;
    }
}
