<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;
use App\Comment;
use App\Like;
use App\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Validator;
use Illuminate\Support\Facades\Log;
class PostsController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }
    public function home(){
    	$user = Auth::user();
    	$posts = Post::orderBy('created_at', 'desc')->get();
        $comments = Comment::orderby('created_at', 'asc')->get();
    	return view('home', compact('posts','comments'));
    }
    public function getPostImage($filename)
	{
	    $file = Storage::disk('local')->get($filename);
	    return new Response($file, 200);
	}

	public function getUserPage($user_id)
	{
	   $posts = Post::orderBy('created_at', 'desc')->where('user_id', $user_id)->get();
	   $comments = Comment::orderby('created_at', 'asc')->get();
	   return view('userpage', compact('posts', 'comments'))->with(['user_id' => $user_id]);
	}

	public function postCreatePost(Request $request)
	{
	   $validator = Validator::make($request->all(),[
	      'body' => 'required|max:1000'
	   ]);
	   if($validator->fails())
	   return back()->WithErrors($validator->errors()->all())->withInput();

	   $post = new Post();
	   $post->body = $request->body;
	   $message = 'There was an error';
	   $file = $request->file('image');
	   $random = str_random(16);
	   $filename = $random. '.jpg';
	   if ($file) {
	      $post->post_image = $filename;
	      $file->storeAs('/public/assets/img/posts/', $filename);
	   }
	   else {
	   	  $post->post_image = 'no-image.jpg';
	   }
	   if ($request->user()->posts()->save($post)) {
	      $message = 'Post successfully created!';
	   }
	   return redirect()->route('home')->with(['message' => $message]);
	}

	public function getDeletePost($post_id)
	{
		$post = Post::find($post_id);
        if($post) {
          $post->delete();

          return back()->with('success', 'Successfully deleted!');
        // swal()->success('Successfully Deleted',[]);
        }

        else {
          return back()->with('error', 'Error.');
        }

        return redirect()->route('home');
	}

	public function postEditPost(Request $request)
	{
	   $validator = Validator::make($request->all(),[
	      'body' => 'required|max:1000'
	   ]);
	   if($validator->fails())
	   return back()->WithErrors($validator->errors()->all())->withInput();

	   $post = Post::find($request->postId);
	   if (Auth::user() != $post->user) {
	      return redirect()->back();
	   }
	   $post->body = $request->body;
	   $post->update();
	   return response()->json(['new_body' => $post->body], 200);
	}
	public function postCreateComment(Request $request)
	{
	   $validator = Validator::make($request->all(),[
	      'comment' => 'required|max:1000'
	   ]);
	   if($validator->fails())
	   return back()->WithErrors($validator->errors()->all())->withInput();

	   $comment = new Comment();
	   $comment->comment = $request->comment;
	   $comment->post_id = $request->c_post_id;
	   $message = 'There was an error';
	   if ($request->user()->comments()->save($comment)) {
	      $message = 'Commented  successfully!';
	   }
	   return redirect()->route('home')->with(['message' => $message]);
	}

	public function postLikePost(Request $request, $id)
	{
   $post_id = $request->$id;
   $is_like = $request->isLike;
   if ($is_like == "Like") {
      $is_like = 0;
   } else {
      $is_like = 1;
   }

   $post = Post::find($id);
   $user = Auth::user();
   $like = $user->likes()->where('post_id', $id)->first();
   if ($like) {
      $already_like = $like->like;
      if ($already_like == $is_like) {
         $like->like = !$is_like;
         $like->delete();
      }
   } else {
      $like = new Like();
      $like->like = 1;
      $like->user_id = $user->id;
      $like->post_id = $id;
      $like->save();
   }

   $liked = $post->likes()->where('post_id', $id)->first();
   if($liked) {
      $num_likes = $post->likes()->where('like', 1)->count();
   }
   return back()->with('like', $like);
   }

}
