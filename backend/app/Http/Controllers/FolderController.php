<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateFolder;
use App\Models\Folder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    public function showCreateForm()
    {
        return view('folders/create');
    }

    public function create(CreateFolder $request)
    {
        //モデルの永続化(DBに書き込む処理)
        $user_id=Auth::id();
        $user=User::find($user_id);
        $folder=new Folder();
        //$user_id=Auth::id();
        //$folder =Folder::find($user_id);

        $folder->title=$request->title;

        $user->folders()->save($folder);

        //$user_id=Auth::id();
        //$User_Folder=Folder::find($user_id);
        //Auth::user()->folders()->save($folder);

        return redirect()->route('tasks.index',['folder'=>$folder->id,]);

    }
}
