<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function showCreateForm()
    {
        return view('folders/create');
    }

    public function create(Request $request)
    {
        //モデルの永続化(DBに書き込む処理)
        $folder=new Folder();

        $folder->title=$request->title;

        $folder->save();



        return redirect()->route('tasks.index',['id'=>$folder->id,]);
    }
}
