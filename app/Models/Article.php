<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;


    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function scopeFilter($articleQuery, $filters = [])
    {
        if ($search = $filters['search'] ?? null) {
            //logical grouping

            $articleQuery->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('body', 'LIKE', '%' . $search . '%');
            })
                ->orWhereHas('user', function (Builder $query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orwhere('email', 'like', '%' . $search . '%');
                });
        }

        if ($category = $filters['category'] ?? null) {
            $articleQuery->whereHas('category', function ($query) use ($category) {
                $query->where('name', $category);
            });
        }

        if ($username = $filters['user'] ?? null) {
            $articleQuery->whereHas('user', function ($query) use ($username) {
                $query->where('name', $username);
            });
        }
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
