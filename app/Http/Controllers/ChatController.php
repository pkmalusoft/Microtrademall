<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\ChatEvent;
use App\Chat;
use App\User;
use Auth;
use DB;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('chat.chat');
    }

    // public function fetchAllMessages()
    // {
    //     $msg =  Chat::with('user')
    //             ->orWhere('user_id', Auth::user()->id)
    //             ->orWhere('reciever', Auth::user()->id)
    //             ->get();
    //     return $msg;
    // }


    public function fetchAllContacts()
    {
        $msg =  Chat::with('user')
                ->where('user_id', Auth::user()->id)
                ->orWhere('reciever', Auth::user()->id)
                // ->distinct(['reciever','user_id'])
                ->select('reciever','user_id', 'users.name as recievername')
                ->leftJoin('users','users.id','chats.reciever')
                ->get()
                ->toArray(); 
        if($msg){
            $contactIds = array();
            $userId = Auth::user()->id;
            $msg = array_reverse($msg);
            foreach ($msg as $key => $c) {
                if(!in_array($c['reciever'], $contactIds) && $c['reciever'] != $userId ){
                    $contactIds[] = $c['reciever'];
                }
                if(!in_array($c['user_id'], $contactIds) && $c['user_id'] != $userId ){
                    $contactIds[] = $c['user_id'];
                }
            }
            $contacts = array();
            // $contactIds = array_reverse($contactIds);
            $contactOrder = implode(',', $contactIds);
            if(count($contactIds)){
                $contacts = User::whereIn( 'id',$contactIds )
                ->orderByRaw("FIELD(id, $contactOrder)")
                ->get()
                ->toArray();

                $unseen = Chat::where('status','0')
                            ->where('reciever',Auth::user()->id)
                            ->where('deletedby','!=',Auth::user()->id)
                            ->select('user_id', DB::raw('count(*) as total'))
                            ->groupBy('user_id')
                            ->get()
                            ->toArray();
                // foreach ($contacts as $key => $con) {

                // }
            }
            return array('contacts' => $contacts, 'unseen' => $unseen);
        } else{
            return null;
        }
    }


    public function fetchChat($id)
    {   
        Chat::where('user_id', $id)->where('reciever',Auth::user()->id)->whereIn('status',[0,5])
            ->update(['status' => 1]);
        $msg =  Chat::with('user')

                ->where(function($query) use ($id){
                    $query->where('user_id',Auth::user()->id)->where('reciever',$id)
                        ->where('deletedby', '!=', Auth::user()->id);
                })
                ->orWhere(function($query) use ($id){
                    $query->where('user_id',$id)->where('reciever',Auth::user()->id)
                        ->where('deletedby', '!=', Auth::user()->id);
                })
                ->orderBy('chats.created_at', 'asc')
                ->get(); 
        return $msg;
    }

    public function updateMsgStatus($id){
        Chat::find($id)->where('reciever', Auth::user()->id)->update(['status' => 1]);
        return 'success';
    }

    public function deleteChat($id){
         $msg =  Chat::with('user')
                ->where(function($query) use ($id){
                    $query->where('user_id',Auth::user()->id)->where('reciever',$id)->where('deletedby','0');
                })
                ->orWhere(function($query) use ($id){
                    $query->where('user_id',$id)->where('reciever',Auth::user()->id)->where('deletedby','0');
                })
                ->orderBy('chats.created_at', 'asc')
                ->get() 
                ->toArray();
                if(count($msg) > 0){
                    Chat::with('user')
                    ->where(function($query) use ($id){
                        $query->where('user_id',Auth::user()->id)->where('reciever',$id)->where('deletedby', '0');
                    })
                    ->orWhere(function($query) use ($id){
                        $query->where('user_id',$id)->where('reciever',Auth::user()->id)->where('deletedby', '0');
                    })
                    ->update(['deletedby' => Auth::user()->id]);

                } else{
                    Chat::with('user')
                    ->where(function($query) use ($id){
                        $query->where('user_id',Auth::user()->id)->where('reciever',$id)->where('deletedby', $id);
                    })
                    ->orWhere(function($query) use ($id){
                        $query->where('user_id',$id)->where('reciever',Auth::user()->id)->where('deletedby', $id);
                    })->delete();
                }
        return 'success';
    }


    public function sendMessage(Request $request)
    {
        $chat = auth()->user()->messages()->create([
            'message' => $request->message,
            'reciever' => $request->reciever,
            'status' => 0
        ]);
            broadcast(new ChatEvent($chat->load('user')) )->toOthers();

        return ['status' => 'success'];
    }


    public function invitation($id){
        if($id == Auth::user()->id){
            return redirect()->route('chats');
        }

        $user = User::findOrFail($id);
        $chatCheck = $this->fetchChat($id);
        if(count($chatCheck) == 0){
            $chat = auth()->user()->messages()->create([
                'message' => 'Hi, i would like to add you.',
                'reciever' => $id,
                'status' => 5
            ]);
        }
        return redirect()->route('chats');
    }
}
