<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostEditRequest;
use App\Models\Post;

class PostController extends Controller
{
    public function store(PostCreateRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images', $imageName, 'public');
        }

        $new_post = new Post();
        $new_post->title = $validated['title'];
        $new_post->content = $validated['content'];
        $new_post->image = $imagePath;
        $new_post->save();

        return redirect()->back()->with('success', 'Post Created Successfully');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Delete the image from storage if it exists
        if ($post->image) {
            $imagePath = public_path('storage/' . $post->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $post->delete();
        return redirect()->back()->with('success', 'Post Deleted Successfully');
    }

    public function update(PostEditRequest $request, $id)
    {
        $validated = $request->validated();
        $post = Post::findOrFail($id);

        // Update post details
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->is_active = $request->has('is_active') ? 1 : 0;

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($post->image) {
                $oldImagePath = public_path('storage/' . $post->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Store new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images', $imageName, 'public');

            // Update post image field
            $post->image = 'images/' . $imageName;
        }

        $post->save();

        return redirect()->back()->with('success', 'Post Updated Successfully');
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('show', compact('post'));
    }
}
