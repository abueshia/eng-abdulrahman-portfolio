<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();
        $categories = Category::all();

        return view('front.pages.blog.index', get_defined_vars());
    }

    public function details($slug)
    {
        $categories = Category::all();
        $blog = Blog::where('slug', $slug)->first();
        if (! $blog) {
            abort(404);
        }
        $blogs = Blog::latest()->limit(5)->where('id', '!=', $blog->id)->get();

        return view('front.pages.blog.details', get_defined_vars());
    }

    public function category($slug)
    {
        $category = Category::with('blogs')->where('slug', $slug)->first();

        if (! $category) {
            abort(404);
        }

        $categories = Category::all();

        return view('front.pages.blog.category', compact('category', 'categories'));
    }
}
