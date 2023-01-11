@extends('layouts.app')
@section('content')
    <div class="container">
        @if(session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif
        {{ $articles->links()}}
        @foreach($articles as $article)
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">{{ $article->title }}</h5>
                    <div class="card-subtitle mb-2 text-muted small">
                    {{ $article->created_at->diffForHumans() }},
                    Comments: ({{ count($article->comments) }}),
                    Created by: <b>{{ ($article->user_id == auth()->user()->id)? $article->user->name." (you)" : $article->user->name }}</b>
                    <hr>
                    </div>
                    <p class="card-text font-weight-bold">{{ $article->body }}</p>
                    <a class="card-link"
                    href="{{ url("/articles/detail/$article->id") }}">
                    View Detail &raquo;
                    </a>
                </div>
            </div>
        @endforeach
@endsection
