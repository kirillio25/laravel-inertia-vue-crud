<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::paginate(10);

        return Inertia::render('Posts', [
            'posts' => PostResource::collection($posts),
        ]);
    }

//    public function index(Request $request)
//    {
//        $users = User::when($request->search, function ($query) use ($request) {
//            $query->where('name', 'like', '%' . $request->search . '%')
//                ->orWhere('email', 'like', '%' . $request->search . '%');
//        })->paginate(5)->withQueryString();
//
//        return Inertia::render('Home', [
//            'users' => $users,
//            'searchTerm' => $request->search,
//            'can' => [
//                'delete_user' => Auth::user()
//                    ? Auth::user()->can('delete', User::class)
//                    : null,
//            ],
//        ]);
//    }

    public function create()
    {
        //
    }

    public function store(StorePostRequest $request)
    {
        //
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        //
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    public function destroy(Post $post)
    {
        //
    }
}
