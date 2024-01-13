<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleDetailResource;
use App\Http\Resources\ArticleResource;

class ArticleController extends Controller
{

    public function index(Request $request)
    {
        $query = Article::with('user', 'category', 'comments')->orderByDesc('id');

        if (isset($request->key)) {
            $key = $request->key;
            $query->where(function ($query) use ($key) {
                $query->where('title', 'like', '%' . $key . '%')
                    ->orWhere('body', 'like', '%' . $key . '%');
            });
        }
        if (isset($request->category->id)) {

            $query->where('category_id', $request->category->id);
        }

        $articles = $query->latest()->paginate(6);

        return ArticleResource::collection($articles)->additional(['message' => 'success']);
    }
    public function create(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|string',
                'body' => 'required|string',
                'category_id' => 'required',
                'image' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            ],
            [
                'category_id.required' => 'The category feild is required.',
            ]
        );

        $article = new Article;
        $article->title = $request->title;
        $article->body = $request->body;
        $article->user_id = auth()->user()->id;
        $article->category_id = $request->category_id;

        $imageName = date('YmdHis') . "." . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $imageName);

        $article->image = $imageName;

        $article->save();

        return ResponseHelper::success([], 'Articles Create Success!');
    }

    public function detail($id)
    {
        $articles = Article::with('user', 'category', 'comments')->findorfail($id);
        // $categories = Category::all();

        return ResponseHelper::success(new ArticleDetailResource($articles));
    }

    public function delete($id)
    {
        $article = Article::with('user', 'category', 'comments')->findorfail($id)->delete();

        return ResponseHelper::success($article);
    }
}
