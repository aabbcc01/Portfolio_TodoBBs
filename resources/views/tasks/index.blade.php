@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-4">
        <nav class="panel panel-default">
          <div class="panel-heading">カテゴリ</div>
          <div class="panel-body">
            <a href="{{ route('folders.create') }}" class="btn btn-default btn-block">
              カテゴリを追加する
            </a>
          </div>
          <div class="list-group">
            @foreach($folders as $folder)
              <a
                  href="{{ route('tasks.index', ['folder' => $folder->id]) }}"
                  class="list-group-item {{ $current_folder_id === $folder->id ? 'active' : '' }}"
              >
             {{ $folder->title }}
              </a>
                
              <form id="submitTitle_{{$folder->id}}" action="{{ route('tasks.index', ['folder' => $folder->id]) }}" method="POST" >
                @csrf
                <button id="editTitle_{{$folder->id}}"  type="button">Edit</button>
                <button id ="cansell_{{$folder->id}}" type ="button" onclick="clickBtn2_{{$folder->id}}()">Cansell</button>
                <input id="input_{{$folder->id}}" name="folder_title" type="text"  size="47" value="{{$folder->title}}"/>
                <input name="folder_id" type="hidden" value="{{ $folder->id }}"/>
               
              
              </form>
 
              <script>
           
              //初期表示は非表示
              document.getElementById("input_{{$folder->id}}").style.visibility ="hidden";
              document.getElementById("cansell_{{$folder->id}}").style.visibility ="hidden";
              document.getElementById("editTitle_{{$folder->id}}").addEventListener("click", function(event) {
                    //event.preventDefault();
                const editTitle = document.getElementById("editTitle_{{$folder->id}}");
                const inputarea= document.getElementById("input_{{$folder->id}}");
                const cansell=document.getElementById("cansell_{{$folder->id}}");
                const ta1 =document.getElementById("editTitle_{{$folder->id}}").value;
                if(inputarea.style.visibility=="visible"){
                  document.getElementById("submitTitle_{{$folder->id}}").submit();
                }else{
                  inputarea.style.visibility="visible";
                  cansell.style.visibility="visible"; 
                  document.getElementById("editTitle_{{$folder->id}}").textContent= '送信';
                }
              })

              function clickBtn2_{{$folder->id}}(){
                const editTitle = document.getElementById("editTitle_{{$folder->id}}");
                const cansell=document.getElementById("cansell_{{$folder->id}}");
                const inputarea= document.getElementById("input_{{$folder->id}}");
                const ta1 =document.getElementById("editTitle_{{$folder->id}}").value;
                editTitle.style.visibility="visible";
                cansell.style.visibility="hidden";
                inputarea.style.visibility="hidden";
                document.getElementById("editTitle_{{$folder->id}}").textContent= 'Edit';
              
              }
              
           </script>
            
            @endforeach
            
          </div>
        </nav>
      </div>
      <div class="column col-md-8">
        <div class="panel panel-default">
          <div class="panel-heading">タスク</div>
          <div class="panel-body">
            <div class="text-right">
              <a href="{{ route('tasks.create', ['folder' => $current_folder_id]) }}" class="btn btn-default btn-block">
                タスクを追加する
              </a>
            </div>
          </div>
          <table class="table">
            <thead>
            <tr>
              <th>タイトル</th>
              <th>件数</th>
              <th>状態</th>
              <th>期限</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
              <tr>
                <td>
                <a href="{{ route('bbs.show', ['folder' => $task->folder_id, 'task' => $task->id]) }}">
                {{ $task->title }}
                </a>
                </td>
                  @if ($task->notes->count())
                    <td>
                          <span class="badge badge-primary">
                              Note :  {{ $task->notes()->count() }}件
                          </span>
                    </td>
                  @else
                    <td>
                      <span class="badge badge-primary">
                              Note :  0 件
                      </span>
                    </td>
                  @endif
                <td>
                  <span class="label {{ $task->status_class }}">{{ $task->status_label }}</span>
                </td>
                <td>{{ $task->formatted_due_date }}</td>
                <td>
                  <a href="{{ route('tasks.edit', ['folder' => $task->folder_id, 'task' => $task->id]) }}">
                    編集
                  </a>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

@endsection