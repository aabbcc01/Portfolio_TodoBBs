<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Http\Requests\CreateFolder;
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
        // フォルダモデルのインスタンスを作成する
        $folder = new Folder();
        // タイトルに入力値を代入する
        $folder->title = $request->title;

        // インスタンスの状態をデータベースに書き込む
        Auth::user()->folders()->save($folder);

        return redirect()->route('tasks.index', [
            'folder' => $folder->id,
        ]);
    }
    public function update(Folder $folder, Request $request)
    {
       //$this->checkRelation($task, $request);
       $validate_rule=['folder_title'=>'required',];
       $this->validate($request,$validate_rule);
       $folder =Folder::findOrFail($request->folder_id);
       $folder->title=$request->folder_title;
        $folder->save();
        return redirect()->route('tasks.index', ['folder' => $folder->id,
        ]);
    }
}