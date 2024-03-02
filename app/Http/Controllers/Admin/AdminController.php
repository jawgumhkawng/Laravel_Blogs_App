<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $categories = Category::all();
        $articles = Article::all();
        return view('/admin.index', compact('categories', 'articles', 'users'));
    }
}
