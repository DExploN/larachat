@extends('layouts.app')
@section('footer_script')

@endsection
@section('content')
    <div class="container">

        @foreach($rooms as $room)
            <a href="{{route('rooms.show',['room'=>$room->id])}}" class="btn btn-primary mr-4 mb-2">{{$room->name}}</a>
        @endforeach

        <form action="{{route('rooms.store')}}" method="post">
            @csrf
            <input class="form-control mb-1" name="name" type="text"/>
            <button class="btn btn-primary" type="submit">Создать комнату</button>
        </form>
    </div>
@endsection
