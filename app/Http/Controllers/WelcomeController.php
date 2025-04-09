<?php

namespace App\Http\Controllers;

use App\Category;
use App\Destinations;
use App\Tag;
use App\Blog;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $search = request()->query('search');
        if (request()->query('search')) {
            $destinations = Destinations::with(['images', 'primaryImage'])
                ->where('title', 'LIKE', "%{$search}%")
                ->simplePaginate(3);
        } else {
            $destinations = Destinations::with(['images', 'primaryImage'])
                ->simplePaginate(3);
        }

        return view('welcome')
            ->with('destinations', $destinations)
            ->with('categories', Category::all())
            ->with('tags', Tag::all());
    }


    public function about()
    {
        return view('about');
    }

    public function packages()
    {
        return view('packages')
            ->with('categories', Category::withCount('destinations')->get())
            ->with('tags', Tag::all());
    }

    public function categoryDestinations($category)
    {
        $category = Category::findOrFail($category);
        $destinations = Destinations::with(['images', 'primaryImage'])
            ->where('category_id', $category->id)
            ->paginate(9);

        return view('category-destinations')
            ->with('category', $category)
            ->with('destinations', $destinations)
            ->with('categories', Category::withCount('destinations')->get())
            ->with('tags', Tag::all());
    }

    public function blog()
    {
        return view('blog')
            ->with('blogs', Blog::paginate(6))
            ->with('tags', Tag::all())
            ->with('categories', Category::all());
    }

    public function blogShow($id)
    {
        $blog = Blog::with('category')->findOrFail($id);
        $recentBlogs = Blog::with('category')
                           ->where('id', '!=', $id)
                           ->latest()
                           ->take(4)
                           ->get();
        
        $categories = Category::withCount('blogs')
                             ->orderBy('blogs_count', 'desc')
                             ->get();
        
        return view('blog.show')
            ->with('blog', $blog)
            ->with('recentBlogs', $recentBlogs)
            ->with('categories', $categories)
            ->with('tags', Tag::all());
    }

    public function contact()
    {
        return view('contact')
            ->with('categories', Category::all())
            ->with('tags', Tag::all());
    }

    public function Bali()
    {
        return view('Bali')
            ->with('destinations', Destinations::all())
            ->with('tags', Tag::all())
            ->with('categories', Category::all());
    }

    public function cart()
    {
        return view('cart')
            ->with('destinations', Destinations::first())
            ->with('tags', Tag::all())
            ->with('categories', Category::all());;
    }

    public function checkout()
    {
        return view('checkout')
        ->with('destinations', Destinations::first());
    }

     public function stripe()
    {
        return view('stripe')
        ->with('destinations', Destinations::first());
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $destinations = Destinations::with(['primaryImage', 'category'])
            ->where('title', 'like', '%' . $query . '%')
            ->get();

        return view('search-results', [
            'destinations' => $destinations,
            'query' => $query,
            'categories' => Category::all(),
            'tags' => Tag::all()
        ]);
    }

    public function share()
    {
        return view('share');
    }

    public function shareSearch(Request $request)
    {
        $query = $request->input('query');
        $destinations = Destinations::where('title', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->orWhere('content', 'like', '%' . $query . '%')
            ->orWhere('location', 'like', '%' . $query . '%')
            ->with(['primaryImage', 'category'])
            ->get();

        return view('share', compact('destinations', 'query'));
    }

}
