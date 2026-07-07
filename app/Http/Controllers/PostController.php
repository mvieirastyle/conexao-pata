<?php

namespace App\Http\Controllers;

use Jorenvh\Share\ShareFacade as Share;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PostController extends Controller
{
    public function show(): View
    {
        $posts = Post::where('status', 'aprovado')->paginate(6)->withQueryString();

        return view('pages.blog.index', [
            'posts' => $posts,
            'user' => Auth::user(),
        ]);
    }
    public function showAdd(): View
    {
        return view('pages.blog.new_post');
    }

    public function add(Request $request, int $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'description' => 'required',
        ]);

        Post::createNew($request->all(), $id);

        return redirect('/blog')->with('success', 'Sua publicação foi enviado com sucesso. Ela será postada assim que um administrador validar as sua informações. Obrigada pela contribuição!');
    }

    public function showPost(int $id)
    {
        $post = Post::findOrFail($id);

        $comments = Comment::where('post_id', $id)
            ->latest()
            ->get();

        $data = [
            'post' => $post,
            'comments' => $comments,
        ];

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

        return redirect('/blog')->with('success', 'Sua publicação foi editada com sucesso');
    }

    public function showManagePost()
    {
        $posts = Post::where('status', '!=', 'aprovado')->where('status', '!=', 'negado')->get();

        return view('pages.admin.blog.manage', [
            'posts' => $posts,
        ]);
    }
    public function acceptPost(int $id)
    {
        $post = Post::findOrFail($id);

        $post->update([
            'status' => 'aprovado'
        ]);

        return redirect('/admin/blog/posts')->with('success', 'Post aprovado com sucesso!');
    }

    public function rejectPost(int $id)
    {
        dd('kk');
        $post = Post::findOrFail($id);

        $post->update([
            'status' => 'negado'
        ]);

        return redirect('/admin/blog/posts')->with('success', 'Post rejeitado com sucesso!');
    }

    public function showManageComment(){
        $comments = Comment::where('status', '!=', 'aprovado')->where('status', '!=', 'negado')->get();

        return view('pages.admin.blog.manage-comment', [
            'comments' => $comments,
        ]);
    }

        public function acceptComment(int $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update([
            'status' => 'aprovado'
        ]);

        return redirect('/admin/blog/comments')->with('success', 'Comentario aprovado com sucesso!');
    }

    public function rejectComment(int $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update([
            'status'=> 'negado'
            ]);
       
        return redirect('/admin/blog/comments')->with('success','Comentario negado com sucesso!');
    }
}
