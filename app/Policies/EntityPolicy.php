<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EntityPolicy
{
    use HandlesAuthorization;


    protected static  function getEntityName()
    {
        $baseName=class_basename(get_called_class());
        $snakeName=snake_case($baseName);
        $entityName=explode('_',$snakeName)[0];
        return $entityName;
    }
    public static function view(User $user,$item=null)
    {
        $entityName=Static::getEntityName();
        return $user->hasPermissions(["{$entityName}_view"]);
    }
    public static function delete(User $user,$item=null)
    {
        $entityName=Static::getEntityName();
        return $user->hasPermissions(["{$entityName}_delete"]);
    }
    public static function edit(User $user,$item=null)
    {
        $entityName=Static::getEntityName();
        return $user->hasPermissions(["{$entityName}_edit"]);
    }
    public static function create(User $user,$item=null)
    {
        $entityName=Static::getEntityName();
        return $user->hasPermissions(["{$entityName}_create"]);
    }
}
