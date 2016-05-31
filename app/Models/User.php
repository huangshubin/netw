<?php

namespace App\Models;
use Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
use SoftDeletes;
    protected $fillable = [
        'name', 'email', 'password'
    ];
    protected $casts = [
        'is_admin' => 'boolean',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];

    /**
     * Set the permissions attribute on the model.
     *
     * @param  mixed  $value
     * @return $this
     */
    protected function setPermissionsAttribute($value){
        if(empty($value)) {
            $this->attributes['permissions'] = 0;
        }
        else {
            $bitmask = 0;
            foreach((array)$value as $permission){
                $bitmask = $bitmask |USER_PERMISSIONS[$permission][0];
            }

            $this->attributes['permissions'] = $bitmask;
        }

        return $this;
    }

    /**
     * Expands the value of the permissions attribute
     *
     * @param  mixed  $value
     * @return mixed
     */
    protected function getPermissionsAttribute($value){
        $permissions = [];
        foreach(USER_PERMISSIONS as $permission => $bitmask){
            if(($value & $bitmask[0]) == $bitmask[0]) {
                $permissions[$permission] = $bitmask[1];
            }
        }

        return $permissions;
    }

    /**
     * Checks to see if the user has the required permission
     *
     * @param  mixed  $permission Either a single permission or an array of possible permissions
     * @param boolean True to require all permissions, false to require only one
     * @return boolean
     */
    public function hasPermissions($permission, $requireAll = false){
        if ($this->is_admin) {
            return true;
        } else if(is_string($permission)){
            return !empty($this->permissions[$permission]);
        } else if(is_array($permission)) {
            if($requireAll){
                return count(array_diff($permission,array_keys($this->permissions))) == 0;
            } else {

                return count(array_intersect($permission, array_keys($this->permissions))) > 0;
            }
        }

        return false;
    }
    public function scopeExceptForCur($query)
    {
        $curUser=Auth::user();
        return $query->where(

             'id','<>',$curUser->id

        );
    }

}
