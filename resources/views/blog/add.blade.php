@extends('layouts.default')

@section('title', config('app.name', 'SUMAN') . ' | '. (isset($blog) ? 'Edit' : 'Add New') .' Blog')

@section('content')

<div class="container mt-5">
    <h1 class="mb-4">{{ isset($blog) ? 'Edit' : 'Add New' }} Blog</h1>
    <form action="{{ isset($blog) ? route('blog.update', $blog->id) : route('blog.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($blog))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="title" class="form-label">Blog Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Enter blog title" value="{{ old('title', $blog->title ?? '') }}">
            
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="image" class="form-label">Blog Image</label>
            @if(isset($blog) && $blog->image)
                <div>
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="Current Image" class="img-fluid" width="100">
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                </div>
            @else
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
            @endif
            
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="content" class="form-label">Blog Content</label>
            <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror" rows="10" placeholder="Write your blog content here...">{{ old('content', $blog->content ?? '') }}</textarea>
            
            @error('content')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="tags" class="form-label">Tags (Optional)</label>
            <input type="text" class="form-control @error('tags') is-invalid @enderror" id="tags" name="tags" placeholder="Comma-separated tags (e.g., Laravel, PHP, Blogging)" value="{{ old('tags', $blog->tags ?? '') }}">
            
            @error('tags')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>        

        <button type="submit" class="btn btn-success">@if(isset($blog)) Update @else Submit @endif Blog</button>
    </form>
</div>

@endsection

@push('head-scripts')
{{-- <script src="https://cdn.tiny.cloud/1/chr12di64klyia3ittp3qqlsmh45xhzfh/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

<script>
  tinymce.init({
    selector: '#content',  // Make sure TinyMCE applies only to the 'content' textarea
    setup: function (editor) {
        editor.on('blur', function () {
            document.querySelector('textarea[name="content"]').setCustomValidity('');
        });
    },
    plugins: [
      'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
      'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown','importword', 'exportword', 'exportpdf'
    ],
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [
      { value: 'First.Name', title: 'First Name' },
      { value: 'Email', title: 'Email' },
    ],
    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
  });
</script> --}}
@endpush
