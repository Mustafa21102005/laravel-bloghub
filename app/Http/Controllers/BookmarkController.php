<?php

namespace App\Http\Controllers;

use App\Models\Post;

class BookmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookmarkedPosts = auth()->user()->bookmarkedPosts()->latest()->paginate(10);
        return view('bookmarks', compact('bookmarkedPosts'));
    }

    /**
     * Toggle bookmark on a given post
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggle(Post $post)
    {
        $user = auth()->user();

        if ($user->bookmarkedPosts()->where('post_id', $post->id)->exists()) {
            $user->bookmarkedPosts()->detach($post->id);
            $bookmarked = false;
        } else {
            $user->bookmarkedPosts()->attach($post->id);
            $bookmarked = true;
        }

        return response()->json(['bookmarked' => $bookmarked]);
    }
}
