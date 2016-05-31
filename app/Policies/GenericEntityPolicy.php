<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GenericEntityPolicy
{
    use HandlesAuthorization;

    public static function view(User $user,$itemType)
    {
        if(method_exists("App\\Policies\\{$itemType}Policy",'view'))
        {
          return  call_user_func_array(["App\\Policies\\{$itemType}Policy","view"],[$user]);
        }
        return false;
    }
    public static function edit(User $user,$itemType)
    {
        if(method_exists("App\\Policies\\{$itemType}Policy",'edit'))
        {
        return    call_user_func_array(["App\\Policies\\{$itemType}Policy","edit"],[$user]);
        }
        return false;
    }
    public static function delete(User $user,$itemType)
    {
        if(method_exists("App\\Policies\\{$itemType}Policy",'delete'))
        {
           return call_user_func_array(["App\\Policies\\{$itemType}Policy","delete"],[$user]);
        }
        return false;
    }
    public static function create(User $user,$itemType)
    {
        if(method_exists("App\\Policies\\{$itemType}Policy",'create'))
        {
            return call_user_func_array(["App\\Policies\\{$itemType}Policy","create"],[$user]);
        }
        return false;
    }
 
}
