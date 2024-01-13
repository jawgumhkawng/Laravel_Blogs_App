<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleDetailResource extends JsonResource
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
            'body' => $this->body,
            'category_name' => optional($this->category)->name ?? 'Unknown Category',
            'author' => optional($this->user)->name ?? 'Unknown User',
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s A'),
            'created_by' => $this->created_at->diffForHumans(),
            'image' => asset('images/' . $this->image),

        ];
    }
}
