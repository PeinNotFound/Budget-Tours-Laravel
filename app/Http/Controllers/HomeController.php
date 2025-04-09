<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Destinations;
use App\Category;
use App\Blog;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'destinationsCount' => Destinations::count(),
            'categoriesCount' => Category::count(),
            'postsCount' => Blog::count(),
            'usersCount' => User::count(),
            'recentDestinations' => Destinations::latest()->take(5)->get()
        ]);
    }
}
