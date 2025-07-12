<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'user_id',
        'body'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected function scopeFilter(Builder $query, array $key): void
    {
        $query->when($key['title'], function ($query) use ($key) {
            $query->whereLike('title', '%' . $key['title'] . '%');
        })->when($key['username'], function ($query) use ($key) {
            $query->whereHas('user', function ($query) use ($key) {
                $query->where('username', $key['username']);
            });
        })->when($key['category'], function ($query) use ($key) {
            $query->whereHas('category', function ($query) use ($key) {
                $query->where('slug', $key['category']);
            });
        });
    }
}
