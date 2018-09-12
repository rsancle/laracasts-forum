@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $thread->creator->name }} posted: {{ $thread->title }}</div>

                    <div class="card-body">
                        <article>
                            <div class="body">{{ $thread->body }}</div>
                        </article>

                        <hr>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($thread->replies as $reply)
                    @include('threads.reply')
                @endforeach
            </div>
        </div>

        @auth
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form method="POST" action="{{ route('addReply', $thread) }}">
                        @csrf
                        <div class="form-group">
                            <textarea name="body" id="body" rows="5" class="form-control" placeholder="Have something to say?"></textarea>
                            <button type="submit">Post</button>
                        </div>
                    </form>
                </div>
            </div>
        @endauth
    </div>
@endsection