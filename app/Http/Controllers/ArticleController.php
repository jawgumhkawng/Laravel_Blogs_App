<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleCreateRequest;

class ArticleController extends Controller
{
    public function index()
    {   
        $data = Article::latest()->paginate(5);

        
        return view('/articles.index',[
            'articles' => $data
        ]);
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
        $data = [
            [ "id" => 1, "name" => "News" ],
            [ "id" => 2, "name" => "Tech" ],
            ];
        return view('articles.add', [
            'categories' => $data
            ]);
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
        $article->category_id = request()->category_id;

        $imageName = date('YmdHis'). "." .request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $imageName);

        $article->image = $imageName;

        $article->save();

        return redirect('/articles')->with('Created', 'Article Created Successfully!');

    }

    public function delete($id)
    {
        $articles = Article::find($id);

        $articles->delete();

        return redirect('/articles')->with('Deleted','Article Deleted!');
        
    }

}
