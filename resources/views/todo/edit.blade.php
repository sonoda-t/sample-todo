@extends('app')

@section('content')
<div class="container">
    <h2 class="page-header">ToDo編集</h2>
    {!! Form::open(['route' => ['todo.update', $todo->id], 'method' => 'PUT']) !!}
    <div class="form-group">
        {!! Form::input('text', 'title', $todo->title, ['required', 'class' => 'form-control']) !!}
    </div>
    <button type="submit" class="btn btn-success pull-right">更新</button>
    {!! Form::close() !!}

    @forelse($todo->file as $file)
    <!-- <div><img src="{{ url($file->file_path . $file->file_name) }}" alt=""></div> -->
    <div><a href="{{ url('/pureimages/' . $file->todo_id . '/' . $file->file_name) }}"><img src="{{ url($file->file_path . $file->file_name) }}" alt=""></a></div>
    @empty
    <div>
      {!! Form::open(['route' => 'files.store', 'files' => true]) !!}
      <div class="form-group">
          {!! Form::hidden('id', $todo->id) !!}
          {!! Form::file('file', ['required', 'class' => 'form-control']) !!}
      </div>
      <button type="submit" class="btn btn-success pull-right">アップロード</button>
      {!! Form::close() !!}
    </div>
    @endforelse

    <div><a class="btn btn-info" href="/todo">戻る</a></div>
    <!-- Scripts -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</div>
@endsection
