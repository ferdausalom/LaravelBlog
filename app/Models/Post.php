<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('excerpt', 'like', '%' . $search . '%');
        });
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    public function allComments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function storePost($request)
    {
        $this->user_id = auth()->user()->id;
        $this->title = $request->title;
        $processSlug = str_replace(' ', '-', $request->slug);
        $this->slug = strtolower($processSlug);
        $this->imgUpload($request);
        $this->excerpt = $request->excerpt;
        $this->body = $request->body;
        if ($request->featured) {
            $this->featured = 1;
        }
        $this->save();

        $this->categories()->sync(request('categories'));
    }

    protected function imgUpload($request)
    {
        if ($request->file('thumbnail')) {
            $this->thumbnail = $request->file('thumbnail')->store('thumbnails');
        } else {
            $this->thumbnail = "thumbnails/800x400.png";
        }
    }
}
