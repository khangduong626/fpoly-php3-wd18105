<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    const PATH_VIEW = 'posts.';
    const PATH_UPLOAD = 'posts';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Post::query()->latest()->paginate(5);

        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:posts|max:50',
            'img' => 'nullable|image|max:1024',
            'describe' => 'nullable',
            'status' => [
                'required',
                Rule::in([
                    Post::STATUS_DRAFT,
                    Post::STATUS_PUBLISHED,
                ])
            ],
        ]);

        $data = $request->except('img');

        if ($request->hasFile('img')) {
            $data['img'] = Storage::put(self::PATH_UPLOAD, $request->file('img'));
        }

        Post::query()->create($data);

        return back()->with('msg', 'Thao tác thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
//            'title' => 'required|max:50|unique:posts,title,' . $post->id,
            'title' => [
                'required',
                'max:50',
                Rule::unique('posts')->ignore($post->id)
            ],
            'img' => 'nullable|image|max:1024',
            'describe' => 'nullable',
            'status' => [
                'required',
                Rule::in([
                    Post::STATUS_DRAFT,
                    Post::STATUS_PUBLISHED,
                ])
            ],
        ]);

        $data = $request->except('img');

        if ($request->hasFile('img')) {
            $data['img'] = Storage::put(self::PATH_UPLOAD, $request->file('img'));
        }

        $oldPathImg = $post->img;

        $post->update($data);

        if ($request->hasFile('img') && Storage::exists($post->img)) {
            Storage::delete($oldPathImg);
        }

        return back()->with('msg', 'Thao tác thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        if (Storage::exists($post->img)) {
            Storage::delete($post->img);
        }

        return back()->with('msg', 'Thao tác thành công');
    }
}
