@extends('layouts.theme')

@section('title', 'Create Post')

@section('content')
    <header class="masthead" style="background-image: url('{{ asset('theme/assets/img/home-bg.jpg') }}')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="post-heading">
                        <h1>Create a new blog here</h1>
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

                        {{-- Show Errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Show Success Message --}}
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-floating">
                                <input class="form-control" value="{{ old('title') }}" name="title" type="text"
                                    placeholder="Enter your title..." required />
                                <label for="title">Title</label>
                            </div>
                            <br />
                            <div class="form-floating">
                                <textarea class="form-control" name="content" id="content" required>{{ old('content') }}</textarea>
                            </div>
                            <br />
                            <div class="form-floating">
                                <input class="form-control" type="file" name="image" required />
                                <label for="image">Upload Image</label>
                            </div>
                            <br />
                            <button class="btn btn-primary text-uppercase" type="submit">Create</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    {{-- Include CKEditor for rich text editing --}}
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    {{-- initialize CKEditor on the textarea with id 'content' --}}
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
