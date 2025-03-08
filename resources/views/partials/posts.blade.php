@if ($posts->isEmpty())
    @if (request('show_hidden') == 'true')
        <h2 align="middle">
            No more hidden posts available.
            <img src="https://fonts.gstatic.com/s/e/notoemoji/latest/1f972/512.gif" width="32" height="32">
        </h2>
    @else
        <h2 align="middle">
            No more posts available for now.
            <img src="https://fonts.gstatic.com/s/e/notoemoji/latest/1f605/512.gif" width="32" height="32">
        </h2>
    @endif
    @foreach ($posts as $post)
        <div class="post-preview">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid" alt="Post Image"
                            style="object-fit: cover; height: 100%; width: 100%;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h2 class="post-title">{{ $post->title }}</h2>
                            <p class="card-text">
                                {!! \Illuminate\Support\Str::limit($post->content, 20, $end = '...') !!}
                            </p>
                            <p class="post-meta">
                                Posted on {{ $post->created_at->format('F d, Y') }}
                            </p>
                            <div class="d-flex">
                                <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary me-2">Read More</a>
                                <a href="{{ route('edit.post', $post->id) }}" class="btn btn-warning me-2">Edit</a>
                                <a href="{{ route('posts.delete', $post->id) }}" class="btn btn-danger me-2">Delete</a>
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
@endif
