@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Article {{ $article->id }}
       @if(Auth::guest())
       <a href="{{ url('/register') }}" class="btn btn-primary btn-xs" title="Edit Article"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
       @else
        <a href="{{ url('articles/' . $article->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Article"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['articles', $article->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete Article',
                    'onclick'=>'return confirm("Confirm delete?")'
            ));!!}
        {!! Form::close() !!}
        @endif
    </h1>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $article->id }}</td>
                </tr>
                <tr><th> Id </th><td> {{ $article->id }} </td></tr><tr><th> Name </th><td> {{ $article->name }} </td></tr><tr><th> Body </th><td> {{ $article->body }} </td></tr>
            </tbody>
        </table>
@if($article->comments)

<div class="col-lg-10">
@foreach($article->comments as $comment)
 @if($comment->user_id != NULL)
      @foreach($users as $user)
            @if($comment->user_id == $user->id)
            <p>Author: {{$user->name}}<br/><span>{{ $comment->body }}</p>
            @endif
      @endforeach 
  @else
    <p>Author: Anonymous<br/><span>{{ $comment->body }}</p>
  @endif
@endforeach

</div>

@endif
    </div>
<div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/articles').'/'.$article->id.'/comment' }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @if(Auth::guest())
                        @else

                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        @endif
                        <div class="form-group">
                            <label for="body" class="col-md-4 control-label">Коментар</label>
                            <div class="col-md-6">
                                <textarea id="body" type="text" class="form-control" name="body"></textarea>

                            </div>
                        </div>

                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Коментирай!
                                </button>
                            </div>
                        </div>
                    </form>
            </div>

</div>
@endsection
