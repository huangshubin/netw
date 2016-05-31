<?php

namespace App\Http\Controllers;

use App\models\Message;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->q;
        $relied = $request->r;
        $messages = $this->searchMessage($search, $relied);
        $data = [
            'messages' => $messages
        ];
        $request->flash();
        return view('message.index', $data);

    }

    public function show(Request $request, Message $message)
    {
        $data = [
            'message' => $message
        ];
        return view('message.show', $data);
    }

    public function createReply(Request $request, Message $message)
    {

        $this->authorize("reply",$message);
        $data = [
            'message' => $message
        ];
        return view('message.create_reply', $data);
    }

    public function sendReply(Request $request, Message $message)
    {
        $this->authorize("reply",$message);

        $validate = Validator::make($request->all(), [
            'reply_message' => 'required|min:10'

        ]);

        $validate->after(function ($validate) use ($message) {
            if ($message->is_reply) {
                $validate->errors()->add('replied', 'this message have replied');
            }
        });

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();

        }
        $replyMsg = $request->input('reply_message');
        $message->reply_message = $replyMsg;
        $message->is_reply = true;

        $message->save();

        $data = ['message' => $message,
            'tip' => 'Reply Success'
        ];
        return view('message.show', $data);
    }

    public function showDelete(Request $request, Message $message)
    {
        $this->authorize('delete',ENTITY_MESSAGE);
        $data = [
            'message' => $message,
            'action'=>'delete',
        ];

        return view('message.show',$data);
    }

    public function delete(Request $request, Message $message)
    {
        $this->authorize('delete',ENTITY_MESSAGE);
        
        $message->delete();
        return redirect()->to('message/manage');
    }

    public function manage(Request $request)
    {
        $search = $request->q;
        $relied = $request->r;
        $messages = $this->searchMessage($search, $relied);
        $data = [
            'messages' => $messages
        ];
        $request->flash();
        return view('message.manage', $data);
    }

    protected function searchMessage($search, $relied)
    {
        $query = Message::query();
        if (!empty($search)) {
            $query->where(function ($squery) use ($search) {
                $squery->where('name', 'like', "%$search%")
                    ->orWhere('phone_number', 'like', "%$search%")
                    ->orWhere('message', 'like', "%$search%");
            });
        }

        if (!empty($relied)) {
            $query->where('is_reply', '=', $relied);
        }
        $messages = $query->orderBy('is_reply')->paginate(5);

        return $messages;
    }
}
