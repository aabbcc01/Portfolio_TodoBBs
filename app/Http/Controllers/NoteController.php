<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Folder;
use App\Note;
use App\Http\Requests\CreateNote;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Folder $folder, Task $task, CreateNote $request)
    {
        $note=new Note([
            'task_id'=> $request->get('idOfTask'),
             'body' => $request->get('body')
        ]);
        $note->save();
        //return redirect()->route('tasks.index',['folder' =>$request->idOfFolder]);
        return redirect()->route('bbs.show',['folder' => $folder->id,'task'=>$task->id]);
        //return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Folder $folder, Task $task)
    {

        return view('tasks/show', [
            'folder' => $folder,
            'task' => $task,
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Folder $folder, Task $task, Note $note)
    {
        
        $notes=Note::find($note->id);
        return view('tasks.editNotes',['folder' => $folder,
        'task' => $task,'notes'=>$notes,]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Folder $folder, Task $task,Note $note,Request $request)
    {
       $this->checkRelation($task, $request);
       $note =Note::findOrFail($request->note_id);
       $note->body=$request->body;
        $note->save();
        return redirect()->route('bbs.show',['folder' => $folder->id,'task'=>$task->id,]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Folder $folder,Task $task)
    {
        $id= $request->note_id;
        Note::find($id)->delete();
        return redirect()->route('bbs.show',['folder' => $folder->id,'task'=>$task->id]);
    }
    /**
     * フォルダとタスクの関連性があるか調べる
     * @param Task $task
     * @param Note $note
     */
    private function checkRelation(Task $task, Request $request)
    {
        //まずnote_idを含むNoteインスタンスを取り出す。
        $note=Note::findOrFail($request->note_id);
        if ($task->id !== $note->task_id) {
            abort(404);
        }
    }
}
