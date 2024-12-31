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
        </div>
    </div>
</div>

@endsection
