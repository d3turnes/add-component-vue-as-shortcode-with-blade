<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index(Request $request) {
		
		$posts = Post::paginate(10);
		
		return view('posts.index', compact('posts'));
		
	}
		
	public function show(Request $request, $slug) {
		
		$page = Post::where('slug', '=', $slug)->first();
		if (!is_null($page)) {		
			
			//<!--//<example-component name="example"></example-component>//--> 
			$page->body = str_replace("&lt;","<",str_replace("&gt;",">",preg_replace('/&lt;!--\\/\\/(.*)\\/\\/--&gt;/i', '${1}', $page->body, -1)));
			
			//[example-component name="example"][/example-component]
			$page->body = preg_replace('/\[(.*?)\]/i','<${1}>', $page->body, -1);
				
			return view('posts.single', compact('page'));		
		}
		
		return abort('404');
	}
}
