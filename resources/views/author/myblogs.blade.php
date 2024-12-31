@extends('layouts.default')

@section('title', config('app.name', 'SUMAN') . ' | My Blogs')

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

        .blog-list-image {
            max-width: 300px;
        }
    </style>
@endpush

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">My Blogs</h1>
            <a href="{{ route('blog.create') }}" class="btn btn-info">
                <i class="fas fa-plus"></i> Create A Blog
            </a>
        </div>        
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
                                Author: {{ $blog->user->name }}
                            </small>
                            <small class="text-muted">
                                Created: {{ $blog->created_at->format('Y-m-d') }} | Updated:
                                {{ $blog->updated_at->format('Y-m-d') }}
                            </small>
                            <div class="mt-3 action-buttons">
                                <a class="btn btn-primary btn-sm me-2" href="{{ route('blog.edit', $blog->id) }}">Edit</a>
                                <form action="{{ route('blog.destroy', $blog->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
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
            window.location.href = `/blog/myblog/${blogId}`;
        }
    </script>
@endpush
