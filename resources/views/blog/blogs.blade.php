@extends('layouts.default')

@section('title', config('app.name', 'SUMAN') . ' | Blogs')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .blog-item {
            cursor: pointer;
        }

        .action-buttons {
            z-index: 2;
        }

        .blog-bg {
            background: #f2f2f2;
            border-radius: 1em;
            padding: 2em;
        }
    </style>
@endpush

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Blogs</h1>
        <div class="row">
            @foreach ($blogs as $blog)
                <div class="col-12 mb-4 blog-bg">
                    <div class="row align-items-center blog-item" onclick="redirectToViewPage({{ $blog->id }})">
                        <div class="col-md-4">
                            <img src="{{ asset('storage/' . $blog->image) }}" class="img-fluid rounded blog-list-image"
                                alt="Blog Image">
                        </div>
                        <div class="col-md-8">
                            <h3>{{ $blog->title }}</h3>
                            <p>{!! Str::limit(strip_tags($blog->content), 150, '...') !!}</p>
                            <small class="text-muted">
                                Author: {{ $blog->user->name }} | Date: {{ $blog->created_at->format('Y-m-d') }}
                            </small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $blogs->links('pagination::bootstrap-5') }}
        </div>
        
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function redirectToViewPage(blogId) {
            window.location.href = `/blogs/view/${blogId}`;
        }
    </script>
@endpush
