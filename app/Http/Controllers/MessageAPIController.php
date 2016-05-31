<?php

namespace App\Http\Controllers;
use App\Models;
use App\models\Contact;
use App\models\Message;
use Illuminate\Http\Request;

use App\Http\Requests;

class MessageAPIController extends Controller
{
    public function post(Request $request)
    {

        $input=$request->all();
        $validator = \Validator::make($input, [
            'name' => 'required|max:255',
            'phone_number' => 'required|numeric|min:5',
            'message' => 'required|min:10',
        ]);

        if ($validator->fails()) {

            return response()->json(['success'=>false,'errors'=>$validator->errors()]);

        }

        $input=$request->all();

        $contact=new Message($input);
        $contact->save();

        return response()->json(['success'=>true]);

    }
}
