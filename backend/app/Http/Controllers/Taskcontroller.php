<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use App\Models\Folder;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Taskcontroller extends Controller
{
    // public function index(int $id)
    // {
    //     //フォルダデータをDBから取得
    //     //$folders=Auth::user()->User::folders()->get();
    //     $user_id=Auth::id();
    //     $folders=Folder::find($user_id)->get;
    //     // 選ばれたフォルダを取得する
    //     $current_folder = Folder::find($id);
    //     if (is_null($current_folder)) {
    //         abort(404);
    //     }
    //     // 選ばれたフォルダに紐づくタスクを取得する
    //     $tasks = $current_folder->tasks()->get();
    //     //view(テンプレートファイル名,テンプレートに関するデータ)
    //     return view('tasks/index', [
    //         'folders' => $folders,
    //         'current_folder_id' => $current_folder->id,
    //         'tasks' => $tasks,
    //     ]);
    // }
     public function showCreateForm(Folder $folder)
      {
         return view('tasks/create',[
             'folder_id'=>$folder->id
         ]);
      }

    public function index(Folder $folder)
    {


        // ユーザーのフォルダを取得する
        $user_id=Auth::id();
        $folders=Folder::where('user_id',$user_id)->get();

        $tasks = $folder->tasks()->get();

        if (Auth::user()->id !== $folder->user_id) {
            abort(403);
        }

        return view('tasks/index', [
        'folders' => $folders,
        'current_folder_id' => $folder->id,
        'tasks' => $tasks,
    ]);
    }


    // public function create(int $id,CreateTask $request)
    // {
    //     $current_folder = Folder::find($id);

    //     $task = new Task();
    //     $task->title = $request->title;
    //     $task->due_date = $request->due_date;

    //     $current_folder->tasks()->save($task);

    //     return redirect()->route('tasks.index', [
    //         'id' => $current_folder->id,
    //     ]);
    // }

    public function create(Folder $folder, CreateTask $request)
    {
        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        $folder->tasks()->save($task);

        return redirect()->route('tasks.index', [
            'folder' => $folder->id,
        ]);
    }


    // public function showEditForm(int $id, int $task_id)
    // {
    // $task = Task::find($task_id);

    // return view('tasks/edit', [
    //     'task' => $task,
    // ]);
    // }
    public function showEditForm(Folder $folder, Task $task)
    {
        $this->checkRelation($folder, $task);

        return view('tasks/edit', [
            'task' => $task,
        ]);
    }


//     public function edit(int $id, int $task_id, EditTask $request)
// {
//     // 1
//     $task = Task::find($task_id);

//     // 2
//     $task->title = $request->title;
//     $task->status = $request->status;
//     $task->due_date = $request->due_date;
//     $task->save();

//     // 3
//     return redirect()->route('tasks.index', [
//         'id' => $task->folder_id,
//     ]);
// }

    public function edit(Folder $folder, Task $task, EditTask $request)
    {

        $this->checkRelation($folder, $task);

    $task->title = $request->title;
    $task->status = $request->status;
    $task->due_date = $request->due_date;
    $task->save();
    return redirect()->route('tasks.index', [
        'folder' => $task->folder_id,
    ]);
    }


    private function checkRelation(Folder $folder, Task $task)
    {
    if ($folder->id !== $task->folder_id) {
        abort(404);
    }
    }

}
