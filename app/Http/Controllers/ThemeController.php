<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index(Request $request)
    {
        // Default query for active posts (is_active = 1)
        $query = Post::where('is_active', 1);

        // Check if we need to fetch hidden posts
        if ($request->has('show_hidden') && $request->get('show_hidden') == 'true') {
            // Modify the query to fetch inactive posts (is_active = 0)
            $query = Post::where('is_active', 0);
        }

        // Paginate the posts (3 posts per page)
        $posts = $query->orderBy('created_at', 'DESC')->paginate(1);

        // If it's an AJAX request, return JSON with HTML and empty check
        if ($request->ajax()) {
            $view = view('partials.posts', compact('posts'))->render();

            return response()->json([
                'html' => $view,
                'isEmpty' => $posts->isEmpty(), // Check if posts are empty
            ]);
        }

        // For non-AJAX requests, return the main view
        return view('welcome', compact('posts'));
    }

    public function createPost()
    {
        return view('createPost');
    }

    public function editPost($id)
    {
        $post = Post::find($id);
        return view('editPost', [
            'post' => $post
        ]);
    }
}
