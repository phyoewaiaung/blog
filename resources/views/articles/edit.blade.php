@extends('layouts.app')
@section('content')
    <div class="container">
            @if ($errors->any())
               <div class="alert alert-warning">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
               </div>
            @endif
        <form method="post">
            @csrf
            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" value="{{ old($article->title) }}" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Body</label>
                    <textarea name="body" class="form-control">{{ old($article->body) }}</textarea>
                </div>
                <div class="mb-3">
                <label>Category</label>
                <select class="form-select" name="category_id">
                    @foreach($categories as $category)
                    <option value="{{ $category['id'] }}">
                    {{ $category['name'] }}
                    </option>
                    @endforeach
                </select>
            </div>
            <input type="submit" value="Update Article"
            class="btn btn-primary">
        </form>
    </div>
@endsection
