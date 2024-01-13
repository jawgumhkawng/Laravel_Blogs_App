<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ProfileResource;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = auth()->guard()->user();
        return ResponseHelper::success(new ProfileResource($user));
    }

    public function posts(Request $request)
    {
        $query = Article::with('user', 'category', 'comments')->orderByDesc('id')->where('user_id', auth()->user()->id);

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
}
