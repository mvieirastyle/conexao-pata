<?php

namespace App\Http\Controllers;

use Jorenvh\Share\ShareFacade as Share;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PostController extends Controller
{
    private function getPostCacheKey($id)
    {
        return 'post_' . $id;
    }
    private function getPostsCacheKey()
    {
        $page = request('page', 1);

        $version = Cache::get('posts_cache_version', 1);

        return 'posts_' . $version . '_page_' . $page;
    }

    public function show(): View
    {
        $posts = Cache::remember($this->getPostsCacheKey(), now()->addHours(3), function () {
            return Post::query()->paginate(6)->withQueryString();
        });

        return view('pages.blog.index', [
            'posts' => $posts,
            'user' => Auth::user(),
        ]);
    }
    public function showAdd(): View
    {
        return view('pages.blog.new_post');
    }

    public function showPost(int $id)
    {
        $data = Cache::remember($this->getPostCacheKey($id), now()->addHours(3), function () use ($id) {

            $post = Post::findOrFail($id);

            $comments = Comment::where('post_id', $id)
                ->latest()
                ->get();

            return [
                'post' => $post,
                'comments' => $comments,
            ];
        });

        $url = url('/blog/post/' . $data['post']->id);

        $shareLinks = Share::page(
            $url,
            $data['post']->title
        )->facebook()->twitter()->whatsapp();

        return view('pages.blog.post', [
            'post' => $data['post'],
            'comments' => $data['comments'],
            'shareLinks' => $shareLinks,
        ]);
    }

    public function add(Request $request, int $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'description' => 'required',
        ]);

        Post::createNew($request->all(), $id);

        Cache::increment('posts_cache_version');

        return redirect('/blog');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required | image | max: 2048',
        ]);

        $path = $request->file('image')->store('images', 'public');

        return response()->json([
            'url' => Storage::url($path),
        ]);
    }


    public function delete(int $id)
    {
        Post::deletePost($id);

        Cache::increment('posts_cache_version');

        return redirect('/blog');
    }

    public function showEdit(int $postId)
    {
        $post = Post::findOrFail($postId);
        return view('pages.blog.edit', [
            'post' => $post,
        ]);
    }

    public function edit(Request $request, int $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'description' => 'required',
        ]);

        Post::updatePost($id, $request->all());

        Cache::increment('posts_cache_version');

        return redirect('/blog')->with('success', 'Sua publicação foi editada com sucesso');
    }
}
