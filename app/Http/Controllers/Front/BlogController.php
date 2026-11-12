<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;

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

    public function tag($tag_slug)
    {
        $tag = Tag::where('slug', $tag_slug)->first();
        $blogs = Blog::query()->whereHas('tags', function ($q) use ($tag_slug): void {
            $q->where('tags.slug', $tag_slug);
        })->get();
        $categories = Category::get();

        return view('front.pages.blog.tag', compact('blogs', 'tag', 'categories'));
    }
}
