<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostEditRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     *
     * This method handles the display of blog posts. It checks if the request is an AJAX
     * request to return a JSON response with HTML content and an empty check. Otherwise,
     * it returns the main view with the posts.
     *
     * @param  \Illuminate\Http\Request  $request  The incoming request instance.
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse  The view or JSON response.
     */
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
        $posts = $query->orderBy('created_at', 'DESC')->paginate(3);

        // If it's an AJAX request, return JSON with HTML and empty check
        if ($request->ajax()) {
            $view = view('partials.posts', compact('posts'))->render();

            return response()->json([
                'html' => $view,
                'isEmpty' => $posts->isEmpty(), // Check if posts are empty
            ]);
        }

        // For non-AJAX requests, return the main view
        return view('index', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     *
     * This method handles the display of the post creation form.
     *
     * @return \Illuminate\View\View  The view for creating a new post.
     */
    public function create()
    {
        // Return the view for creating a new post
        return view('create');
    }

    /**
     * Store a newly created post in storage.
     *
     * This method handles the creation of a new blog post. It validates the incoming
     * request data, processes the uploaded image (if provided), and saves the post
     * details to the database.
     *
     * @param  \App\Http\Requests\PostCreateRequest  $request  The validated request instance containing post data.
     * @return \Illuminate\Http\RedirectResponse  Redirects back with a success message upon successful creation.
     *
     * @throws \Illuminate\Validation\ValidationException  If the request validation fails.
     */
    public function store(PostCreateRequest $request)
    {
        $validated = $request->validated();

        // Initialize the image path variable
        $imagePath = null;

        if ($request->hasFile('image')) {
            // Get the uploaded image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images', $imageName, 'public');
        }

        // Create a new post
        $new_post = new Post();
        $new_post->title = $validated['title'];
        $new_post->content = $validated['content'];
        $new_post->save();

        // Create the image via the polymorphic relation
        if ($imagePath) {
            // Create the image record in the database
            $new_post->image()->create([
                'url' => 'images/' . $imageName, // The image URL to be saved
            ]);
        }

        return redirect()->back()->with('success', 'Post Created Successfully');
    }

    /**
     * Show the form for editing the specified post.
     *
     * This method handles the display of the post edit form.
     *
     * @param  \App\Models\Post  $post  The post instance to be edited.
     * @return \Illuminate\View\View  The view for editing the post.
     */
    public function edit(Post $post)
    {
        // Return the view for editing the post
        return view('edit', compact('post'));
    }

    /**
     * Update the specified post in the database.
     *
     * @param  \App\Http\Requests\PostEditRequest  $request  The validated request instance containing post data.
     * @param  \App\Models\Post  $post  The post model instance to be updated.
     * @return \Illuminate\Http\RedirectResponse  Redirects back with a success message upon successful update.
     *
     * This method performs the following actions:
     * - Validates the incoming request data.
     * - Updates the post's title, content, and active status.
     * - Handles image updates by deleting the old image (if it exists) and storing the new one.
     * - Saves the updated post to the database.
     */
    public function update(PostEditRequest $request, Post $post)
    {
        $validated = $request->validated();

        // Update post details
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->is_active = $request->has('is_active') ? 1 : 0;
        $post->save();

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image file if it exists
            if ($post->image) {
                $oldImagePath = public_path('storage/' . $post->image->url); // Ensure we're using 'url' here

                // Only unlink if it's a file and exists
                if (is_file($oldImagePath) && file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Delete the old image file
                }

                // Delete the old image record via polymorphic relation
                $post->image()->delete();
            }

            // Store new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images', $imageName, 'public'); // Correctly storing under 'public' disk

            // Create new image record via polymorphic relation
            $post->image()->create([
                'url' => 'images/' . $imageName,
            ]);
        }

        return redirect()->back()->with('success', 'Post Updated Successfully');
    }

    /**
     * Display the specified post.
     *
     * @param  \App\Models\Post  $post  The post instance to display.
     * @return \Illuminate\View\View  The view displaying the post details.
     */
    public function show(Post $post)
    {
        return view('show', compact('post'));
    }

    /**
     * Remove the specified post from storage.
     *
     * This method deletes the specified post from the database and removes
     * its associated image file from the storage if it exists.
     *
     * @param  \App\Models\Post  $post  The post instance to be deleted.
     * @return \Illuminate\Http\RedirectResponse  Redirects back with a success message.
     */
    public function destroy(Post $post)
    {
        // Delete the image from storage if it exists
        if ($post->image) {
            // Ensure we're using the 'url' field to get the image path
            $imagePath = public_path('storage/' . $post->image->url); // Using 'url' here

            // Check if the file exists and delete it
            if (file_exists($imagePath)) {
                unlink($imagePath); // Delete the image file
            }

            // Delete the image record from the database
            $post->image()->delete();
        }

        // Delete the post itself
        $post->delete();

        return redirect()->back()->with('success', 'Post and Image Deleted Successfully');
    }
}
