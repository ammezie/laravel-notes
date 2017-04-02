@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">My notes</div>
                    <div class="panel-body">
                        @if($notes->isEmpty())
                            <p>
                                You have not created any notes! <a href="{{ url('create') }}">Create one</a> now.
                            </p>
                        @else
                        <ul class="list-group">
                            @foreach($notes as $note)
                                <li class="list-group-item">
                                    <a href="{{ url('edit', [$note->slug]) }}">
                                        {{ $note->title }}
                                    </a>
                                    <span class="pull-right">{{ $note->updated_at->diffForHumans() }}</span>
                                </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection