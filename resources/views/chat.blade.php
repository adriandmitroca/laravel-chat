@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Discussion (last 10 messages)</div>

                <div class="panel-body" id="messages">
                    @foreach($messages->reverse() as $message)
                        <p><strong>{{ $message->author }}</strong> [{{ $message->created_at }}]: {{ $message->content }}</p>
                    @endforeach
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Talk</div>

                <div class="panel-body">
                    <form action="{{ action('MessagesController@store') }}" method="POST" id="sendMessage">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" class="form-control" name="author" placeholder="Name" required value="{{ session()->get('nickname') }}">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="content" placeholder="Message" required></textarea>
                        </div>
                        <div class="form-group pull-right">
                            <button class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
