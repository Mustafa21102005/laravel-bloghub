@extends('layouts.theme')

@section('title', 'Home')

@section('css')
    <style>
        .me {
            color: white;
        }

        .me:hover {
            color: #0085A1;
        }
    </style>
@endsection

@section('content')
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('{{ asset('theme/assets/img/post-bg.jpg') }}')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>Here are our newest blogs.</h1>
                        <span class="subheading">A Blog Website by <a href="https://wa.me/966545117570" target="_blank"
                                class="me">Mustafa</a></span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                {{-- show success message --}}
                @if (session('success'))
                    <div class="alert alert-success alert-sm text-center">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Main Content -->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7" id="posts">
                @include('partials.posts', ['posts' => $posts])
            </div>
            <div class="d-flex justify-content-center mb-3">
                <button class="btn btn-primary" id="load_more">Load More</button>
            </div>
        </div>
    </div>
@endsection

@section('js')
    {{-- js to handle load more button --}}
    <script>
        var page = 1;
        var showHidden = "{{ request('show_hidden') == 'true' ? 'true' : 'false' }}"; // Detect hidden posts mode

        $('#load_more').click(function() {
            $(this).prop('disabled', true).text('Loading...');

            $.ajax({
                type: 'GET',
                url: '{{ route('posts.index') }}',
                data: {
                    page: ++page,
                    show_hidden: showHidden // Maintain hidden post mode
                },
                dataType: 'json',
                success: function(response) {
                    if (response.isEmpty || $.trim(response.html) === '') {
                        $('#load_more').addClass('d-none'); // Hide button

                        // If we are in normal mode, show "Want to see hidden posts?"
                        if (showHidden !== 'true') {
                            $('#posts').append(`
                            <div class="alert alert-warning text-center mt-3">
                                There are no more posts to show. 
                                <a href="{{ route('posts.index', ['show_hidden' => 'true']) }}" class="fw-bold">
                                    Want to see hidden posts?
                                </a>
                            </div>
                        `);
                        }
                        // If we are already in hidden mode, show "No more hidden posts"
                        else {
                            $('#posts').append(`
                            <div class="alert alert-danger text-center mt-3">
                                There are no more hidden posts to show.
                            </div>
                        `);
                        }
                    } else {
                        $('#posts').append(response.html);
                        $('#load_more').prop('disabled', false).text('Load More');
                    }
                }
            });
        });
    </script>
@endsection
