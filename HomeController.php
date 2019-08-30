<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;

class HomeController extends Controller {
	
    public function index() {
		
	$page = Page::where('slug', '=', 'hello-world')->first();
		
		
	$page->body = str_replace("&lt;","<",str_replace("&gt;",">",preg_replace('/&lt;!--\\/\\/(.*)\\/\\/--&gt;/i', '${1}', $page->body, -1)));
	$page->body = preg_replace('/\[(.*?)\]/i','<${1}>', $page->body, -1);
		
		
	return view('home', compact('page'));		
    }
	
}
