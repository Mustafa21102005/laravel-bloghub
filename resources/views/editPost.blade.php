@extends('layouts.theme')

@section('title', 'Edit Post')

@section('content')
    <header class="masthead" style="background-image: url('{{ asset('theme/assets/img/home-bg.jpg') }}')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="post-heading">
                        <h1>Edit a blog here</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="my-5">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="col-lg-6 mx-auto">
                                <div class="alert alert-success alert-sm text-center">
                                    {{ session('success') }}
                                </div>
                            </div>
                        @endif
                        <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-floating mb-3">
                                <input class="form-control" value="{{ $post->title }}" name="title" type="text"
                                    placeholder="Enter your title..." required style="border-radius: 5px;" />
                                <label for="title">Title</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" name="content" id="content" required>{{ $post->content }}</textarea>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                    {{ $post->is_active == 1 ? 'checked' : '' }} style="border-radius: 5px;">
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                            <div class="mb-3">
                                @if ($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="Current Post Image"
                                        class="img-fluid mb-3" style="max-width: 200px;">
                                @endif
                                <input class="form-control" type="file" name="image" accept="image/*" />
                            </div>
                            <br />
                            <button class="btn btn-primary text-uppercase" type="submit">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
