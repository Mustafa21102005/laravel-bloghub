@extends('layouts.theme')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <!-- Page Header -->
    <header class="masthead"
        style="background-image: url('{{ asset('storage/' . $post->image) }}'); background-size: cover; background-position: center;">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="post-heading">
                        <h1>{{ $post->title }}</h1>
                        <span class="meta">Posted on {{ $post->created_at->format('F d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content -->
    <main class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <article style="word-wrap: break-word; max-width: 100%;">
                        <p>{!! $post->content !!}</p>
                    </article>
                    <div class="clearfix">
                        <a class="btn btn-primary float-right" href="{{ route('posts.index') }}">
                            <i class="fa-solid fa-arrow-left"
                                style="color: #ffffff; font-size: 1.2em; margin-right: 0.5em; vertical-align: middle;"></i>
                            Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
