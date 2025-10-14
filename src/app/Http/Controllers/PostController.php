<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::when($request->search, function ($query) use ($request) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        })
            ->orderBy($request->sort ?? 'id', $request->direction ?? 'asc')
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Posts', [
            'posts' => PostResource::collection($posts),
            'searchTerm' => $request->search,
        ]);
    }

    public function create()
    {
        $categories = Category::all();

        return Inertia::render('PostsCreate', compact('categories'));
    }


    public function store(StorePostRequest $request)
    {
        Post::create($request->validated());

        return redirect()->intended('/posts')->with('success', 'Пост добавлен!');
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        $categories = Category::all();

        return Inertia::render('PostsEdit', [
            'post' => $post, // просто модель
            'categories' => $categories,
        ]);
    }


    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->validated());

        return redirect()->route('posts.index')->with('success', 'Пост обновлён!');
    }


    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Пост удалён!');
    }
}
