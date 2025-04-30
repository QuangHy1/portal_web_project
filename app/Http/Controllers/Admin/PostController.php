<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Editor;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|object
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $posts = Post::with('editor')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('tags', 'like', '%' . $keyword . '%')
                    ->orWhereHas('editor', function ($editorQuery) use ($keyword) {
                        $editorQuery->where('full_name', 'like', '%' . $keyword . '%');
                    }); // Thêm tìm kiếm theo tên editor
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.posts.index', compact('posts', 'keyword'));
    }


    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|object
     */
    public function create()
    {
        $editors = Editor::all();
        return view('admin.posts.create', compact('editors'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'editor_id' => 'required|exists:editors,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:posts,slug|max:255', // Thêm validation cho slug
            'content' => 'required|string',
            'status' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'view_count' => 'nullable|integer|min:0', // Thêm validation cho view_count
            'category' => 'nullable|string|max:255',
            'tags' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/posts', 'public');
            $validatedData['image'] = basename($imagePath);
        }
        // Nếu slug không được cung cấp, tự động tạo từ tiêu đề
        if (!isset($validatedData['slug'])) {
            $validatedData['slug'] = Str::slug($validatedData['title']);
        }

        Post::create($validatedData);

        return redirect()->route('admin.posts.index')->with('success', 'Tạo bài đăng thành công !');
    }

    /**
     * Display the specified post.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|object
     */
    public function show(Post $post)
    {
        //  Logic to display a single post.  Not used for the index page, but good to have.
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|object
     */
    public function edit(Post $post)
    {
        $editors = Editor::all();
        return view('admin.posts.edit', compact('post', 'editors'));
    }

    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'editor_id' => 'required|exists:editors,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:posts,slug,' . $post->id . '|max:255', // Validation cho slug khi update
            'content' => 'required|string',
            'status' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'view_count' => 'nullable|integer|min:0',  // Thêm validation cho view_count
            'category' => 'nullable|string|max:255',
            'tags' => 'nullable|string',
        ]);
        if (!isset($validatedData['slug'])) {
            $validatedData['slug'] = Str::slug($validatedData['title']);
        }

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::delete('public/uploads/posts/' . $post->image);
            }
            $imagePath = $request->file('image')->store('uploads/posts', 'public');
            $validatedData['image'] = basename($imagePath);
        }

        $post->update($validatedData);

        return redirect()->route('admin.posts.index')->with('success', 'Cập nhật bài đăng thành công !');
    }

    /**
     * Remove the specified post from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::delete('public/uploads/posts/' . $post->image);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Xóa thành công 1 bài đăng !');
    }
}
