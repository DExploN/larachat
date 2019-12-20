@extends('layouts.app')
@section('content')
    <div class="container">
        @foreach($messages as $message)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{$message->user->name}}</h5>
                    <small class="text-muted mb-1">{{$message->created_at->format('H:i:s d.m.Y')}}</small>
                    <div class="card-text">{{$message->text}}</div>
                </div>
            </div>
        @endforeach
        <form class="mt-3" action="{{route('chat.store')}}" method="post">
            @csrf
            <input type="text" class="form-control @if($errors->has('text')) is-invalid @endif" name="text"/>
            @if ($errors->has('text'))
                <ul class="list-unstyled invalid-feedback mb-1">
                    @foreach ($errors->get('text') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <button type="submit" class="btn btn-primary mt-3">Отправить</button>
        </form>
    </div>
@endsection
