@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Articles @if(!Auth::guest()) <a href="{{ url('/articles/create') }}" class="btn btn-primary btn-xs" title="Add New Article"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>@endif</h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Id </th><th> Name </th><th> Body </th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($articles as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->id }}</td><td>{{ $item->name }}</td><td>{{ $item->body }}</td>
                    <td>
                        <a href="{{ url('/articles/' . $item->id) }}" class="btn btn-success btn-xs" title="View Article"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                       @if(!Auth::guest()) 
                        <a href="{{ url('/articles/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Article"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/articles', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Article" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Article',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ));!!}
                        {!! Form::close() !!}
                        @endif

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $articles->render() !!} </div>
    </div>

</div>
@endsection
