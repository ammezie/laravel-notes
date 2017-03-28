@extends('layouts.app')

@section('title', 'Edit note')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit note</div>
                    <div class="panel-body">
                        <form action="{{ route('notes.update', [$note->slug]) }}" method="POST" class="form" role="form">
                            <input type="hidden" name="_method" value="PATCH">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <input type="text" class="form-control" name="title" value="{{ $note->title }}">
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" name="body" rows="15">{{ $note->body }}</textarea>
                            </div>

                            <button class="btn btn-primary pull-right">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection