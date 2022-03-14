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
        $folder = new Folder();
        $folder->title = $request->title;

        $user = User::find(Auth::id());
        $user->folders()->save($folder);

        return redirect()->route('tasks.index', ['folder' => $folder->id,]);
    }
}
