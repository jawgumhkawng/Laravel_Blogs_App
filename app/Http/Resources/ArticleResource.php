<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => Str::limit($this->body, 60),
            'category_name' => optional($this->category)->name ?? 'Unknown Category',
            'author' => optional($this->user)->name ?? 'Unknown User',
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s A'),
            'created_by' => $this->created_at->diffForHumans(),
            'image' => asset('images/' . $this->image),

        ];
    }
}
