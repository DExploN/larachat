@extends('layouts.app')
@section('footer_script')

@endsection
@section('content')
    <div class="container">
        <table class="table">
            <tr>
                <th>Комната</th>
                <th>Создатель</th>
                <th>Принять</th>
                <th>Отказать</th>
            </tr>
            @foreach($rooms as $room)
                <tr>
                    <td>{{$room->name}}</td>
                    <td>{{$room->creator->name}}</td>
                    <td>
                        <form method="post"
                              action="{{route('rooms.invites.delete',['room'=>$room->id])}}">@csrf @method('delete')
                            <button type="submit" class="btn btn-success" name="status" value="1">Принять</button>
                        </form>
                    </td>
                    <td>
                        <form method="post"
                              action="{{route('rooms.invites.delete',['room'=>$room->id])}}">@csrf @method('delete')
                            <button type="submit" class="btn btn-danger" name="status" value="0">Отказать</button>
                        </form>
                    </td>
                </tr>

            @endforeach
        </table>
    </div>
@endsection
