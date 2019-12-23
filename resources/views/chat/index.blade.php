@extends('layouts.app')
@section('footer_script')

@endsection
@section('content')
    <chat-component
        :routes="{{json_encode(['messages'=>route('chat.messages'),'store'=>route('chat.store')])}}"></chat-component>

    {{--        @foreach($messages as $message)--}}
    {{--            <div class="card mb-3">--}}
    {{--                <div class="card-body">--}}
    {{--                    <h5 class="card-title">{{$message->user->name}}</h5>--}}
    {{--                    <small class="text-muted mb-1">{{$message->created_at->format('H:i:s d.m.Y')}}</small>--}}
    {{--                    <div class="card-text">{{$message->text}}</div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        @endforeach--}}
    {{--        <form class="mt-3" id="message_form">--}}
    {{--            @csrf--}}
    {{--            <input type="text" class="form-control @if($errors->has('text')) is-invalid @endif" name="text"/>--}}

    {{--            <ul class="list-unstyled invalid-feedback mb-1 text_errors"></ul>--}}

    {{--            <button type="submit" class="btn btn-primary mt-3">Отправить</button>--}}
    {{--        </form>--}}
    {{--            <script>--}}

    {{--                let form = document.getElementById('message_form');--}}
    {{--                form.addEventListener('submit', function (event) {--}}
    {{--                    jQuery("[name=text]").removeClass("is-invalid");--}}
    {{--                    event.preventDefault();--}}
    {{--                    axios({--}}
    {{--                        'url': '{{ route('chat.store')}}',--}}
    {{--                    'method': 'post',--}}
    {{--                    'data': new FormData(event.target)--}}
    {{--                }).then(response => {--}}
    {{--                    jQuery("[name=text]").val('');--}}

    {{--                    }).catch(errors => {--}}
    {{--                        jQuery(".text_errors").empty()--}}
    {{--                        let validate_errors = errors.response.data.errors;--}}
    {{--                        jQuery("[name=text]").addClass("is-invalid");--}}
    {{--                        Object.keys(validate_errors).forEach(key => {--}}
    {{--                            jQuery("." + key + "_errors").append("<li>" + validate_errors[key][0] + "</li>")--}}
    {{--                        });--}}
    {{--                    }).finally(function () {--}}

    {{--                    })--}}
    {{--                });--}}

    {{--                Echo.channel('{{config('database.redis.options.prefix')}}' + 'chat')--}}
    {{--                    .listen('SendMessageEvent', (e) => {--}}
    {{--                        console.log(e);--}}
    {{--                    });--}}
    {{--            </script>--}}
@endsection
