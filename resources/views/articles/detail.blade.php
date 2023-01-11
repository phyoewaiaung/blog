@extends("layouts.app")
@section("content")
    <div class="container">
        @if ($errors->any())
           <div class="alert alert-warning">
                <ul class="m-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
           </div>
        @endif
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">{{ $article->title }}</h5>
                <div class="card-subtitle mb-2 text-muted small">
                {{ $article->created_at->diffForHumans() }},
                Category: <b>{{ $article->category->name}}</b>,
                Created by: <b>{{ $article->user->name }}</b>
                </div>
                <p class="card-text">{{ $article->body }}</p>
                <a class="btn btn-secondary mx-3"
                href="{{ url("/articles/edit/$article->id") }}">
                Edit
                <a class="btn btn-warning"
                href="{{ url("/articles/delete/$article->id") }}">
                Delete
                </a>
            </div>
        </div>
        <ul class="list-group">
            <li class="list-group-item active">
            <b>Comments ({{ count($article->comments) }})</b>
            </li>
            @foreach($article->comments as $comment)
            <li class="list-group-item">
            <a href="{{ url("/comments/delete/$comment->id") }}"
                class="btn-close float-end">
            </a>
            {{ $comment->content }}
            <div class="small mt-2">
                By <b>{{ $comment->user->name }}</b>,
                {{ $comment->created_at->diffForHumans() }}
            </div>
            </li>
            @endforeach
        </ul>
        <form action="{{ url('/comments/add') }}" method="post">
            @csrf
            <input type="hidden" name="article_id"
            value="{{ $article->id }}">
            <textarea name="content" class="form-control mb-2"
            placeholder="New Comment"></textarea>
            <input type="submit" value="Add Comment"
            class="btn btn-secondary">
        </form>

        <div class="text-center mt-2">
            <a class=" btn btn-primary" href="/articles">Back</a>
        </div>
    </div>
@endsection
