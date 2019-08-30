<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;

class PageController extends Controller {

	public function index(Request $request) {
		
	}
		
	public function show(Request $request, $slug) {
		
			$page = Page::where('slug', '=', 'hello-world')->first();
		
		
			$page->body = str_replace("&lt;","<",str_replace("&gt;",">",preg_replace('/&lt;!--\\/\\/(.*)\\/\\/--&gt;/i', '${1}', $page->body, -1)));
			$page->body = preg_replace('/\[(.*?)\]/i','<${1}>', $page->body, -1);
		
		
		return view('home', compact('page'));		
	}
}
