
@extends('layouts.bbs_layout')

@section('content')
<div class="container mt-4">
    <div class="border p-4">
        <div class="form-group">
        <form action="{{ route('bbs.show', ['folder' => $folder->id,'task'=> $task->id]) }}" method="POST">
                @csrf
                
                <input
                    name="idOfTask"
                    type="hidden"
                    value="{{ $task->id }}"
                >
            

                <textarea  id="body" name="body" rows="7" cols="72"></textarea>
               
                <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    送信
                </button>
                <a class="btn btn-primary" href= "{{route('tasks.index', ['folder' => $folder->id]) }}" >戻る</a>
                </div>
            </form>
            
            @forelse($task->notes as $note)
                    <div class="border-top p-4">
                        
                        <time class="text-secondary">
                         {{ $note->created_at->format('Y.m.d H:i') }} 
                        </time>
                       
                        <p class="mt-2">
                            {!! nl2br(e($note->body)) !!}
                        </p>
                    </div>
                    <a class="btn btn-primary" href="{{ route('bbs.edit', ['folder' => $folder->id,'task'=> $task->id,'note' =>$note->id]) }}">
                    編集
                    </a>
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
                    value="{{ $note->id }}"
                    >
                    <button class="btn btn-danger">削除する</button>
                    </form>       
            @empty
                    <p>コメントはまだありません。</p>
            @endforelse
           
        </div>
    </div>
 </div>
 @endsection
 


