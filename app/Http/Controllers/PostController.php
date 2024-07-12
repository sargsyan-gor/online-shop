<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request)
    {

        if ($request->submit and is_null($request->filter) and is_null($request->filterByPrice) and is_null($request->filterByPriceMax)){
            return redirect()->back()->with('error', 'you must filter posts by title, or by price.');
        }
        $query = $request->input('filter');
        if (!$query){
            $request->validate([
                'filterByPrice' => 'required_with:filterByPriceMax|gt:0',
                'filterByPriceMax' => 'required_with:filterByPrice|gt:0'
            ]);
        }
        $minimumPrice = $request->input('filterByPrice');
        $maximumPrice = $request->input('filterByPriceMax');
        if ($query) {
            $posts = Post::where('title', 'like', '%' . $query . '%')->get();
        }
        elseif ($minimumPrice AND $maximumPrice){
            $posts = Post::whereBetween('price', [$minimumPrice, $maximumPrice])->get();
        }
        else {
//            $posts = Post::paginate(3);

            $posts = Post::all();
        }
        return view('posts.main', compact('posts'));
    }

    public function postPage()
    {
        return view('posts/createPost');
    }

    public function createPost(Request $request)
    {
        $request->validate([
           'title' => 'required|min:6',
           'content' => 'required|min:12',
           'price' => 'required|numeric|gt:0',
           'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
        ]);

        $inputs = $request->all();
        if ($request->hasFile('image')) {
            $inputs['image'] = 'storage/' . Storage::disk('public')->putFile('images', $request->file('image'));
        }
        $inputs['user_id'] = auth()->id();
        $post = Post::create($inputs);
        return redirect()->route('index')->with('success', 'Post created successfully!');
    }

    public function editPage(Post $post)
    {
        return view('posts/editPost', compact('post'));
    }

    public function aboutPost(Post $post)
    {
        if (! Gate::allows('view', $post)) {
            abort(403, "you don't own this post");
        }
        return view('posts/post', compact('post'));
    }
    public function editPost($id,Request $request)
    {
        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->content = $request->post_content;
        $post->price = $request->price;
        if ($request->hasFile('image')) {
            $post['image'] = 'storage/' . Storage::disk('public')->putFile('images', $request->file('image'));
        }
        $post->save();

        return redirect()->route('adminPanel')->with('success', 'Post updated successfully!');
    }

    public function deletePost(Post $post)
    {
        $post->delete();
        return redirect()->back()->with('success', 'Post deleted successfully!');
    }
}
