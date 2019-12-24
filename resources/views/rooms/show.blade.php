@extends('layouts.app')
@section('footer_script')

@endsection
@section('content')
    <div class="container">
        <div class="col-12 mb-4">
            <b class="mr-1">Members:</b> {{$room->members->pluck('name')->implode(', ')}}
        </div>
        @if(count($usersForInvite))
            <form class="mb-4 form-group form-inline" method="post"
                  action="{{route('rooms.invites.store',['room'=>$room->id])}}">
                @csrf
                <select class="form-control" name="user">
                    @foreach($usersForInvite as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
                <button class="form-control btn btn-primary ml-2" type="submit">Выслать инвайт</button>
            </form>
        @endif
        <chat-component
            :routes="{{json_encode(['messages'=>route('rooms.messages.index',['room'=>$room->id]),'store'=>route('rooms.messages.store',['room'=>$room->id])])}}"
            room="{{$room->id}}">
        </chat-component>
    </div>
@endsection
