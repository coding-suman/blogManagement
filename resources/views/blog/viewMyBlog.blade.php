@extends('layouts.default')

@section('title', $blog->title . ' | ' . config('app.name', 'SUMAN'))

@section('content')

<div class="container mt-5">
    <h1 class="mb-4">{{ $blog->title }}</h1>
    
    <div class="row">
        <div class="col-md-8">
            @if($blog->image)
                <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" class="img-fluid mb-4">
            @endif

            <div class="blog-content">
                {!! $blog->content !!}
            </div>
        </div>

        <div class="col-md-4">
            <h4>Author</h4>
            <span class="badge bg-info">{{ $blog->user->name }}</span>
            
            <h4>Created At</h4>
            <span class="badge bg-warning">{{ $blog->created_at->format('Y-m-d') }}</span>
            
            <h4>Tags</h4>
            <ul>
                @foreach(explode(',', $blog->tags) as $tag)
                <li><span class="badge bg-primary">{{ trim($tag) }}</span></li>
                @endforeach
            </ul>

            <div class="mt-3 action-buttons">
                <a class="btn btn-primary btn-sm me-2" href="{{ route('blog.edit', $blog->id) }}">Edit</a>
                <form action="{{ route('blog.destroy', $blog->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
            
        </div>
        <div class="col-md-4">
            
        </div>
    </div>

    <a href="{{ route('myblogs') }}" class="btn btn-secondary mt-4">Back to Blog List</a>
</div>

@endsection
