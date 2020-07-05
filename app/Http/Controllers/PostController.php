<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Post;
use foo\bar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Auth::user()->posts()->paginate(2);
        return view('admin.posts.view-all-posts', ['posts' => $posts]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $this->authorize('create', Post::class);
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {

        $input = $request->all();

        if ($file = $request->file('post_image')){
           $path = $file->store('images');
            $input['post_image'] = $path;
        }
        $this->authorize('create', Post::class);
        Auth::user()->posts()->create($input);
        session()->flash('alert', $request->title.' post has been created.');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('single-blog', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // Authorize Policies
//        $this->authorize('view', $post);
        return view('admin.posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $input = $request->validate([
            'title' => 'required',
            'post_image' => 'file',
            'content' => 'required'
        ]);

        // First why to UPDATE Post
            if ($request->hasFile('post_image')){
                $input['post_image'] = $request->file('post_image')->store('images');
                $post['post_image'] = $input['post_image'];
            }
            $post->title = $input['title'];
            $post->content = $input['content'];
            $this->authorize('update', $post);
            Auth::user()->posts()->where('id', $post->id)->save($post); // aita dileo kaj kore
//            Auth::user()->posts()->save($post); // aita dileo kaj kore

//
//       // Second way to UPDATE POST
//        if ($request->hasFile('post_image')){
//            $file = $request->file('post_image')->store('images');
//            $input['post_image'] = $file;
//        }
//        Auth::user()->posts()->where('id', $post->id)->update($input);
//

            session()->flash('alert', 'Post has been updated.');
            return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
            $name = $post->title;
            Auth::user()->posts()->where('id', $post->id)->delete();

        session()->flash('alert', $name.' has been deleted.');
        // Authorize Policies
//        $this->authorize('delete', $post);
        return redirect()->back();

    }
}
