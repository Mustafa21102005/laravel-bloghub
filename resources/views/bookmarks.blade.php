@extends('layouts.theme')

@section('title', 'My Bookmarked Posts')

@section('content')
    {{-- Page Header --}}
    <header class="masthead" style="background-image: url('{{ asset('theme/assets/img/post-bg.jpg') }}')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>My Bookmarked Posts</h1>
                        <span class="subheading">A Blog Website by <a href="https://wa.me/966545117570" target="_blank"
                                class="me">Mustafa</a></span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                @if ($bookmarkedPosts->count())
                    <div class="row">
                        @foreach ($bookmarkedPosts as $post)
                            <div class="post-preview">
                                <div class="card mb-3">
                                    <div class="row g-0 d-flex align-items-stretch">
                                        <div class="col-md-4">
                                            <div class="position-relative h-100 w-100" style="overflow: hidden;">
                                                <img src="{{ filter_var($post->image->url, FILTER_VALIDATE_URL) ? $post->image->url : asset('storage/' . $post->image->url) }}"
                                                    class="w-100 h-100 d-block" style="object-fit: cover;" alt="Post Image">

                                                <form action="{{ route('bookmarks.toggle', $post->id) }}" method="POST"
                                                    class="position-absolute top-0 end-0 m-2 bookmark-toggle-form"
                                                    data-auth="{{ auth()->check() ? 'true' : 'false' }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-light btn-sm shadow-sm"
                                                        data-bs-toggle="tooltip" title="Bookmark">
                                                        <i
                                                            class="{{ auth()->user()?->bookmarkedPosts->contains($post->id) ? 'ph-fill ph-bookmark-simple' : 'ph ph-bookmark-simple' }}"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h2 class="post-title">{!! \Illuminate\Support\Str::limit($post->title, 20, '...') !!}</h2>
                                                <p class="card-text">
                                                    {!! \Illuminate\Support\Str::limit($post->content, 40, '...') !!}
                                                </p>
                                                <p class="post-meta">
                                                    Posted on {{ $post->created_at->format('F d, Y') }}
                                                </p>
                                                <div class="d-flex">
                                                    <a href="{{ route('posts.show', $post->id) }}"
                                                        class="btn btn-primary me-2">Read More</a>
                                                    <a href="{{ route('posts.edit', $post->id) }}"
                                                        class="btn btn-warning me-2">Edit</a>
                                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger me-2">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if (!$loop->last)
                                    <hr class="my-4" />
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <h2 align="middle" class="mb-5">
                        You have no bookmarked posts.
                        <img src="https://fonts.gstatic.com/s/e/notoemoji/latest/1f638/512.gif" width="32">
                    </h2>
                @endif
            </div>
        </div>
    </div>
@endsection
