@extends('layouts.bbs_layout')

@section('content')


    <div class="container mt-4">
        <div class="border p-4">
        
            <h1 class="h5 mb-4">
                コメントの編集
            </h1>
            <p>Folder title : {{ $folder->title }} </p>
            
            

                    <div class="form-group">
                        <label for="body">
                            Task title : {{$task->title}}
                        </label>
                        <form method="POST" action="{{ route('bbs.show', ['folder' => $folder->id,'task'=> $task->id]) }}">
                            @csrf
                            @method('PUT')
                                
                            <textarea
                            id="body"
                            name="body"
                            cols="72"
                            rows="7"
                            >{{$notes->body}}</textarea>
                            <input
                                    name="note_id"
                                   type="hidden"
                                    value="{{ $notes->id }}"
                            >   
                            <div class="mt-5">
                                <a class="btn btn-secondary" href="{{ route('bbs.show', ['folder' => $folder->id,'task'=> $task->id]) }}">
                                    キャンセル
                                </a>

                                <button type="submit" class="btn btn-primary">
                                    更新する
                                </button>
                        </form>
                            
                                <form
                                    style="display: inline-block;"
                                    method="POST"
                                    action="{{ route('bbs.show', ['folder' => $folder->id,'task'=> $task->id]) }}"
                                    >
                                    @csrf
                                    @method('DELETE')
                                    <input
                                    name="note_id"
                                    type="hidden"
                                    value="{{ $notes->id }}"
                                    >
                                    <button class="btn btn-danger">削除する</button>
                                </form>    
                           
                    </div>
                </fieldset>
            </form>
        </div>
    </div> 

@endsection