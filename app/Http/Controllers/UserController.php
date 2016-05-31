<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public  function index(Request $request)
    {
        $search=$request->q;
       $users= $this->searchUser($search);
        $data=[
          'users'=>$users,
        ];

      $this->authorize('view',ENTITY_USER);
        
        $request->flash();
        return view('user.index',$data);
    }
    public  function show(Request $request,User $user)
    {

        $data=[
            'user'=>$user,
        ];
        return view('user.show',$data);
    }
    public  function delete(Request $request,User $user)
    {
        $this->authorize('delete',ENTITY_USER);
        $user->delete();
        return redirect('/users');
    }
    public function showEdit(Request $request,User $user)
    {
        $this->authorize('edit',ENTITY_USER);
        $allPermissons=[];

        foreach (USER_PERMISSIONS as $key=>$value)
        {
            $allPermissons[$key]=$value[1];
        }

        $data=[
            'all_permissions'=>$allPermissons,
            'user'=>$user,
        ];
        return view('user.edit',$data);
    }
    public function update(Request $request,User $user)
    {
        $this->authorize('edit',ENTITY_USER);
        $permissions=array_keys($request->input('permissions'));
        $is_admin=$request->input('is_admin');
        $user->permissions=$permissions;
        $user->is_admin=$is_admin;
       $user->save();


        $data=[
            'user'=>$user,
        ];

        return view('user.show',$data);
    }
    public function profile(Request $request)
    {
        $data=[
            'user'=>$request->user(),
        ];

        return view('user.profile',$data);
    }
    protected function searchUser($search)
    {
        $query = User::exceptForCur();
        if (!empty($search)) {
            $query->where(function($query) use($search){
                $query->where('name', 'like', "%$search%")
                ->orWhere('email','like',"%$search%");
            });

        }

        return $query->paginate(5);
    }
}
