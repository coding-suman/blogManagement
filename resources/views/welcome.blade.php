@extends('layouts.default')

@section('content')

<div class="container my-4">
    <h1 class="mb-4">All Blogs</h1>

    <div class="row">
        @foreach($blogs as $blog)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if($blog->image)
                        <img src="{{ asset('storage/' . $blog->image) }}" class="card-img-top" alt="{{ $blog->title }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $blog->title }}</h5>
                        <p class="card-text">{{ Str::limit(strip_tags($blog->content), 100, '...') }}</p>
                        <a href="{{ route('blog.show', $blog->id) }}" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>    
    
    <div class="text-center mt-4">
        <a href="{{ route('blog.index') }}" class="btn btn-info">View All Blogs</a>
    </div>
    
</div>

@endsection

