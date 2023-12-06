<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\ArticleCreateRequest;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'detail']);
    }
   
    public function index(Request $request)
    {   
       if(isset($request->key))
       {
        $key = $request->key;
            $articles = Article::where(function($query) use ($key) {
            $query->where('title', 'like', '%' . $key .'%');
           
        })->latest()->paginate(12);
        
         if(Auth::user()){
            $id = Auth::user()->id;
            $user = User::find($id);
         
        
        return view('/articles.index',compact('articles','user'))->with('Deleted','Article Deleted!');

        } else {
            return view('/articles.index',compact('articles'))->with('Deleted','Article Deleted!');
        }
       }
       else
       {
         $articles = Article::latest()->paginate(6);
         if(Auth::user()){
            $id = Auth::user()->id;
            $user = User::find($id);
         
        
        return view('/articles.index',compact('articles','user'));

        } else {
            return view('/articles.index',compact('articles')); 
        }
       }
    }

    public function detail($id)
    {
        $data = Article::find($id);

        return view('/articles.detail', [
            'articles' => $data
        ]);
    }

    
    public function add()
    {
       $categories = Category::all();

       return view('/articles.add',  compact('categories'));

    }



    public function create()
    {
        $validator = validator(request()->all(), [
                'title' => 'required',
                'body' => 'required',
                'category_id' => 'required',
                'image' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
                ]);
        if($validator->fails()) {

            return back()->withErrors($validator);

          }

        $article = new Article;
        $article->title = request()->title;
        $article->body = request()->body;
        $article->user_id = auth()->user()->id;
        $article->category_id = request()->category_id;

        $imageName = date('YmdHis'). "." .request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $imageName);

        $article->image = $imageName;

        $article->save();

        return redirect('/articles')->with('Created', 'Article Created Successfully!');

    }

    public function edit($id)
    {
        $articles = Article::find($id);
        $categories = Category::all();

        return view('/articles.edit', compact('articles', 'categories'));
    }

    public function update($id)
    {

         $validator = validator(request()->all(), [
                'title' => 'required',
                'body' => 'required',
                'category_id' => 'required',
               
                ]);
      

        $article = Article::find($id);
        $article->title = request()->title;
        $article->body = request()->body;
        $article->user_id = auth()->user()->id;
        $article->category_id = request()->category_id;

    //    if(request()->hasfile('image')){
    //      $imageName = date('YmdHis'). "." .request()->image->getClientOriginalExtension();
    //     request()->image->move(public_path('images'), $imageName);

    //     $article->image = $imageName;
    //    }
       
        if(request()->image){
            $image = request()->file('image');
            $imageName = date('YmdHis').".".$image->getClientOriginalExtension();
            $image->move(public_path('/images'), $imageName);

            $article->image = $imageName;
       
           
        }

          if($validator->fails()) {

            return back()->withErrors($validator);

          }
      
         $article->save();

        return redirect('/articles')->with('Updated', 'Article update Successfully!');
    }

    public function delete($id)
    {
         $articles = Article::find($id);

        if(Gate::denies('article-delete', $articles)) {

        return view()->with('Auth', 'Unauthorize'); 

        }   

        $articles->delete();

        return redirect('/articles')->with('Deleted','Article Deleted!');
        
    }

}