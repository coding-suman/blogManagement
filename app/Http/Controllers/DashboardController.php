<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $blogs = Blog::where('user_id', auth()->id())->with('user')->paginate(10);
        return view('author.myblogs', compact('blogs'));
    }
    
    public function home(){
        $blogs = Blog::latest()->paginate(10);
        return view('welcome', compact('blogs'));
    }
}
